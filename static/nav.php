<nav>
    <ul>
        <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>
        <li><a href="index.php" <?= $currentPage == 'index.php' ? 'id="active"' : '' ?>>Pokedex</a></li>
        <?php
        if (isset($_SESSION['is_connected'])){
            echo "<li><a href='php/logout.php'>Deconnection</a></li>";
            echo "<li><a href='edit.php'";
            if ($currentPage == 'edit.php'){
                echo 'id="active"';
            }
            echo ">Editer mes pokemons</a></li>";
        }
        else {
            echo "<li><a href=connection.php ";
            if($currentPage == 'connection.php'){
                echo "id='active'";
            }
            echo " >Connection</a></li>";
        }
        ?>
    </ul>
</nav>