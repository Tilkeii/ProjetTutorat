<?php
session_start();
if(isset($_POST["idannonce"])){
    include('../Helper/Helper_Mail.php');
	include ('../templates/template.php');

    include ('../BD/parametres.php');
    $bdd = db_connect();
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

	$refus1 = new Template("../templates/mail.tpl");
	$refus1->set("annonce", $demandeur["commentaire"]);
	$refus1->set("text", "Vous avez refuse l'aide pour l'annonce ");
	$refus1->set("url", "https://media.giphy.com/media/Hwq45iwTIUBGw/giphy.gif");
	
    $mail_demandeur = new Helper_Mail();
    $mail_demandeur
        ->to($demandeur["email"])
        ->sujet("Refus d'aide")
		->content($refus1->output())
        ->send();

	$refus2 = new Template("../templates/mail.tpl");
	$refus2->set("annonce", $demandeur["commentaire"]);
	$refus2->set("text", "Un etudiant a refuse votre demande d'aide pour l'annonce ");
	$refus2->set("url", "http://www.reactiongifs.com/r/d9.gif");
	
    $mail_helper = new Helper_Mail();
    $mail_helper
        ->to($helper["email"])
        ->sujet("Refus d'aide")
		->content($refus2->output())
        ->send();

    $req = $bdd->prepare('UPDATE needhelp
                          SET etat = 0
                          WHERE id = :idannonce
                          ');
    $req->execute(array('idannonce' => $_POST["idannonce"])) or die('3'.print_r($bdd->errorInfo(), true));

    $req = $bdd->prepare('DELETE FROM aide
                          WHERE id_needhelp = :idannonce
                          ');
    $req->execute(array('idannonce' => $_POST["idannonce"])) or die('4'.print_r($bdd->errorInfo(), true));

}
else{
    echo "not ok lol";
}
