<?php

namespace Entity;

use Database\MyPdo;
use Entity\Collection\AlbumCollection;
use Entity\Exception\EntityNotFoundException;

use function PHPUnit\Framework\throwException;

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

    public static function findById(int $id): Artist
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT id, name
                FROM artist
                WHERE id = :Id
            SQL
        );
        $stmt->execute([":Id" => $id]);
        $a = $stmt->fetchObject(Artist::class);
        if ($a === false) {
            throw new EntityNotFoundException();
        }
        return $a;
    }

    public function getAlbums(): array
    {
        return AlbumCollection::findByArtistId($this->id);
    }



}
