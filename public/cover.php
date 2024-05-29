<?php

declare(strict_types=1);

use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    if (isset($_GET['coverId']) && ctype_digit($_GET['coverId'])) {
        $cover = \Entity\Cover::findById((int)$_GET['coverId']);
    } else {
        throw new ParameterException();
    }
    header('Content-Type: image/jpeg');
    echo $cover->getJpeg();
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
