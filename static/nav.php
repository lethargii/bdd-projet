<nav>
  <ul>
    <li><a href="/jvcom/">Accueil</a></li>
    <?php
      if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        echo "<li><a href='/jvcom/profil?login=" . $_SESSION['login'] . "'>Profil</a></li>";
        echo "<li><a href='/jvcom/php/logout.php'>Déconnection</a></li>";
      }
      else{
        echo "<li><a href='/jvcom/connection'>Se connecter</a></li>";
        echo "<li><a href='/jvcom/inscription'>S'inscrire</a></li>";
      }
    ?>
  </ul>
  <form action="/jvcom"  method="GET">
    <?php
      $categories = listCategorie($mysqli);
      $supports = listSupport($mysqli);
    ?>
    <input type=text name=search placeholder="Rechercher...">
    <select name="idCategorie" id="idCategorie">
      <option value="">Choisir une catégorie</option>
      <?php listOption($categories, "idCategorie", "nomCategorie"); ?>
    </select>
    <select name="idSupport" id="idSupport">
      <option value="">Choisir un support</option>
      <?php listOption($supports, "idSupport", "nomSupport"); ?>
    </select>
  </form>
</nav>
