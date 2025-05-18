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
if(!isset($_SESSION['logged']) || !$_SESSION['logged'] || empty($_POST)){
  closeDB($mysqli);
  header('Location: ../');
}
$form = $_POST;
$idJeu = $form['idJeu'];
$titre = $form['titre'];
$texte = $form['texte'];
$noteAvis = $form['noteAvis'];
$login = $_SESSION['login'];
writeDB($mysqli, 'INSERT INTO avis (idJeu, titre, texte, noteAvis, login) VALUES ("' . $idJeu . '", "' . $titre . '", "' . $texte . '", "' . $noteAvis . '", "' . $login . '")');
closeDB($mysqli);
header('Location: ../');
?>
