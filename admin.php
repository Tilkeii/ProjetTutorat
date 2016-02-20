<!DOCTYPE html>
<?php
session_start();


if(isset($_SESSION['login']) and isset($_SESSION['pass'])) {
    $bdd = new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');
    $reqpriv = $bdd->prepare('SELECT id_priv from etudiant where numero_etudiant = :id');
    $reqpriv->execute(array('id' => $_SESSION['login']));
    $priv = $reqpriv->fetch();


	//recuperation des etudiants
	$req = $bdd->prepare('select * from etudiant where numero_etudiant<>:id');
	$req->execute(array('id' => $_SESSION['login'])) or die(print_r($bdd->errorinfo(),true));
	$etudiants = $req->fetchAll();

    if ($priv['id_priv'] == 2) {
?>
<html>
    <!-- head -->
    <?php include('includes/head.php'); ?>
    <!-- body -->
    <body>
		<title>Page d'administration</title>
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
						<th>Actions</th>
		    		</tr>
		    		</thead>
		    		<!--récupération des étudiants et insertion dans tableau-->
		    		<?php
		    		foreach($etudiants as $r)
		        		echo"<tr><td>" . $r["numero_etudiant"] . "</td>" .
						"<td>" . $r["prenom"] . "</td>" .
						"<td>" . $r["nom"] . "</td>" .
						"<td style=\"text-align:center\"><input class=\"button warning tiny\" type=\"submit\"
						value=\"Supprimer\" onclick=\"delete_user(".$r["numero_etudiant"].")\"/></td></tr>";
		    		?>
				</table>	
			</div> 	
		</div>	
        <?php include('includes/footer_scripts.php'); ?>
		<script>
			$(document).foundation();
			function delete_user(iduser){
                swal({
						title: "Attention !",
						text: "Êtes vous sûr de vouloir supprimer l'étudiant de la base ainsi que toutes ses offres/demandes en cours ?",
						type: "warning",
						cancelButtonText: "Annuler",
						showCancelButton: true,
						closeOnConfirm: false,
						showLoaderOnConfirm: true
					},
					function(){
						$.post("Query/supprimeetudiant.php",{iduser:iduser},function(data){
							swal({title : "Good job!", text : "Suppression terminée !", type : "success"}, function () {
								window.location.href = "admin.php";
							});
						});
					});	
			}
		</script>
    </body>

    <?php include 'includes/footer.php' ?>
</html>
<?php
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}?>