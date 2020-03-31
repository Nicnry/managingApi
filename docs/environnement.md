# Environnement de développement
Lors de ce projet, nous avons besoin de l'environnement suivant afin de pouvoir mener à bien notre projet :

- Visual Studio Code v1.42.1 (x64)
- PHP ^7.0
- Composer v1.9.1 2019-11-01 17:20:17
- Git v2.21.1 (Apple Git-122.3) / Git v2.24.0.windows.1
- Credentials Google Cloud (lié à votre compte)
- macOS Catalina v10.15.3 ou Windows 10

`Optionnel :`

Dans le cadre du développement, nous utilisons 2 extensions vscode pour améliorer l'environnement de dev. Vous pouvez les installer en executant les commandes suivantes (macOS) :
`code --install-extension felixfbecker.php-intellisense`
`code --install-extension bmewburn.vscode-intelephense-client`

## Librairies installées
- google/cloud-storage ^1.18
- vlucas/phpdotenv ^4.1
- google/cloud-vision ^0.25.0

Vous n'avez pas besoin d'installer ces librairies pour utiliser ce projet. Pour utiliser ce projet vous pouvez toujours suivre ce [lien](../README.md) pour commencer. Si vous n'avez pas réussi à charger une librairie, vous pouver toujours essayer de la réinstaller avec l'example suivant : `composer require google/cloud-storage`

## plugins
Afin d'effectuer nos tests, nous utilisons PHPUnit Test Explorer.
Vous pourrez l'installer en effectuant la commande suivante : `code --install-extension recca0120.vscode-phpunit` (environnement unix, sinon vous pouvez acceder directement via le marketplace en cherchant PHPUnit Test Explorer).
Cet outil ajoute un onglet à la barre de menu à gauche avec une "fiole".
Pour effectuer le test, il est important d'etre à la racine du projet (managingApi) et ensuite, vous pourrez lancer les tests.
Il n'est pas possible de lancer tout les tests d'un coup, il vous faut faire cela par "groupe" de tests (ce qui correspond à chaque fichier de test.)