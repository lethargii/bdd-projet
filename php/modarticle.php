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
$login = $_SESSION['login'];
if(!modArticlePossible($mysqli, $login, $idJeu)){
  closeDB($mysqli);
  header('Location: ../');
}
$idArticle = readDB($mysqli, "SELECT idArticle FROM article WHERE idJeu = '$idJeu'")[0]['idArticle'];
$titre = $form['titre'];
$contenu = $form['contenu'];
$noteArticle = $form['noteArticle'];
$caracteristiques = $form['caracteristiques'];
if($_FILES['imagesArticle']['error'][0] == UPLOAD_ERR_OK){
  $oldimages = infoArticle($mysqli, $idJeu);
  // Remove all images from filesystem
  if(!empty($oldimages)){
    foreach($oldimages as $oldimage){
      $lienImage = $oldimage['lienImage'];
      unlink("../" . $oldimage['lienImage']);
  // Remove all images from database
      writeDB($mysqli, "DELETE FROM image WHERE lienImage = '$lienImage'");
    }
  }
  // Add new images to database
  $nbImage = 1;
  foreach($_FILES['imagesArticle']['tmp_name'] as $file){
    $lienImage = "images/article/" . $idJeu . "-" . $nbImage . ".png";
    move_uploaded_file($file, "../" . $lienImage);
    writeDB($mysqli, "INSERT INTO image (lienImage, idArticle) VALUES ('$lienImage', '$idArticle')");
    $nbImage = $nbImage + 1;
  }
}
writeDB($mysqli, "UPDATE article SET titre = \"$titre\", contenu = \"$contenu\", noteArticle = '$noteArticle', caracteristiques = \"$caracteristiques\"
  WHERE idJeu = '$idJeu'");
closeDB($mysqli);
header("Location: ../article?idJeu=$idJeu");
?>
