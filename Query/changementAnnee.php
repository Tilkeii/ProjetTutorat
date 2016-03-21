<?php

session_start();
include('../BD/parametres.php');
$bdd = db_connect();

//suppresion de toutes les aides en cours
$req = $bdd->prepare('DELETE FROM aide');
$req->execute();

//suppression de toutes les demandes d'aide en cours
$req = $bdd->prepare('DELETE FROM needhelp');
$req->execute();

//suppression de tous les propositions d'aide(pas implenté)
$req = $bdd->prepare('DELETE FROM helper');
$req->execute();

//suppression de tous les etudiants de deuxième année n'ayant pas de super-droits
$req = $bdd->prepare('DELETE FROM etudiant WHERE id_grp>4 AND id_priv<3');
$req->execute();

//passage des premières année en seconde année
$req = $bdd->prepare('UPDATE etudiant set id_grp=id_grp+4 where id_priv<3');
$req->execute();

//on update l'annee scolaire
$req = $bdd->prepare('update infos set anneeEnCours=anneeEnCours+1');
$req->execute();

$req = $bdd->prepare('update infos set anneeSuivante=anneeSuivante+1');
$req->execute();

?>
