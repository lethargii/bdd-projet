<?php
session_start();
//affichage des erreurs côté PHP et côté MYSQLI
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Import du site
require_once("./includes/constantes.php");
require_once("./php/functions-DB.php");
require_once("./php/functions_query.php");
require_once("./php/functions_structure.php");
$mysqli = connectionDB();
$numero = $_GET['numero'];
$tabArticle=infoArticle($mysqli, $numero);
$tabNomJeu = getNomJeu($mysqli, $numero);
$nomJeu = $tabNomJeu[0]['nom'];
?>
<!DOCTYPE html>
<?php
include("static/html.php");
include("static/head.php");
?>
  <body>
    <?php include("static/header.php"); ?>
    <?php include("static/nav.php"); ?>
    <main class="lilMargin">
      <?php
        if (isset($_SESSION['is_connected'])) {
            echo "<h2>Vous êtes connectés " . htmlspecialchars($_SESSION['login'])."</h2>";
            echo "<h3>Votre id est : " . htmlspecialchars($_SESSION['id'])."</h3>";
        }
        echo "<h1>Ceci est l'article du jeu $nomJeu </h1>";
        echo "<h2>{$tabArticle[0]['titre']}</h2>";
        echo "<p>{$tabArticle[0]['contenu']}</p>";
        echo "<p>Note de l'article : {$tabArticle[0]['noteArticle']}</p>";
        echo "<p>Caractéristiques du jeu : {$tabArticle[0]['caracteristiques']}</p>";
        echo "<p>Date de création de l'article : {$tabArticle[0]['dateCreationArticle']}</p>";
        echo "<p>Date de modification de l'article : {$tabArticle[0]['dateModification']}</p>";
      ?>
    </main>
    <?php
      include("static/footer.php");
    ?>
  </body> 
</html>
<?php closeDB($mysqli); ?>
