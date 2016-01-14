<?php
session_start();


if(isset($_SESSION['login']) and isset($_SESSION['pass'])) {
    $bdd = new PDO('mysql:host=89.234.180.28;dbname=w4130d_tutorat;charset=utf8', 'w4130d_tutorat', '159753Tu');
    $reqpriv = $bdd->prepare('SELECT id_priv from etudiant where numero_etudiant = :id');
    $reqpriv->execute(array('id' => $_SESSION['login']));
    $priv = $reqpriv->fetch();

    if ($priv['id_priv'] == 2) {
?>
<html>
    <!-- head -->
    <?php include('includes/head.php'); ?>
    <!-- body -->
    <body>
        <div class="off-canvas-wrap" data-offcanvas>

            <?php include 'includes/menu.php' ?>

            <div class="content medium-12 large-8">
                Page admin
            </div>
        </div>
        <?php include('includes/footer_scripts.php'); ?>
    </body>

    <?php include 'includes/footer.php' ?>
</html>
<?php
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}