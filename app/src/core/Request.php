<?php

declare(strict_types=1);

namespace app\src\core;


class Request
{

    /**
     * Returns the url path
     * @return string
     */
    public function getPath(): string
    {
        // Verkrijg het pad van de request url (als niet bestaat, ga uit dat het de index pagina is)
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        // Verwijder een eventuele slash van het eind
        $path = rtrim($path, '/');

        // Bekijk of er een '?' (parameter) in het pad staat
        $position = strpos($path, '?');

        // Geen '?' in de url, return het pad als string
        if ($position === false) {
            return $path;
        }

        // Zit er wel een '?' (parameter) in de url.
        // Return het pad als string maar enkel het gedeelte wat voor '?' staat.
        return substr($path, 0, $position);
    }

    public function getUrlFragments(string $path): array
    {
        $url = explode('/', filter_var(rtrim($path, '/')), FILTER_SANITIZE_URL);
        array_shift($url);
        return $url;
    }

    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool
    {
        return $this->method() === 'get';
    }

    public function isPost(): bool
    {
        return $this->method() === 'post';
    }

    public function getBody(): array
    {
        // Lege body array
        $body = [];

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

}