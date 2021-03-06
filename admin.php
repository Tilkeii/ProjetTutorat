<!DOCTYPE html>
<?php
session_start();


if(isset($_SESSION['login']) and isset($_SESSION['pass'])) {
    include ('BD/parametres.php');
    $bdd = db_connect();
    $reqpriv = $bdd->prepare('SELECT id_priv from etudiant where numero_etudiant = :id');
    $reqpriv->execute(array('id' => $_SESSION['login']));
    $priv = $reqpriv->fetch();


	//recuperation des etudiants
	$req = $bdd->prepare('select * from etudiant where numero_etudiant<>:id');
	$req->execute(array('id' => $_SESSION['login'])) or die(print_r($bdd->errorinfo(),true));
	$etudiants = $req->fetchall();

    //recupération des années
	$req = $bdd->prepare('select * from infos');
	$req->execute();
	$annees = $req->fetch();

    if ($priv['id_priv'] > 1) {
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
                    <h3>Liste des options disponibles</h3>
                    <br/>
                    <table>
                    	<tr>
                    	    <td>
                    	    <div class="large-4 small-10 columns"> <input type="submit" class="button small" style="width:100%" value="Changer d'année" onclick="changementAnnee()"/> </div>
                    	    <div class="large-4 small-10 columns"> <input type="submit" class="button small" style="width:100%" value="Poster une news" data-reveal-id="newpost-modal"/> </div>
                    	    </td>
                    	</tr>
                    	<tr>
                    	    <td>
                    	        <div class="large-4 small-10 columns"> <input type="submit" class="button small" style="width:100%" value="Supprimer le contenu du chat" onclick="suppressionContenuChat()"/> </div>
                    	    </td>
                    	</tr>
                    </table>
                </div>
                <div> Année scolaire actuelle: <?php echo("".$annees["anneeEnCours"]."/".$annees["anneeSuivante"]);?> </div> <br/>
            	<div class="row">
		    		<div class="large-8 small-12 columns"><h3>Liste des Etudiants</h3></div>
				</div>
				<table>
		    		<thead>
		    		<tr>
		        		<th>Numéro étudiant</th>
		        		<th>Prénom</th>
		        		<th>Nom</th>
						<th width="25%" colspan="2" >Actions</th>
		    		</tr>
		    		</thead>
		    		<!--récupération des étudiants et insertion dans tableau-->
		    		<?php
		    		foreach($etudiants as $r){
		        		echo"<tr><td>" . $r["numero_etudiant"] . "</td>" .
						"<td>" . $r["prenom"] . "</td>" .
						"<td>" . $r["nom"] . "</td>" .
						"<td style=\"text-align:center\"><input class=\"button warning tiny\" type=\"submit\"
						value=\"Supprimer\" onclick=\"delete_user(".$r["numero_etudiant"].")\"/></td>";
                        if($r["id_priv"]==1){
                                echo "<td style=\"text-align:center\"><input class=\"button success tiny\" type=\"submit\" value=\"Rendre Admin\" onclick=\"rendre_admin(".$r["numero_etudiant"].")\"/></td>";
                                
                        }
                        else{
                            echo "<td style=\"text-align:center\"><input class=\"button success tiny\" type=\"submit\" value=\"Rendre User\" onclick=\"rendre_user(".$r["numero_etudiant"].")\"/></td>";
                        }
                        echo "</tr>";
                    }
		    		?>
				</table>

                <!-- partie ajout d'une news -->
                
                    <div id="newpost-modal" class="reveal-modal small" data-reveal aria-labelledby="newpost" aria-hidden="true" role="dialog">
                        <form data-abide action="" method="post">
                            <h3> Nouvelle news </h3>
			                <div class="row">
				                <div class="small-12 columns">
					                <label>Titre de la news :
                                        <input type="text" name="titre" placeholder=""/>
					                </label>
				                </div>
			                </div>
			                <div class="row">
				                <div class="small-12 columns">
					                <label> Contenu de la news :
						                <small class="chars_info"></small>
						                    <textarea class="contenu" name="contenu" rows="4" maxlength="300"
								                placeholder="Contenu de la news" required></textarea>
					                </label>
				                </div>
			                </div>
			                <div class="row">
				                <div class="small-12 small-centered text-center columns">
					                <input class="button small secondary" type="submit" name="submit_news" value="Valider"/>
				                </div>
			                </div>
		                </form>
		                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
	                </div>
                </div>
            </div>	
	</div>
	
        
        
        <?php include('includes/footer_scripts.php'); ?>
		<script>
			$(document).foundation();
            $(document).ready(function () {
			    $('.contenu').change(function () {
						var charleft = 300 - $('.contenu').val().length;
						if (charleft > 20)
							$('.chars_info').text(charleft + ' caractères restant').css('color', 'green');
						else
							$('.chars_info').text(charleft + ' caractères restant').css('color', 'red');
					})
					.keyup(function () {
						var charleft = 300 - $('.contenu').val().length;
						if (charleft > 20)
							$('.chars_info').text(charleft + ' caractères restant').css('color', 'green');
						else
							$('.chars_info').text(charleft + ' caractères restant').css('color', 'red');
					});
		});

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
            function rendre_admin(iduser){
                    swal({
						title: "Attention !",
						text: "Voulez vous vraiment donner les privilèges à cet utilisateur ?",
						type: "warning",
						cancelButtonText: "Annuler",
						showCancelButton: true,
						cancelButtonColor: "#FF0000",
						cancelButtonText: "Annuler",
						confirmButtonText: "Confirmer",
						closeOnConfirm: false,
						closeOnCancel: false,
						showLoaderOnConfirm: true,
						showLoaderOnCancel: true
					},
					function(isConfirm){
                        if(isConfirm){
						        $.post("Query/changementDroits.php",{iduser:iduser},function(data){
							        swal({title : "Good job!", text : "Droits donnés !", type : "success"}, function () {
								    window.location.href = "admin.php";
							    });
						    });
                        }
                        else {
                            swal({title : "Annulation", text : "Droits non donnés", type : "error"}, function () {
						    });

                        }
					});

            }

            function rendre_user(iduser){
                    swal({
						title: "Attention !",
						text: "Voulez vous vraiment enlever les privilèges de cet utilisateur ?",
						type: "warning",
						cancelButtonText: "Annuler",
						showCancelButton: true,
						cancelButtonColor: "#FF0000",
						cancelButtonText: "Annuler",
						confirmButtonText: "Confirmer",
						closeOnConfirm: false,
						closeOnCancel: false,
						showLoaderOnConfirm: true,
						showLoaderOnCancel: true
					},
					function(isConfirm){
                        if(isConfirm){
						        $.post("Query/changementDroits.php",{iduser:iduser},function(data){
							        swal({title : "Good job!", text : "Droits enlevés !", type : "success"}, function () {
								    window.location.href = "admin.php";
							    });
						    });
                        }
                        else {
                            swal({title : "Annulation", text : "Droits non enlevés", type : "error"}, function () {
						    });

                        }
					});

            }
            function changementAnnee(){
                    swal({
						title: "Attention !",
						text: "Voulez-vous vraiment passer à l'année suivante ? Cela signifie supprimer toutes les aides en cours et les étudiants de deuxième année.",
						type: "warning",
						cancelButtonText: "Annuler",
						showCancelButton: true,
						cancelButtonColor: "#FF0000",
						cancelButtonText: "Annuler",
						confirmButtonText: "Confirmer",
						closeOnConfirm: false,
						closeOnCancel: false,
						showLoaderOnConfirm: true,
						showLoaderOnCancel: true
					},
					function(isConfirm){
                        if(isConfirm){
						        $.post("Query/changementAnnee.php",function(){
							        swal({title : "Good job!", text : "Passage d'année effectuée !", type : "success"}, function () {
								    window.location.href = "admin.php";
							    });
						    });
                        }
                        else {
                            swal({title : "Annulation", text : "Passage d'année non effectuée", type : "error"}, function () {
						    });

                        }
					});

            }
            function suppressionContenuChat(){
                    swal({
						title: "Attention !",
						text: "Supprimer le contenu du chat de la base de données ?",
						type: "warning",
						cancelButtonText: "Annuler",
						showCancelButton: true,
						cancelButtonColor: "#FF0000",
						cancelButtonText: "Annuler",
						confirmButtonText: "Confirmer",
						closeOnConfirm: false,
						closeOnCancel: false,
						showLoaderOnConfirm: true,
						showLoaderOnCancel: true
					},
					function(isConfirm){
                        if(isConfirm){
						        $.post("Query/suppressionContenuChat.php",function(){
							        swal({title : "Good job!", text : "Suppression du contenu du chat effectuée", type : "success"}, function () {
								    window.location.href = "admin.php";
							    });
						    });
                        }
                        else {
                            swal({title : "Annulation", text : "Passage d'année non effectuée", type : "error"}, function () {
						    });

                        }
					});

            }
		</script>
    </body>

    <?php include 'includes/footer.php' ?>
</html>
<?php

if(isset($_POST['submit_news'])){
    $titre = $_POST["titre"];
    $contenu = $_POST["contenu"];

    if(strlen($contenu)<=300){
        $req = $bdd->prepare('DELETE FROM news');
        $req->execute() or die(print_r($bdd->errorInfo(), true));

        $req = $bdd->prepare('INSERT INTO news(titre,contenu,datePublication) VALUES(:titre, :contenu, :datep)');
        $req->execute(array(
                'titre' => $titre,
                'contenu' => $contenu,
                'datep' => date('Y-m-d')
        )) or die(print_r($bdd->errorInfo(), true));
        ?>
        <script>swal({title : "Good job!", text : "Ajout réussi!", type : "success"}, function () {
            window.location.href = "admin.php"
            });
        </script>
        <?php
    }
}
        
    } else {
        header('Location: index.php');
    }
}?>
