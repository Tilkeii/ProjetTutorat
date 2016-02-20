<?php
session_start();
if(isset($_POST["iduser"])){
    $bdd = new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');
    
    // Suppression de l'étudiant
    //devoir gérer le cas ou l'etudiant aidait: informer le demandeur
    $req = $bdd->prepare('DELETE FROM aide WHERE numero_etudiant = :iduser or id_needhelp = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('4'.$bdd->errorInfo(),true));

    $req = $bdd->prepare('DELETE FROM helper WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('3'.$bdd->errorInfo(),true));
						
    $req = $bdd->prepare('DELETE FROM needhelp WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('2'.$bdd->errorInfo(),true));
    
    $req = $bdd->prepare('DELETE FROM etudiant WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('1'.$bdd->errorInfo(),true));

    
}

?>
