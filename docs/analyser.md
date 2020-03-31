# Analyse
Ce document regroupe les analyses, les solutions ainsi que les problèmes rencontrés durant le projet.

## phpdox
Dans le cadre du module nous avons du utiliser une génération de documentation automatique. Pour cela nous nous sommes tournés vers phpdox. Il est vrai que doxygen est l'outil reconnu pour la génération de documentation cependant, nous souhaitions utiliser une autre librairie afin de découvrir d'autres outils et fournir quelque chose de plus ciblé pour PHP.

### Installation
Pour l'installation de cette dépendance, nous avons utilisé composer pour le lier directement à notre projet. Ensuite, il a été necessaire de créer un fichier `phpdox.xml` pour indiquer ce qu'il doit être générer. Nous avons eu quelques soucis car par défaut, vu que nous souhaitons générer la documentation pour tout le projet, il a fallu exclure le dossier vendor. Pour cela, nous avons ajouté la ligne suivante : 
```xml 
<exclude mask="**vendor**" />
```

Ainsi, phpdox ne prend pas en compte le dossier vendor et crée la documentation pour le reste du projet.

Il aura aussi fallu lui demander de fournir un exemple en `html`. 
```xml 
<build engine="html" output="html"/>
```

Vous pouvez trouver le fichier de configuration [ici](../phpdox.xml).

## PHPUnit
Des tests sont requis pour répondre aux exigences du client, pour cela nous avons opté pour un outil très connu pour le PHP. 

### Installation
Lors de l'installation, nous avons voulu suivre la documentation de PHPUnit cependant, une erreur est survenue. La version de php-timer requise pour l'installation de PHPUnit est la version 3 ou supérieur. Malheureusement, phpdox utilise la version 2.0 ou supérieur. Après avoir fait des recherches dessus, il n'y avait pas de possibilité de faire travailler ces deux programmes avec la même version de php-timer. Nous avons donc opté pour la version 8 de PHPUnit qui annonce un support jusqu'au 5 fevrier 2021, ce qui est largement suffisant pour ce projet. Vous pouvez consulter la documentation sur ce [lien](https://phpunit.de/getting-started/phpunit-8.html).

Une fois installé, la documentation de PHPUnit explique qu'il faut créer une classe avec un suffixe `Test`. Ainsi lors de l'appel à PHPUnit, le fichier est lancé par `PHPUnit\Framework\TestCase` qui nous fournis un resultat. Nous avons donc fair un exemple présenté en cours afin d'avoir un retour standard.
