Requirements:
PHP 7.2. Composer Symfony 4

Contenu du projet

Une page utilisateurs permettra les actions basiques du CRUD. Un utilisateur est composé des informations suivantes :
Nom
Prénom
Matricule
Une page « Chantiers » permettra les mêmes actions sur cette entité composée des informations suivantes :
Nom
Adresse
Date de début Il sera également possible depuis la page d’un chantier de visualiser le nombre de personne différentes ayant été pointés sur ce chantier, ainsi que le nombre d’heures cumulés pointés sur ce chantier.
Une page « Pointages » doit permettre à l’utilisateur de lister les pointages existants, ainsi que de créer des pointages sur un chantier. Un pointage est composé des informations suivantes :
Un utilisateur
Un chantier
Une date
Une durée
Installation and configuration:

télécharger le projet dans le dossier htdocs de Xampp
Ouvrir CMD et se rendre dans le projet
Exécutez la commande php -S localhost:8000 -t public pour lancer le serveur locale
Ouvrir une autre CMD sans fermer la permiere et par la suite :
Exécutez la commande php bin/console doctrine:database:create pour créer la base de données
Exécutez la commande php bin/console make:migration
Exécutez la commande php bin/console doctrine:migrations:migrate pour migrer et créer les entités dans la base de données
Ouvrir le projet dans la navigateur on saisissant le lien http://localhost:8000
Exploitez les fonctionnalités
Utilisation de l'application

Ajouter un utilisateur
Ajouter un chantier
affecter un pointage pour un utilisateur a un chantier ben définies.
Régles de gestion 1.Vous nous pouvez pas supprimer un utilisateur ou bien un chantier s'il est précedement affecté a un chantier. 2.un utilisateur ne peut pas etre affecter a un chantier deux fois le meme jour
