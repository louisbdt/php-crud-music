<?php

namespace Entity;

use Database\MyPdo;
use Entity\Collection\AlbumCollection;
use Entity\Exception\EntityNotFoundException;

use function PHPUnit\Framework\throwException;

class Artist
{
    private ?int $id;
    private string $name;

    private function __construct()
    {
    }

    public static function findById(?int $id): Artist
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
    public function getId(): ?int
    {
        return $this->id;
    }
    private function setId(?int $id): Artist
    {
        $this->id = $id;
        return $this;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): Artist
    {
        $this->name = $name;
        return $this;
    }

    public function delete(): Artist
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            DELETE 
            FROM artist
            WHERE id = :Id
            SQL
        );
        $stmt->execute([':Id' => $this->getId()]);
        $this->setId(null);
        return $this;
    }

    protected function update(): Artist
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            UPDATE artist
            SET name = :name
            WHERE id = :Id
            SQL
        );
        $stmt->execute([':Id' => $this->getId(), ':name' => $this->getName()]);
        return $this;
    }

    public static function create(string $name, ?int $id): Artist
    {
        $artist = new Artist();
        $artist->setName($name)->setId($id);
        return $artist;
    }

    protected function insert(): Artist
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            INSERT INTO artist
            VALUES (:Id, :name)
            SQL
        );
        $stmt->execute([':Id' => $this->getId(), ':name' => $this->getName()]);
        $this->setId((int)MyPdo::getInstance()->lastInsertId());
        return $this;
    }

    public function save(): Artist
    {
        if ($this->getId()) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }

}
