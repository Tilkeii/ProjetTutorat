<?php
session_start();
if(isset($_POST["idannonce"])){
    include ('../BD/parametres.php');
    $bdd = db_connect();
    $req = $bdd->prepare('DELETE FROM helper
                          WHERE id = :idannonce
                           ');
    $req->execute(array('idannonce' => $_POST["idannonce"])) or die(print_r('3'.$bdd->errorInfo(), true));

    echo "ok";
}
else{
    echo "not ok lol";
}
