<?php

	include("bdd.php");

	function console_log( $data ){
  	echo '<script>';
  	echo 'console.log('. json_encode( $data ) .')';
  	echo '</script>';
}

	$bdd=connectionDbLocalhost('agogy_questionnaire');

	if(!empty($_POST['nom_questionnaire'])) {
		$nom_questionnaire=$_POST['nom_questionnaire'];
		execute_queries_questionnaire_insertion($bdd,$nom_questionnaire);
	}

	if(!empty($_POST['module_liste'])) {
		$num_module=$_POST['module_liste'];
		console_log($num_module);
		execute_queries_liaison_questionnaire_module_insertion($bdd,$num_module);
	}
	else {
		console_log("vide");
	}

	include("../html/insertion.html");

?>
