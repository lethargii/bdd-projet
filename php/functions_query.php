<?php
require_once(__DIR__."/functions-DB.php");
function getPokedex($mysqli, $id_dresseur) {
  $pokemons = readDB($mysqli, "SELECT pokemon.id_pokemon, numero, nom, chemin, nbVue, nbAttrape 
    FROM pokemon 
    INNER JOIN image ON pokemon.id_pokemon = image.id_pokemon 
    LEFT JOIN pokedex ON pokemon.id_pokemon = pokedex.id_pokemon AND pokedex.id_dresseur = '$id_dresseur'
    WHERE chemin LIKE '%/pokemon_miniature/%'
    ORDER BY numero");
  return $pokemons;
}
function infPokemon($mysqli, $nom, $id_dresseur){
  $inf = readDB($mysqli, "SELECT nom, numero, description, nbVue, nbAttrape 
    FROM pokemon
   LEFT JOIN pokedex ON pokemon.id_pokemon = pokedex.id_pokemon AND pokedex.id_dresseur = '$id_dresseur'
    WHERE nom ='$nom'");
  return $inf;
}

function typesPokemon($mysqli, $nom){
  $types = readDB($mysqli, "SELECT libelle, chemin FROM pokemon INNER JOIN esttype ON pokemon.id_pokemon=esttype.id_pokemon INNER JOIN type ON esttype.id_type=type.id_type WHERE nom ='$nom'");
  return $types;
}

function imgPokemon($mysqli, $nom) {
  $img = readDB($mysqli, "SELECT chemin FROM pokemon INNER JOIN image ON pokemon.id_pokemon=image.id_pokemon WHERE nom ='$nom'");
  return $img;
}

function atkPokemon($mysqli, $nom) {
  $atk = readDB($mysqli, "SELECT libelle_capacite, pp_capacite, puissance_capacite, precision_capacite, chemin FROM pokemon INNER JOIN lance ON pokemon.id_pokemon=lance.id_pokemon INNER JOIN capacite ON lance.id_capacite=capacite.id_capacite INNER JOIN type ON capacite.id_type=type.id_type WHERE nom ='$nom'");
  return $atk;
}

function evoPokemon($mysqli, $nom, $id_dresseur) {
  $sousevos = readDB($mysqli, "SELECT pokemon_sousevo.nom, pokemon_sousevo.numero, pokemon_sousevo.description, chemin 
    FROM pokemon 
    LEFT JOIN evolue ON pokemon.id_pokemon=evolue.id_pokemon_evolue 
    LEFT JOIN pokemon AS pokemon_sousevo ON evolue.id_pokemon_base=pokemon_sousevo.id_pokemon 
    LEFT JOIN image ON pokemon_sousevo.id_pokemon=image.id_pokemon
    LEFT JOIN pokedex ON pokemon_sousevo.id_pokemon=pokedex.id_pokemon AND pokedex.id_dresseur = '$id_dresseur'
    WHERE pokemon.nom ='" . $nom . "'AND chemin LIKE '%/pokemon/%'
    ORDER BY pokemon_sousevo.numero");
  $sousevovos = readDB($mysqli, "SELECT pokemon_sousevovo.nom, pokemon_sousevovo.numero, pokemon_sousevovo.description, chemin 
    FROM pokemon 
    LEFT JOIN evolue AS evo ON pokemon.id_pokemon=evo.id_pokemon_evolue 
    LEFT JOIN pokemon AS pokemon_sousevo ON evo.id_pokemon_base=pokemon_sousevo.id_pokemon
    LEFT JOIN evolue AS evovo ON pokemon_sousevo.id_pokemon=evovo.id_pokemon_evolue 
    LEFT JOIN pokemon AS pokemon_sousevovo ON evovo.id_pokemon_base=pokemon_sousevovo.id_pokemon
    LEFT JOIN image ON pokemon_sousevovo.id_pokemon=image.id_pokemon 
    LEFT JOIN pokedex ON pokemon_sousevovo.id_pokemon=pokedex.id_pokemon AND pokedex.id_dresseur = '$id_dresseur'
    WHERE pokemon.nom ='" . $nom . "'AND chemin LIKE '%/pokemon/%'
    ORDER BY pokemon_sousevovo.numero");
  $evos = readDB($mysqli, "SELECT pokemon_evo.nom, pokemon_evo.numero, pokemon_evo.description, chemin 
    FROM pokemon 
    LEFT JOIN evolue ON pokemon.id_pokemon=evolue.id_pokemon_base 
    LEFT JOIN pokemon AS pokemon_evo ON evolue.id_pokemon_evolue=pokemon_evo.id_pokemon
    LEFT JOIN image ON pokemon_evo.id_pokemon=image.id_pokemon 
    LEFT JOIN pokedex ON pokemon_evo.id_pokemon=pokedex.id_pokemon AND pokedex.id_dresseur = '$id_dresseur'
    WHERE pokemon.nom ='" . $nom . "'AND chemin LIKE '%/pokemon/%'
    ORDER BY pokemon_evo.numero");
  $evovos = readDB($mysqli, "SELECT pokemon_evovo.nom, pokemon_evovo.numero, pokemon_evovo.description, chemin 
    FROM pokemon 
    LEFT JOIN evolue AS evo ON pokemon.id_pokemon=evo.id_pokemon_base 
    LEFT JOIN pokemon AS pokemon_evo ON evo.id_pokemon_evolue=pokemon_evo.id_pokemon
    LEFT JOIN evolue AS evovo ON pokemon_evo.id_pokemon=evovo.id_pokemon_base 
    LEFT JOIN pokemon AS pokemon_evovo ON evovo.id_pokemon_evolue=pokemon_evovo.id_pokemon
    LEFT JOIN image ON pokemon_evovo.id_pokemon=image.id_pokemon 
    LEFT JOIN pokedex ON pokemon_evovo.id_pokemon=pokedex.id_pokemon AND pokedex.id_dresseur = '$id_dresseur'
    WHERE pokemon.nom ='" . $nom . "'AND chemin LIKE '%/pokemon/%'
    ORDER BY pokemon_evovo.numero");
  return array(array($sousevovos, $sousevos), array($evos, $evovos));
}

function infoDresseur($mysqli, $dresseur){
  $nom_dresseur = $dresseur['nom_dresseur'];
  $mdp_dresseur = $dresseur['mdp_dresseur'];
  return readDB($mysqli, "SELECT * FROM dresseur WHERE nom_dresseur = '$nom_dresseur' AND mdp_dresseur = '$mdp_dresseur'");
}

function loginCorrect($mysqli, $dresseur){
  $dresExiste = infoDresseur($mysqli, $dresseur);
  return !empty($dresExiste);
}

function pokeNotExist($mysqli, $nom){
  $pokemon = readDB($mysqli, "SELECT * FROM pokemon WHERE nom='$nom'");
  return empty($pokemon);
}

function nbVueAttrapePokemon($mysqli, $id_pokemon, $id_dresseur){
  return readDB($mysqli, "SELECT nbVue, nbAttrape FROM pokedex WHERE id_pokemon = '$id_pokemon' AND id_dresseur = '$id_dresseur'");
}

function inPokedex($mysqli, $id_pokemon, $id_dresseur){
  $pokedex = nbVueAttrapePokemon($mysqli, $id_pokemon, $id_dresseur);
  return !empty($pokedex);
}

?>
