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
$idJeu = $form['idJeu'];
$titre = $form['titre'];
$contenu = $form['contenu'];
$noteArticle = $form['noteArticle'];
$caracteristiques = $form['caracteristiques'];
/* $lienImage = "images/avatar/" . $login . ".png"; */
/* move_uploaded_file($_FILES['avatar']['tmp_name'], "../". $lienImage); */
/* writeDB($mysqli, "INSERT INTO image (lienImage) VALUES ('$lienImage')"); */
/* $idImage = readDB($mysqli, "SELECT idImage FROM image WHERE lienImage = '$lienImage'")[0]['idImage']; */
writeDB($mysqli, "UPDATE article SET titre = \"$titre\", contenu = \"$contenu\", noteArticle = '$noteArticle', caracteristiques = \"$caracteristiques\"
  WHERE idJeu = '$idJeu'");
closeDB($mysqli);
header("Location: ../article?idJeu=$idJeu");
?>
