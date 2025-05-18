<?php
require_once(__DIR__ . "/functions_query.php");
function displayJV($bdd, $mysqli){
  echo "<div class='Menu'>";
  foreach($bdd as $pd){
    // On peut ajouter ici si l'utilisateur possède le jeu ou pas
    echo "<a href='article.php?numero=$pd[idJeu]' class='myLilPokeBloc'>";//ajouter une classe bloc
    echo "<img src=$pd[lienImage] class='pokeLilImg'><br>";//a changer pour une image de jeu
    echo "$pd[nom]<br>";
    echo "sortie le $pd[dateSortie]<br>";
    $tabCategories = getBDDcategorie($mysqli, $pd['idJeu']);
    foreach($tabCategories as $tabCategorie){
      echo "<p>$tabCategorie[nomCategorie]</p>";// On peut ici changel la police en fonction du de la cotégorie ou mettre une image
    }
    $tabSupports = getBDDsupport($mysqli, $pd['idJeu']);
    foreach($tabSupports as $tabSupport){
      echo "<p>$tabSupport[nomSupport]</p>";// On peut ici faire comme pour les catégories
    }

    echo "</a>";
  }
  echo "</div>";
}

function listOption($options, $idName, $nomName){
  foreach($options as $option){
    $id = $option[$idName];
    $nom = $option[$nomName];
    echo "<option value='$id'>$id - $nom</option>";
  }
}

function listJeuOption($jeux){
  foreach($jeux as $jeu){
    $idJeu = $jeu['idJeu'];
    $nom = $jeu['nom'];
    echo "<option value='$idJeu'>$idJeu - $nom</option>";
  }
}

function listCategorieOption($categories){
  echo "<div>";
  foreach($categories as $categorie){
    $idCategorie = $categorie['idCategorie'];
    $nomCategorie = $categorie['nomCategorie'];
    echo "<input type='checkbox' name='categorie[]' value='$idCategorie' id='$idCategorie'>";
    echo "<label for='$idCategorie'>$nomCategorie</label>";
  }
  echo "</div>";
}

function listSupportOption($supports){
  echo "<div>";
  foreach($supports as $support){
    $idSupport = $support['idSupport'];
    $nomSupport = $support['nomSupport'];
    echo "<input type='checkbox' name='support[]' value='$idSupport' id='$idSupport'>";
    echo "<label for='$idSupport'>$nomSupport</label>";
  }
  echo "</div>";
}

function modprofil($utilisateur){
  echo '<input type="text" id="login" name="login" placeholder="Nom d\'utilisateur" value="' . $utilisateur[0]['login'] . '" required>';
  echo '<input type="text" id="nom" name="nom" placeholder="Nom" value="' . $utilisateur[0]['nom'] . '" required>';
  echo '<input type="text" id="prenom" name="prenom" placeholder="Prénom" value="' . $utilisateur[0]['prenom'] . '" required>';
  echo '<input type="email" id="mel" name="mel" placeholder="Adresse mail" value="' . $utilisateur[0]['mel'] . '" required>';
  echo '<input type="date" id="dateNaissance" name="dateNaissance" placeholder="Date de naissance" value="' . $utilisateur[0]['dateNaissance'] . '" required>';
  echo '<input type="password" id="mdp" name="mdp" placeholder="Mot de passe" value="' . $utilisateur[0]['mdp'] . '" required>';
}

function modavis($avis){
  echo '<input type="text" id="titre" name="titre" placeholder="Titre de l\'avis" value = "' . $avis[0]['titre'] . '" required>';
  echo '<input type="text" id="texte" name="texte" placeholder="Contenu de l\'avis" value = "' . $avis[0]['texte'] . '" required>';
  echo '<input type="number" id="noteAvis" name="noteAvis" placeholder="Note de l\'avis" value = "' . $avis[0]['noteAvis'] . '" required>';
}

function modarticle($article){
  echo '<input type="text" id="titre" name="titre" placeholder="Titre de l\'article" value = "' . $article[0]['titre'] . '" required>';
  echo '<input type="text" id="contenu" name="contenu" placeholder="Contenu de l\'article" value = "' . $article[0]['contenu'] . '" required>';
  echo '<input type="number" id="noteArticle" name="noteArticle" placeholder="Note du jeu" value = "' . $article[0]['noteArticle'] . '" required>';
  echo '<input type="text" id="caracteristiques" name="caracteristiques" placeholder="Caractéristiques du jeu" value = "' . $article[0]['caracteristiques'] . '" required>';
}

function profileditable($mysqli, $loginprec, $loginnew){
  return empty(readDB($mysqli, "SELECT * FROM utilisateur WHERE login = '$loginnew' AND login != '$loginprec'"));
}

