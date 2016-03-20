<?php
session_start();
if(isset($_POST["iduser"])){
    include ('../BD/parametres.php');
    $bdd = db_connect(); 
    // Suppression de l'étudiant
    

    //suppression des proposition d'aide
    //on envoie un mail pour prévenir la personne qui demandait de l'aide
    $reqBis = $bdd->prepare('SELECT numero_etudiant FROM needhelp WHERE etat=1 and id IN(SELECT id_needhelp FROM aide WHERE etat=0 AND numero_etudiant= :iduser)');
    $reqBis->execute(array('iduser' => $_POST["iduser"])) or die(print_r('1'.$bdd->errorInfo(),true));
    $resultat = $reqBis->fetchAll();
    foreach($resultat as $r){
        $req = $bdd->prepare('SELECT email,nom,prenom FROM etudiant WHERE numero_etudiant= :iduser2');
        $req->execute(array(
	    			'iduser2' => $r['numero_etudiant'])
                ) or die(print_r('2'.$bdd->errorInfo(), true));
        $resultatfind = $req->fetch();
        // Envoi du mail
        $mail_demandeur = new Helper_Mail();
        $mail_demandeur
            ->to($resultatfind['email'])
            ->sujet("Annulation echange")
            ->content("Bonjour ".$resultatfind["prenom"]." ".$resultatfind["nom"]." .Malheuresement, nous avons banni un élève qui souhaitait vous aider :
            nous avons donc interrompu l'echange en cours et de nouvelles personnes peuvent maintenant vous proposer votre aide. Bonne journée !")
            ->send();

    }

    //On remet la demande d'aide à l'état d'origine
    $reqBis = $bdd->prepare('UPDATE needhelp SET etat=0 WHERE id IN(SELECT id_needhelp FROM aide WHERE etat=0 AND numero_etudiant= :iduser1)');
    $reqBis->execute(array('iduser1' => $_POST["iduser"])) or die(print_r('3'.$bdd->errorInfo(),true));
    
    $req = $bdd->prepare('DELETE FROM aide WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('4'.$bdd->errorInfo(),true));
    //fin partie suppression proposeur aide

    //partie suppression demandes
    
    //On recupère les etudiants qui voulaient aider l'élève qui va être supprimer
    $reqBis = $bdd->prepare('SELECT numero_etudiant FROM aide WHERE etat=0 and id_needhelp in(SELECT id FROM needhelp WHERE etat=1 AND numero_etudiant= :iduser)');
    $reqBis->execute(array('iduser' => $_POST["iduser"])) or die(print_r('6'.$bdd->errorInfo(),true));
    $resultat = $reqBis->fetchAll();
    //Ensuite on envoie un mail pour prévenir ces personnes
    foreach($resultat as $r){
        $req = $bdd->prepare('SELECT email,nom,prenom FROM etudiant WHERE numero_etudiant= :iduser2');
        $req->execute(array(
	    			'iduser2' => $r['numero_etudiant'])
                ) or die(print_r('7'.$bdd->errorInfo(), true));
        $resultatfind = $req->fetch();
        // Envoi du mail
        $mail_demandeur = new Helper_Mail();
        $mail_demandeur
            ->to($resultatfind['email'])
            ->sujet("Annulation echange")
            ->content("Bonjour ".$resultatfind["prenom"]." ".$resultatfind["nom"]." .Malheuresement, nous avons banni un élève que vous souhaitiez aider :
            nous avons donc interrompu l'echange en cours.N'hésitez pas à aider d'autres personnes. Bonne journée !")
            ->send();

    }
    $req = $bdd->prepare('DELETE FROM aide WHERE id_needhelp IN(SELECT id from needhelp where numero_etudiant = :iduser)');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('8'.$bdd->errorInfo(),true));

    $req = $bdd->prepare('DELETE FROM needhelp WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('9'.$bdd->errorInfo(),true));
    //fin supression demandes



    $req = $bdd->prepare('DELETE FROM helper WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('5'.$bdd->errorInfo(),true));
	

    $req = $bdd->prepare('DELETE FROM etudiant WHERE numero_etudiant = :iduser');
    $req->execute(array('iduser' => $_POST["iduser"])) or die(print_r('10'.$bdd->errorInfo(),true));

    
}

?>
