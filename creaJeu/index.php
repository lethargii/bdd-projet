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
if(!isset($_SESSION['logged']) || !$_SESSION['logged'] || $_SESSION['role'] != "redac"){
  closeDB($mysqli);
  header('Location: ../');
}
?>
<!DOCTYPE html>
<?php
include("../static/html.php");
include("../static/head.php");
?>
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
          <?php
            $categories = listCategorie($mysqli);
            $supports = listSupport($mysqli);
            listCategorieOption($categories);
            listSupportOption($supports);
          ?>
          <input type="submit" value="Créer le jeu" id="creajeu"/>
        </fieldset>
      </form>
      <a href="../connection/">Se connecter</a>
    </main>
    <?php include("../static/footer.php"); ?>
  </body> 
</html>
<?php closeDB($mysqli); ?>
