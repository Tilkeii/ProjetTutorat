<?php
    session_start();
    include('Helper/Helper_Mail.php');
    $texte = htmlspecialchars($_GET["contenuMail"]);
// Envoi du mail
    $mail_demandeur = new Helper_Mail();
    $mail_demandeur
        ->to("admin@e-tutorat.tk")
        ->sujet("Demande/Question")
        ->content("".$texte)
        ->send();
header('Location:profile.php?rep=1');

?>
