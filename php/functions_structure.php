<?php
require_once(__DIR__ . "/functions_query.php");
function displayJV($bdd){
  echo "<div class='Menu'>";//ajouter une classe Menu
  foreach($bdd as $pd){
    // On peut ajouter ici si l'utilisateur possède le jeu ou pas
    // Trouver le(s) chemin de l'image du jeu
    echo "<a href='article.php?numero=$pd[idJeu]'>";//ajouter une classe bloc
    echo "<img src=$pd[chemin] class='pokeLilImg'><br>";
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

function listJeuOption($jeux){
  foreach($jeux as $jeu){
    $idJeu = $jeu['idJeu'];
    $nom = $jeu['nom'];
    echo "<option value='$idJeu'>$idJeu - $nom</option>";
  }
}

function listCategorieOption($categories){
  foreach($categories as $categorie){
    $idCategorie = $categorie['idCategorie'];
    $nomCategorie = $categorie['nomCategorie'];
    echo "<input type='checkbox' name='categorie' value='$idCategorie' id='$idCategorie'>";
    echo "<label for='$idCategorie'>$nomCategorie</label>";
  }
}

function listSupportOption($supports){
  foreach($supports as $support){
    $idSupport = $support['idSupport'];
    $nomSupport = $support['nomSupport'];
    echo "<input type='checkbox' name='categorie' value='$idSupport' id='$idSupport'>";
    echo "<label for='$idSupport'>$nomSupport</label>";
  }
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

function shortArticleDisplay($article){
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
}

function avisDisplay($avis){
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
}

function profilDisplay($profil, $articles, $avis, $private){
  echo "<div>";
  echo "<p>";
  echo $profil[0]['login'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $profil[0]['nom'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $profil[0]['prenom'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $profil[0]['mel'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $profil[0]['dateNaissance'];
  echo "</p>";
  echo "</div>";
  echo "<div>";
  echo "<p>";
  echo $profil[0]['role'];
  echo "</p>";
  echo "</div>";
  $img = "../" . $profil[0]['lienImage'];
  echo "<div>";
  echo "<img src='$img'>";
  echo "</div>";
  if($private){
    if(!empty($articles)){
      echo "<div>";
      echo "<p>";
      echo "Liste des articles :";
      echo "</p>";
      echo "</div>";
      foreach($articles as $article)
      shortArticleDisplay($article);
    }
    if(!empty($avis)){
      echo "<div>";
      echo "<p>";
      echo "Liste des avis :";
      echo "</p>";
      echo "</div>";
      foreach($avis as $avi){
        avisDisplay($avi);
      }
    }
  }
}
?>
