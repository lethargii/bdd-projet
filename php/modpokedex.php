<?php
session_start();
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
if($form['nbAttrape'] > $form['nbVue']){
  closeDB($mysqli);
  header("Location: ../formpokedex.php?error=1");
}
if(inPokedex($mysqli, $form['id_pokemon'], $_SESSION['id_dresseur'])){
  writeDB($mysqli, "UPDATE pokedex
    SET nbVue='" . $form['nbVue'] . "', nbAttrape='" . $form['nbAttrape'] . "'
    WHERE id_dresseur='" . $_SESSION['id_dresseur'] . "' AND id_pokemon='" . $form['id_pokemon'] . "'");
}
else{
  writeDB($mysqli,
    "INSERT INTO pokedex (id_dresseur, id_pokemon, nbVue, nbAttrape)
      VALUES (" . $_SESSION['id_dresseur'] . "," . $form['id_pokemon'] . "," . $form['nbVue'] . "," . $form['nbAttrape'] . ")");
}
header("Location: ../");
?>
