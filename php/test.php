<?php 

function connectionDbLocalhost($nomBdd) {

	try {

		$bdd = new PDO('mysql:host=localhost;dbname='.$nomBdd.';charset=utf8', 'root', '');

	}catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
}

	return $bdd;
}

//echo "<script>alert(\"la variable est nulle\")</script>";
$bdd=connectionDbLocalhost('agogy_questionnaire');	
$module_liste=$_POST['module_liste'];

if(!empty($module_liste)) {

$reponse = $bdd->query("SELECT id_question, nom_question FROM question JOIN module_question ON question.id_question=module_question.fk_question where fk_module=".$module_liste);}
else {
		$reponse = $bdd->query('SELECT id_question, nom_question FROM question JOIN module_question ON id_question=fk_question where fk_module=(select id_module from module where nom_module="Incendie")');
}

	while ($donnees = $reponse->fetch()) {
		echo '<li value="'.$donnees['id_question'].'">'.$donnees['nom_question'];
		echo '</li>';
	}

	$reponse->closeCursor();
?>