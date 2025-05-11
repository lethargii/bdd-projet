<nav>
  <ul>
    <li><a href="./">Accueil</a></li>
    <?php
      if(isset($_SESSION['connect_dresseur']) && $_SESSION['connect_dresseur']){
        echo "<li><a href='./profil'>Profil</a></li>";
        echo "<li><a href='./php/logout.php'>Déconnection</a></li>";
      }
      else{
        echo "<li><a href='./connection'>Connection</a></li>";
      }
    ?>
    </ul>
</nav>
