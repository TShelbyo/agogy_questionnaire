
//affichage choix question simple

$("ul li").click(function (){

valeur = new String($(this).text());
console.log(valeur);
if(valeur==' Jeter de la vodka') {

	$("#un").css('color','white');
	$("#un").css('background-color','#FF8C00');
	$("#un").css('padding','10px');
	$("#un").css('border-radius','3px');

	$("#deux").css('color','black');
	$("#deux").css('background-color','');
	$("#deux").css('border','');
	$("#deux").css('padding','10px');
	$("#deux").css('border-radius','3px');

	$("#trois").css('color','black');
	$("#trois").css('background-color','');
	$("#trois").css('border','');
	$("#trois").css('padding','10px');
	$("#trois").css('border-radius','3px');
}

else if(valeur==' Souffler') {

	$("#un").css('color','black');
	$("#un").css('background-color','');
	$("#un").css('border','');
	$("#un").css('padding','10px');
	$("#un").css('border-radius','3px');

	$("#deux").css('color','white');
	$("#deux").css('background-color','#FF8C00');
	$("#deux").css('padding','10px');
	$("#deux").css('border-radius','3px');

	$("#trois").css('color','black');
	$("#trois").css('background-color','');
	$("#trois").css('border','');
	$("#trois").css('padding','10px');
	$("#trois").css('border-radius','3px');
}
else {

	$("#un").css('color','black');
	$("#un").css('background-color','');
	$("#un").css('border','');
	$("#un").css('padding','10px');
	$("#un").css('border-radius','3px');

	$("#deux").css('color','black');
	$("#deux").css('background-color','');
	$("#deux").css('border','');
	$("#deux").css('padding','10px');
	$("#deux").css('border-radius','3px');

	$("#trois").css('color','white');
	$("#trois").css('background-color','#FF8C00');
	$("#trois").css('padding','10px');
	$("#trois").css('border-radius','3px');
}

});

//barre de progession circulaire

function createJauge(elem) {
  if (elem) {
    // on commence par un clear
    while (elem.firstChild) {
      elem.removeChild(elem.firstChild);
    }
    // création des éléments
    var oMask  = document.createElement('DIV');
    var oBarre = document.createElement('DIV');
    var oSup50 = document.createElement('DIV');
    // affectation des classes
    oMask.className  = 'progress-masque';
    oBarre.className = 'progress-barre';
    oSup50.className = 'progress-sup50';
    // construction de l'arbre
    oMask.appendChild(oBarre);
    oMask.appendChild(oSup50);
    elem.appendChild(oMask);
  }
  return elem;
}

function initJauge(elem) {
  var oBarre;
  var angle;
  var valeur;
  //
  createJauge( elem);
  oBarre = elem.querySelector('.progress-barre');
  valeur = elem.getAttribute('data-value');
  valeur = valeur ? valeur * 1 : 0;
  elem.setAttribute('data-value', valeur.toFixed(1));
  angle = 360 * valeur / 100;
  if (oBarre) {
    oBarre.style.transform = 'rotate(' + angle + 'deg)';
  }
}

// Initialisation après chargement du DOM
document.addEventListener('DOMContentLoaded', function () {
  var oJauges = document.querySelectorAll('.progress-circle');
  var i, nb = oJauges.length;
  for (i = 0; i < nb; i += 1) {
    initJauge(oJauges[i]);
  }
});

