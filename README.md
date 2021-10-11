# Module 31104 - Programmation Web côté serveur
Lisa Le Goff Mauvoisin | Thomas Poulain - 2A


## Contenu / Arborescence 

* index.php: point d'entré
* controllers: Contient tous les controllers de page
* model: contient la partie model du site avec la bdd, les classes qui intéragissent pas elle
* view: partie vue du site, toutes les pages du site


**/** => La page racine pointe sur la page de connexion 
**user_add_form** => création d'un utilisateur
**user_connect_form** => connexion
**user_disconnect** => déconnexion
**upload_activity_form** => importer une activité, redirige sur *user_connect_form* si pas connecté
**list_activities** => liste les données de l'utilisateur et ses activités

