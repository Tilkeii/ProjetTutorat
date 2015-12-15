
/*DROP TABLE needhelp;
DROP TABLE helper;
DROP TABLE etudiant;
DROP TABLE groupe;
DROP TABLE matiere;
DROP TABLE privileges;*/

/**
NOT NULL ne fonctionne pas sur les "references" alors que sa fonctionne lorsque l'on modifie sur phpmyadmin
THE FUCK ! Peut pas mettre non plus de valeur par defaut (marche sur phpmyadmin)
Need serveur distant :D 
**/

CREATE TABLE privileges (
  id_priv INT(4) PRIMARY KEY AUTO_INCREMENT,
  nom_priv VARCHAR(30) NOT NULL
);

CREATE TABLE matiere (
  id_mat INT(4) PRIMARY KEY AUTO_INCREMENT,
  nom_mat VARCHAR(30) NOT NULL
);

CREATE TABLE groupe (
  id_grp INT(4) PRIMARY KEY AUTO_INCREMENT,
  filiere VARCHAR(30) NOT NULL,
  annee INT NOT NULL NOT NULL
);

CREATE TABLE etudiant (
  numero_etudiant INT(8) PRIMARY KEY,
  mdp VARCHAR(50) NOT NULL,
  nom VARCHAR(30) NOT NULL,
  prenom VARCHAR(30) NOT NULL,
  age INT(3),
  email VARCHAR(30) NOT NULL,
  id_priv INT(4) REFERENCES privileges,
  id_grp INT(4) REFERENCES groupe
);                                      

CREATE TABLE helper (
  numero_etudiant INT(8) REFERENCES etudiant,
  id_mat INT(4) REFERENCES matiere,
  commentaire VARCHAR(300),
  PRIMARY KEY(numero_etudiant, id_mat)
);

CREATE TABLE needhelp (
  numero_etudiant INT(8) REFERENCES etudiant,
  id_mat INT(4) REFERENCES matiere,
  commentaire VARCHAR(300),
  PRIMARY KEY(numero_etudiant, id_mat)
);

CREATE TABLE cours(
  id_mat INT(4) REFERENCES matiere,
  id_grp INT(4) REFERENCES groupe,
  PRIMARY KEY(id_mat, id_grp)
);

INSERT INTO privileges (nom_priv) VALUES ('user');
INSERT INTO privileges (nom_priv) VALUES ('admin');
INSERT INTO groupe (filiere,annee) VALUES ('GEII',1);
INSERT INTO groupe (filiere,annee) VALUES ('INFO',1);
INSERT INTO groupe (filiere,annee) VALUES ('MMI',1);
INSERT INTO groupe (filiere,annee) VALUES ('RT',1);
INSERT INTO groupe (filiere,annee) VALUES ('GEII',2);
INSERT INTO groupe (filiere,annee) VALUES ('INFO',2);
INSERT INTO groupe (filiere,annee) VALUES ('MMI',2);
INSERT INTO groupe (filiere,annee) VALUES ('RT',2);

INSERT INTO matiere (nom_mat) VALUES ('Anglais');
INSERT INTO matiere (nom_mat) VALUES ('Algorithmique');
INSERT INTO matiere (nom_mat) VALUES ('Architecture des systèmes informatiques');
INSERT INTO matiere (nom_mat) VALUES ('Bases de données');
INSERT INTO matiere (nom_mat) VALUES ('Conception orientée objet');
INSERT INTO matiere (nom_mat) VALUES ('Conception de documents');
INSERT INTO matiere (nom_mat) VALUES ('Systèmes informatique');
INSERT INTO matiere (nom_mat) VALUES ('Mathématiques discrètes');
INSERT INTO matiere (nom_mat) VALUES ('Algèbre linéaire');
INSERT INTO matiere (nom_mat) VALUES ('Expression-communication');
INSERT INTO matiere (nom_mat) VALUES ('Architecture réseaux');
INSERT INTO matiere (nom_mat) VALUES ('Programmation orientée objet');
INSERT INTO matiere (nom_mat) VALUES ('Graphes et langages');
INSERT INTO matiere (nom_mat) VALUES ('Gestion de projet');
INSERT INTO matiere (nom_mat) VALUES ('Programmation web');
INSERT INTO matiere (nom_mat) VALUES ('Services réseaux');
INSERT INTO matiere (nom_mat) VALUES ('Probabilités et statistiques');
INSERT INTO matiere (nom_mat) VALUES ('Modélisations mathématiques');
INSERT INTO matiere (nom_mat) VALUES ('Droit des TIC');
INSERT INTO matiere (nom_mat) VALUES ('Gestion des systèmes d informations');
INSERT INTO matiere (nom_mat) VALUES ('Systèmes d exploitation');
INSERT INTO matiere (nom_mat) VALUES ('Comptabilité');
INSERT INTO matiere (nom_mat) VALUES ('IHM');
INSERT INTO matiere (nom_mat) VALUES ('Economie');
INSERT INTO matiere (nom_mat) VALUES ('Fonctionnement des organisations');
INSERT INTO matiere (nom_mat) VALUES ('Conception et développement mobile');
INSERT INTO matiere (nom_mat) VALUES ('Programmation répartie');
INSERT INTO matiere (nom_mat) VALUES ('Administration système et réseau');

INSERT INTO matiere (nom_mat) VALUES ('Langue vivante 2');
