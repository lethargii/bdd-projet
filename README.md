# Coucou.

Liste des choses à faire :

- réparer la base de données ?
- Faire un site qui marche
- Ajouter des styles basiques
- Ajouter polices
- Voir comment créer un article pour un jeu qui n'existe pas
- connecter a l'inscription (pas important)

## Descriptif des pages à faire

### jvcom/

C'est la page principale du site.

Une succession de tous les articles du site triés par ordre décroissant de date de création.

On peut rajouter une pagination (5 articles par page).

### jvcom/jeu/

Page d'un article d'un jeu vidéo en particulier.

Toutes les infos de l'article dessus.

Si administrateur, permet de modifier ou de supprimer un article.

Toutes les infos des avis.

Si utilisateur, permet de créer un avis si aucun n'a été fait, de créer ou de supprimer un avis créé.

Si administrateur, permet de supprimer n'importe quel avis.

### jvcom/connection/

Permet à un utilisateur de se connecter.

Possibilité d'accéder à la page d'inscription.

Si connecté, redirige vers l'acceuil.

### jvcom/search/

Affiche le résultat d'une recherche effectuée par l'utilisateur.

### jvcom/inscription/

Permet à un utilisateur de créer un compte.

Possibilité d'accéder à la page de connection.

Si connecté, redirige vers l'acceuil.

### jvcom/profil/

Si utilisateur connecté permet de visualiser les infos utilisateur.

Sinon redirige vers l'acceuil.

Permet de voir la liste des articles rédigés si administrateur.

Permet de voir la liste des avis rédigés si utilisateur.

### jvcom/modprofil/

Si utilisateur connecté permet de modifier les infos utilisateur.

Sinon redirige vers l'acceuil.

## Parties statiques du site

### /jvcom/static/head.php

Head du site

imports des polices

### /jvcom/static/nav.php

Barre de navigation du site.

Aller vers l'acceuil.

Lien vers page de connection si non connecté.

Lien de déconnection si connecté et lien vers le profil.

### /jvcom/static/header.php

Header du site.

Lien vers l'acceuil sur le logo.

### /jvcom/static/footer.php

Footer du site.

Quelques caractéristiques.

### /jvcom/static/html.php

pour changer la classe de la balise html en fonction du compte connecté
