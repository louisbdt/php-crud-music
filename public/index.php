<?php

declare(strict_types=1);

//Exemple de configuration et d'utilisation

use Database\MyPdo;
use Html\WebPage;

$webPage = new WebPage();

$webPage->appendContent("<h1>Liste des artistes</h1>");

$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, name
    FROM artist
    ORDER BY name
SQL
);

$stmt->execute();

while (($ligne = $stmt->fetch()) !== false) {
    $webPage->appendContent("<p> <a href='/artist.php?artistId={$ligne['id']}'> {$webPage->escapeString($ligne['name'])}</a> </p> \n");
}

echo $webPage->toHTML();
