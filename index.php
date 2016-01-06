<?php
ob_start(); //Permet de mettre le header n'importe ou dans le code : sinon doit se placer avant le code html
session_start();
try {
    $bdd = new PDO('mysql:host=sql.e-tutorat.tk;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>

<!DOCTYPE html>
<html>
<!-- head -->
<?php include('includes/head.php'); ?>

<!-- body -->
<body>
<?php
    if(isset($_SESSION['login']) and isset($_SESSION['pass']))
        include("includes/menu.php");
    else {?>
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
                    <li id="menu_accueil" class="navbar_menu_item"><a href="#">Accueil</a></li>
                    <li id="menu_inscription" class="navbar_menu_item"><a href="#" data-reveal-id="inscription-modal">Inscription</a></li>
                    <li id="menu_connexion" class="navbar_menu_item"><a href="#" data-reveal-id="connexion-modal">Connexion</a></li>
                </ul>
            </div>

            <div id="inscription-modal" class="reveal-modal tiny" data-reveal aria-labelledby="inscription" aria-hidden="true" role="dialog">
                <!-- Page inscription here -->
                <h3>Inscription</h3>
                <span id="error1" style="display: none; color: red;">L'identifiant existe deja<br /></span>
                <span id="error2" style="display: none; color: red;">L'adresse email existe deja<br /></span>
                <span id="error3" style="display: none; color: red;">L'identifiant doit etre compose de 8 chiffres<br /></span>
                <span id="error4" style="display: none; color: red;">Le nom ne doit comporter que des lettres (entre 2 et 30)<br /></span> <!-- Erreurs Verification Serveur -->
                <span id="error5" style="display: none; color: red;">Le prenom ne doit comporter que des lettres (entre 2 et 30)<br /></span>
                <span id="error6" style="display: none; color: red;">Une adresse email valide est requise<br /></span>
                <span id="error7" style="display: none; color: red;">Un mot de passe est requis (entre 6 et 30 caracteres)<br />Caracteres speciaux acceptes : !@#$%_;:,*?.<br /></span>
                <span id="error8" style="display: none; color: red;">Les mots de passe ne correspondent pas</span>
                <form data-abide action="" method="post"> <!-- PATTERN PAS FAIT -->
                    <div class="row">
                        <div class="small-12 columns">
                            <div class="name-field">
                                <label>Identifiant <small>required</small>
                                    <input type="text" name="identifiant" placeholder=""  required pattern="identifiant"/>
                                </label>
                                <small class="error">L'identifiant doit etre compose de 8 chiffres</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label>Nom <small>required</small>
                                <input type="text" name="nom" placeholder=""  required pattern="nom_prenom"/>
                            </label>
                            <small class="error">Le nom ne doit comporter que des lettres (entre 2 et 30)</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label>Prenom <small>required</small>
                                <input type="text" name="prenom" placeholder="" required pattern="nom_prenom"/>
                            </label>
                            <small class="error">Le prenom ne doit comporter que des lettres (entre 2 et 30)</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label> Email <small>required</small>
                                <input type="email" name="email" placeholder="" required pattern="email"/>
                            </label>
                            <small class="error">Une adresse email valide est requise</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label> Mot de passe <small>required</small>
                                <input id="password" type="password" name="pass" placeholder="" required pattern="password"/>
                            </label>
                            <small class="error">Un mot de passe est requis (entre 6 et 30 caracteres)</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label> Confirmation mot de passe <small>required</small>
                                <input type="password" name="pass_verif" placeholder="" required pattern="password" data-equalto="password" />
                            </label>
                            <small class="error">Les mots de passe ne correspondent pas</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-8 columns">
                            <label> Departement <small>required</small>
                                <select name="formation" required>
                                    <option value="">Selectionner un departement</option>
                                    <option value="GEII">Genie Electrique et Informatique</option>
                                    <option value="INFO">Informatique</option>
                                    <option value="MMI">Metiers du multimedia et de l'Internet</option>
                                    <option value="RT">Reseaux et Telecommunication</option>
                                </select>
                            </label>
                            <small class="error">Selectionner un departement</small>
                        </div>
                        <div class="small-4 columns">
                            <label> Annee <small>required</small>
                                <select name="annee" required>
                                    <option value="">Annee</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </label>
                            <small class="error">Selectionner une annee</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 small-centered text-center columns">
                            <input style="margin-top: 15px; margin-bottom: 0px;" class="button small secondary" type="submit" name="submit_inscription" value="Valider" />
                        </div>
                    </div>
                </form>
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>


            <div id="connexion-modal" class="reveal-modal tiny" data-reveal aria-labelledby="connexion" aria-hidden="true" role="dialog">
                <!-- Page connexion here -->
                <h3>Connexion</h3>
                <span id="error9" style="display: none; color: red;">Identifiant ou mot de passe introuvable<br /></span>
                <span id="error10" style="display: none; color: red;">L'identifiant doit etre composer de 8 chiffres<br /></span>
                <span id="error11" style="display: none; color: red;">Un mot de passe est requis (entre 6 et 30 caracteres)<br />Caracteres speciaux acceptes : !@#$%_;:,*?.</span>
                <form data-abide action="" method="post">
                    <div class="row">
                        <div class="small-12 columns">
                            <label>Identifiant
                                <input type="text" name="id"  placeholder=""required pattern="identifiant"/>
                            </label>
                            <small class="error">L'identifiant doit etre composer de 8 chiffres</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label> Mot de passe
                                <input type="password" name="passconnexion" placeholder="" required pattern="password"/>
                            </label>
                            <small class="error">Un mot de passe est requis (entre 6 et 30 caracteres)</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 small-centered text-center columns">
                            <input class="button small secondary" type="submit" name="submit_connexion" value="Valider" />
                        </div>
                    </div>
                </form>
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>
            <?php };?>
            <!-- fin banniere -->

            <div id="content">
                <h1>Bienvenue sur le projet tutorat</h1>
                <p>Si vous êtes étudiant à l'IUT de Vélizy, alors ce site est fait pour vous.<br />
                    Avec ce site et une fois inscrit, vous pourrez demander de l'aide aux autres étudiants
                    inscrits dans des matières où vous avez des difficultés.<br /> A l'inverse vous pouvez aussi
                    proposer de l'aide dans des matières où vous avez de bonnes capacités.<br />
                    Bonne navigation sur notre site !<br /><br />
                    NOTE: En vous inscrivant ou connectant sur ce site, vous acceptez aussi de ne pas poster/écrire de contenus
                    inappropriés : dans le cas contraire, votre compte sera définitevement supprimé sans préavis
                    par nos administrateurs.

                </p>
            </div>

            <?php include 'includes/footer.php' ?>

            <a class="exit-off-canvas"></a>

        </div>
        </div>
    </div>

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
        </script>
</body>
</html>

<?php

//Inscription

if (isset($_POST['submit_inscription'])) {
    $identifiant = htmlspecialchars($_POST['identifiant']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $pass = sha1($_POST['pass']);
    $pass_verif = sha1($_POST['pass_verif']);
    $departement= htmlspecialchars($_POST['formation']);
    $annee = htmlspecialchars($_POST['annee']);

    if(formValideInscription($bdd,$identifiant,$email,$nom,$prenom,$pass,$pass_verif))
    {
		
		//Requete pour recuperer le groupe par rapport a la formation et a l'annee	
		$reqfind = $bdd->prepare('SELECT id_grp from groupe where filiere = :departement AND annee = :annee');
        $reqfind->execute(array(
            'departement' => $departement,
            'annee' => $annee));
        $resultatfind = $reqfind->fetch();



        $req = $bdd->prepare('INSERT INTO etudiant(numero_etudiant, mdp, nom, prenom, email,id_grp) VALUES(:identifiant, :pass, :nom, :prenom, :email, :id_grp)');
        $req->execute(array(
            'identifiant' => $identifiant,
            'pass' => $pass,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
			'id_grp' => $resultatfind['id_grp']
			
        ));
        ?><script>swal("Good job!", "Inscription validee!", "success");</script><?php
        echo htmlspecialchars($_POST['nom']);
    } // pas besoin de else : deja geré dans la fonction
}

// Connexion

if(isset($_POST['submit_connexion'])) {
    echo "Connexion submit";
    //données du formulaire dans variables
    $passconnexion = sha1($_POST['passconnexion']);
    $id = htmlspecialchars($_POST['id']);

    if(formValideConnexion($id))
    {
        //recuperation du resultat
        $req = $bdd->prepare('SELECT numero_etudiant from etudiant where numero_etudiant = :id AND mdp = :pass');
        $req->execute(array(
            'id' => $id,
            'pass' => $passconnexion));
        $resultat = $req->fetch();

        if($resultat == null){//données invalides
            ?>
            <script>
                $('#connexion-modal').foundation('reveal', 'open');
                document.getElementById('error9').style.display = 'inline';
            </script><?php
        }
        else//Utilisateur trouvé
        {
            $_SESSION['login'] = $id;
            $_SESSION['pass'] = $passconnexion;
            header('Location: profile.php');
            ob_end_flush();
        }
    }
}

function formValideInscription($bdd,$identifiant,$email,$nom,$prenom,$pass,$pass_verif){
    $valide = true;

    //Requete
    $req_id = "SELECT count(*) AS Nbr_id FROM etudiant where numero_etudiant = '" . $identifiant . "'";
    $req_email = "SELECT count(*) AS Nbr_email FROM etudiant where email = '" . $email . "'";

    // Traitement disponibilite identifiant
    $reponse_id = $bdd->query($req_id);
    $row_id = $reponse_id->fetch();
    $reponse_id->closeCursor();

    if ($row_id['Nbr_id'] > 0) {
        ?>
        <script>
            $('#inscription-modal').foundation('reveal', 'open');
            document.getElementById('error1').style.display = 'inline';
        </script><?php
        $valide = false;
    }

    // Traitement disponibilite email
    $reponse_email = $bdd->query($req_email);
    $row_email = $reponse_email->fetch();
    $reponse_email->closeCursor();

    if ($row_email['Nbr_email'] > 0) {
        ?>
        <script>
            $('#inscription-modal').foundation('reveal', 'open');
            document.getElementById('error2').style.display = 'inline';
        </script><?php
        $valide = false;
    }

    // Verification serveur (au cas ou que l'utilisateur ferait des betises

    if (!preg_match('/^([0-9]){8}$/', $identifiant))
    {
        ?>
        <script>
            $('#inscription-modal').foundation('reveal', 'open');
            document.getElementById('error3').style.display = 'inline';
        </script>
        <?php
        $valide = false;
    }
    if (!preg_match('/^([a-zA-Z ]){2,30}$/', $nom))
    {
        ?>
        <script>
            $('#inscription-modal').foundation('reveal', 'open');
            document.getElementById('error4').style.display = 'inline';
        </script><?php
        $valide = false;
    }

    if (!preg_match('/^([a-zA-Z ]){2,30}$/', $prenom))
    {
        ?>
        <script>
            $('#inscription-modal').foundation('reveal', 'open');
            document.getElementById('error5').style.display = 'inline';
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

    if(!preg_match('/^[a-zA-Z0-9!@#$%_;:,*?.]{6,30}$/', $_POST['pass'])) //pass en clair pour verifier son contenu (je pense)
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

    return $valide;
}

function formValideConnexion($identifiant)
{
    $valide = true;

    if (!preg_match('/^([0-9]){8}$/', $identifiant))
    {
        ?>
        <script>
            $('#connexion-modal').foundation('reveal', 'open');
            document.getElementById('error10').style.display = 'inline';
        </script>
        <?php
        $valide = false;
    }
    if(!preg_match('/^[a-zA-Z0-9!@#$%_;:,*?.]{6,30}$/', $_POST['passconnexion'])) //pass en clair pour verifier son contenu (je pense)
    {
        ?>
        <script>
            $('#connexion-modal').foundation('reveal', 'open');
            document.getElementById('error11').style.display = 'inline';
        </script><?php
        $valide = false;
    }
    return $valide;
}
?>
