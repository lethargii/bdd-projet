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
if((isset($_SESSION['logged']) && $_SESSION['logged']) || empty($_POST)){
  closeDB($mysqli);
  header('Location: ../');
}
$form = $_POST;
if(existUtilisateur($mysqli, $form)){
  closeDB($mysqli);
  header('Location: ../inscription?error=1');
}
$login = $form['login'];
$mdp = $form['mdp'];
$nom = $form['nom'];
$prenom = $form['prenom'];
$mel = $form['mel'];
$dateNaissance = $form['dateNaissance'];
$role = "membre";
$lienImage = "images/avatar/" . $login . ".png";
if($_FILES['avatar']['error'] != 0){
  copy("../images/imagesSite/user.png", "../" . $lienImage);
}
else{
  move_uploaded_file($_FILES['avatar']['tmp_name'], "../". $lienImage);
}
writeDB($mysqli, "INSERT INTO image (lienImage) VALUES ('$lienImage')");
$idImage = readDB($mysqli, "SELECT idImage FROM image WHERE lienImage = '$lienImage'")[0]['idImage'];
writeDB($mysqli, "INSERT INTO utilisateur VALUES ('$login', '$mdp', '$nom', '$prenom', '$mel', '$dateNaissance', '$role', '$idImage')");
closeDB($mysqli);
header('Location: ../');
?>
