<?php
require_once(__DIR__ . "/functions_query.php");
function displayJV($bdd){
    echo "<div class='pokeMenu'>";
    foreach($bdd as $pd){
        if (isset($_SESSION['is_connected'])) {
            echo "<a href='pokemon.php?numero=$pd[numero]' class='myLilPokeBlocConnected'>";
                $seenGot = seenGot($_SESSION['id'], $pd['numero']);
                if (count($seenGot) == 0) {
                    echo "<p>Pokemon non découvert</p>";
                    echo "<img src=$pd[chemin] class='pokeLilImgGhost'><br>";
                    echo "<img src=images/myimages/pokeball.png class='pokeballBlack'><br>";
                }
                else {
                    if ($seenGot[0]['nbVue'] > 0) {
                        echo "<p>Vue : ".$seenGot[0]['nbVue']." Attrape : ".$seenGot[0]['nbAttrape']."</p>";
                        echo "<img src=$pd[chemin] class='pokeLilImg'><br>";
                    } else {
                        echo "<p>Pokemon non découvert</p>";
                        echo "<img src=$pd[chemin] class='pokeLilImgGhost'><br>";
                    }
                    if ($seenGot[0]['nbAttrape'] == 0) {
                        echo "<img src=images/myimages/pokeball.png class='pokeballBlack'><br>";
                    } else {
                        echo "<img src=images/myimages/pokeball.png class='pokeball'><br>";
                    }
                }
                
        }
        else{
            echo "<a href='pokemon.php?numero=$pd[numero]' class='myLilPokeBloc'>";
            echo "<img src=$pd[chemin] class='pokeLilImg'><br>";
        }
        echo "$pd[nom]<br>";
        echo "#$pd[numero]<br>";
        $tabType = tabType($pd['numero']);
        foreach($tabType as $tabType2){
            echo "<img src=".$tabType2['chemin']." class=smallerImg><br>";
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
  echo  '<input type="text" id="contenu" name="contenu" placeholder="Contenu de l\'article" value = "' . $article[0]['contenu'] . '" required>';
  echo  '<input type="number" id="noteArticle" name="noteArticle" placeholder="Note du jeu" value = "' . $article[0]['noteArticle'] . '" required>';
  echo  '<input type="text" id="caracteristiques" name="caracteristiques" placeholder="Caractéristiques du jeu" value = "' . $article[0]['caracteristiques'] . '" required>';
}

function profileditable($mysqli, $loginprec, $loginnew){
  return empty(readDB($mysqli, "SELECT * FROM utilisateur WHERE login = '$loginnew' AND login != '$loginprec'"));
}
?>
