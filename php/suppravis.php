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
if(!isset($_SESSION['logged']) || !$_SESSION['logged'] || !isset($_GET['idAvis'])){
  closeDB($mysqli);
  header('Location: ../');
}
$login = $_SESSION['login'];
$role = $_SESSION['role'];
$idAvis = $_GET['idAvis'];
if(!supprAvisPossible($mysqli, $login, $idAvis, $role)){
  closeDB($mysqli);
  header('Location: ../');
}
writeDB($mysqli, "DELETE FROM avis WHERE idAvis = '$idAvis'");
closeDB($mysqli);
header('Location: ../');
?>
