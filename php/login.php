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
if((isset($_SESSION['logged']) && $_SESSION['logged']) || empty($_POST)){
  closeDB($mysqli);
  header('Location: ../');
}
$form = $_POST;
$role = roleUtilisateur($mysqli, $form);
if(empty($role)){
  closeDB($mysqli);
  header('Location: ../connection?error=1');
}
else{
  $login = $form['login'];
  writeDB($mysqli, "UPDATE utilisateur SET dateDerniereConnection = CURRENT_TIMESTAMP WHERE login = '$login'");
  $_SESSION['login'] = $login;
  $_SESSION['role'] = $role[0]['role'];
  $_SESSION['logged'] = true;
}
closeDB($mysqli);
header('Location: ../');
?>
