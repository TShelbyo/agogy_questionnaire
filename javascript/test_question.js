
//affichage choix question simple

var valeur="";

function valider_reponse() {
	if(valeur!="") {
		if(valeur==' Jeter de la vodka') {
			click_rouge('un');
			click_vert('trois');

		}
		else if(valeur==' Souffler') {
			click_rouge('deux');
			click_vert('trois');

		}
		else {
			click_vert('trois');
		}

		affichage_bouton_explication();

		$("#un").css('pointer-events','none');
		$("#deux").css('pointer-events','none');
		$("#trois").css('pointer-events','none');

	}
}

$("ul li").click(function (){

valeur = new String($(this).text());
console.log(valeur);
if(valeur==' Jeter de la vodka') {

	click_couleur('un');

	click_suppr_couleur('deux');

	click_suppr_couleur('trois');
}

else if(valeur==' Souffler') {

	click_suppr_couleur('un');

	click_couleur('deux');

	click_suppr_couleur('trois');
}
else {
	
	click_suppr_couleur('un');

	click_suppr_couleur('deux');

	click_couleur('trois');
}

});
