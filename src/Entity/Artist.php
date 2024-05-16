<?php

namespace Entity;

use Database\MyPdo;
use Entity\Collection\AlbumCollection;

class Artist
{
    private int $id;
    private string $name;
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public static function findById($id): Artist
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT id, name
                FROM artist
                WHERE id = :Id
            SQL
        );
        $stmt->execute([":Id" => $id]);
        return $stmt->fetchObject(Artist::class);
    }

    public function getAlbums(): array
    {
        return AlbumCollection::findByArtistId($this->id);
    }



}
