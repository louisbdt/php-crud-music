<?php

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Cover
{
    private int $id;
    private string $jpeg;

    public function getId(): int
    {
        return $this->id;
    }
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): Cover
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
                SELECT id, jpeg
                FROM cover
                WHERE id = :Id
            SQL
        );
        $stmt->execute([":Id" => $id]);
        $cover = $stmt->fetchObject(Cover::class);
        if ($cover === false) {
            throw new EntityNotFoundException();
        }
        return $cover;
    }

}
