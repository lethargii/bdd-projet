<?php
require_once(__DIR__."/functions-DB.php");
function infoUtilisateur($mysqli, $utilisateur){
  $login = $utilisateur['login'];
  $mdp = $utilisateur['mdp'];
  return readDB($mysqli, "SELECT * FROM utilisateur WHERE login = '$login' AND mdp = '$mdp'");
}

function loginCorrect($mysqli, $utilisateur){
  $dresExiste = infoUtilisateur($mysqli, $utilisateur);
  return !empty($dresExiste);
}

function existUtilisateur($mysqli, $utilisateur){
  $login = $utilisateur['login'];
  return !empty(readDB($mysqli, "SELECT * FROM utilisateur WHERE login = '$login'"));
}

function profilQuery($mysqli, $login){
  return readDB($mysqli, "SELECT login, nom, prenom, mel, dateNaissance, modo, lienImage FROM utilisateur
    INNER JOIN image ON utilisateur.idImage = image.idImage
    WHERE login = '$login'");
}
?>
