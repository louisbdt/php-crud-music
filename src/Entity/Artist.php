<?php

namespace Entity;

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

}
