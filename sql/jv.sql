CREATE TABLE article (
  PRIMARY KEY (idArticle),
  idArticle           BIGINT AUTO_INCREMENT NOT NULL,
  titre               VARCHAR(300) NOT NULL,
  contenu             TEXT NOT NULL,
  noteArticle         TINYINT NOT NULL CHECK (noteArticle <= 10 AND noteArticle >= 0),
  caracteristiques    TEXT NOT NULL,
  dateCreationArticle DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  dateModification    DATETIME NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  idJeu               BIGINT NOT NULL,
  login               VARCHAR(300) NOT NULL,
  UNIQUE (idJeu)
  
);

CREATE TABLE avis (
  PRIMARY KEY (idAvis),
  idAvis           BIGINT AUTO_INCREMENT NOT NULL,
  titre            VARCHAR(300) NOT NULL,
  texte            TEXT NOT NULL,
  noteAvis         TINYINT NOT NULL CHECK (noteAvis <= 10 AND noteAvis >= 0),
  dateCreationAvis DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  idJeu            BIGINT NOT NULL,
  login            VARCHAR(300) NOT NULL
  
);

CREATE TABLE categorie (
  PRIMARY KEY (idCategorie),
  idCategorie  BIGINT AUTO_INCREMENT NOT NULL,
  nomCategorie VARCHAR(100) NOT NULL
);

CREATE TABLE categoriesJeu (
  PRIMARY KEY (idJeu, idCategorie),
  idJeu       BIGINT NOT NULL,
  idCategorie BIGINT NOT NULL
);

CREATE TABLE image (
  PRIMARY KEY (idImage),
  idImage   BIGINT AUTO_INCREMENT NOT NULL,
  lienImage VARCHAR(300) NOT NULL,
  idArticle BIGINT
);

CREATE TABLE jeu (
  PRIMARY KEY (idJeu),
  idJeu      BIGINT AUTO_INCREMENT NOT NULL,
  nom        VARCHAR(300) NOT NULL,
  prix       FLOAT NOT NULL,
  dateSortie DATE NOT NULL,
  synopsis   TEXT NOT NULL,
  idImage    BIGINT NOT NULL,
  UNIQUE(idImage)
);

CREATE TABLE support (
  PRIMARY KEY (idSupport),
  idSupport  BIGINT AUTO_INCREMENT NOT NULL,
  nomSupport VARCHAR(100) NOT NULL
);

CREATE TABLE supportsJeu (
  PRIMARY KEY (idJeu, idSupport),
  idJeu     BIGINT NOT NULL,
  idSupport BIGINT NOT NULL
);

CREATE TABLE utilisateur (
  PRIMARY KEY (login),
  login         VARCHAR(300) NOT NULL,
  mdp           VARCHAR(100) NOT NULL,
  nom           VARCHAR(300) NOT NULL,
  prenom        VARCHAR(300) NOT NULL,
  mel           VARCHAR(300) NOT NULL,
  dateNaissance DATE NOT NULL,
  modo          BOOLEAN NOT NULL,
  idImage       BIGINT NULL,
  UNIQUE (idImage)
  
);

ALTER TABLE article ADD FOREIGN KEY (login) REFERENCES utilisateur (login);
ALTER TABLE jeu ADD FOREIGN KEY (idImage) REFERENCES image (idImage);
ALTER TABLE article ADD FOREIGN KEY (idJeu) REFERENCES jeu (idJeu);

ALTER TABLE avis ADD FOREIGN KEY (login) REFERENCES utilisateur (login);
ALTER TABLE avis ADD FOREIGN KEY (idJeu) REFERENCES jeu (idJeu);

ALTER TABLE categoriesJeu ADD FOREIGN KEY (idCategorie) REFERENCES categorie (idCategorie);
ALTER TABLE categoriesJeu ADD FOREIGN KEY (idJeu) REFERENCES jeu (idJeu);

ALTER TABLE image ADD FOREIGN KEY (idArticle) REFERENCES article (idArticle);

ALTER TABLE supportsJeu ADD FOREIGN KEY (idSupport) REFERENCES support (idSupport);
ALTER TABLE supportsJeu ADD FOREIGN KEY (idJeu) REFERENCES jeu (idJeu);

ALTER TABLE utilisateur ADD FOREIGN KEY (idImage) REFERENCES image (idImage);

INSERT INTO categorie (nomCategorie) VALUES
    ('Action'),
    ('Action-aventure'),
    ('Infiltration'),
    ('Survival horror'),
    ('Combat'),
    ('Beat them all'),
    ('Plateformes'),
    ('Tir'),
    ('Tir à la première personne (FPS)'),
    ('Rail shooter'),
    ('Aventure'),
    ('Fiction interactive'),
    ('Aventure graphique'),
    ('Simulation de drague'),
    ('Jeu de rôle (RPG)'),
    ('Jeu de rôle d\'action (ARPG)'),
    ('Hack and slash'),
    ('Roguelike'),
    ('Jeu de rôle en ligne massivement multijoueur (MMORPG)'),
    ('Jeu de rôle tactique (T-RPG)'),
    ('Réflexion'),
    ('Labyrinthe'),
    ('Puzzle'),
    ('Simulation'),
    ('Gestion'),
    ('Stratégie'),
    ('Stratégie au tour par tour'),
    ('Stratégie en temps réel (RTS)'),
    ('Grande stratégie'),
    ('4X'),
    ('Wargame'),
    ('Sport'),
    ('Course');

INSERT INTO support (nomSupport) VALUES
    ('Atari 2600'),
    ('Nintendo Entertainment System (NES)'),
    ('Sega Mega Drive'),
    ('Super Nintendo Entertainment System (SNES)'),
    ('PlayStation'),
    ('Nintendo 64'),
    ('Dreamcast'),
    ('PlayStation 2'),
    ('Xbox'),
    ('GameCube'),
    ('PlayStation 3'),
    ('Xbox 360'),
    ('Wii'),
    ('PlayStation 4'),
    ('Xbox One'),
    ('Nintendo Switch'),
    ('PlayStation 5'),
    ('Xbox Series X'),
    ('Steam Deck'),
    ('Playdate');

INSERT INTO support (nomSupport) VALUES
    ('Game Boy'),
    ('Game Boy Color'),
    ('Game Boy Advance'),
    ('Nintendo DS'),
    ('Nintendo 3DS'),
    ('PlayStation Portable (PSP)'),
    ('PlayStation Vita'),
    ('Neo Geo Pocket'),
    ('Neo Geo Pocket Color'),
            $categories = listCategorie($mysqli);
    ('Sega Game Gear'),
    ('WonderSwan'),
    ('WonderSwan Color'),
    ('Atari Lynx'),
    ('Analogue Pocket');
