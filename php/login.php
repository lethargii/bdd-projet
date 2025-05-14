<?php
session_start();
//affichage des erreurs côté PHP et côté MYSQLI
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Import du site
require_once(__DIR__."/../includes/constantes.php");
require_once(__DIR__."/../php/functions-DB.php");
require_once(__DIR__."/../php/functions_query.php");
require_once(__DIR__."/../php/functions_structure.php");
$mysqli = connectionDB();
$form = $_POST;
if(!loginCorrect($mysqli, $form)){
  closeDB($mysqli);
  header('Location: ../connection?error=1');
}
else{
  $_SESSION['login'] = $form['login'];
  $_SESSION['logged'] = true;
}
closeDB($mysqli);
header('Location: ../');
?>
