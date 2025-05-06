<?php
require_once("./php/functions-DB.php");
function getPokedex($mysqli) {
  $pokemons = readDB($mysqli, "SELECT pokemon.id_pokemon, numero, nom, chemin FROM pokemon INNER JOIN image ON pokemon.id_pokemon = image.id_pokemon WHERE chemin LIKE '%/pokemon/%'");
  return $pokemons;
}
function infPokemon($mysqli, $name){
  $inf = readDB($mysqli, "SELECT nom, numero, description FROM pokemon WHERE nom ='" . $name . "'");
  return $inf;
}

function typesPokemon($mysqli, $name){
  $types = readDB($mysqli, "SELECT libelle, chemin FROM pokemon INNER JOIN esttype ON pokemon.id_pokemon=esttype.id_pokemon INNER JOIN type ON esttype.id_type=type.id_type WHERE nom ='" . $name . "'");
  return $types;
}

function imgPokemon($mysqli, $name) {
  $img = readDB($mysqli, "SELECT chemin FROM pokemon INNER JOIN image ON pokemon.id_pokemon=image.id_pokemon WHERE nom ='" . $name . "'");
  return $img;
}

function atkPokemon($mysqli, $name) {
  $atk = readDB($mysqli, "SELECT libelle_capacite, pp_capacite, puissance_capacite, precision_capacite, chemin FROM pokemon INNER JOIN lance ON pokemon.id_pokemon=lance.id_pokemon INNER JOIN capacite ON lance.id_capacite=capacite.id_capacite INNER JOIN type ON capacite.id_type=type.id_type WHERE nom ='" . $name . "'");
  return $atk;
}

function evoPokemon($mysqli, $name) {
  $evos = readDB($mysqli, "SELECT pokemon_evo.nom, pokemon_evo.numero, pokemon_evo.description FROM pokemon INNER JOIN evolue ON pokemon.id_pokemon=evolue.id_pokemon_base INNER JOIN pokemon AS pokemon_evo ON evolue.id_pokemon_evolue=pokemon_evo.id_pokemon WHERE pokemon.nom ='" . $name . "'");
  return $evos;
}

function infoDresseur($mysqli, $dresseur){
  return readDB($mysqli, 'SELECT * FROM dresseur WHERE nom_dresseur = "' . $dresseur["login"] . '" AND mdp_dresseur = "' . $dresseur["mdp"] . '"');
}

function loginCorrect($mysqli, $dresseur){
  $dresExiste = infoDresseur($mysqli, $dresseur);
  return !empty($dresExiste);
}

function nbVueAttrapePokemon($mysqli, $id_pokemon, $id_dresseur){
  return readDB($mysqli, 'SELECT nbVue, nbAttrape FROM pokedex WHERE id_pokemon = "' . $id_pokemon . '" AND id_dresseur = "' . $id_dresseur . '"');
}

function getPokedexDresseur($mysqli, $id_dresseur){
  $pokemons = readDB($mysqli, "SELECT pokemon.id_pokemon, numero, nom, chemin, nbVue, nbAttrape FROM pokemon INNER JOIN image ON pokemon.id_pokemon = image.id_pokemon LEFT OUTER JOIN pokedex ON pokemon.id_pokemon = pokedex.id_pokemon WHERE (pokedex.id_dresseur = '" . $id_dresseur . "' OR pokedex.id_dresseur IS NULL) AND chemin LIKE '%/pokemon/%'");
  return $pokemons;
}
?>
