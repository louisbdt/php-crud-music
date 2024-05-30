<?php

namespace Form;

use Entity\Artist;

class ArtistForm
{
    private Artist $artist;

    /**
     * @param Artist $artist
     */
    public function __construct(Artist $artist)
    {
        $this->artist = $artist;
    }
    public function getArtist(): Artist
    {
        return $this->artist;
    }

    public function getHtmlForm(string $action): string
    {

    }
}
