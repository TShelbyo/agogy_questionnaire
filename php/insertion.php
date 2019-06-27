<?php

	include("bdd.php");

	function console_log( $data ){
  	echo '<script>';
  	echo 'console.log('. json_encode( $data ) .')';
  	echo '</script>';
}

	if(!empty($_POST['nom_questionnaire']) && !empty($_POST['tab1'])) {
		$nom_questionnaire=$_POST['nom_questionnaire'];
		$myTable = $_POST['tab1'];
		print_r($myTable);

		execute_queries_questionnaire_insertion($bdd,$nom_questionnaire);
		execute_queries_liaison_questionnaire_question_insertion($bdd,$myTable); 
	}

	if(!empty($_POST['module_liste'])) {
		$num_module=$_POST['module_liste'];
		execute_queries_liaison_questionnaire_module_insertion($bdd,$num_module);
	}

	if(!empty($_POST['nom_nouveau_module'])) {
		$nom_module=$_POST['nom_nouveau_module'];
		execute_queries_module_insertion($bdd,$nom_module);
	}

	if(!empty($_POST['nom_nouvelle_question'])) {
		$nom_question=$_POST['nom_nouvelle_question'];
		$fk_type_question=$_POST['fk_type_question'];
		$num_module1=$_POST['num_module1'];
		execute_queries_question_insertion($bdd,$nom_question,$fk_type_question);
		execute_queries_liaison_module_question_insertion($bdd,$num_module1);
	}

	if(!empty($_POST['tab_reponse'])) {
		$tab_reponse=$_POST['tab_reponse'];
		$tab_checkbox=$_POST['tab_checkbox'];
		execute_queries_reponse_insertion($bdd,$tab_reponse);
		execute_queries_liaison_question_reponse_insertion($bdd,$tab_checkbox);
	}
	
include("../html/insertion.html");
?>

	
