<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['login']) and isset($_SESSION['pass']))
{

// recuperation des annonces
include ('BD/parametres.php');
$bdd = db_connect();
$req = $bdd->prepare('SELECT id,nom_mat,commentaire,date_publication,etat
							from needhelp
							left join matiere on needhelp.id_mat = matiere.id_mat
							where numero_etudiant = :id
							order by etat desc');
$req->execute(array(
				'id' => $_SESSION['login'])
) or die(print_r($bdd->errorInfo(), true));
$resultat = $req->fetchAll();

// recuperation matieres de l'étudiant
$req = $bdd->prepare('select id_grp from etudiant where numero_etudiant = :idetu');
$req->execute(array(
				'idetu' => $_SESSION['login'])
) or die(print_r($bdd->errorInfo(), true));
$resultat2 = $req->fetch();

$req = $bdd->prepare('select * from matiere where id_mat in(select id_mat from cours where id_grp = :idgrp)');
$req->execute(array(
				'idgrp' => $resultat2['id_grp'])
) or die(print_r($bdd->errorInfo(), true));
$matieres = $req->fetchAll();

?>
<html>
<!-- head -->
<?php include('includes/head.php'); ?>
<!-- body -->
<body>
<title>Mes demandes d'aide</title>
<div class="off-canvas-wrap" data-offcanvas>

	<?php include 'includes/menu.php' ?>

	<div class="content medium-12 large-8">
		<div class="row">
			<div class="large-8 small-12 columns"><h3>Mes demandes d'aide</h3></div>
			<div class="large-4 small-12 columns"><input type="submit" class="button small" style="width:100%"
														 value="Poster une annonce" data-reveal-id="newpost-modal"/>
			</div>
		</div>
		<table class="hover" style="width:100%">
			<thead>
			<tr>
				<th>Matière</th>
				<th>Commentaire</th>
				<th style="text-align:right">Date de publication</th>
				<th></th>
			</tr>
			</thead>
			<?php foreach ($resultat as $r)
				echo "<tr><td>" . $r["nom_mat"] . "</td>" .
						"<td>" . $r["commentaire"] . "</td>" .
						"<td style=\"text-align:right\">" . date("d/m/Y", strtotime($r["date_publication"])) . "</td>" .
						($r["etat"] == 1 ?
								"<td style=\"text-align:center\"><input class=\"button success tiny\" type=\"submit\" value=\"Répondre\" onclick=\"accept_post(".$r["id"].")\"/></td></tr>":
								"<td style=\"text-align:center\"><input class=\"button warning tiny\" type=\"submit\" value=\"Supprimer\" onclick=\"delete_post(".$r["id"].")\"/></td></tr>");
			?>
        </table>
	</div>

	<!-- Formulaire ajouter annonce -->
	<div id="newpost-modal" class="reveal-modal small" data-reveal aria-labelledby="newpost" aria-hidden="true"
		 role="dialog">
		<!-- Page connexion here -->
		<h3>Nouvelle annonce</h3>
		<span id="error1" style="display: none; color: red;">Commentaire trop long.<br/></span>
		<span id="error2" style="display: none; color: red;">La matière choisie est inconnue.</span>
		<span id="error4" style="display: none; color: red;">Vous ne pouvez pas publier plus de 3 annonces à la fois.</span>
		<span id="error5" style="display: none; color: red;">Vous avez déjà demandé de l'aide dans cette matière.</span>

		<form data-abide action="" method="post">
			<div class="row">
				<div class="small-12 columns">
					<label>Matière
						<select name="matiere" required>
							<option value="">Sélectionner une matière</option>
							<?php
							foreach($matieres as $row)
								echo "<option value=\"".$row["id_mat"]."\">".$row["nom_mat"]."</option>";
							?>
						</select>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="small-12 columns">
					<label> Commentaire
						<small class="chars_info"></small>
						<textarea class="commentaire" name="commentaire" rows="3" maxlength="160"
								  placeholder="Courte description du problème..." required></textarea>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="small-12 small-centered text-center columns">
					<input class="button small secondary" type="submit" name="submit_newpost" value="Valider"/>
				</div>
			</div>
		</form>
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>

	<!-- formulaire supprimer annonce -->
	<div id="delete-modal" class="reveal-modal small" data-reveal aria-labelledby="delete" aria-hidden="true"
		 role="dialog">
		<!-- Page connexion here -->
		<span id="error1" style="display: none; color: red;">Cette annonce n'existe pas.<br/></span>

		<form data-abide action="" method="post">
			<div class="row">
				<div class="small-12 small-centered text-center columns">
					<label>Désirez-vous vraiment supprimer l'annonce ?<br/><br/>
						<input class="button alert" type="submit" name="submit_delete" value="Oui, supprimer l'annonce"/>
					</label>
				</div>
			</div>
		</form>
		<a class="close-reveal-modal" aria-label="Close">&#215;</a>
	</div>

	<?php include('includes/footer_scripts.php'); ?>

	<script>
		$(document).foundation();
		$(document).ready(function () {
			$('.commentaire').change(function () {
						var charleft = 160 - $('.commentaire').val().length;
						if (charleft > 20)
							$('.chars_info').text(charleft + ' caractères restant').css('color', 'green');
						else
							$('.chars_info').text(charleft + ' caractères restant').css('color', 'red');
					})
					.keyup(function () {
						var charleft = 160 - $('.commentaire').val().length;
						if (charleft > 20)
							$('.chars_info').text(charleft + ' caractères restant').css('color', 'green');
						else
							$('.chars_info').text(charleft + ' caractères restant').css('color', 'red');
					});
		});
		function accept_post(idannonce){
			swal({
						title: "Attention !",
						text: "En acceptant l'aide proposée, vos adresses mail seront échangées et votre annonce supprimée. Continuer ?",
						type: "warning",
						showCancelButton: true,
						cancelButtonColor: "#FF0000",
						cancelButtonText: "Refuser l'aide",
						confirmButtonText: "Accepter l'aide",
						closeOnConfirm: false,
						closeOnCancel: false,
						showLoaderOnConfirm: true,
						showLoaderOnCancel: true
					},
					function(isConfirm){
						if(isConfirm){
							$.post("Query/accepteaide.php",{idannonce:idannonce},function(data){
								swal({title : "Good job!", text : "Aide acceptee !", type : "success"}, function () {
									window.location.href = "list.php";
								});
							});
						} else {
							toggleLoading();
							$.post("Query/refuseaide.php",{idannonce:idannonce},function(data){
								toggleLoading();
								swal({title : "Succes", text : "Aide refusee", type : "error"}, function () {
									window.location.href = "egolist.php";
								});
							});
						}
					});
		}
		function delete_post(idannonce){
			swal({
						title: "Attention !",
						text: "Etes-vous sur de vouloir supprimer cette annonce ?",
						type: "warning",
						cancelButtonText: "Annuler",
						showCancelButton: true,
						closeOnConfirm: false,
					    showLoaderOnConfirm: true
					},
					function(){
						$.post("Query/supprimeannonce.php",{idannonce:idannonce},function(data){
							swal({title : "Good job!", text : "Suppression terminée !", type : "success"}, function () {
								window.location.href = "egolist.php";
							});
						});
					});
		}
	</script>
</body>

<?php include 'includes/footer.php' ?>
</html>

<?php
// Annonce valide
function formValideAnnonce($bdd,$identifiant,$matiere,$commentaire){
	$valide = true;

	// Matiere existante
	$reqfind = $bdd->prepare('SELECT id_mat from matiere where id_mat = :id');
	$reqfind->execute(array(
			'id' => $matiere
	)) or die(print_r($bdd->errorInfo(), true));
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
	$reqfind = $bdd->prepare('SELECT count(id) as nbr_id from needhelp where numero_etudiant = :id');
	$reqfind->execute(array(
			'id' => $identifiant
	)) or die(print_r($bdd->errorInfo(), true));
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
	$reqfind = $bdd->prepare('SELECT count(id) as nbr_id from needhelp where numero_etudiant = :id and id_mat = :mat');
	$reqfind->execute(array(
			'id' => $identifiant,
			'mat' => $matiere
	)) or die(print_r($bdd->errorInfo(), true));
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
	if(strlen($commentaire) > 160){
		?>
		<script>
			$('#newpost-modal').foundation('reveal', 'open');
			document.getElementById('error1').style.display = 'inline';
		</script><?php
		$valide = false;
	}
	return $valide;
}

// Nouveau post
if (isset($_POST['submit_newpost'])) {
	$identifiant = $_SESSION["login"];
	$matiere	 = $_POST["matiere"];
	$commentaire = htmlspecialchars(str_replace(array("\r", "\n"), ' ',$_POST["commentaire"]));

	if(formValideAnnonce($bdd,$identifiant,$matiere,$commentaire)){

		$req = $bdd->prepare('INSERT INTO needhelp(numero_etudiant, id_mat, commentaire, date_publication)
											VALUES(:identifiant, :matiere, :commentaire, :datep)');
		$req->execute(array(
				'identifiant' => $identifiant,
				'matiere' => $matiere,
				'commentaire' => $commentaire,
				'datep' => date('Y-m-d')
		)) or die(print_r($bdd->errorInfo(), true));
		?>
        <script>swal({title : "Good job!", text : "Ajout reussi !", type : "success"}, function () {
            window.location.href = "egolist.php"
            });
        </script>
        <?php
	}
}

// Suppression annonce
else if (isset($_POST['submit_delete'])) {
}

}
else{
	header('Location: index.php');
}
?>
