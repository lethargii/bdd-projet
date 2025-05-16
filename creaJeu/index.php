<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] == false){
  header("Location: ../");
}
//affichage des erreurs côté PHP et côté MYSQLI
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Import du site
require_once("../includes/constantes.php");
require_once("../php/functions-DB.php");
require_once("../php/functions_query.php");
require_once("../php/functions_structure.php");
$mysqli = connectionDB();
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
  closeDB($mysqli);
  header('Location: ../');
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Accueil - Poképédia</title>
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <meta name="keywords" content="BDD-IHM, TD, CUPGE2">
    <meta name="author" content="ESIR">
  </head>
  <body>
    <?php include("../static/header.php"); ?>
    <?php include("../static/nav.php"); ?>
    <main>
      <form action="../php/addgame.php" method="POST" enctype="multipart/form-data">
        <fieldset>
          <legend>Entrez vos informations</legend>
          <input type="text" id="nom" name="nom" placeholder="Nom du jeu" required>
          <input type="number" id="prix" name="prix" placeholder="Prix à la sortie" required>
          <input type="date" id="dateSortie" name="dateSortie" placeholder="Date de sortie" required>
          <input type="text" id="synopsis" name="synopsis" placeholder="Synopsis" required>
          <input type="file" id="imageJeu" name="imageJeu" accept="image/png, image/jpeg" />
          <input type="submit" value="Créer le jeu" id="creajeu"/>
          <?php
            $categories = listCategorie($mysqli);
            $supports = listSupport($mysqli);
            listCategorieOption($categories);
            listSupportOption($supports);
          ?>
        </fieldset>
      </form>
      <a href="../connection/">Se connecter</a>
    </main>
    <?php include("../static/footer.php"); ?>
  </body> 
</html>
<?php closeDB($mysqli); ?>
