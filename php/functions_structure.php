<?php
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


?>
?>
