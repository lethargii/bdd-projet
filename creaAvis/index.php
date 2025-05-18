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
if(!isset($_GET['idJeu'])){
  closeDB($mysqli);
  header('Location: ../');
}
if(!creaAvisPossible($mysqli, $_SESSION['login'], $_GET['idJeu'])){
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
      <form action="../php/addavis.php" method="POST">
        <fieldset>
          <legend>Entrez vos informations</legend>
          <input type="text" id="titre" name="titre" placeholder="Titre de l'avis" required>
          <input type="text" id="texte" name="texte" placeholder="Contenu de l'avis" required>
          <input type="number" id="noteAvis" name="noteAvis" placeholder="Note de l'avis" min=0 max=10 required>
          <input type="hidden" name="idJeu" value="<?php echo $_GET['idJeu']; ?>" />
          <input type="submit" value="Créer l'avis" id="creaavis"/>
        </fieldset>
      </form>
    </main>
    <?php include("../static/footer.php"); ?>
  </body> 
</html>
<?php closeDB($mysqli); ?>
