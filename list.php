<!DOCTYPE html>
<?php
session_start();
try {
    $bdd = new PDO('mysql:host=sql.e-tutorat.tk;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
if(isset($_SESSION['login']) and isset($_SESSION['pass']))
{

// recuperation des annonces

$req = $bdd->prepare('SELECT nom_mat,commentaire,date_publication
							from needhelp
							left join matiere on needhelp.id_mat = matiere.id_mat
							where numero_etudiant <> :id
							order by date_publication desc');
$req->execute(array(
				'id' => $_SESSION['login'])
) or die(print_r($bdd->errorInfo(), true));
$resultat = $req->fetchAll();

// recuperation matieres
$req = $bdd->prepare('select * from matiere');
$req->execute() or die(print_r($bdd->errorInfo(), true));
$matieres = $req->fetchAll();


?>
<html>
<!-- head -->
<?php include('includes/head.php'); ?>
<!-- body -->
<body>
<div class="off-canvas-wrap" data-offcanvas>

	<?php include 'includes/menu.php' ?>

	<div id="content">
		<div class="row">
			<div class="large-8 small-12 columns"><h3>Dernières demandes d'aide</h3></div>
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
						"<td style=\"text-align:center\"><input class=\"button secondary tiny\" type=\"submit\" value=\"Proposer son aide\" data-reveal-id=\"reponse-modal\"/></td></tr>";
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

	<!-- formulaire accepter annonce -->
	<div id="reponse-modal" class="reveal-modal small" data-reveal aria-labelledby="reponse" aria-hidden="true"
		 role="dialog">
		<!-- Page connexion here -->
		<h3>Répondre à une annonce</h3>
		<span id="error1" style="display: none; color: red;">Commentaire trop long.<br/></span>

		<form data-abide action="" method="post">
			<div class="row">
				<div class="small-12 columns">
					<label> Commentaire
						<small class="chars_info_reponse"></small>
						<textarea class="commentaire_reponse" name="commentaire_reponse" rows="3" maxlength="160"
								  placeholder="Courte réponse (infos contact, disponibilités, etc.)" required></textarea>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="small-12 small-centered text-center columns">
					<label>Êtes-vous sûr de vouloir répondre à cette demande d'aide ?
						<input class="button small success" type="submit" name="submit_reponse" value="Oui, je confirme"/>
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
			$('.commentaire_reponse').change(function () {
						var charleft = 160 - $('.commentaire_reponse').val().length;
						if (charleft > 20)
							$('.chars_info_reponse').text(charleft + ' caractères restant').css('color', 'green');
						else
							$('.chars_info_reponse').text(charleft + ' caractères restant').css('color', 'red');
					})
					.keyup(function () {
						var charleft = 160 - $('.commentaire_reponse').val().length;
						if (charleft > 20)
							$('.chars_info_reponse').text(charleft + ' caractères restant').css('color', 'green');
						else
							$('.chars_info_reponse').text(charleft + ' caractères restant').css('color', 'red');
					});
		});
	</script>
</body>

<?php include 'includes/footer.php' ?>
</html>

<?php
// Annonce valide
function formValideAnnonce($bdd,$identifiant,$matiere,$commentaire){
	$valide = true;

	// Matiere existante pls
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

//Nouveau post
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
		?><script>swal("Good job!", "Ajout reussi !", "success");</script><?php
	}
}

// Reponse post
else if (isset($_POST['submit_reponse'])) {
	?><script>alert('pouf');</script><?php
}

}
else{
	header('Location: index.php');
}
?>
