<?php

declare(strict_types=1);

namespace app\src\core;


class Request
{

    /**
     * Return url path without query parameters
     * @return string
     */
    public function getPath(): string
    {
        // If $_SERVER['REQUEST_URI'] is empty, set path to home '/'
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        // Remove slashes at the end of the url
        $path = rtrim($path, '/');

        // Check if there is a '?' for query parameters
        $position = strpos($path, '?');

        // No query params? return path as string
        if ($position === false) {
            return $path;
        }

        // If there are query parameters
        // Return only the part before '?' as url path
        return substr($path, 0, $position);
    }

    /**
     * @param string $path
     * @return array
     */
    public function getUrlFragments(string $path): array
    {
        $url = explode('/', filter_var(rtrim($path, '/')), FILTER_SANITIZE_URL);
        array_shift($url);
        return $url;
    }


    /**
     * Return request methods to lowercase
     * To be able to strictly compare with method type in routes array
     * @return string
     */
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


    /**
     * Filters applied to escape "<>& and characters with ASCII value below 32
     * @return array
     */
    public function getBody(): array
    {

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