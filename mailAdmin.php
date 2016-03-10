<?php
    session_start();
    include('Helper/Helper_Mail.php');
    $texte = htmlspecialchars($_GET['contenuMail']);
    $texte = wordwrap($texte, 70, "\r\n"); //Au cas ou les lignes font plus de 70 on les découpent (mail() ne peut avoir lignes > 70 caracteres)
    //si le champ de saisi a bien été rempli , alors on envoie l'email au mail admin et on renvoie l'utilisateur à sa page de profil.
    if(!empty($texte)){
        var_dump(mail('admin@e-tutorat.tk','Remarque/Question',$texte));
        header('Location: profile.php'."");
    }

?>
