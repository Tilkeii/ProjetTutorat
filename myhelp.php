<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['login']) and isset($_SESSION['pass']))
{

// recuperation des annonces
include ('BD/parametres.php');
$bdd = db_connect();
$req = $bdd->prepare('SELECT aide.id as id,nom_mat,commentaire,date_publication,titre as etat
							from aide
							left join needhelp on aide.id_needhelp = needhelp.id
							left join matiere on needhelp.id_mat = matiere.id_mat
							left join etat_aide on aide.etat = etat_aide.id
							where aide.numero_etudiant = :id
							order by date_publication desc');
$req->execute(array(
				'id' => $_SESSION['login'])
) or die(print_r($bdd->errorInfo(), true));
$resultat = $req->fetchAll();

?>
<html>
<!-- head -->
<?php include('includes/head.php'); ?>
<!-- body -->
<body>
<title>Mes réponses en attente</title>
<div class="off-canvas-wrap" data-offcanvas>

	<?php include 'includes/menu.php' ?>

	<div class="content medium-12 large-8">
		<div class="row">
			<div class="large-8 small-12 columns"><h3>Mes réponses en attente</h3></div>
			<div class="large-4 small-12 columns"><input type="submit" class="button small" style="width:100%"
														 value="Proposer son aide" onclick="window.location = 'list.php'"/>
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
						"<td style=\"text-align:right\">".$r["etat"]."</td></tr>";
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
		function help_offer(idannonce){
			toggleLoading();
			$.post("Query/proposeaide.php",{idannonce:idannonce},function(data){
				toggleLoading();
				swal({title : "Good job!", text : "Proposition d'aide envoyee !", type : "success"}, function () {
					window.location.href = "profile.php";
				});
			});
		}
	</script>
</body>

<?php include 'includes/footer.php' ?>
</html>

<?php
}
else{
	header('Location: index.php');
}
?>
