    var canvas,
    context,
    dragging = false,
    dragStartLocation,
    dragEndLocation,
    snapshot,
    array_pt_debut=new Array(3),
    array_pt_fin=new Array(3),
    i=0,
    t=0;




function getCanvasCoordinates(event) {
    var x = event.clientX - canvas.getBoundingClientRect().left,
        y = event.clientY - canvas.getBoundingClientRect().top;
        //z = event.clientZ - canvas.getBoundingClientRect().right;

    return {x: x, y: y};
}

function takeSnapshot() {
    snapshot = context.getImageData(0, 0, canvas.width, canvas.height);
}

function restoreSnapshot() {
    context.putImageData(snapshot, 0, 0);
}


function drawLine(position) {
	if(i<=3) {
    	context.beginPath();
    	context.moveTo(0, dragStartLocation.y);
    	context.lineTo( canvas.getBoundingClientRect().right, position.y);
    	context.stroke();
    }
    
}

function drawLine_restore(position1,position2) {
	if(i<=3) {
    	context.beginPath();
    	context.moveTo(0, position1.y);
    	context.lineTo(canvas.getBoundingClientRect().right, position2.y);
    	context.stroke();
    }
    
}

function drag(event) {
    var position;
    if (dragging === true) {
        restoreSnapshot();
        position = getCanvasCoordinates(event);
        drawLine(position);
    }
   
}

function init() {

    canvas = document.getElementById("canvas");
    context = canvas.getContext('2d');
    context.strokeStyle = 'purple';
    context.lineWidth = 6;
    context.lineCap = 'round';

    canvas.addEventListener('mousemove', drag, false);

}

function clear_last_trait(champ) {
	array_pt_debut[champ]=null;
	array_pt_fin[champ]=null;

	if(t>0)
	t--;
}

function afficher_trait() {
	var p=0;

	for(p=0;p<t;p++) {
		drawLine_restore(array_pt_debut[p],array_pt_fin[p]);
		console.log(p+" : dbt -> "+ array_pt_debut[p].y+" fin-> " +array_pt_fin[p].y);
	}


	console.log('t :'+t);
}

function restore() {
	i--;
	context.clearRect(0,0,canvas.getBoundingClientRect().right-canvas.getBoundingClientRect().left,canvas.getBoundingClientRect().bottom-canvas.getBoundingClientRect().top);
	clear_last_trait(t);
	afficher_trait();
}

window.addEventListener('load', init, false);

$("#gauche_relies ul li").click(function (){
	   dragging = true;
    takeSnapshot();
	dragStartLocation = getCanvasCoordinates(event);
	array_pt_debut[t]=dragStartLocation;

});

$("#droite_relies ul li").mouseup(function (){
	dragging = false;
    restoreSnapshot();
    dragEndLocation = getCanvasCoordinates(event);
    i++;
    array_pt_fin[t]=dragEndLocation;
    drawLine(dragEndLocation);
  
	t++;
	
	console.log('x:'+ dragEndLocation.x+', y:'+dragEndLocation.y);
});