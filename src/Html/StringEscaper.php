<?php

namespace Html;

trait StringEscaper
{
    public function escapeString(?string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
    }

    public function stripTagsAndTrim(?string $text): string
    {
        if ($text == null) {
            $res = '';
        } else {
            $res = trim(strip_tags($text));
        }
        return $res;
    }

}
