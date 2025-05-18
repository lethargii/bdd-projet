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
if(isset($_GET['idSupport'])){
  $idSupport = $_GET['idSupport'];
}
else{
  $idSupport = "";
}
if(isset($_GET['idCategorie'])){
  $idCategorie = $_GET['idCategorie'];
}
else{
  $idCategorie = "";
}
if(isset($_GET['search'])){
  $search = $_GET['search'];
}
else{
  $search = "";
}
if(isset($_GET['page'])){
  $page = $_GET['page'];
}
else{
  $page = "";
}
$bdd=getBDD($mysqli, $idCategorie, $idSupport, $search, $page);
?>
<!DOCTYPE html>
<?php
include("static/html.php");
include("static/head.php");
include("static/header.php");
include("static/nav.php");
?>
  <body>
    <main class="lilMargin">
    <?php
        echo $bdd[0]['COUNT(*)'];
        displayJV($bdd, $mysqli);
        // On peut ajouter ici si l'utilisateur possède le jeu ou pas
      ?>
    </main>
    <?php
      include("static/footer.php");
    ?>
  </body> 
</html>
<?php closeDB($mysqli); ?>
