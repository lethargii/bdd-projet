<?php
require_once(__DIR__."/functions-DB.php");
function infoUtilisateur($mysqli, $utilisateur){
  $login = $utilisateur['login'];
  $mdp = $utilisateur['mdp'];
  return readDB($mysqli, "SELECT * FROM utilisateur WHERE login = '$login' AND mdp = '$mdp'");
}

function loginCorrect($mysqli, $utilisateur){
  $dresExiste = infoUtilisateur($mysqli, $utilisateur);
  return !empty($dresExiste);
}

function notExistUtilisateur($mysqli, $utilisateur){
  $login = $utilisateur['login'];
  return empty(readDB($mysqli, "SELECT * FROM utilisateur WHERE login = '$login'"));
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
