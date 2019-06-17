
//affichage choix questions multiples
var valeur="";
var tab=new Array(4);
var tab_resultat=new Array(4);
var i=0;

//init_tab

for(var i=0;i<4;i++) {
	tab[i]=0;
}

///////////////////////////////////


function valider_reponse() {
	
	if(valeur!="") {
		if(tab_resultat[0]==' Orange' && tab_resultat[1]==' Bleu') {

			click_vert('un');
			click_vert('deux');

		}

		else if(tab_resultat[0]==' Orange') {

			click_vert('un');
			click_bleu('deux');

		}

		else if (tab_resultat[1]==' Bleu') {

			click_vert('deux');
			click_bleu('un');

		}
		else if(tab_resultat[2]==' Violet') {
			click_rouge('trois');
			click_vert('un');
			click_vert('deux');
		}
		else {
			click_rouge('trois');
			click_vert('un');
			click_vert('deux');
		}

		affichage_bouton_explication()

		$("#un").css('pointer-events','none');
		$("#deux").css('pointer-events','none');
		$("#trois").css('pointer-events','none');
		$("#quatre").css('pointer-events','none');


	}
}


$("ul li").click(function (){
valeur = new String($(this).text());
i++;
initialiser_padding();

if(valeur==' Orange') {

	tab[0]++;
	tab[0]=tab[0]%2;
	tab_resultat[0]=valeur;

	if(tab[0]==1) {

		click_couleur('un');
	}
	else {
		click_suppr_couleur('un');
	}

}

else if(valeur==' Bleu') {

	tab[1]++;
	tab[1]=tab[1]%2;
	tab_resultat[1]=valeur;

	if(tab[1]==1) {

			click_couleur('deux');
	}

	else {

	click_suppr_couleur('deux');
	}


}
else if(valeur==' Violet') {

	tab[2]++;
	tab[2]=tab[2]%2;
	tab_resultat[2]=valeur;

	if(tab[2]==1) {

		click_couleur('trois');
	}

	else {

	click_suppr_couleur('trois');

	}
}


else {

	tab[3]++;
	tab[3]=tab[3]%2;
	tab_resultat[3]=valeur;

	if(tab[3]==1) {

		click_couleur('quatre');
	}

	else {

		click_suppr_couleur('quatre');
	}
}

});
