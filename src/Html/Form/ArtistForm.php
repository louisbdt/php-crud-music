<?php

namespace Html\Form;

use Entity\Artist;
use Entity\Exception\ParameterException;
use Html\AppWebPage;
use Html\StringEscaper;

class ArtistForm
{
    use StringEscaper;
    private ?Artist $artist;

    /**
     * @param Artist $artist
     */
    public function __construct(Artist $artist = null)
    {
        $this->artist = $artist;
    }
    public function getArtist(): Artist
    {
        return $this->artist;
    }

    public function getHtmlForm(string $action): string
    {
        //        echo <<<HTML
        //        +++++++++++++++++++++++++++++++++++++++++++
        //        <input name="name" type="text" value="{$this->escapeString($this->artist?->getName())})" required>
        //        +++++++++++++++++++++++++++++++++++++++++++
        //
        //        HTML;
        return <<<HTML
                <form name="artistes" method="post" action="{$action}">
                    <input type="hidden" name="id" value="{$this->artist?->getId()}">
                    <div>
                    <label for="name"> <label>
                        <input name="name" type="text" value="{$this->escapeString($this->artist?->getName())}" required>
                    </div>
                    <button type="submit">Enregistrer</button>
                </form>
            HTML;
    }

    public function setEntityFromQueryString(): void
    {
        $id = null;
        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = (int) $_POST['id'];
        }
        if (!empty($_POST['name'])) {
            $name = $this->escapeString($this->stripTagsAndTrim($_POST['name']));
        } else {
            throw new ParameterException("Nom d'artiste manquant");
        }
        $this->artist = Artist::create($name, $id);

    }
}
