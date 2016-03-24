# ProjetTutorat
Projet de seconde année de dut informatique (2015)

Bienvenue sur le read-me du projet tutorat.
Ce document a pour but de vous guider sur le projet afin de vous faire une meilleure idée de comment fonctionne le projet.

Tout d'abord à la racine du projet vous avez plusieurs fichiers de code:

-index.php : la page d'accueil du site ,là ou on arrive en premier.
-admin.php : la page d'aministration du site, pour les admins.
-egolist.php : la page qui contient vos demandes d'aide
-profile.php : page qui résume vos données , permet d'ecrire un mail aux admins et permet de discuter sur le mini chat.
-mailAdmin.php : fichier qui traite l'envoie du mail a l'admin
-deconnexion.php : permet a l'utilisateur de se deconnecter
-list.php : page qui permet de consulter les demandes d'aide.
-minichat_pdo et minichat.js sont des fichiers qui permettent de gerer le mini chat

le reste n'est pas très important ou n'est pas utilisé.

Ensuite le Dossier Query contient des fichiers php qui sont utilisés pour traiter des requetes SQL dont on peut avoir souvent besoin,
par exemple la suppresion d'un etudiant ou la confirmation d'une demande d'aide...

Le dossier include contient les entetes html classique comme le head ou footer ou la barrière de navigation.

Pictures contient toutes les images du site.

CSS contient tout le code CSS

BD contient les paramètres de bases de données

helper contient un fichier permettant d'ecrire des mails.

Le reste ce sont des bibliothèques ou framework : nous utilisons foundation comme framework CSS et sweet alert pour du javascript(
ce sont les messages d'alerte qui pop sur votre ecran).

Voilà pour les explications sur l'organisation du code source !
