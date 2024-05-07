<?php

declare(strict_types=1);

use Html\WebPage;

if (isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
    $artistId = $_GET['artistId'];
} else {
    header('Location: index.php');
    exit();
}

$stmt = \Database\MyPdo::getInstance();
$stmt = $stmt->prepare(
    <<<'SQL'
    SELECT name
    FROM artist
    WHERE id = :artistId
SQL
);

$stmt->execute(['artistId' => $artistId]);
$artist = $stmt->fetch();

if($artist === false) {
    http_response_code(404);
    exit();

}

$html = new WebPage();

$html->setTitle("Albums de {$html->escapeString($artist['name'])}");

$html->appendContent("<h1> Albums de {$artist['name']} </h1>");

$requeteAlbums = \Database\MyPdo::getInstance()->prepare(
    <<<'SQL'
    SELECT year, name
    FROM album
    WHERE artistId = :id
    ORDER BY year DESC, name 
SQL
);

$requeteAlbums->execute([":id" => $artistId]);

while (($ligne = $requeteAlbums->fetch()) !== false) {
    $html->appendContent("<p>{$ligne['year']} {$html->escapeString($ligne['name'])}</p>");
}

echo $html->toHTML();
