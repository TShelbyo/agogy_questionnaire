<?php

$bdd=connectionDbLocalhost('agogy_questionnaire');	

//---------------------------------------------------------------------


	//affichage questions lors du changement de module

	if(!empty($_POST['module_liste'])) {
		display_questions($bdd);
	} 

	//affichage modules lors d'un ajout_module
	if(!empty($_POST['nouveau_module'])) {
		display_module($bdd);
	}  

//------------------------------------------------------------------------

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
	$i=0;

	if(!empty($_POST['module_liste'])) {

	$module_liste=$_POST['module_liste'];
	$reponse = $bdd->query('SELECT id_question, nom_question, nom_type_question FROM question JOIN module_question ON id_question=fk_question JOIN type_question ON question.fk_type_question=type_question.id_type_question where fk_module='.$module_liste);}
	else {
		$reponse = $bdd->query('SELECT id_question, nom_question, nom_type_question FROM question JOIN module_question ON id_question=fk_question JOIN type_question ON question.fk_type_question=type_question.id_type_question where fk_module=(select id_module from module where nom_module="Incendie")');
	}

	while ($donnees = $reponse->fetch()) {
		echo '<li id='.$i.' value="'.$donnees['id_question'].'">'.$donnees['nom_question'].' ('.$donnees['nom_type_question'].')';
		echo '</li>';
		$i++;
	}

	$reponse->closeCursor();

}

function display_questions_questionnaire($bdd,$fk_questionnaire) {
	$i=0;
	//affichage question liées à un questionnaire

		$question = $bdd->query("SELECT id_question, nom_question, nom_type_question FROM question JOIN questionnaire_question ON question.id_question=questionnaire_question.fk_question JOIN type_question ON question.fk_type_question=type_question.id_type_question where fk_questionnaire=".$fk_questionnaire);//}	

		while ($donnees = $question->fetch()) {
			$reponse= $bdd->query("SELECT id_reponse, nom_reponse FROM reponse JOIN question_reponse on question_reponse.fk_reponse=reponse.id_reponse where fk_question=".$donnees['id_question']);
			echo '<h2 id='.$i.' value="'.$donnees['id_question'].'">'.$donnees['nom_question'].'('.$donnees['nom_type_question'].')';
			echo '</h2>';
			$i++;

			echo '<ul id="question_liste" class="question_liste2">';

			while($donnees_r = $reponse->fetch()) {
				echo '<li value="'.$donnees_r['id_reponse'].'">'.$donnees_r['nom_reponse'];
				echo '<li>';
			}

			echo '</ul>';
			$reponse->closeCursor();
		}

	$question->closeCursor();
		
	}
	
function display_type_question($bdd) {
	
		$reponse = $bdd->query('SELECT id_type_question, nom_type_question FROM type_question');

	while ($donnees = $reponse->fetch()) {
		echo '<option value="'.$donnees['id_type_question'].'">'.$donnees['nom_type_question'];
		echo '</option>';
	}

	$reponse->closeCursor();

}

function display_questionnaire($bdd) {

	$i=1;
	
	$reponse = $bdd->query('SELECT id_questionnaire, nom_questionnaire FROM questionnaire');

	while ($donnees = $reponse->fetch()) {
		echo '<li id='.$i.' value="'.$donnees['id_questionnaire'].'">'.$donnees['nom_questionnaire'];
		echo '</li>';
		$i++;
	}

	$reponse->closeCursor();

}

function prepared_queries_questionnaire_insertion($bdd) {

	$i=0;

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

   	  			