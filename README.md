# ManagingApi

Ce projet à lieu dans le cadre du CPNV pour le module RIA2.

Les pré-requis pour utiliser ce projets se trouvent à cet [endroit](./docs/environnement.md).

Afin de faire fonctionner ce projet, merci de suivre la marche à suivre suivante :

- Clonez le repository
- Executer `cd managingApi/`
- Executer `composer install`
  - L'erreur suivante risque de se produire : `theseer/fxsl 1.1.1 requires ext-xsl * -> the requested PHP extension xsl is missing from your system.`
  - Ouvrez le fichier php.ini et retirer le `;` qui précède `extension=xsl`
  - Relancer la commande `composer install`
- Renommer `.env.example` `mv .env.example .env` (fonctionne sur un environnement linux)
- Ajouter les informations dans le fichier `.env`
- Lancez votre application avec la commande suivante : `php -S 127.0.0.1:9999`
- Vous pouvez accéder à votre application à l'adresse `127.0.0.1:9999`

Développeurs :
- Alexandre Junod
- Nicolas Henry
