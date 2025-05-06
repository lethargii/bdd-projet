<?php
function displayPokedex($pokedex){
  foreach ($pokedex as $pokemon) {
    echo('<div class="card" style="width: 18rem;">');
    echo('<a href="pokemon.php?name=' . $pokemon['nom'] . '"><img class="card-img-top" src="'.$pokemon['chemin'].'"></a>');
    echo('<div class="card-body">');
    echo('<h5 class="card-title">'.$pokemon['nom'].'</h5>');
    echo('<p class="card-text"># '.$pokemon['numero'].'</p>');
    echo('</div>');
    echo('</div>');
  }
}

function formPokedex($pokedex){
  foreach ($pokedex as $pokemon) {
    echo '<option value="' . $pokemon['id'] . '">' . $pokemon['nom'] . '</option>';
  }
}

function displayPokemon($inf, $types, $img, $atk, $evo){
  // Image
  echo '<img src="' . $img[0]['chemin'] . '">';
  // Infos générales
  echo "<h1>" . $inf[0]['nom'] . "</h1>";
  echo "<h2>" . $inf[0]['numero'] . "</h2>";
  echo "<p>" . $inf[0]['description'] . "</p>";
  // Types du pokémon
  echo "<h3>Types du pokémon</h3>";
  echo "<ul>";
  foreach ($types as $type) {
    echo "<li><img src='" . $type['chemin'] . "'></li>";
  }
  echo "</ul>";
  // Evolution
  echo "<h3>Évolution</h3>";
  // Liste d'attaques
  echo "<h3>Liste d'attaques</h3>";
  echo "<table>";
  echo "<tr>";
  echo "<th>Nom</th>";
  echo "<th>PP</th>";
  echo "<th>Puissance</th>";
  echo "<th>Précision</th>";
  echo "<th>Type</th>";
  echo "</tr>";
  foreach ($atk as $cap) {
    echo "<tr>";
    echo "<td>" . $cap['libelle_capacite'] . "</td>";
    echo "<td>" . $cap['pp_capacite'] . "</td>";
    echo "<td>" . $cap['puissance_capacite'] . "</td>";
    echo "<td>" . $cap['precision_capacite'] . "</td>";
    echo "<td><img src='" . $cap['chemin'] . "'></td>";
    echo "</tr>";
  }
  echo "</table>";
  // Gallerie d'images
  echo "<h3>Gallerie d'images</h3>";
  echo '<div>';
  foreach ($img as $image) {
    echo '<img src="' . $image['chemin'] . '">';
  }
  echo '</div>';
}

function displayPokedexDresseur($pokedex){
  foreach ($pokedex as $pokemon) {
    echo('<div class="card" style="width: 18rem;">');
    if($pokemon['nbVue'] == 0){
      echo('<a href="pokemon.php?name=' . $pokemon['nom'] . '"><img class="card-img-top neverSeen" src="'.$pokemon['chemin'].'"></a>');
    }
    else{
      echo('<a href="pokemon.php?name=' . $pokemon['nom'] . '"><img class="card-img-top" src="'.$pokemon['chemin'].'"></a>');
    }
    echo('<div class="card-body">');
    if($pokemon['nbAttrape'] > 0){
      echo('<h5 class="card-title">'.$pokemon['nom'].'<img style="width: 12%" src="images/pokeball.png"></h5>');
    }
    else {
      echo('<h5 class="card-title">'.$pokemon['nom'].'</h5>');
    }
    echo('<p class="card-text"># '.$pokemon['numero'].'</p>');
    echo('</div>');
    echo('</div>');
  }
}

function displayPokemonDresseur($inf, $types, $img, $atk, $evo){
  // Image
  echo '<img src="' . $img[0]['chemin'] . '">';
  // Infos générales
  echo "<h1>" . $inf[0]['nom'] . "</h1>";
  echo "<h2>" . $inf[0]['numero'] . "</h2>";
  echo "<p>" . $inf[0]['description'] . "</p>";
  // Types du pokémon
  echo "<h3>Types du pokémon</h3>";
  echo "<ul>";
  foreach ($types as $type) {
    echo "<li><img src='" . $type['chemin'] . "'></li>";
  }
  echo "</ul>";
  // Evolution
  echo "<h3>Évolution</h3>";
  // Liste d'attaques
  echo "<h3>Liste d'attaques</h3>";
  echo "<table>";
  echo "<tr>";
  echo "<th>Nom</th>";
  echo "<th>PP</th>";
  echo "<th>Puissance</th>";
  echo "<th>Précision</th>";
  echo "<th>Type</th>";
  echo "</tr>";
  foreach ($atk as $cap) {
    echo "<tr>";
    echo "<td>" . $cap['libelle_capacite'] . "</td>";
    echo "<td>" . $cap['pp_capacite'] . "</td>";
    echo "<td>" . $cap['puissance_capacite'] . "</td>";
    echo "<td>" . $cap['precision_capacite'] . "</td>";
    echo "<td><img src='" . $cap['chemin'] . "'></td>";
    echo "</tr>";
  }
  echo "</table>";
  // Gallerie d'images
  echo "<h3>Gallerie d'images</h3>";
  echo '<div>';
  foreach ($img as $image) {
    echo '<img src="' . $image['chemin'] . '">';
  }
  echo '</div>';
}
?>
