<?php
    session_start();
    include('Helper/Helper_Mail.php');
    $texte = htmlspecialchars($_GET["contenuMail"]);

    if($_GET["rep"]==1 or $_GET["rep"]==4){//mail dejà envoyé
        header('Location:profile.php?rep=4');
    }
    else if($texte!=null){
        // Envoi du mail
        $mail_demandeur = new Helper_Mail();
        $mail_demandeur
            ->to("admin@e-tutorat.tk")
            ->sujet("Demande/Question")
            ->content("".$texte)
            ->send();
        header('Location:profile.php?rep=1');
    }
    else if($texte==null){
        header('Location:profile.php?rep=2');
    }
    else{
        header('Location:profile.php?rep=3');
    }

?>
