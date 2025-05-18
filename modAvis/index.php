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
if(!isset($_SESSION['logged']) || !$_SESSION['logged'] || !isset($_GET['idAvis']) || !isset($_GET['idJeu'])){
  closeDB($mysqli);
  header('Location: ../');
}
if(!modAvisPossible($mysqli, $_SESSION['login'], $_GET['idAvis'])){
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
      <form action="../php/modavis.php" method="POST" enctype="multipart/form-data">
        <fieldset>
          <?php
            $avis = infoAvis($mysqli, $_GET['idAvis']);
            modavis($avis);
          ?>
          <input type="hidden" name="idAvis" value="<?php echo $_GET['idAvis']; ?>" />
          <input type="hidden" name="idJeu" value="<?php echo $_GET['idJeu']; ?>" />
          <input type="submit" value="Enregistrer" id="modavis"/>
        </fieldset>
      </form>
    </main>
    <?php include("../static/footer.php"); ?>
  </body> 
</html>
<?php closeDB($mysqli); ?>
