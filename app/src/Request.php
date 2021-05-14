<?php

declare(strict_types=1);

namespace app\src;


class Request
{
    /**
     * Returns the url path
     * @return false|mixed|string
     */
    public function getPath(): string
    {
        // Verkrijg het pad van de request url (als niet bestaat, ga uit dat het de index pagina is)
        $path = $_SERVER['REQUEST_URI'] ?? '/';
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

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

}