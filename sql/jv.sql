CREATE TABLE article (
  PRIMARY KEY (idArticle),
  idArticle           SERIAL NOT NULL,
  titre               VARCHAR(300) NOT NULL,
  contenu             TEXT NOT NULL,
  noteArticle         TINYINT CHECK (noteArticle <= 10 AND noteArticle >= 0) NOT NULL,
  caracteristiques    VARCHAR(300) NOT NULL,
  dateCreationArticle DATE NOT NULL,
  dateModification    DATE NOT NULL,
  idJeu               BIGINT NOT NULL,
  idImage             BIGINT NOT NULL,
  login               VARCHAR(300) NOT NULL,
  UNIQUE (idJeu),
  UNIQUE (idImage)
  
);

CREATE TABLE avis (
  PRIMARY KEY (idAvis),
  idAvis           SERIAL NOT NULL,
  titre            VARCHAR(300) NOT NULL,
  texte            TEXT NOT NULL,
  noteAvis         TINYINT CHECK (noteAvis <= 10 AND noteAvis >= 0) NOT NULL,
  dateCreationAvis DATE NOT NULL,
  idJeu            BIGINT NOT NULL,
  login            VARCHAR(300) NOT NULL
  
);

CREATE TABLE categorie (
  PRIMARY KEY (idCategorie),
  idCategorie  SERIAL NOT NULL,
  nomCategorie VARCHAR(100) NOT NULL
);

CREATE TABLE categoriesJeu (
  PRIMARY KEY (idJeu, idCategorie),
  idJeu       BIGINT NOT NULL,
  idCategorie BIGINT NOT NULL
);

CREATE TABLE image (
  PRIMARY KEY (idImage),
  idImage   SERIAL NOT NULL,
  lienImage VARCHAR(300) NOT NULL,
  idArticle BIGINT
);

CREATE TABLE jeu (
  PRIMARY KEY (idJeu),
  idJeu      SERIAL NOT NULL,
  nom        VARCHAR(300) NOT NULL,
  prix       FLOAT NOT NULL,
  dateSortie DATE NOT NULL,
  synopsis   VARCHAR(1000) NOT NULL
);

CREATE TABLE support (
  PRIMARY KEY (idSupport),
  idSupport  SERIAL NOT NULL,
  nomSupport VARCHAR(100) NOT NULL
);

CREATE TABLE supportsJeu (
  PRIMARY KEY (idJeu, idSupport),
  idJeu     SERIAL NOT NULL,
  idSupport BIGINT NOT NULL
);

CREATE TABLE utilisateur (
  PRIMARY KEY (login),
  login         VARCHAR(300) NOT NULL,
  mdp           VARCHAR(100) NOT NULL,
  nom           VARCHAR(300) NOT NULL,
  prenom        VARCHAR(300) NOT NULL,
  mel           VARCHAR(300) NOT NULL,
  dateNaissance DATE CHECK (dateNaissance <= DATEADD(year, CURRENT_DATE(), -15)) NOT NULL,
  modo          BOOLEAN NOT NULL,
  idImage       BIGINT NULL,
  UNIQUE (idImage)
  
);

ALTER TABLE article ADD FOREIGN KEY (login) REFERENCES utilisateur (login);
ALTER TABLE article ADD FOREIGN KEY (idImage) REFERENCES image (idImage);
ALTER TABLE article ADD FOREIGN KEY (idJeu) REFERENCES jeu (idJeu);

ALTER TABLE avis ADD FOREIGN KEY (login) REFERENCES utilisateur (login);
ALTER TABLE avis ADD FOREIGN KEY (idJeu) REFERENCES jeu (idJeu);

ALTER TABLE categoriesJeu ADD FOREIGN KEY (idCategorie) REFERENCES categorie (idCategorie);
ALTER TABLE categoriesJeu ADD FOREIGN KEY (idJeu) REFERENCES jeu (idJeu);

ALTER TABLE image ADD FOREIGN KEY (idArticle) REFERENCES article (idArticle);

ALTER TABLE supportsJeu ADD FOREIGN KEY (idSupport) REFERENCES support (idSupport);
ALTER TABLE supportsJeu ADD FOREIGN KEY (idJeu) REFERENCES jeu (idJeu);

ALTER TABLE utilisateur ADD FOREIGN KEY (idImage) REFERENCES image (idImage);

