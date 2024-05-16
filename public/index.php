<?php

declare(strict_types=1);

//Exemple de configuration et d'utilisation

use Database\MyPdo;
use Html\WebPage;

$webPage = new \Html\AppWebPage();

$webPage->appendContent("<h1>Liste des artistes</h1>");

$ligne = \Entity\Collection\ArtistCollection::findAll();

foreach ($ligne as $artist) {
    $webPage->appendContent("<p> <a href='/artist.php?artistId={$artist->getId()}'> {$webPage->escapeString($artist->getName())}</a> </p> \n");
}

echo $webPage->toHTML();
