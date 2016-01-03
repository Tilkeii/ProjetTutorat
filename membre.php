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
	?>
		<html>
		<!-- head -->
			<head>
				<link rel="stylesheet" href="foundation/css/foundation.css"/>
				<link rel="stylesheet" href="foundation/css/app.css"/>
				<link rel="stylesheet" href="CSS/default.css"/>
					<script src="foundation/js/vendor/modernizr.js"></script>
			</head>
			<!-- body -->
			<body>
				<div class="off-canvas-wrap" data-offcanvas>
					<div class="inner-wrap">
						<!-- debut banniere -->
						<!-- en-tete mobile -->
						<div id="ban_mobile" class="show-for-small-down">
							<div id="navbar">
								<ul>
									<li class="left-off-canvas-toggle menu-icon"><a href="#" ><span>Menu</span></a></li>
								</ul>
							</div>
							<aside class="left-off-canvas-menu">
								<ul id="navbar_menu_mobile" class="menu">
									<li><a href="#">Accueil</a></li>
									<li><a href="#" data-reveal-id="inscription-modal">Inscription</a></li>
									<li><a href="#" data-reveal-id="connexion-modal">Connexion</a></li>
								</ul>
							</aside>
						</div>
						<!-- en-tete pc -->
						<div id="ban_pc" class="show-for-medium-up">
							<div id="ban_img">
							
							</div>
							<div id="navbar">
								<ul id="navbar_menu_pc" class="menu">
									<li id="menu_modification" class="navbar_menu_item"><a href="#" >Modifier le profil</a></li>
									<li id="menu_deconnexion" class="navbar_menu_item"><a href="deconnection.php">Deconnexion</a></li>
									<?php
										$reqfind = $bdd->prepare('SELECT id_priv from etudiant where numero_etudiant = :num');
										$reqfind->execute(array(
											'num' => $_SESSION['login']));
										$resultatfind = $reqfind->fetch();
									  	if($resultatfind['id_priv'] == 2){
											?><li id="menu_administration" class="navbar_menu_item"><a href="#" >Administration</a></li><?php
									   	}
									?>

									  
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!-- info perso -->

				<div class="row">
					<h4>Informations :</h4>
					<div class="small-6 columns">
						<p>Numero etudiant : <?php echo $_SESSION['login'] ?></p>
						<?php
							$req = $bdd->query("SELECT * FROM etudiant WHERE numero_etudiant = ".$_SESSION['login']."");
							$resp = $req->fetchAll(PDO::FETCH_ASSOC);
						?>
						<p>Nom : <?php echo $resp[0]['nom'];?></p>
						<p>Prenom : <?php echo $resp[0]['prenom'];?></p>
					</div>
					<div class="small-6 columns">
						<p>Age : <?php if($resp[0]['age'] == NULL){echo "Non renseigné";} else{ echo $resp[0]['age'];}?></p>
						<p>email : <?php echo $resp[0]['email'];?></p>
						<p>Groupe : <?php $reqgroupe = $bdd->query("SELECT filiere,annee FROM groupe,etudiant WHERE groupe.id_grp = etudiant.id_grp AND numero_etudiant = ".$_SESSION['login'].""); $resgroupe = $reqgroupe->fetchAll(PDO::FETCH_ASSOC); echo $resgroupe[0]['filiere']." - "; echo $resgroupe[0]['annee'];?></p>
					</div>
				</div>

				<div class="row">
					<div class="small-6 columns">
						<h4>Demande d'aide</h4>
						<div class="small-12 columns">

						</div>
					</div>
					<div class="small-6 columns">
						<h4>Proposition d'aide</h4>
					</div>
				</div>

				<div class="row">
					<div class="small-12 columns">

					</div>
				</div>

				<script src="foundation/js/vendor/jquery.js"></script>
				<script src="foundation/js/foundation.min.js"></script>
				<script>
					$(document).foundation();
				</script>
			</body>
		</html>
	<?php
	}
	else{
		header('Location: index.php');
	}
	?>

