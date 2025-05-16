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
if(!isset($_SESSION['logged']) || !$_SESSION['logged']){
  closeDB($mysqli);
  header('Location: ../');
}
$form = $_POST;
$idJeu = $form['idJeu'];
$titre = $form['titre'];
$contenu = $form['contenu'];
$noteArticle = $form['noteArticle'];
$caracteristiques = $form['caracteristiques'];
$login = $_SESSION['login'];
writeDB($mysqli, 'INSERT INTO article (idJeu, titre, contenu, noteArticle, caracteristiques, login) VALUES ("' . $idJeu . '", "' . $titre . '", "' . $contenu . '", "' . $noteArticle . '", "' . $caracteristiques . '", "' . $login . '")');
$idArticle = readDB($mysqli, "SELECT idArticle FROM article WHERE idJeu = '$idJeu'")[0]['idArticle'];
print_r($_FILES['imagesArticle']);
$nbImage = 1;
foreach($_FILES['imagesArticle']['tmp_name'] as $file){
  $lienImage = "images/article/" . $idJeu . "-" . $nbImage . ".png";
  move_uploaded_file($file, "../" . $lienImage);
  writeDB($mysqli, "INSERT INTO image (lienImage, idArticle) VALUES ('$lienImage', '$idArticle')");
  $nbImage = $nbImage + 1;
}
closeDB($mysqli);
header('Location: ../');
?>
