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
                          FROM etudiant
                          WHERE etudiant.numero_etudiant = :idetu');
    $req->execute(array('idetu' => $_SESSION["login"])) or die(print_r('2'.$bdd->errorInfo(), true));
    $helper = $req->fetch();

    $mail_demandeur = new Helper_Mail();
    $mail_demandeur
        ->to($demandeur["email"])
        ->sujet("Proposition d'aide")
        ->content("Un etudiant a repondu a votre demande d'aide : ".$demandeur["commentaire"].", merci de confirmer dans votre espace");

    $mail_helper = new Helper_Mail();
    $mail_helper
        ->to($helper["email"])
        ->sujet("Proposition d'aide")
        ->content("Vous avez repondu a l'annonce : ".$demandeur["commentaire"].", merci d'attendre la confirmation de l'etudiant");

    if($mail_demandeur->send() && $mail_helper->send()){
        $req = $bdd->prepare('UPDATE needhelp
                              SET etat = 1
                              WHERE id = :idannonce
                              ');
        $req->execute(array('idannonce' => $_POST["idannonce"])) or die('3'.print_r($bdd->errorInfo(), true));

        $req = $bdd->prepare('INSERT INTO aide(numero_etudiant, id_needhelp)
                              VALUES (:idetu, :idannonce)
                              ');
        $req->execute(array(
            'idetu'     => $_SESSION["login"],
            'idannonce' => $_POST["idannonce"]
            ))
        or die(print_r('4'.$bdd->errorInfo(), true));

        echo "ok";
    }
    else{
        echo "not ok lol";
    }
}