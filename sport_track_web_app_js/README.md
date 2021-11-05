# Module 31104 - Programmation Web côté serveur

## Contenu / Arborescence 

* sport-track-db : module de connexion à la BDD et les classes DAO
* web_app : l'application web comportant les controllers dans `routes` et les vues dans `view`, `app.js` est le point d'entrée du site.

**/** => La page racine pointe sur la page de connexion si l'utilisateur est connecté, sur activities sinon

**/users** => création d'un utilisateur

**/connect** => connexion

**/disconnect** => déconnexion

**/upload** => importer une activité, redirige sur *user_connect_form* si pas connecté

**/activities** => liste les données de l'utilisateur et ses activités


`npm install` pour télécharger les modules requis au fonctionnement de l'application.