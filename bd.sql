
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
  nom_mat VARCHAR(50) NOT NULL
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


/*Matieres générales*/
INSERT INTO matiere (nom_mat) VALUES ('Anglais');
INSERT INTO matiere (nom_mat) VALUES ('Physique');
INSERT INTO matiere (nom_mat) VALUES ('Expression,Communication');
INSERT INTO matiere (nom_mat) VALUES ('PPP');
INSERT INTO matiere (nom_mat) VALUES ('Mathematiques');
INSERT INTO matiere (nom_mat) VALUES ('Economie');
INSERT INTO matiere (nom_mat) VALUES ('Gestion, Gestion projet');
INSERT INTO matiere (nom_mat) VALUES ('Organisation');
INSERT INTO matiere (nom_mat) VALUES ('Droit');

/*Matieres Specifiques a l informatique*/
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

/*Matieres Specifiques aux GEII*/
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

/*Matieres Specifiques aux MMI*/
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
/*Bases de donnees deja dans informatiques*/

/*Matieres Specifiques aux R&T*/
INSERT INTO matiere (nom_mat) VALUES ('Administration et securite des reseaux');
INSERT INTO matiere (nom_mat) VALUES ('Architecture de l internet');
INSERT INTO matiere (nom_mat) VALUES ('Developpement/exploitation des services reseaux');
INSERT INTO matiere (nom_mat) VALUES ('Telecommunications fixes et mobiles');
INSERT INTO matiere (nom_mat) VALUES ('Outils pour le signal');
INSERT INTO matiere (nom_mat) VALUES ('Electronique/Physique pour les telecommunications');
/*informatique deja dans GEII*/

/*relie les matieres avec les promos avec cours*/

/*Anglais*/
INSERT INTO cours (id_mat,id_grp) VALUES (1,1);
INSERT INTO cours (id_mat,id_grp) VALUES (1,2);
INSERT INTO cours (id_mat,id_grp) VALUES (1,3);
INSERT INTO cours (id_mat,id_grp) VALUES (1,4);
INSERT INTO cours (id_mat,id_grp) VALUES (1,5);
INSERT INTO cours (id_mat,id_grp) VALUES (1,6);
INSERT INTO cours (id_mat,id_grp) VALUES (1,7);
INSERT INTO cours (id_mat,id_grp) VALUES (1,8);

/*Physique*/
INSERT INTO cours (id_mat,id_grp) VALUES (2,1);
INSERT INTO cours (id_mat,id_grp) VALUES (2,5);

/*Expression et communication*/
INSERT INTO cours (id_mat,id_grp) VALUES (3,1);
INSERT INTO cours (id_mat,id_grp) VALUES (3,2);
INSERT INTO cours (id_mat,id_grp) VALUES (3,3);
INSERT INTO cours (id_mat,id_grp) VALUES (3,4);
INSERT INTO cours (id_mat,id_grp) VALUES (3,5);
INSERT INTO cours (id_mat,id_grp) VALUES (3,6);
INSERT INTO cours (id_mat,id_grp) VALUES (3,7);
INSERT INTO cours (id_mat,id_grp) VALUES (3,8);

/*PPP*/
INSERT INTO cours (id_mat,id_grp) VALUES (4,1);
INSERT INTO cours (id_mat,id_grp) VALUES (4,2);
INSERT INTO cours (id_mat,id_grp) VALUES (4,3);
INSERT INTO cours (id_mat,id_grp) VALUES (4,4);
INSERT INTO cours (id_mat,id_grp) VALUES (4,5);
INSERT INTO cours (id_mat,id_grp) VALUES (4,6);
INSERT INTO cours (id_mat,id_grp) VALUES (4,7);
INSERT INTO cours (id_mat,id_grp) VALUES (4,8);

/*Mathematiques*/
INSERT INTO cours (id_mat,id_grp) VALUES (5,1);
INSERT INTO cours (id_mat,id_grp) VALUES (5,2);
INSERT INTO cours (id_mat,id_grp) VALUES (5,4);
INSERT INTO cours (id_mat,id_grp) VALUES (5,5);
INSERT INTO cours (id_mat,id_grp) VALUES (5,6);
INSERT INTO cours (id_mat,id_grp) VALUES (5,8);

