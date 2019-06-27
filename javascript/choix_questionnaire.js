$("ul li").click(function (){

var valeur = new String($(this).val());
var index = $("ul li").index(this);

	
index=index-2;
console.log(index);
console.log(valeur);
//click_couleur('index');

// $.ajax({ 
// 		type: "POST", 
// 		url: "../php/generation_questionnaire.php", 
// 		data: {fk_questionnaire : 'aaaaaaaaa'},
// 		async:false,
// 		success: function(data) {
// 		alert(data); 
// 				document.location.href="../php/generation_questionnaire.php";
// 			}
// 		});

$("#affichage_questionnaire").load("../php/bdd.php", { // N'oubliez pas l'ouverture des accolades !
    fk_questionnaire : $(this).val(),
});

/*setTimeout(suiteTraitement, 2000);

function suiteTraitement() {
	document.location.href="../php/generation_questionnaire.php";
}*/

});