<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Album;
use PDO;

class AlbumCollection
{
    public static function findByArtistId($artistId): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT id, name, year, artistId, genreId, coverId
                FROM album 
                WHERE artistId = :artistId
                ORDER BY year DESC, name
            SQL
        );
        $stmt->execute([":artistId" => $artistId]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, Album::class);
    }
}
