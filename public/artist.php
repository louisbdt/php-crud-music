<?php

declare(strict_types=1);

use Html\WebPage;

$artistId = 17;

$stmt = \Database\MyPdo::getInstance();
$stmt = $stmt->prepare(
    <<<'SQL'
    SELECT name
    FROM artist
    WHERE id = :artistId
SQL
);

$stmt->execute(['artistId' => $artistId]);
$artiste = $stmt->fetch();

$html = new WebPage();

$html->setTitle("Albums de {$html->escapeString($artiste['name'])}");

$html->appendContent("<h1> Albums de {$artiste['name']} </h1>");

$requeteAlbums = \Database\MyPdo::getInstance()->prepare(
    <<<'SQL'
    SELECT name, year
    FROM artist 
    WHERE artisteId = :id
    ORDER BY year DESC, name 
SQL
);

$requeteAlbums->execute([":id" => $artistId]);

echo $html->toHTML();


