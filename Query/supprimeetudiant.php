<?php
session_start();
if(isset($_POST["iduser"])){
    $bdd = new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');
    
    // Suppression de l'étudiant

    //on envoie un mail pour prévenir la personne qui demandait de l'aide
    $reqBis = $bdd->prepare('select numero_etudiant from needhelp where id in(select id_needhelp from aide where etat=0 and numero_etudiant = :iduser)');
    $reqBis->execute(array('iduser' => $_post["iduser"])) or die(print_r('5'.$bdd->errorinfo(),true));
    $resultat = $reqBis->fetchAll();
    foreach($resultat as $r){
        $req = $bdd->prepare('SELECT email,nom,prenom FROM etudiant WHERE numero_etudiant = :iduser');
        $req->execute(array(
	    			'iduser' => $r['numero_etudiant'])
                ) or die(print_r($bdd->errorInfo(), true));
        $resultatfind = $req->fetch();
        // Envoi du mail
        $mail_demandeur = new Helper_Mail();
        $mail_demandeur
            ->to($resultatfind['email'])
            ->sujet("Annulation echange")
            ->content("Bonjour".$resultatfind["prenom"]." ".$resultatfind["nom"].". Malheuresement nous avons banni un élève qui souhaitait vous aider :
            nous avons donc interrompu l'echange en cours et de nouvelles personnes peuvent maintenant vous proposer votre aide. Bonne journée !")
            ->send();

    }

    //On remet la demande d'aide à l'état d'origine
    $reqBis = $bdd->prepare('UPDATE needhelp SET etat=0 WHERE id in(select id_needhelp where etat=0 AND numero_etudiant = :iduser)');
    $reqbis->execute(array('iduser' => $_post["iduser"])) or die(print_r($bdd->errorinfo(),true));

    
    $req = $bdd->prepare('DELETE FROM aide WHERE numero_etudiant = :iduser AND etat=0');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('4'.$bdd->errorInfo(),true));
    
    $req = $bdd->prepare('DELETE FROM helper WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('3'.$bdd->errorInfo(),true));
	

    //On recupères ls etudiants qui voulaient aider l'élève qui va être supprimer
    $reqBis = $bdd->prepare('select numero_etudiant from aide where id_needhelp in(select id from needhelp where etat=1 and numero_etudiant = :iduser)');
    $reqBis->execute(array('iduser' => $_post["iduser"])) or die(print_r($bdd->errorinfo(),true));
    $resultat = $reqBis->fetchAll();
    //Ensuite on envoie un mail pour prévenir ces personnes
    foreach($resultat as $r){
        $req = $bdd->prepare('SELECT email,nom,prenom FROM etudiant WHERE numero_etudiant = :iduser');
        $req->execute(array(
	    			'iduser' => $r['numero_etudiant'])
                ) or die(print_r($bdd->errorInfo(), true));
        $resultatfind = $req->fetch();
        // Envoi du mail
        $mail_demandeur = new Helper_Mail();
        $mail_demandeur
            ->to($resultatfind['email'])
            ->sujet("Annulation echange")
            ->content("Bonjour".$resultatfind["prenom"]." ".$resultatfind["nom"].". Malheuresement nous avons banni un élève que vous souhaitiez aider :
            nous avons donc interrompu l'echange en cours.N'hésitez pas à aider d'autres personnes. Bonne journée !")
            ->send();

    }
    
    $req = $bdd->prepare('DELETE FROM needhelp WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('2'.$bdd->errorInfo(),true));
    


    $req = $bdd->prepare('DELETE FROM etudiant WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('1'.$bdd->errorInfo(),true));

    
}

?>
