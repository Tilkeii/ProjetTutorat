<?php
ob_start(); //Permet de mettre le header n'importe ou dans le code : sinon doit se placer avant le code html
session_start();
?>

<!DOCTYPE html>
<html>
<!-- head -->
<?php include('includes/head.php'); ?>

<!-- body -->
<body>
<title>Erreur</title>
<?php
    if(isset($_SESSION['login']) and isset($_SESSION['pass'])){
        include("includes/menu.php");
    ?>
            <div class="content medium-12 large-8">
                <h1>Une erreur inattendue s'est produite</h1>
                <p>Merci de contacter le webmaster en expliquant le contexte de l'erreur.
                </p>
            </div>

            <?php include 'includes/footer.php' ?>

            <a class="exit-off-canvas"></a>

        </div>
        </div>
    </div>

    <?php include('includes/footer_scripts.php'); ?>
</body>
</html>
<?php
}
else{
	header('Location: index.php');
}
?>