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
$login = $form['login'];
$oldlogin = $_SESSION['login'];
if(!profileditable($mysqli, $oldlogin, $login)){
  closeDB($mysqli);
  header('Location: ../modprofil?error=1');
}
$mdp = $form['mdp'];
$nom = $form['nom'];
$prenom = $form['prenom'];
$mel = $form['mel'];
$dateNaissance = $form['dateNaissance'];
writeDB($mysqli, "UPDATE utilisateur SET login = '$login', mdp = '$mdp', nom = '$nom', prenom = '$prenom', mel = '$mel', dateNaissance = '$dateNaissance'
  WHERE login = '$oldlogin'");
$lienImage = "images/avatar/" . $login . ".png";
$oldlienimage = readDB($mysqli, "SELECT lienImage FROM utilisateur INNER JOIN image ON utilisateur.idImage = image.idImage WHERE login = '$login'")[0]['lienImage'];
if($_FILES['avatar']['error'] == UPLOAD_ERR_OK){
  //Supprimer l'image
  unlink("../" . $oldlienimage);
  //Rajouter la nouvelle
  move_uploaded_file($_FILES['avatar']['tmp_name'], "../". $lienImage);
}
else{
  //Changer le nom de l'image
  rename("../" . $oldlienimage, "../" . $lienImage);
}
$idImage = readDB($mysqli, "SELECT idImage FROM utilisateur WHERE login = '$login'")[0]['idImage'];
writeDB($mysqli, "UPDATE image SET lienImage = '$lienImage' WHERE idImage = '$idImage'");
$_SESSION['login'] = $login;
closeDB($mysqli);
header('Location: ../profil');
?>
