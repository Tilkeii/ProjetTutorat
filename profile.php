<!DOCTYPE html>
<?php
session_start();
include ('BD/parametres.php');
$bdd = db_connect();

if(isset($_SESSION['login']) and isset($_SESSION['pass']))
{
    $req = $bdd->prepare('SELECT * from etudiant left outer join groupe on etudiant.id_grp = groupe.id_grp where numero_etudiant = :id');
    $req->execute(array(
            'id' => $_SESSION['login'])
    );
    $resultat = $req->fetch();
    ?>
    <html>
    <!-- head -->
    <?php include('includes/head.php'); ?>

    <!-- body -->
    <body onload="refreshChat();">
    <title>Mon profil</title>
    <div class="off-canvas-wrap" data-offcanvas>

        <?php include 'includes/menu.php' ?>

        <div class="content medium-12 large-8">
            <h3> Modifier le profil</h3>
            <p>Certaines modifications doivent faire l'objet d'une demande auprès de l'administrateur.</p>
            <span id="error1" style="display: none; color: red;">L'identifiant existe deja<br /></span>
            <span id="error2" style="display: none; color: red;">L'adresse email existe deja<br /></span>
            <span id="error3" style="display: none; color: red;">L'identifiant doit etre compose de 8 chiffres<br /></span>
            <span id="error4" style="display: none; color: red;">Le nom ne doit comporter que des lettres (entre 2 et 30)<br /></span> <!-- Erreurs Verification Serveur -->
            <span id="error5" style="display: none; color: red;">Le prenom ne doit comporter que des lettres (entre 2 et 30)<br /></span>
            <span id="error6" style="display: none; color: red;">Une adresse email valide est requise<br /></span>
            <span id="error7" style="display: none; color: red;">Un mot de passe est requis (entre 6 et 30 caracteres)<br />Caracteres speciaux acceptes : !@#$%_;:,*?.<br /></span>
            <span id="error8" style="display: none; color: red;">Les mots de passe ne correspondent pas</span>
            <span id="error9" style="display: none; color: red;">Certains champs n'ont pas été remplis</span>
            <form data-abide action="" method="post"> <!-- PATTERN PAS FAIT -->
                <fieldset>
                    <div class="row">
                        <div class="small-12 columns">
                            <div class="name-field">
                                <label>Identifiant <small>NON MODIFIABLE</small>
                                    <input type="text" name="identifiant" placeholder="<?php echo $resultat["numero_etudiant"]; ?>"  disabled pattern="identifiant"/>
                                </label>
                                <small class="error">L'identifiant doit etre compose de 8 chiffres</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label>Nom <small>NON MODIFIABLE</small>
                                <input type="text" name="nom" placeholder="<?php echo $resultat["nom"]; ?>"  disabled pattern="nom_prenom"/>
                            </label>
                            <small class="error">Le nom ne doit comporter que des lettres (entre 2 et 30)</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label>Prenom <small>NON MODIFIABLE</small>
                                <input type="text" name="prenom" placeholder="<?php echo $resultat["prenom"]; ?>" disabled pattern="nom_prenom"/>
                            </label>
                            <small class="error">Le prenom ne doit comporter que des lettres (entre 2 et 30)</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-8 columns">
                            <label> Departement <small>NON MODIFIABLE</small>
                                <input id="dept" type="text" name="formation" placeholder="<?php echo $resultat["filiere"]; ?>" disabled/>
                            </label>
                        </div>
                        <div class="small-4 columns">
                            <label> Année <small>NON MODIFIABLE</small>
                                <input id="annee" type="text" name="formation" placeholder="<?php echo $resultat["annee"]; ?>" disabled/>
                            </label>
                            <small class="error">Selectionner une annee</small>
                        </div>
                    </div>
                </fieldset>
                <div class="row" id="input_mail">
                    <div class="small-12 columns">
                        <label> Email <small id="clickme_mail" style="color:red">CLIQUER POUR MODIFIER</small>
                            <input id="mail" type="email" name="email" placeholder="<?php echo $resultat["email"]; ?>" disabled pattern="email"/>
                        </label>
                        <small class="error">Une adresse email valide est requise</small>
                    </div>
                </div>
                <div class="row" id="input_pass">
                    <div class="small-12 columns">
                        <label> Mot de passe <small id="clickme_pass" style="color:red">CLIQUER POUR MODIFIER</small>
                            <input id="password" type="password" name="pass" placeholder="•••••••" disabled pattern="password"/>
                        </label>
                        <small class="error">Un mot de passe est requis (entre 6 et 30 caracteres)</small>
                    </div>
                </div>
                <div class="row" id="confirm_pass" style="display:none">
                    <div class="small-12 columns">
                        <label> Confirmation mot de passe
                            <input type="password" name="pass_verif" placeholder="" required pattern="password" data-equalto="password" />
                        </label>
                        <small class="error">Les mots de passe ne correspondent pas</small>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 small-centered text-center columns">
                        <input id="submit_button" class="button small secondary" type="submit" name="submit_modification" value="Valider" disabled />
                    </div>
                </div>
            </form>
        </div>

        <!-- formulaire pour requête au près d'un admin -->
        <div class="content medium-12 large-6">
            <h4> Envoyer un Mail aux administrateurs</h4>
            <form action="mailAdmin.php" method="GET">
                <p>
                    <textarea name="contenuMail" id="contenuMail" rows=10></textarea>
                    <input type="hidden" value="<?php echo $_GET["rep"]?>" id="rep" name="rep" />
                    <input type="submit" value="Envoyer Mail" name="boutonMail" id="boutonMail" />
                    <br />
                </p>
            </form>
        </div>
        
        <div class="content medium-12 large-6">
        	<h4> Mini-chat :</h4>
        	<!-- Affichage du minichat ici -->
		<div id="minichat" style='margin:0px auto;width:900px;'>
		</div>
		<!-- Fin Affichage du minichat -->
		<p>
			<input type="hidden" value=<?php echo $resultat['prenom']?> name="pseudo" id="pseudo" />
			Message : <br/><textarea name="message" rows="1" cols="30" id="message"></textarea><br />
			<input type="submit" value="Envoyer" onclick="submitChat();" />
		</p>
        </div>
        

        <!-- affichage du résultatde l'envoi du mail-->
        <?php
        if($_GET["rep"]==-2){//inscription effectuée
            ?><script>swal({title: "Good job!",text: "Inscription réussie !",type :"success"});</script><?php
        }
        else if($_GET["rep"]==1){//mail bien envoyé
            ?><script>swal({
                title: "Mail bien envoyé!",
                text:"Nous avons bien reçu votre message, merci pour votre contribution !",
                timer: 4000,
                showConfirmButton: false
                });
            </script><?php
        }
        else if($_GET["rep"]==2){//mail vide
            ?><script>swal({
                title: "Mail non envoyé :",
                text:"Votre message est vide, remplissez le champ de saisie avant de nous envoyer votre message",
                timer: 4000,
                showConfirmButton: false
                });
            </script><?php
        }
        else if($_GET["rep"]==3){//echec de l'envoi du mail
            ?><script>swal({
                title: "Mail non envoyé :",
                text:"Une erreur est survenue, veuillez réesayer. Si le problème persiste, écrivez-nous via votre messagerie",
                timer: 4000,
                showConfirmButton: false
                });
            </script><?php

        }
        else if($_GET["rep"]==4){//echec de l'envoi du mail
            ?><script>swal({
                title: "Mail non envoyé :",
                text:"Vous avez déjà envoyé un mail durant cette session.",
                timer: 4000,
                showConfirmButton: false
                });
            </script><?php

        }
        ?>

        

        <a class="exit-off-canvas"></a>
        <?php include('includes/footer_scripts.php'); ?>

        <script>
            $(document).foundation({
                    abide: {
                        patterns: {
                            identifiant: /^([0-9]){8}$/, //CUSTOM PATERN
                            nom_prenom: /^([a-zA-Z ]){2,30}$/,
                            password: /^[a-zA-Z0-9!@#$%_;:,*?.]{6,30}$/
                        }
                    }
                }
            );
            $(document).ready(function(){
                $("#input_mail").click(function(){
                    $("#mail").removeAttr("disabled").removeAttr("placeholder").focus();
                    $("#submit_button").removeAttr("disabled");
                    $("#clickme_mail").hide();
                });
                $("#input_pass").click(function(){
                    $("#password").removeAttr("disabled").removeAttr("placeholder").focus();
                    $("#submit_button").removeAttr("disabled");
                    $("#confirm_pass").show();
                    $("#clickme_pass").hide();
                });
            });
        </script>

    </body>
    <?php include 'includes/footer.php' ?>
    </html>
    <?php
    function formValideModification($bdd,$email,$pass,$pass_verif){
        $valide = true;

        //Requete
        $req_email = "SELECT count(*) AS Nbr_email FROM etudiant where email = '" . $email . "' and numero_etudiant <> '".$_SESSION["login"]."'";

        // Traitement disponibilite email
        $reponse_email = $bdd->query($req_email);
        $row_email = $reponse_email->fetch();
        $reponse_email->closeCursor();

        if(isset($_POST["email"])){
            if(empty($_POST['email'])){
                ?>
                <script>
                    $('#inscription-modal').foundation('reveal', 'open');
                    document.getElementById('error9').style.display = 'inline';
                </script><?php
                $valide = false;
            }
            if ($row_email['Nbr_email'] > 0) {
                ?>
                <script>
                    $('#inscription-modal').foundation('reveal', 'open');
                    document.getElementById('error2').style.display = 'inline';
                </script><?php
                $valide = false;
            }

            if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                ?>
                <script>
                    $('#inscription-modal').foundation('reveal', 'open');
                    document.getElementById('error6').style.display = 'inline';
                </script><?php
                $valide = false;
            }
        }

        if(!$pass)
        {
            ?>
            <script>
                $('#inscription-modal').foundation('reveal', 'open');
                document.getElementById('error9').style.display = 'inline';
            </script><?php
            $valide = false;
        }

        if($pass && isset($_POST['pass']) && isset($_POST['pass_verif'])){
            if(!preg_match('/^[a-zA-Z0-9!@#$%_;:,*?.]{6,30}$/', $_POST['pass'])) //pass en clair pour verifier son contenu
            {
                ?>
                <script>
                    $('#inscription-modal').foundation('reveal', 'open');
                    document.getElementById('error7').style.display = 'inline';
                </script><?php
                $valide = false;
            }
            if($pass != $pass_verif)
            {
                ?>
                <script>
                    $('#inscription-modal').foundation('reveal', 'open');
                    document.getElementById('error8').style.display = 'inline';
                </script><?php
                $valide = false;
            }
        }
        return $valide;
    }

    if (isset($_POST['submit_modification'])) {
        $identifiant = htmlspecialchars($_SESSION['login']);
        isset($_POST['email']) && !empty($_POST["email"]) ? $email = htmlspecialchars($_POST['email']) : $email = $resultat["email"];
        isset($_POST['pass']) && !empty($_POST["pass"]) ? $pass = sha1($_POST['pass']) : $pass = /*false*/$resultat['mdp'];
        isset($_POST['pass_verif']) && !empty($_POST["pass_verif"]) ? $pass_verif = sha1($_POST['pass_verif']) : $pass_verif = $resultat['mdp']/*false*/;

        if(formValideModification($bdd,$email,$pass,$pass_verif))
        {
            $req = $bdd->prepare('UPDATE etudiant SET mdp = :pass, email = :email WHERE numero_etudiant = :identifiant');
            $req->execute(array(
                'pass' => $pass,
                'email' => $email,
                'identifiant' => $identifiant
            ))  or die(print_r($req->errorInfo(), true));
            ?>
            <script>
                swal({title : "Good job!", text : "Modifications terminées !", type : "success"}, function () {
                    window.location.href = "profile.php";
                });
            </script>
            <?php
        } // pas besoin de else : deja geré dans la fonction
    }

}
else{
    header('Location: index.php');
}
?>

