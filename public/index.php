<?php

declare(strict_types=1);

//Exemple de configuration et d'utilisation

use Database\MyPdo;
use Html\WebPage;

$webPage = new WebPage();

$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, name
    FROM artist
    ORDER BY name
SQL
);

$stmt->execute();

while (($ligne = $stmt->fetch()) !== false) {
    $webPage->appendContent("<p>{$webPage->escapeString($ligne['name'])}\n");
}

echo $webPage->toHTML();
