<?php
session_start();
if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
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
if(isset($_SESSION['logged']) && $_SESSION['logged']){
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
      <form action="../php/login.php" method="POST">
        <fieldset>
          <legend>Entrez vos informations</legend>
          <input type="text" id="login" name="login" placeholder="Nom d'utilisateur" required>
          <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required>
          <input type="submit" value="Se connecter" id="signin"/>
        </fieldset>
      </form>
      <a href="../inscription/">S'inscrire</a>
    </main>
    <?php include("../static/footer.php"); ?>
  </body>
</html>
<?php closeDB($mysqli); ?>
