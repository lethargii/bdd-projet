<?php
session_start();
if(!isset($_GET['login'])){
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
      <?php
      $profil = profilQuery($mysqli, $_GET['login']);
      $articles = profilArticleQuery($mysqli, $_GET['login']);
      $avis = profilAvisQuery($mysqli, $_GET['login']);
      $private = (isset($_SESSION['login']) && ($_SESSION['login'] == $_GET['login']));
      profilDisplay($profil, $articles, $avis, $private);
      ?>
    </main>
    <?php include("../static/footer.php"); ?>
  </body> 
</html>
<?php closeDB($mysqli); ?>
