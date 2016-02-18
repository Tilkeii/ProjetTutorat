<?php
session_start();
if(isset($_POST["idannonce"])){
    $bdd = new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');

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
