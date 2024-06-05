<?php



declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    $artist = null;
    if (isset($_GET['artistId'])) {
        if (ctype_digit($_GET['artistId'])) {
            $artist = \Entity\Artist::findById((int)$_GET['artistId']);
        } else {
            throw new ParameterException();
        }
    }
    $artisteForm = new \Html\Form\ArtistForm($artist);
    $webpage = new \Html\AppWebPage("Formulaire");
    $webpage->appendContent($artisteForm->getHtmlForm('artist-save.php'));
    echo $webpage->toHTML();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

