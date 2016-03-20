<?php
    function db_connect(){
        try{
            //INFOS de connection
            $host = '89.234.180.28';
            $dbname = 'w4130d_tutorat';
            $charset = 'utf8';
            $user = 'w4130d_tutorat';
            $password = '159753Tu';

            $db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset='.$charset.'',$user,$password);
            return $db;

        } catch(PDOException $e){
            print('Erreur de connection : '. $e->getMessage());
        }
    }
?>
