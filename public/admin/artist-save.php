<?php

use Entity\Exception\ParameterException;

try {
    $form = new \Html\Form\ArtistForm();
    $form->setEntityFromQueryString();
    $form->getArtist()->save();
    header('Location: /index.php');
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}