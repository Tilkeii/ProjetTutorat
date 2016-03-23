<?php

session_start();
include('../BD/parametres.php');
$bdd = db_connect();

$req = $bdd->prepare('DELETE FROM minichat');
$req->execute();

?>