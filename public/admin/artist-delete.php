<?php

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if (isset($_GET['artistId']) && ctype_digit($_GET['artistId'])) {
        $artist = \Entity\Artist::findById((int)$_GET['artistId']);
        $artist->delete();
        header('Location: /index.php');
    } else {
        throw new ParameterException();
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
