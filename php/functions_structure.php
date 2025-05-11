<?php
function displayPokedex($pokedex, $connected){
  foreach ($pokedex as $pokemon) {
    echo "<div class='frame frame_card'>";
    echo('<div class="frame_updown">');
    if($connected && $pokemon['nbVue'] == 0){
      echo('<a href="pokemon.php?name=' . $pokemon['nom'] . '"><img class="card-img-top neverSeen" src="'.$pokemon['chemin'].'"></a>');
    }
    else{
      echo('<a href="pokemon.php?name=' . $pokemon['nom'] . '"><img class="card-img-top" src="'.$pokemon['chemin'].'"></a>');
    }
    echo('<div class="card-body">');
    if($connected && $pokemon['nbAttrape'] > 0){
      echo('<h5 class="card-title">'.$pokemon['nom'].'<img style="width: 12%" src="images/pokeball.png"></h5>');
    }
    else {
      echo('<h5 class="card-title">'.$pokemon['nom'].'</h5>');
    }
    echo('<p class="card-text"># '.$pokemon['numero'].'</p>');
    echo('</div>');
    echo('</div>');
    echo "</div>";
  }
}

function displayPokemon($inf, $types, $img, $atk, $evos, $connected){
  echo "<div id=pokemon>";
  // Image
  echo "<div id=upper>";
  echo "<div id=img_pokemon>";
  $chemin = $img[3]['chemin'];
  if($connected && $inf[0]['nbVue'] == 0){
    echo "<img class='neverSeen' src='$chemin'>";
  }
  else{
    echo "<img src='$chemin'>";
  }
  echo "</div>";
  // Infos générales
  echo "<div id=inf>";
  echo "<div class='frame'>";
  echo "<div class=frame_left id=id>";
  $nom = $inf[0]['nom'];
  $numero = $inf[0]['numero'];
  echo "<h1>$numero $nom</h1>";
  echo "</div>";
  echo "</div>";
  echo "<div id=typdres>";
  // Types du pokémon
  echo "<div id=types>";
  foreach ($types as $type) {
    $chemin = $type['chemin'];
    echo "<img class='typ_img' src='$chemin'>";
  }
  echo "</div>";
  if($connected){
    echo "<div class='frame'>";
    echo "<div class=frame_left id=seencatched>";
    $vue = $inf[0]['nbVue'];
    $attrape = $inf[0]['nbAttrape'];
    if($vue == ""){
      $vue = 0;
      $attrape = 0;
    }
    echo "<p>Vue $vue</p>";
    echo "<p>Attrape $attrape</p>";
    echo "</div>";
    echo "</div>";
  }
  echo "</div>";
  echo "</div>";
  echo "</div>";
  echo "<div class=frame>";
  echo "<div class=frame_leftright id=description>";
  echo "<p>" . $inf[0]['description'] . "</p>";
  echo "</div>";
  echo "</div>";
  echo "</div>";
  // Evolution
  echo "<table>";
  echo "<tr><th>Table d'évolution de $nom</th></tr>";
  if(!empty($evos[0][1])){
    foreach($evos[0] as $sousevos){
      if(!empty($sousevos[0])){
        echo "<tr>";
        foreach($sousevos as $sousevo){
          echo "<td>";
          echo "<div class=poke>";
          $nom = $sousevo['nom'];
          echo "<a href='pokemon.php?name=$nom'><img src='" . $sousevo['chemin'] . "'></a>";
          echo "<a href='pokemon.php?name=$nom'>$nom</a>";
          echo "</div>";
          echo "</td>";
        }
        echo "</tr>";
        echo "<tr><td>▼</td></tr>";
      }
    }
  }
  echo "<tr><td>";
  echo "<div class=poke>";
  echo "<a><img src='" . $img[0]['chemin'] . "'></a>";
  echo "<a href='pokemon.php?name=" . $inf[0]['nom'] . "'>" . $inf[0]['nom'] . "</a>";
  echo "</div>";
  echo "</td></tr>";
  if(!empty($evos[1][0])){
    foreach($evos[1] as $surevos){
      if(!empty($surevos[0])){
        echo "<tr><td>▼</td></tr>";
        echo "<tr>";
        foreach($surevos as $surevo){
          echo "<td>";
          echo "<div class=poke>";
          $nom = $surevo['nom'];
          echo "<a href='pokemon.php?name=$nom'><img src='" . $surevo['chemin'] . "'></a>";
          echo "<a href='pokemon.php?name=$nom'>$nom</a>";
          echo "</div>";
          echo "</td>";
        }
        echo "</tr>";
      }
    }
  }
  echo "</table>";
  // Liste d'attaques
  echo "<div class='frame'>";
  echo "<h3 class=frame_up>Liste d'attaques</h3>";
  echo "</div>";
  echo "<table>";
  echo "<tr><th>Nom</th><th>PP</th><th>Puissance</th><th>Précision</th><th>Type</th></tr>";
  foreach ($atk as $cap) {
    echo "<tr>";
    echo "<td>" . $cap['libelle_capacite'] . "</td>";
    echo "<td>" . $cap['pp_capacite'] . "</td>";
    $puissance_capacite = $cap['puissance_capacite'];
    if($puissance_capacite == ""){
      $puissance_capacite = "-";
    }
    echo "<td>$puissance_capacite</td>";
    echo "<td>" . $cap['precision_capacite'] . "</td>";
    echo "<td><img class='typ_img' src='" . $cap['chemin'] . "'></td>";
    echo "</tr>";
  }
  echo "</table>";
  // Gallerie d'images
  echo "<div class='frame'>";
  echo "<h3 class=frame_up>Gallerie d'images</h3>";
  echo "</div>";
  echo '<div id="gallery">';
  foreach ($img as $image) {
    $chemin = $image['chemin'];
    echo "<img class='img_gallery' src='$chemin'>";
  }
  echo '</div>';
}

function listformpokemon($pokedex) {
  foreach ($pokedex as $pokemon) {
    echo '<option value="' . $pokemon['numero'] . '">'. $pokemon['nom'] ."</option>";
  }
}
?>
