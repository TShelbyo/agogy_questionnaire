<?php

function connectionDbLocalhost($nomBdd) {

	try {

		$bdd = new PDO('mysql:host=localhost;dbname='.$nomBdd.';charset=utf8', 'root', '');

	}catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
}

	return $bdd;
}

function connecionDb($chemin,$nomBdd,$user,$mdp) {

	try {

		$bdd = new PDO('mysql:host='.$chemin.';dbname='.$nomBdd.';charset=utf8', "'".$user."'", "'".$mdp."'");
	}catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
}

	return $bdd;
}


function display_module($bdd) {
	$reponse = $bdd->query('SELECT id_module, nom_module FROM module');

	while ($donnees = $reponse->fetch()) {
		echo '<option value="'.$donnees['id_module'].'">'.$donnees['nom_module'];
		echo '</option>';
	}

	$reponse->closeCursor();

}

function display_questions($bdd) {

	if(!empty($_POST['module_liste1'])) {
			echo "tyuiokjh";
		$nom_module=$_POST['module_liste1'];
		echo $nom_module;
		$reponse = $bdd->query('SELECT id_question, nom_question FROM question JOIN module_question ON id_question=fk_question where fk_module='+$nom_module+')');
	}
	else {
		$reponse = $bdd->query('SELECT id_question, nom_question FROM question JOIN module_question ON id_question=fk_question where fk_module=(select id_module from module where nom_module="Incendie")');
	}
//}

	while ($donnees = $reponse->fetch()) {
		echo '<li value="'.$donnees['id_question'].'">'.$donnees['nom_question'];
		echo '</li>';
	}

	$reponse->closeCursor();

}

function display_type_question($bdd,$num_module) {
	
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

function prepared_queries_question_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO question(nom_question,fk_type_question) VALUES(:nom_question,:fk_type_question)');

	return $req;
}

function execute_queries_question_insertion($bdd,$nom_question,$fk_type_question) {

	$req=prepared_queries_question_insertion($bdd);

		$req->execute(array(	
		':nom_question' => $nom_question,
		':fk_type_question' => $fk_type_question
		));
}

function prepared_queries_liaison_question_reponse_insertion($bdd) {
	echo 'bonjourkjhg';
	$req=$bdd->prepare('INSERT INTO question_reponse(fk_question,fk_reponse,juste) VALUES((select max(id_question) from question),(select max(id_reponse) from reponse),:juste)');

	return $req;
}

function execute_queries_liaison_question_reponse_insertion($bdd,$juste) {
	echo 'meeeeeeeeeerdee';
	$req=prepared_queries_liaison_question_reponse_insertion($bdd);

			$req->execute(array(	
			':juste' => $juste
			));
}

function prepared_queries_reponse_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO reponse(nom_reponse) VALUES(:nom_reponse)');

	return $req;
}

function execute_queries_reponse_insertion($bdd,$nom_reponse) {

	$req=prepared_queries_reponse_insertion($bdd);

		//for($i=0;$i<count($nom_reponse);$i++) {
			$req->execute(array(	
			':nom_reponse' => $nom_reponse
			));
		//}

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

function prepared_queries_liaison_module_question_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO module_question(fk_module,fk_question) VALUES(:num_module,(select max(id_question) from question))');

	return $req;
}

function execute_queries_liaison_module_question_insertion($bdd,$num_module) {
	$req=prepared_queries_liaison_module_question_insertion($bdd);

			$req->execute(array(	
			':num_module' => $num_module
			));
}

function prepared_queries_liaison_questionnaire_question_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO questionnaire_question(fk_questionnaire,fk_question) VALUES((select max(id_questionnaire) from questionnaire),:fk_question)');

	return $req;
}

function execute_queries_liaison_questionnaire_question_insertion($bdd,$fk_question) {
	$req=prepared_queries_liaison_questionnaire_question_insertion($bdd);

		for($i=0;$i<count($fk_question);$i++) {
			$req->execute(array(
			':fk_question' => $fk_question[$i]
		));
	}
}
?>

   	  			