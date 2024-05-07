<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Artist;
use PDO;

class ArtistCollection
{
    /** Méthode qui renvoie un tableau contenant tous les artistes.
    * @return Artist[]
     */
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT id, name
                FROM artist
                ORDER BY name;
            SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Artist::class);
    }
}
