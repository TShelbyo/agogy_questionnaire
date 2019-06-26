var valeur;
var x=$('.question_liste2 li').length;
var tab=new Array(x);
var tab_resultat=new Array(x);
var m=$('.l_reponse #reponse').length;

//initialisation------------------------------------------------------------------

for(var i=1;i<=x;i++) {
	tab[i]=0;
}

for(var i=0;i<x;i++) {
	tab_resultat[i]=0;
}

initialiser_padding(x);

//------------------------------------------------------------------------------------

function new_module() {

	$("#new_module").css('display','block');
}

function f_new_question() {
	$("#new_question_reponse").css('display','block');
}

function f_ajouter_reponse() {

	var newDiv=document.createElement('div');
	newDiv.id="reponse";
	var newCheckbox=document.createElement('input');
	newCheckbox.type='checkbox';
	newCheckbox.id='c'+m;

	var newInputText=document.createElement('input');
	newInputText.type='text';
	newInputText.id='r'+m;
	newInputText.placeholder='Remplir reponse';
	m++;

	newDiv.appendChild(newCheckbox);
	newDiv.appendChild(newInputText);
	document.getElementById('reponse_liste').appendChild(newDiv);
}


$("#question_liste li").click(function (){

valeur = new String($(this).val());
var index = $("ul li").index(this);
index=index-2; //a modifier car commence à 3

tab[index]++;

initialiser_padding(x);

if(tab[index]==1) {
	tab_resultat[index]=valeur;
	click_couleur(index-1); //modifier aussi
}
else {
	tab_resultat[index]=0;
	click_suppr_couleur(index-1);
}

});

function ajouter_new_module() {
	var nom_module=document.getElementById('i_nom_module').value;

		$.ajax({ 
		   type: "POST", 
		   url: "../php/insertion.php", 
		   data: {nom_nouveau_module : nom_module}, 
		});

		 $('#id_module').load('../php/bdd.php', {
		 	nouveau_module :$('#i_nom_module').val()
		 });
}

function ajouter_new_question() {

	var nom_question=document.getElementById('i_nouvelle_question').value;
	var type_question=document.getElementById('i_type_question').value;
	var module_liste1=document.getElementById('id_module').value;

		$.ajax({ 
		   type: "POST", 
		   url: "../php/insertion.php", 
		   data: {nom_nouvelle_question : nom_question, fk_type_question : type_question, num_module1 : module_liste1}, 
		});

		ajouter_new_reponse();

		 $('#affichage_question').load('../php/bdd.php', {
		 	module_liste :$('#id_module').val()
		 });
}

function ajouter_new_reponse() {
	var i=0;
	var nb_reponses=$('.l_reponse #reponse').length;
	var tab = new Array();
	var tab_checkbox = new Array();

	for(var j=0;j<nb_reponses;j++) {
		var tmp=document.getElementById('r'+j).value;
	
		if(tmp!="") {
			tab[i]=tmp;
			

			if(document.getElementById('c'+j).checked) {
				tab_checkbox[i]=1;
			}
			else {
				tab_checkbox[i]=0;
			}

			i++;
		}
	}

	for(var g=0;g<i;g++) {
		$.ajax({ 
			   type: "POST", 
		 	   url: "../php/insertion.php", 
		   	   data: {tab_reponse : tab[g], tab_checkbox : tab_checkbox[g]}, 
			});
	}

}

function test() {
	var tab_questions=new Array(x);
	var j=0;
	var nom_questionnaire=document.getElementById('i_nom_questionnaire').value;

	for(var i=1;i<=tab_resultat.length;i++) {
		if(tab_resultat[i]!=0) {
			tab_questions[j]=tab_resultat[i];
			j++;
		}

	}

	$.ajax({ 
		type: "POST", 
		url: "../php/insertion.php", 
		data: {nom_questionnaire : nom_questionnaire, tab1 : tab_questions}, 
	});
}

$("#module select").change(function(){

		var val=$('#id_module').val();

		 $('#affichage_question').load('../php/bdd.php', {
		 	module_liste :$('#id_module').val()
		 });

		 setTimeout(suiteTraitement, 10000);
 });

function suiteTraitement()
{
	var x=$('.question_liste2 li').length;
	console.log(x);
	initialiser_padding(x);
}