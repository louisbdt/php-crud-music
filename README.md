# Développement d'une application Web de consultation et modification de morceaux de musique

## Baudat Louis

## Installation / Configuration 

## Serveur Web Local 

Pour lancer le serveur Web Local il faut utiliser la commande : 
    ``php -d display_errors -S localhost:8000 -t public/`` dans un terminal 

On peut aussi lancer le serveur avec la commande :
    ``composer start:linux`` dans un terminal

## Styles de codages 

Première vérification manuelle avec la commande : ``php vendor/bin/php-cs-fixer fix --dry-run``  
L'option ``--dry-run`` (test à blanc) demande une exécution normale, mais aucun fichier n'est modifié. 

Nouvelle vérification avec la commande : ``php vendor/bin/php-cs-fixer fix --dry-run --diff``  
L'option ``--diff`` affiche les différences entre l'original et ce qui est ou serait corrigé.  

Dernière vérification manuelle qui fixe les fichiers avec la commande : ``php vendor/bin/php-cs-fixer fix``