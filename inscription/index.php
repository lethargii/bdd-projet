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
      <form action="../php/signin.php" method="POST" enctype="multipart/form-data">
        <fieldset>
          <legend>Entrez vos informations</legend>
          <input type="text" id="login" name="login" placeholder="Nom d'utilisateur" required>
          <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required>
          <input type="text" id="nom" name="nom" placeholder="Nom" required>
          <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
          <input type="email" id="mel" name="mel" placeholder="Adresse mail" required>
          <input type="date" id="dateNaissance" name="dateNaissance" placeholder="Date de naissance" max="<?php echo date('Y-m-d', strtotime('-15 years')); ?>" required>
          <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" />
          <input type="submit" value="S'inscrire" id="signin"/>
        </fieldset>
      </form>
      <a href="../connection/">Se connecter</a>
    </main>
    <?php include("../static/footer.php"); ?>
  </body> 
</html>
<?php closeDB($mysqli); ?>
