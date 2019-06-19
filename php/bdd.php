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

function prepared_queries_artist_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO artiste(nom_artiste,compte_instagram,compte_spotify,compte_youtube,nationalite) VALUES(:nom,:instagram,:spotify,:youtube,:nationalite)');

	return $req;
}

function prepared_queries_media_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO media(nom_media,lien_media,photo_media,date,fk_type_media) VALUES(:nom_media,:lien_media,:photo_media,:date,:fk_type_media)');

	return $req;
}

function prepared_queries_clothe_insertion($bdd) {

	$req=$bdd->prepare('INSERT INTO tenue(reference_tenue,lien_tenue,photo_tenue,fk_type_tenue) VALUES(:reference_tenue,:lien_tenue,:photo_tenue,:date,:fk_type_tenue)');

	return $req;
}

function execute_queries_media_insertion($bdd,$nom_media,$lien_media,$photo_media,$date,$fk_type_media) {

	$req=prepared_queries_media_insertion($bdd);

		$req->execute(array(	
		':nom_media' => $nom_media,
		':lien_media' => $lien_media,
		':photo_media' => $photo_media,
		':date' => $date,
		':fk_type_media' => $fk_type_media
		));
}

function execute_queries_clothe_insertion($bdd,$reference_tenue,$lien_tenue,$photo_tenue,$fk_type_tenue) {

	$req=prepared_queries_clothe_insertion($bdd);

		$req->execute(array(	
		':reference_tenue' => $reference_tenue,
		':lien_tenue' => $lien_tenue,
		':photo_tenue' => $photo_tenue,
		':fk_type_tenue' => $fk_type_tenue
		));
}

function execute_queries_artist_insertion($bdd,$nom,$instagram,$spotify,$youtube,$nationalite) {

	$req=prepared_queries_artist_insertion($bdd);

		$req->execute(array(	
		':nom' => $nom,
		':instagram' => $instagram,
		':spotify' => $spotify,
		':youtube' => $youtube,
		':nationalite' => $nationalite
		));
}

function display_artists($bdd) {
	$reponse = $bdd->query('SELECT id_artiste,nom_artiste FROM artiste ORDER BY nom_artiste');

	while ($donnees = $reponse->fetch()) {
		echo '<option value="'.$donnees['id_artiste'].'">'.$donnees['nom_artiste'];
		echo '</option>';
	}

	$reponse->closeCursor();

}

function display_sort_of_media($bdd) {
	$reponse = $bdd->query('SELECT id_type_media,nom_type_media FROM type_media ORDER BY nom_type_media');

	while ($donnees = $reponse->fetch()) {
		echo '<option value="'.$donnees['id_type_media'].'">'.$donnees['nom_type_media'];
		echo '</option>';
	}

	$reponse->closeCursor();

}

function display_sort_of_clothe($bdd) {
	$reponse = $bdd->query('SELECT id_type_tenue,nom_type_tenue FROM type_tenue ORDER BY nom_type_tenue');

	while ($donnees = $reponse->fetch()) {
		echo '<option value="'.$donnees['id_type_tenue'].'">'.$donnees['nom_type_tenue'];
		echo '</option>';
	}

	$reponse->closeCursor();

}
		

?>

   	  			