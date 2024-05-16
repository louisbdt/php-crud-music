<?php

declare(strict_types=1);

use Html\WebPage;

if (isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
    $artistId = $_GET['artistId'];
} else {
    header('Location: index.php');
    exit();
}

//$stmt = \Database\MyPdo::getInstance();
//$stmt = $stmt->prepare(
//    <<<'SQL'
//    SELECT name
//    FROM artist
//    WHERE id = :artistId
//SQL
//);
//
//$stmt->execute(['artistId' => $artistId]);
// $stmt->fetch();

try {
    $artist = \Entity\Artist::findById($artistId);
} catch (\Entity\Exception\EntityNotFoundException) {
    http_response_code(404);
    exit();
}

$html = new WebPage();

$html->setTitle("Albums de {$html->escapeString($artist->getName())}");

$html->appendContent("<h1> Albums de {$artist->getName()} </h1>");

$albums = $artist->getAlbums();

foreach ($albums as $album) {
    $html->appendContent("<p>{$album->getYear()} {$html->escapeString($album->getName())}</p>");
}

echo $html->toHTML();
