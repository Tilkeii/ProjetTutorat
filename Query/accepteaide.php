<?php
session_start();
if(isset($_POST["idannonce"])){
    include('../Helper/Helper_Mail.php');

    $bdd = new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');

    // Mail demandeur
    $req = $bdd->prepare('SELECT email, commentaire
                          FROM needhelp
                          LEFT JOIN etudiant
                          ON needhelp.numero_etudiant = etudiant.numero_etudiant
                          WHERE needhelp.id = :idannonce');
    $req->execute(array('idannonce' => $_POST["idannonce"])) or die(print_r('1'.$bdd->errorInfo(), true));
    $demandeur = $req->fetch();

    // Mail helper
    $req = $bdd->prepare('SELECT email
                          FROM aide
                          LEFT JOIN etudiant
                          ON aide.numero_etudiant = etudiant.numero_etudiant
                          WHERE aide.id_needhelp = :idannonce');
    $req->execute(array('idannonce' => $_POST["idannonce"])) or die(print_r('2'.$bdd->errorInfo(), true));
    $helper = $req->fetch();

    // Suppression des annonces
    $req = $bdd->prepare('DELETE FROM aide
                          WHERE id_needhelp = :idannonce
                           ');
    $req->execute(array('idannonce' => $_POST["idannonce"])) or die(print_r('4'.$bdd->errorInfo(), true));

    $req = $bdd->prepare('DELETE FROM needhelp
                          WHERE id = :idannonce
                           ');
    $req->execute(array('idannonce' => $_POST["idannonce"])) or die(print_r('3'.$bdd->errorInfo(), true));

    // Envoi des mails
    $mail_demandeur = new Helper_Mail();
    $mail_demandeur
        ->to($demandeur["email"])
        ->sujet("Acceptation d'aide")
        ->content("Vous avez accepté l'aide d'un étudiant pour l'annonce : ".$demandeur["commentaire"].". Merci de prendre contact à l'adresse suivante : ".$helper["email"])
        ->send();

    $mail_helper = new Helper_Mail();
    $mail_helper
        ->to($helper["email"])
        ->sujet("Acceptation d'aide")
        ->content("Votre aide a ete acceptee pour l'annonce : ".$demandeur["commentaire"].". Merci de prendre contact à l'adresse suivante : ".$demandeur["email"])
        ->send();

    echo "ok";
}
else{
    echo "not ok lol";
}
