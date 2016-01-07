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
							from helper
							left join matiere on helper.id_mat = matiere.id_mat
							where numero_etudiant = :id
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
			<div class="large-8 small-12 columns"><h3>Mes propositions d'aide</h3></div>
			<div class="large-4 small-12 columns"><input type="submit" class="button small" style="width:100%"
														 value="Poster une proposition d'aide" data-reveal-id="newpost-modal"/>
			</div>
		</div>
		<table class="hover">
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
						"<td style=\"text-align:center\"><input class=\"button warning tiny\" type=\"submit\" value=\"Supprimer\" data-reveal-id=\"delete-modal\"/></td></tr>";
			?>
	</div>

	<!-- Formulaire ajouter proposition -->
	<div id="newpost-modal" class="reveal-modal small" data-reveal aria-labelledby="newpost" aria-hidden="true"
		 role="dialog">
		<!-- Page connexion here -->
		<h3>Nouvelle annonce</h3>
		<span id="error1" style="display: none; color: red;">Commentaire trop long.<br/></span>
		<span id="error2" style="display: none; color: red;">La matière choisie est inconnue.</span>
		<span id="error4" style="display: none; color: red;">Vous ne pouvez pas publier plus de 3 propositions à la fois.</span>
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
								  placeholder="Courte description des connaissances..." required></textarea>
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

	<!-- formulaire supprimer proposition -->
	<div id="delete-modal" class="reveal-modal small" data-reveal aria-labelledby="delete" aria-hidden="true"
		 role="dialog">
		<!-- Page connexion here -->
		<span id="error1" style="display: none; color: red;">Cette annonce n'existe pas.<br/></span>

		<form data-abide action="" method="post">
			<div class="row">
				<div class="small-12 small-centered text-center columns">
					<label>Désirez-vous vraiment supprimer la proposition ?<br/><br/>
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
	</script>
</body>

<?php //include 'includes/footer.php' ?>
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

	// Pas plus de 3 propositions d'aide !
	$reqfind = $bdd->prepare('SELECT count(id) as nbr_id from helper where numero_etudiant = :id');
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

	// Pas plus d'1 proposition d'aide par matiere !
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

		$req = $bdd->prepare('INSERT INTO helper(numero_etudiant, id_mat, commentaire, date_publication)
											VALUES(:identifiant, :matiere, :commentaire, :datep)');
		$req->execute(array(
				'identifiant' => $identifiant,
				'matiere' => $matiere,
				'commentaire' => $commentaire,
				'datep' => date('Y-m-d')
		)) or die(print_r($bdd->errorInfo(), true));
		?><script>swal("Good job!", "Ajout reussi !", "success");window.location=window.location.href;</script><?php
			
	}
}

// Suppression annonce
else if (isset($_POST['submit_delete'])) {
	?><script>alert('pouf');</script><?php
}

}
else{
	header('Location: index.php');
}
?>
