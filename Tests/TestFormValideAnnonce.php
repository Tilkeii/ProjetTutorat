<?php

/**
 * Created by PhpStorm.
 * User: Florian
 * Date: 22/03/2016
 * Time: 17:11
 */
class TestFormValideAnnonce
{
    var $bdd, $identifiant, $matiere, $commentaire;

    public function __construct($bdd,$identifiant,$matiere,$commentaire)
    {
        $this->bdd = $bdd;
        $this->identifiant = $identifiant;
        $this->matiere = $matiere;
        $this->commentaire = $commentaire;
    }


    function formValideAnnonce(/*$bdd,$identifiant,$matiere,$commentaire*/){
        $valide = true;

        // Matiere existante
        $reqfind = $this->bdd->prepare('SELECT id_mat from matiere where id_mat = :id');
        $reqfind->execute(array(
            'id' => $this->matiere
        )) or die(print_r($this->bdd->errorInfo(), true));
        $resultatfind = $reqfind->fetch();

        if($resultatfind == null){
            ?>
            <script>
                $('#newpost-modal').foundation('reveal', 'open');
                document.getElementById('error2').style.display = 'inline';
            </script><?php
            $valide = false;
        }

        // Pas plus de 3 demandes d'aide !
        $reqfind = $this->bdd->prepare('SELECT count(id) as nbr_id from needhelp where numero_etudiant = :id');
        $reqfind->execute(array(
            'id' => $this->identifiant
        )) or die(print_r($this->bdd->errorInfo(), true));
        $resultatfind = $reqfind->fetch();

        if($resultatfind['nbr_id'] > 3){
            ?>
            <script>
                $('#newpost-modal').foundation('reveal', 'open');
                document.getElementById('error4').style.display = 'inline';
            </script><?php
            $valide = false;
        }

        // Pas plus d'1 demande d'aide par matiere !
        $reqfind = $this->bdd->prepare('SELECT count(id) as nbr_id from needhelp where numero_etudiant = :id and id_mat = :mat');
        $reqfind->execute(array(
            'id' => $this->identifiant,
            'mat' => $this->matiere
        )) or die(print_r($this->bdd->errorInfo(), true));
        $resultatfind = $reqfind->fetch();

        if($resultatfind['nbr_id'] > 0){
            ?>
            <script>
                $('#newpost-modal').foundation('reveal', 'open');
                document.getElementById('error5').style.display = 'inline';
            </script><?php
            $valide = false;
        }

        // Pas plus de 160 caracteres
        if(strlen($this->commentaire) > 160){
            ?>
            <script>
                $('#newpost-modal').foundation('reveal', 'open');
                document.getElementById('error1').style.display = 'inline';
            </script><?php
            $valide = false;
        }
        return $valide;
    }
}