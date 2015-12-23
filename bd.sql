
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


--Matieres générales
INSERT INTO matiere (nom_mat) VALUES ('Anglais');
INSERT INTO matiere (nom_mat) VALUES ('Physique');
INSERT INTO matiere (nom_mat) VALUES ('Expression,Communication');
INSERT INTO matiere (nom_mat) VALUES ('PPP');
INSERT INTO matiere (nom_mat) VALUES ('Mathematiques');
INSERT INTO matiere (nom_mat) VALUES ('Economie');
INSERT INTO matiere (nom_mat) VALUES ('Gestion, Gestion projet');
INSERT INTO matiere (nom_mat) VALUES ('Organisation');
INSERT INTO matiere (nom_mat) VALUES ('Droit');
INSERT INTO matiere (nom_mat) VALUES ('Expression,Communication');

--Matieres Specifiques a l'informatique
INSERT INTO matiere (nom_mat) VALUES ('Algorithmique');
INSERT INTO matiere (nom_mat) VALUES ('Programmation');
INSERT INTO matiere (nom_mat) VALUES ('Architecture Materielle');
INSERT INTO matiere (nom_mat) VALUES ('Systèmes exploitation');
INSERT INTO matiere (nom_mat) VALUES ('Reseaux');
INSERT INTO matiere (nom_mat) VALUES ('Web');
INSERT INTO matiere (nom_mat) VALUES ('Internet');
INSERT INTO matiere (nom_mat) VALUES ('Mobilité');
INSERT INTO matiere (nom_mat) VALUES ('Bases de donnees');
INSERT INTO matiere (nom_mat) VALUES ('Analyse/conception et développement d applis');

--Matieres Specifiques aux GEII
INSERT INTO matiere (nom_mat) VALUES ('Energie');
INSERT INTO matiere (nom_mat) VALUES ('Systeme d information numerique');
INSERT INTO matiere (nom_mat) VALUES ('Informatique');
INSERT INTO matiere (nom_mat) VALUES ('Systemes electronique');
INSERT INTO matiere (nom_mat) VALUES ('Automatisme');
INSERT INTO matiere (nom_mat) VALUES ('Reseau');
INSERT INTO matiere (nom_mat) VALUES ('Automatique');
INSERT INTO matiere (nom_mat) VALUES ('Outils logiciels');
INSERT INTO matiere (nom_mat) VALUES ('Etudes/realisation ensembles pluritechnologiques');
INSERT INTO matiere (nom_mat) VALUES ('Competences projet');

--Matieres Specifiques aux MMI
INSERT INTO matiere (nom_mat) VALUES ('Theories de l information et de la communication');
INSERT INTO matiere (nom_mat) VALUES ('Ecritures dans les medias numeriques');
INSERT INTO matiere (nom_mat) VALUES ('Esthetique et expression artistique');
INSERT INTO matiere (nom_mat) VALUES ('Algorithmie et programmation');
INSERT INTO matiere (nom_mat) VALUES ('Culture scientifique et traitement de l information');
INSERT INTO matiere (nom_mat) VALUES ('Infographie');
INSERT INTO matiere (nom_mat) VALUES ('Integration WEB');
INSERT INTO matiere (nom_mat) VALUES ('Production audiovisuelle');
INSERT INTO matiere (nom_mat) VALUES ('Developpement');
INSERT INTO matiere (nom_mat) VALUES ('Services sur reseaux');
INSERT INTO matiere (nom_mat) VALUES ('Programmation Objet');
INSERT INTO matiere (nom_mat) VALUES ('Integration multimedia');
INSERT INTO matiere (nom_mat) VALUES ('Langue vivante 2');
--Bases de donnees deja dans informatiques

--Matieres Specifiques aux R&T
INSERT INTO matiere (nom_mat) VALUES ('Administration et securite des reseaux');
INSERT INTO matiere (nom_mat) VALUES ('Architecture de l internet');
INSERT INTO matiere (nom_mat) VALUES ('Developpement/exploitation des services reseaux');
INSERT INTO matiere (nom_mat) VALUES ('Telecommunications fixes et mobiles');
INSERT INTO matiere (nom_mat) VALUES ('Outils pour le signal');
INSERT INTO matiere (nom_mat) VALUES ('Electronique/Physique pour les telecommunications');
--informatique deja dans GEII
