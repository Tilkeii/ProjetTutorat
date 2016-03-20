<?php
session_start();
if(isset($_POST["idannonce"])){
    include ('../BD/parametres.php');
    $bdd = db_connect();
    // Suppression des annonces
    $req = $bdd->prepare('DELETE FROM aide
                          WHERE id_needhelp = :idannonce
                           ');
    $req->execute(array('idannonce' => $_POST["idannonce"])) or die(print_r('4'.$bdd->errorInfo(), true));

    $req = $bdd->prepare('DELETE FROM needhelp
                          WHERE id = :idannonce
                           ');
    $req->execute(array('idannonce' => $_POST["idannonce"])) or die(print_r('3'.$bdd->errorInfo(), true));

}

?>
