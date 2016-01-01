<!DOCTYPE html>
<?php
session_start();
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
										$bdd = new PDO('mysql:host=localhost;dbname=projetbase;charset=utf8', 'root', '');
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