function shortArticleDisplay($article, $owner, $admin){
  echo "<div>";
  echo "<p>";
  echo $article['titre'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $article['contenu'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $article['noteArticle'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $article['dateCreationArticle'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $article['dateModification'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $article['nom'];
  echo "</p>";
  echo "</div>";
  if($owner || $admin){
    $idJeu = $article['idJeu'];
    echo "<div>";
    echo "<a href='../modArticle?idJeu=$idJeu'>";
    echo "Modifier l'article";
    echo "</a>";
    echo "</div>";
    echo "<div>";
    echo "<a class='danger' href='#supprarticle$idJeu'>Supprimer l'article</a>";
    echo "<div id='supprarticle$idJeu' class='modal'>";
    echo "<div class='modalContent'>";
    echo "<h1>";
    echo "Êtes-vous sûr de vouloir supprimer cet article ?";
    echo "</h1>";
    echo "<div>";
    echo "<a class='danger' href='../php/supprarticle.php?idJeu=$idJeu'>Oui</a>";
    echo "<a href='#' class='modalClose safe'>Non</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
}

function avisDisplay($avis, $owner, $admin){
  echo "<div>";
  echo "<p>";
  echo $avis['titre'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $avis['texte'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $avis['noteAvis'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $avis['dateCreationAvis'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $avis['nom'];
  echo "</p>";
  echo "</div>";
  if($owner || $admin){
    $idAvis = $avis['idAvis'];
    $idJeu = $avis['idJeu'];
    echo "<div>";
    echo "<a href='../modAvis?idJeu=$idJeu&idAvis=$idAvis'>";
    echo "Modifier l'avis";
    echo "</a>";
    echo "</div>";
    echo "<div>";
    echo "<a class='danger' href='#suppravis$idAvis'>Supprimer l'avis</a>";
    echo "<div id='suppravis$idAvis' class='modal'>";
    echo "<div class='modalContent'>";
    echo "<h1>";
    echo "Êtes-vous sûr de vouloir supprimer cet avis ?";
    echo "</h1>";
    echo "<div>";
    echo "<a class='danger' href='../php/suppravis.php?idAvis=$idAvis'>Oui</a>";
    echo "<a href='#' class='modalClose safe'>Non</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
}

function profilDisplay($profil, $articles, $avis, $private){
  echo "<div>";
  echo "<p>";
  echo "Nom d'utilisateur : " . $profil[0]['login'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo "Nom : " . $profil[0]['nom'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo "Prénom : " . $profil[0]['prenom'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo "Adresse mail : " . $profil[0]['mel'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  $dateNaissance = (new DateTime($profil[0]['dateNaissance']))->format("d/m/Y");
  echo "Date de naissance : " . $dateNaissance;
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  $dateCreationCompte = (new DateTime($profil[0]['dateCreationCompte']))->format("d/m/Y");
  echo "Compte créé le : " . $dateCreationCompte;
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  $dateDerniereConnection = new DateTime($profil[0]['dateDerniereConnection']);
  $dateConnection = $dateDerniereConnection->format("d/m/Y");
  $heureConnection = $dateDerniereConnection->format("H:i");
  echo "Dernière connection le " . $dateConnection . " à " . $heureConnection;
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo "Role : " . $profil[0]['role'];
  echo "</p>";
  echo "</div>";
  $img = "../" . $profil[0]['lienImage'];
  echo "<div>";
  echo "<img class='avatar' src='$img'>";
  echo "</div>";
  if($private){
    if(!empty($articles)){
      echo "<div>";
      echo "<p>";
      echo "Liste des articles :";
      echo "</p>";
      echo "</div>";
      foreach($articles as $article)
      shortArticleDisplay($article, true, true);
    }
    if(!empty($avis)){
      echo "<div>";
      echo "<p>";
      echo "Liste des avis :";
      echo "</p>";
      echo "</div>";
      foreach($avis as $avi){
        avisDisplay($avi, true, true);
      }
    }
    echo "<div>";
    echo '<a href="../creaJeu">Créer un jeu</a>';
    echo "</div>";
    echo "<div>";
    echo '<a href="../creaArticle">Créer un article pour un jeu</a>';
    echo "</div>";
    echo "<div>";
    echo '<a href="../modprofil">Modifier le profil</a>';
    echo "</div>";
    echo "<div>";
    echo '<a class="danger" href="#supprprofil">Supprimer le compte</a>';
    echo "<div id='supprprofil' class='modal'>";
    echo "<div class='modalContent'>";
    echo "<h1>";
    echo "Êtes-vous sûr de vouloir supprimer votre compte ?";
    echo "</h1>";
    echo "<div>";
    echo "<a class='danger' href='../php/supprprofil.php'>Oui</a>";
    echo "<a href='#' class='modalClose safe'>Non</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
  }
}
?>
