<?php

declare(strict_types=1);

namespace Html;

class WebPage
{
    use StringEscaper;
    private string $head;
    private string $title;
    private string $body;


    public function __construct(string $title = "")
    {

        $this->title = $title;
        $this->head = "";
        $this->body = "";
    }

    public function getHead(): string
    {
        return $this->head;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    public function appendCss(string $css): void
    {
        $this->head .= <<<HTML
            <style>{$css}</style>
        HTML;
    }

    public function appendCssUrl(string $url): void
    {
        $this->head .= <<<HTML
            <link rel="stylesheet" href="$url">
        HTML;
    }

    public function appendJs(string $js): void
    {
        $this->head .= <<<HTML
            <script>$js</script>
        HTML;

    }

    public function appendJsUrl(string $url): void
    {
        $this->head .= <<<HTML
            <script src="$url"></script>
        HTML;
    }

    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    public function toHTML(): string
    {
        return <<<HTML
            <!doctype html>
                <html lang="fr">
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                        <meta http-equiv="X-UA-Compatible" content="ie=edge">
                        <title>{$this->title}</title>
                        {$this->head}
                    </head>
                    <body>
                        {$this->body}
                    </body>
                    {$this->getLastModification()} 
            </html>
        HTML;
    }

    public function getLastModification(): string
    {
        return "Dernière modification de cette page le " . date("d/m/Y H:i:s.", getlastmod());
    }
}
