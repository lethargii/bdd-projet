<?php
session_start();
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
if(!isset($_SESSION['logged']) || !$_SESSION['logged'] || !isset($_GET['idJeu'])){
  closeDB($mysqli);
  header('Location: ../');
}
$login = $_SESSION['login'];
$role = $_SESSION['role'];
$idJeu = $_GET['idJeu'];
if(!supprArticlePossible($mysqli, $login, $idJeu, $role)){
  closeDB($mysqli);
  header('Location: ../');
}
$images = listArticleImage($mysqli, $idJeu);
if(!empty($images)){
  foreach($images as $image){
    $idImage = $image['idImage'];
    writeDB($mysqli, "DELETE FROM image WHERE idImage = $idImage");
  }
}
writeDB($mysqli, "DELETE FROM article WHERE idJeu = '$idJeu'");
closeDB($mysqli);
header('Location: ../');
?>
