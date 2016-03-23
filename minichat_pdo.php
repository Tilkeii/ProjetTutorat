<?php
// Version avec PDO
header("Content-Type: text/html; charset=iso-8859-1");

include('BD/parametres.php');
$conn = db_connect();

if (isset($_POST['pseudo']) && isset($_POST['message'])) 
{
    if (!empty($_POST['pseudo']) && !empty($_POST['message'])) 
    {
	$message = utf8_decode($_POST['message']);
        $pseudo = utf8_decode($_POST['pseudo']);
        $query = $conn->prepare("INSERT INTO minichat(pseudo,message,timestamp) VALUES(:pseudo, :message, :timestamp)");
        $query->bindParam(":pseudo", $pseudo);
        $query->bindParam(":message", $message);
        $query->bindParam(":timestamp", time());
		$query->execute();
    }
}
$sql = "SELECT * FROM minichat ORDER BY id DESC LIMIT 0,10";
foreach($conn->query($sql) as $val)
{
	echo '<br/> <strong>'.htmlentities(stripslashes($val['pseudo'])).'</strong> a '.date('H\:i\:s',$val['timestamp']).' : '. htmlentities(stripslashes($val['message']));
}
?>
