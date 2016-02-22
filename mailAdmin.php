<?php
    session_start();
    include('Helper/Helper_Mail.php');
    $texte = htmlspecialchars($_GET['contenuMail']);
    if(!empty($texte)){
        var_dump(mail('admin@e-tutorat.tk','Remarque/Question',$texte));
        header('Location: profile.php'."");
    }

?>
