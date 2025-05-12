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
$form = $_POST;
if(notExistUtilisateur($mysqli, $form)){
  closeDB($mysqli);
  header('Location: ../inscription?error=1');
}
$login = $form['login'];
$mdp = $form['mdp'];
$nom = $form['nom'];
$prenom = $form['prenom'];
$mel = $form['mel'];
$dateNaissance = $form['dateNaissance'];
$modo = $form['modo'];
writeDB($mysqli, "INSERT INTO utilisateur VALUES ('$login', '$mdp', '$nom', '$prenom', '$mel', '$dateNaissance', '$modo')");
closeDB($mysqli);
header('Location: ../');
?>