/*Economie*/
INSERT INTO cours (id_mat,id_grp) VALUES (6,5);
INSERT INTO cours (id_mat,id_grp) VALUES (6,2);
INSERT INTO cours (id_mat,id_grp) VALUES (6,3);
INSERT INTO cours (id_mat,id_grp) VALUES (6,7);
INSERT INTO cours (id_mat,id_grp) VALUES (6,8);

/*Gestion, gestion de projet*/
INSERT INTO cours (id_mat,id_grp) VALUES (7,2);
INSERT INTO cours (id_mat,id_grp) VALUES (7,6);
INSERT INTO cours (id_mat,id_grp) VALUES (7,3);
INSERT INTO cours (id_mat,id_grp) VALUES (7,7);
INSERT INTO cours (id_mat,id_grp) VALUES (7,8);

/*Organisation*/
INSERT INTO cours (id_mat,id_grp) VALUES (8,2);
INSERT INTO cours (id_mat,id_grp) VALUES (8,3);
INSERT INTO cours (id_mat,id_grp) VALUES (8,7);

/*droit*/
INSERT INTO cours (id_mat,id_grp) VALUES (9,5);
INSERT INTO cours (id_mat,id_grp) VALUES (9,6);
INSERT INTO cours (id_mat,id_grp) VALUES (9,3);
INSERT INTO cours (id_mat,id_grp) VALUES (9,7);
INSERT INTO cours (id_mat,id_grp) VALUES (9,8);

/*informatique*/
/*Algo*/
INSERT INTO cours (id_mat,id_grp) VALUES (10,2);
INSERT INTO cours (id_mat,id_grp) VALUES (10,6);

/*programmation*/
INSERT INTO cours (id_mat,id_grp) VALUES (11,2);
INSERT INTO cours (id_mat,id_grp) VALUES (11,6);

/*Architecture materielle*/
INSERT INTO cours (id_mat,id_grp) VALUES (12,2);

/*Systeme d exploitation*/
INSERT INTO cours (id_mat,id_grp) VALUES (13,2);
INSERT INTO cours (id_mat,id_grp) VALUES (13,6);

/*Reseau*/
INSERT INTO cours (id_mat,id_grp) VALUES (14,2);
INSERT INTO cours (id_mat,id_grp) VALUES (14,6);

/*Web*/
INSERT INTO cours (id_mat,id_grp) VALUES (15,2);
INSERT INTO cours (id_mat,id_grp) VALUES (15,6);

/*internet*/

/*Mobilité*/
INSERT INTO cours (id_mat,id_grp) VALUES (17,6);

/*BD*/
INSERT INTO cours (id_mat,id_grp) VALUES (18,2);
INSERT INTO cours (id_mat,id_grp) VALUES (18,6);

/*Analyse/concetpion et dev d'applis*/
INSERT INTO cours (id_mat,id_grp) VALUES (19,2);
INSERT INTO cours (id_mat,id_grp) VALUES (19,6);

/*GEII*/
/*Energie*/
INSERT INTO cours (id_mat,id_grp) VALUES (20,1);
INSERT INTO cours (id_mat,id_grp) VALUES (20,5);

/*Syst. d info num. */
INSERT INTO cours (id_mat,id_grp) VALUES (21,1);

/*Informatique*/
INSERT INTO cours (id_mat,id_grp) VALUES (22,1);

/*Syst. electr. */
INSERT INTO cours (id_mat,id_grp) VALUES (23,1);
INSERT INTO cours (id_mat,id_grp) VALUES (23,5);

/*Automatisme*/
INSERT INTO cours (id_mat,id_grp) VALUES (24,1);

/*Reseau*/
INSERT INTO cours (id_mat,id_grp) VALUES (25,5);

/*Automatique*/
INSERT INTO cours (id_mat,id_grp) VALUES (26,5);

