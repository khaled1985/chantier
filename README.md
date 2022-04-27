# Requirements:
PHP 7.2.
Composer
Symfony 4 

Contenu du proet

1. Une page utilisateurs permettra les actions basiques du CRUD. Un utilisateur est composé des
informations suivantes :
- Nom
- Prénom
- Matricule

2. Une page « Chantiers » permettra les mêmes actions sur cette entité composée des informations
suivantes :
- Nom
- Adresse
- Date de début
Il sera également possible depuis la page d’un chantier de visualiser le nombre de personne différentes
ayant été pointés sur ce chantier, ainsi que le nombre d’heures cumulés pointés sur ce chantier.
3. Une page « Pointages » doit permettre à l’utilisateur de lister les pointages existants, ainsi que de créer
des pointages sur un chantier. Un pointage est composé des informations suivantes :
- Un utilisateur
- Un chantier
- Une date
- Une durée

 


Installation and configuration:

1. télécharger le projet dans le dossier htdocs de Xampp
2. Ouvrir CMD et se rendre dans le projet 
3. Exécutez la commande    php -S localhost:8000 -t public    pour lancer le serveur locale
4. Ouvrir une autre CMD sans fermer la permiere et par la suite :
5. Exécutez la commande   php bin/console doctrine:database:create  pour créer la base de données
6. Exécutez la commande     php bin/console make:migration   
7. Exécutez la commande   php bin/console doctrine:migrations:migrate   pour migrer et créer les entités dans la base de données
8. Ouvrir le projet dans la navigateur on saisissant le lien http://localhost:8000
9. Exploitez les fonctionnalités 
