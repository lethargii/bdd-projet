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
    <input type=text name=search placeholder="Rechercher...">
    <select>

    </select>
    <select>

    </select>
  </form>
</nav>
