<?php
session_start();


if(isset($_SESSION['login']) and isset($_SESSION['pass'])) {
    $bdd = new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');
    $reqpriv = $bdd->prepare('SELECT id_priv from etudiant where numero_etudiant = :id');
    $reqpriv->execute(array('id' => $_SESSION['login']));
    $priv = $reqpriv->fetch();

    if ($priv['id_priv'] == 2) {
?>
<html>
    <!-- head -->
    <?php include('includes/head.php'); ?>
    <!-- body -->
    <body>
        <div class="off-canvas-wrap" data-offcanvas>

            <?php include 'includes/menu.php' ?>
			
            <div class="content medium-12 large-8">
            	<div class="row">
					<div class="large-8 small-12 columns"><h3>Liste des Etudiants</h3></div>
				</div>
				<table>
					<thead>
					<tr>
						<th>Numéro étudiant</th>
						<th>Prénom</th>
						<th>Nom</th>
					</tr>
					</thead>
					<!--récupération des étudiants et insertion dans tableau-->
					<?php
					$req = $bdd->prepare('select * from etudiant');
					$req->execute() or die(print_r($bdd->errorInfo(),true));
					$etudiants = $req->fetchAll();
					
					foreach($etudiants as $r)
						echo"<tr><td>" . $r["numero_etudiant"] . "</td>" .
								"<td>" . $r["prenom"] . "</td>" .
								"<td>" . $r["nom"] . "</td>" ;
					?>
				</table>
			</div>

        </div>
        <?php include('includes/footer_scripts.php'); ?>
    </body>

    <?php include 'includes/footer.php' ?>
</html>
<?php
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
