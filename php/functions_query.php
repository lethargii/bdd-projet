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

function roleUtilisateur($mysqli, $utilisateur){
  $login = $utilisateur['login'];
  $mdp = $utilisateur['mdp'];
  $role = readDB($mysqli, "SELECT role FROM utilisateur WHERE login = '$login' AND mdp = '$mdp'");
  return $role;
}

function existUtilisateur($mysqli, $utilisateur){
  $login = $utilisateur['login'];
  return !empty(readDB($mysqli, "SELECT * FROM utilisateur WHERE login = '$login'"));
}

function profilQuery($mysqli, $login){
  return readDB($mysqli, "SELECT login, nom, prenom, mel, dateNaissance, dateCreationCompte, dateDerniereConnection, role, lienImage FROM utilisateur
    INNER JOIN image ON utilisateur.idImage = image.idImage
    WHERE login = '$login'");
}

function profilArticleQuery($mysqli, $login){
  return readDB($mysqli, "SELECT idArticle, titre, contenu, noteArticle, dateCreationArticle, dateModification, jeu.nom, article.idJeu FROM utilisateur
    INNER JOIN article ON utilisateur.login = article.login
    INNER JOIN jeu ON article.idJeu = jeu.idJeu
    WHERE utilisateur.login = '$login'");
}

function profilAvisQuery($mysqli, $login){
  return readDB($mysqli, "SELECT idAvis, titre, texte, noteAvis, dateCreationAvis, jeu.nom, avis.idJeu FROM utilisateur
    INNER JOIN avis ON utilisateur.login = avis.login
    INNER JOIN jeu ON avis.idJeu = jeu.idJeu
    WHERE utilisateur.login = '$login'");
}

function listArticleImage($mysqli, $idJeu){
  return readDB($mysqli, "SELECT idImage, lienImage FROM article INNER JOIN image ON article.idArticle = image.idArticle WHERE idJeu='$idJeu'");
}

function listJeu($mysqli){
  return readDB($mysqli, "SELECT jeu.idJeu, nom FROM jeu LEFT JOIN article ON jeu.idJeu = article.idJeu WHERE idArticle IS NULL");
}

function listCategorie($mysqli){
  return readDB($mysqli, "SELECT idCategorie, nomCategorie FROM categorie");
}

function listSupport($mysqli){
  return readDB($mysqli, "SELECT idSupport, nomSupport FROM support");
}

//fonction qui donne les différents jeux
function getBDD($mysqli, $idCategorie, $idSupport, $search){
	$query = "SELECT jeu.idJeu, jeu.nom, jeu.dateSortie, image.lienImage
      FROM jeu
  INNER JOIN image ON jeu.idImage = image.idImage
  LEFT JOIN categoriesJeu ON jeu.idJeu = categoriesJeu.idJeu
  LEFT JOIN supportsJeu ON jeu.idJeu = supportsJeu.idJeu";
  $querySearch = array();
  if($search != ""){
    $querySearch[] = "jeu.nom LIKE '%$search%'";
  }
  if($idCategorie != ""){
    $querySearch[] = "idCategorie = $idCategorie";
  }
  if($idSupport != ""){
    $querySearch[] = "idSupport = $idSupport";
  }
  if(!empty($querySearch)){
    foreach($querySearch as $i => $querySearchh){
      if($i == 0){
        $query .= " WHERE " . $querySearchh;
      }
      else{
        $query .= " AND " . $querySearchh;
      }
    }
  }
  $query .= " ORDER BY jeu.dateSortie";
  return(readDB($mysqli, $query));
}

//fonction qui donne les différentes catégories pour un jeu
function getBDDcategorie($mysqli, $idJeu){
  return readDB($mysqli, "SELECT categorie.nomCategorie
      FROM categorie
      INNER JOIN categoriesJeu ON categorie.idCategorie = categoriesJeu.idCategorie
      WHERE categoriesJeu.idJeu = $idJeu");
}

//fonction qui donne les différents supports pour un jeu
function getBDDsupport($mysqli, $idJeu){
  return readDB($mysqli, "SELECT support.nomSupport
      FROM support
      INNER JOIN supportsJeu ON support.idSupport = supportsJeu.idSupport
      WHERE supportsJeu.idJeu = $idJeu");
}

//fonction qui me donne le nom du jeu
function getNomJeu($mysqli, $idJeu){
  return readDB($mysqli, "SELECT jeu.nom
      FROM jeu
      WHERE jeu.idJeu = '$idJeu'");
}

//fonction qui me donne les id d'avis d'un jeu
function getIdAvis($mysqli, $idJeu){
  return readDB($mysqli, "SELECT avis.idAvis
      FROM avis
      WHERE avis.idJeu = '$idJeu'");
}

function modAvisPossible($mysqli, $login, $idAvis){
  return(!empty(readDB($mysqli, "SELECT * FROM avis WHERE login = '$login' AND idAvis = '$idAvis'")));
}

function supprAvisPossible($mysqli, $login, $idAvis, $role){
  return($role == "admin" || modAvisPossible($mysqli, $login, $idAvis));
}

function modArticlePossible($mysqli, $login, $idJeu){
  return(!empty(readDB($mysqli, "SELECT * FROM avis WHERE login = '$login' AND idJeu = '$idJeu'")));
}

function supprArticlePossible($mysqli, $login, $idArticle, $role){
  return($role == "admin" || modArticlePossible($mysqli, $login, $idArticle));
}

function creaAvisPossible($mysqli, $login, $idJeu){
  return(empty(readDB($mysqli, "SELECT * FROM avis WHERE idJeu = '$idJeu' AND login = '$login'")));
}

function creaArticlePossible($mysqli, $idJeu, $role){
  return($role == "redac" && empty(readDB($mysqli, "SELECT * FROM article WHERE idJeu = '$idJeu'")));
}

?>
