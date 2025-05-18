<?php
session_start();
//affichage des erreurs côté PHP et côté MYSQLI
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Import du site
require_once("./includes/constantes.php");
require_once("./php/functions-DB.php");
require_once("./php/functions_query.php");
require_once("./php/functions_structure.php");
$mysqli = connectionDB();
$numero = $_GET['numero'];
$tabArticle=infoArticle($mysqli, $numero);
$tabNomJeu = getNomJeu($mysqli, $numero);
$nomJeu = $tabNomJeu[0]['nom'];
$idAvis = getIdAvis($mysqli, $numero);
?>
<!DOCTYPE html>
<?php
include("static/html.php");
include("static/head.php");
?>
  <body>
    <?php include("static/header.php"); ?>
    <?php include("static/nav.php"); ?>
    <main class="lilMargin">
      <?php
        if (isset($_SESSION['is_connected'])) {
            echo "<h2>Vous êtes connectés " . htmlspecialchars($_SESSION['login'])."</h2>";
            echo "<h3>Votre id est : " . htmlspecialchars($_SESSION['id'])."</h3>";
        }
        if (!empty($tabArticle[0])){
          echo "<h1>Ceci est l'article du jeu $nomJeu </h1>";
          echo "<h2>{$tabArticle[0]['titre']}</h2>";
          echo "<p>{$tabArticle[0]['contenu']}</p>";
          echo "<p>Note de l'article : {$tabArticle[0]['noteArticle']}/10</p>";
          echo "<p>Caractéristiques du jeu : {$tabArticle[0]['caracteristiques']}</p>";
          echo "<p>Date de création de l'article : {$tabArticle[0]['dateCreationArticle']}</p>";
          echo "<p>Date de modification de l'article : {$tabArticle[0]['dateModification']}</p>";
        }
        // créer un avis avec creaAvis/index.php
        echo '<a href="../creaAvis"?idJeu='.$numero.'>Donner ton avis</a>';
        foreach ($idAvis as $idA){
          $avis = infoAvis($mysqli, $idA['idAvis']);
          if (!empty($avis[0])){
            echo "<h2>{$avis[0]['titre']}</h2>";
            echo "<p>{$avis[0]['texte']}</p>";
            echo "<p>Note de l'avis : {$avis[0]['noteAvis']}/10</p>";
            echo "<p>Date de création de l'avis : {$avis[0]['dateCreationAvis']}</p>";
            $wroteBy = infoUtilisateur($mysqli, $avis[0]['login']);
            echo "<p>Rédigé par : {$wroteBy[0]['login']}</p>";
            avisDisplay($idA['idAvis'], 0, 0);
          }
        }
        
      ?>
    </main>
    <?php
      include("static/footer.php");
    ?>
  </body>
</html>
<?php closeDB($mysqli); ?>
