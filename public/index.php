<?php

declare(strict_types=1);

//Exemple de configuration et d'utilisation

use Database\MyPdo;
use Html\WebPage;

$webPage = new \Html\AppWebPage("Artistes");

$webPage->appendMenuButtton("Ajouter", "");

$webPage->appendContent("<div class='list'>");
$ligne = \Entity\Collection\ArtistCollection::findAll();

foreach ($ligne as $artist) {
    $webPage->appendContent("<p class='Album'> <a href='/artist.php?artistId={$artist->getId()}'>{$webPage->escapeString($artist->getName())}</a> </p> \n");
}

$webPage->appendContent("</div>");
echo $webPage->toHTML();
