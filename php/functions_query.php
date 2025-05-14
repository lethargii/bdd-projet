<?php
require_once(__DIR__."/functions-DB.php");
function infoUtilisateur($mysqli, $login){
  return readDB($mysqli, "SELECT * FROM utilisateur WHERE login = '$login'");
}

function infoAvis($mysqli, $idAvis){
  return readDB($mysqli, "SELECT * FROM avis WHERE idAvis = '$idAvis'");
}

function infoArticle($mysqli, $idJeu){
  return readDB($mysqli, "SELECT article.*, jacquetteJeu.lienImage, imageArticle.lienImage FROM jeu
    INNER JOIN article ON jeu.idJeu = article.idJeu
    INNER JOIN image AS jacquetteJeu ON jeu.idImage = jacquetteJeu.idImage
    LEFT JOIN image AS imageArticle ON article.idArticle = imageArticle.idArticle
    WHERE jeu.idJeu = '$idJeu'");
}

function loginCorrect($mysqli, $utilisateur){
  $login = $utilisateur['login'];
  $mdp = $utilisateur['mdp'];
  $inf = readDB($mysqli, "SELECT * FROM utilisateur WHERE login = '$login' AND mdp = '$mdp'");
  return !empty($inf);
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

function listJeu($mysqli){
  return readDB($mysqli, "SELECT idJeu, nom FROM jeu");
}

function listCategorie($mysqli){
  return readDB($mysqli, "SELECT idCategorie, nomCategorie FROM categorie");
}

function listSupport($mysqli){
  return readDB($mysqli, "SELECT idSupport, nomSupport FROM support");
}
?>
