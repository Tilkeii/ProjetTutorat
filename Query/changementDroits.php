<?php
session_start();
if(isset($_POST["iduser"])){
    $bdd = new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');


    //recuperation du droit actuel de l'utilisateur
    $res = $bdd->prepare('SELECT id_priv from etudiant where numero_etudiant = :iduser');
    $res->execute(array('iduser' => $_POST["iduser"])) or die(print_r('3'.$bdd->errorInfo(),true));
    $priv = $res->fetch();
    //cas de l'ajout de droits
    if($priv['id_priv'] == 1){
        $req = $bdd->prepare('UPDATE etudiant set id_priv = 2 where numero_etudiant = :iduser');
        $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('2'.$bdd->errorInfo(),true));
    }
    else{
        //cas de la suppression de droits
        $req = $bdd->prepare('UPDATE etudiant set id_priv = 1 where numero_etudiant = :iduser');
        $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('1'.$bdd->errorInfo(),true));
    }
}
?>
