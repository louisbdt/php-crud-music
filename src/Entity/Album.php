<?php

namespace Entity;

class Album
{
    private int $id;
    private string $name;
    private int $year;
    private int $artistId;
    private int $genreId;
    private int $coverId;

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getYear(): int
    {
        return $this->year;
    }
    public function getArtistId(): int
    {
        return $this->artistId;
    }
    public function getGenreId(): int
    {
        return $this->genreId;
    }
    public function getCoverId(): int
    {
        return $this->coverId;
    }


}
