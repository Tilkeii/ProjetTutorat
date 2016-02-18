<div class="inner-wrap">
    <!-- debut banniere -->
    <!-- en-tete mobile -->
    <!-- <div id="ban_mobile" class="show-for-small-down">
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
    </div>-->
    <!-- en-tete pc -->
    <div id="ban_pc" class="show-for-medium-up">
        <div id="ban_img">

        </div>
        <div id="navbar">
            <ul id="navbar_menu_pc" class="menu">
                <li id="menu_index" class="navbar_menu_item"><a href="index.php">Accueil</a></li>
                <li id="menu_liste_posts" class="navbar_menu_item"><a href="list.php" >Dernières demandes</a></li>
                <li id="menu_liste_egolist" class="navbar_menu_item"><a href="egolist.php" >Mes demandes</a></li>
                <li id="menu_liste_myhelp" class="navbar_menu_item"><a href="myhelp.php" >Mes reponses</a></li>
                <!--<li id="menu_liste_myoffers" class="navbar_menu_item"><a href="myoffers.php" >Mes offres</a></li>-->
                <li id="menu_modification" class="navbar_menu_item"><a href="profile.php" >Mon profil</a></li>
                <?php
                    $bdd = new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');
                    $reqpriv = $bdd->prepare('SELECT id_priv from etudiant where numero_etudiant = :id');
                    $reqpriv->execute(array( 'id' => $_SESSION['login']));
                    $priv = $reqpriv->fetch();
                    if($priv['id_priv'] == 2)
                        echo "<li id=\"menu_admin\" class=\"navbar_menu_item\"><a href=\"admin.php\">Administration</a></li>";
                ?>
                <li id="menu_deconnexion" class="navbar_menu_item"><a href="deconnexion.php">Deconnexion</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