/*Outils logiciels*/
INSERT INTO cours (id_mat,id_grp) VALUES (27,1);
INSERT INTO cours (id_mat,id_grp) VALUES (27,5);

/*Etude/real ensemblembles pluritech.*/
INSERT INTO cours (id_mat,id_grp) VALUES (28,1);
INSERT INTO cours (id_mat,id_grp) VALUES (28,5);

/*Competences projet*/
INSERT INTO cours (id_mat,id_grp) VALUES (29,1);
INSERT INTO cours (id_mat,id_grp) VALUES (29,5);

/*MMI*/
/*Theories infro com.*/
INSERT INTO cours (id_mat,id_grp) VALUES (30,3);
INSERT INTO cours (id_mat,id_grp) VALUES (30,7);

/*Ecritures medias numeriques*/
INSERT INTO cours (id_mat,id_grp) VALUES (31,3);
INSERT INTO cours (id_mat,id_grp) VALUES (31,7);

/*Esthetique et expr. artistique*/
INSERT INTO cours (id_mat,id_grp) VALUES (32,3);
INSERT INTO cours (id_mat,id_grp) VALUES (32,7);

/*Algo et prog*/
INSERT INTO cours (id_mat,id_grp) VALUES (33,3);
INSERT INTO cours (id_mat,id_grp) VALUES (33,7);

/*Culture scientifique et traitement info. */
INSERT INTO cours (id_mat,id_grp) VALUES (34,3);
INSERT INTO cours (id_mat,id_grp) VALUES (34,7);

/*Infographie*/
INSERT INTO cours (id_mat,id_grp) VALUES (35,3);
INSERT INTO cours (id_mat,id_grp) VALUES (35,7);

/*Integration WEB*/
INSERT INTO cours (id_mat,id_grp) VALUES (36,3);

/*Prod audiovisuelle*/
INSERT INTO cours (id_mat,id_grp) VALUES (37,3);
INSERT INTO cours (id_mat,id_grp) VALUES (37,7);

/*Developpement*/
INSERT INTO cours (id_mat,id_grp) VALUES (38,7);

/*Services sur reseaux*/
INSERT INTO cours (id_mat,id_grp) VALUES (39,3);
INSERT INTO cours (id_mat,id_grp) VALUES (39,7);

/*Prog objet*/
INSERT INTO cours (id_mat,id_grp) VALUES (40,7);

/*Integration Multimedia*/
INSERT INTO cours (id_mat,id_grp) VALUES (41,7);

/*LV2*/
INSERT INTO cours (id_mat,id_grp) VALUES (42,3);
INSERT INTO cours (id_mat,id_grp) VALUES (42,7);

/*BD*/
INSERT INTO cours (id_mat,id_grp) VALUES (18,3);

/*R&T*/
/*Administration et securite des reseaux*/
INSERT INTO cours (id_mat,id_grp) VALUES (43,4);
INSERT INTO cours (id_mat,id_grp) VALUES (43,8);

/*Architecture internet*/
INSERT INTO cours (id_mat,id_grp) VALUES (44,4);
INSERT INTO cours (id_mat,id_grp) VALUES (44,8);

/*Dev./exploit. des services reseaux*/
INSERT INTO cours (id_mat,id_grp) VALUES (45,4);
INSERT INTO cours (id_mat,id_grp) VALUES (45,8);

/*Telecomm fixes et mobiles*/
INSERT INTO cours (id_mat,id_grp) VALUES (46,4);
INSERT INTO cours (id_mat,id_grp) VALUES (46,8);

/*outils pour le signal*/
INSERT INTO cours (id_mat,id_grp) VALUES (47,4);

/*Electronique/Physique pr les telecom*/
INSERT INTO cours (id_mat,id_grp) VALUES (48,4);
INSERT INTO cours (id_mat,id_grp) VALUES (48,8);

/*Informatique*/
INSERT INTO cours (id_mat,id_grp) VALUES (22,4);
INSERT INTO cours (id_mat,id_grp) VALUES (22,8);


