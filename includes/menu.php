<?php
$req = $bdd->prepare('SELECT id_priv FROM etudiant WHERE numero_etudiant = :id');
$req->execute(array(
    'id' => $_SESSION['login']));
$res = $req->fetch();

?>

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
                <li id="menu_liste_posts" class="navbar_menu_item"><a href="list.php" >Dernières annonces</a></li>
                <li id="menu_liste_egolist" class="navbar_menu_item"><a href="egolist.php" >Mes annonces</a></li>
                <li id="menu_modification" class="navbar_menu_item"><a href="profile.php" >Mon profil</a></li>
                <?php
     			$req = $bdd->prepare('SELECT id_priv from etudiant where numero_etudiant = :num');
                $req->execute(array(
                    'num' => $_SESSION['login']));
                $res = $req->fetch();
                if($res['id_priv'] == 2){
                    ?><li id="menu_administration" class="navbar_menu_item"><a href="#" >Administration</a></li><?php
                }
                ?>
                <li id="menu_deconnexion" class="navbar_menu_item"><a href="deconnexion.php">Deconnexion</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
