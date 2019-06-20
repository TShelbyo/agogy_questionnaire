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

	var newInputText=document.createElement('input');
	newInputText.type='text';
	newInputText.placeholder='Remplir reponse';

	newDiv.appendChild(newCheckbox);
	newDiv.appendChild(newInputText);
	document.getElementById('reponse_liste').appendChild(newDiv);
}
