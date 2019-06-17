function click_vert(champ) {
	$("#"+champ).css('background-color','#32CD32');
	$("#"+champ).css('color','white');
}

function click_rouge(champ) {
	$("#"+champ).css('background-color','red');
}

function click_bleu(champ) {
	$("#"+champ).css('background-color','#00BFFF');
}


function initialiser_padding() {

	$("#un").css('padding','10px');
	$("#deux").css('padding','10px');
	$("#trois").css('padding','10px');
	$("#quatre").css('padding','10px');
}

function click_couleur(champ) {

	$('#'+champ).css('color','white');
	$('#'+champ).css('background-color','#D3D3D3');
	$('#'+champ).css('padding','10px');
	$('#'+champ).css('border-radius','3px');
}

function click_suppr_couleur(champ) {

	$('#'+champ).css('color','black');
	$('#'+champ).css('background-color','');
	$('#'+champ).css('border','');
	$('#'+champ).css('padding','10px');
	$('#'+champ).css('border-radius','3px');
}

function affichage_bouton_explication() {
	$("#b2").css('display','block');
	$("#suivant").css('display','block');
}


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

