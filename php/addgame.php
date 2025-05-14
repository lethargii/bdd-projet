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
$nom = $form['nom'];
$prix = $form['prix'];
$dateSortie = $form['dateSortie'];
$synopsis = $form['synopsis'];
$lienImage = "images/jeu/" . $nom . ".png";
move_uploaded_file($_FILES['imageJeu']['tmp_name'], "../". $lienImage);
writeDB($mysqli, "INSERT INTO image (lienImage) VALUES ('$lienImage')");
$idImage = readDB($mysqli, "SELECT idImage FROM image WHERE lienImage = '$lienImage'")[0]['idImage'];
writeDB($mysqli, "INSERT INTO jeu (nom, prix, dateSortie, synopsis, idImage) VALUES ('$nom', '$prix', '$dateSortie', '$synopsis', '$idImage')");
closeDB($mysqli);
header('Location: ../');
?>
