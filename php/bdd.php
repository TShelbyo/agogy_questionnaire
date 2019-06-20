<?php

function connectionDbLocalhost($nomBdd) {

	try {

		$bdd = new PDO('mysql:host=localhost;dbname='.$nomBdd.';charset=utf8', 'root', '');

	}catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
}

	return $bdd;
}


function connectionDb($chemin,$nomBdd,$user,$mdp) {

	try {

		$bdd = new PDO('mysql:host='.$chemin.';dbname='.$nomBdd.';charset=utf8', "'".$user."'", "'".$mdp."'");
	}catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
}

	return $bdd;
}

function display_module($bdd) {
	$reponse = $bdd->query('SELECT id_module, nom_module FROM module ORDER BY nom_module');

	while ($donnees = $reponse->fetch()) {
		echo '<option value="'.$donnees['id_module'].'">'.$donnees['nom_module'];
		echo '</option>';
	}

	$reponse->closeCursor();

}

function display_questions($bdd) {
	$reponse = $bdd->query('SELECT id_question, nom_question FROM question');

	while ($donnees = $reponse->fetch()) {
		echo '<li value="'.$donnees['id_question'].'">'.$donnees['nom_question'];
		echo '</li>';
	}

	$reponse->closeCursor();

}

function display_type_question($bdd) {
	$reponse = $bdd->query('SELECT id_type_question, nom_type_question FROM type_question');

	while ($donnees = $reponse->fetch()) {
		echo '<option value="'.$donnees['id_type_question'].'">'.$donnees['nom_type_question'];
		echo '</option>';
	}

	$reponse->closeCursor();

}

function prepared_queries_questionnaire_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO questionnaire(nom_questionnaire) VALUES(:nom_questionnaire)');

	return $req;
}

function execute_queries_questionnaire_insertion($bdd,$nom_questionnaire) {

	$req=prepared_queries_questionnaire_insertion($bdd);

		$req->execute(array(	
		':nom_questionnaire' => $nom_questionnaire
		));
}

function prepared_queries_module_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO module(nom_module) VALUES(:nom_module)');

	return $req;
}

function execute_queries_module_insertion($bdd,$nom_module) {

	$req=prepared_queries_module_insertion($bdd);

		$req->execute(array(	
		':nom_module' => $nom_module
		));
}

function prepared_queries_liaison_questionnaire_module_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO questionnaire_module(fk_questionnaire,fk_module) VALUES((select max(id_questionnaire) from questionnaire),:num_module)');

	return $req;
}


function execute_queries_liaison_questionnaire_module_insertion($bdd,$num_module) {

	$req=prepared_queries_liaison_questionnaire_module_insertion($bdd);

		$req->execute(array(	
		':num_module' => $num_module
		));
}


?>

   	  			