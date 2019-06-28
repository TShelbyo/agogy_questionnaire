$("ul li").click(function (){

var valeur = new String($(this).val());
var index = $("ul li").index(this);

	
index=index-2;
console.log(index);
console.log(valeur);
//click_couleur('index');

/*$.ajax({ 
		type: "GET", 
		url: "../php/generation_questionnaire.php", 
		data: {fk_questionnaire : 'prout'},
		success: function(data) {
		alert(data); 
				document.location.href="../php/generation_questionnaire.php?fk_questionnaire="+valeur;
			}
		});*/

document.location.href="../php/generation_questionnaire.php?fk_questionnaire="+valeur;
/*
$("#affichage_question_questionnaire").load("../php/bdd.php", { // N'oubliez pas l'ouverture des accolades !
    fk_questionnaire : $(this).val(),
});*/

// setTimeout(suiteTraitement, 2000);

/*function suiteTraitement() {
	document.location.href="../php/generation_questionnaire.php";
}*/

});