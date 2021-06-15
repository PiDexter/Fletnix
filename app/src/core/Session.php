<?php


namespace app\src\core;


class Session
{
    public function __construct()
    {
        session_start();
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key): mixed
    {
        return $_SESSION[$key] ?? false;
    }

    public function remove()
    {
        session_unset();
        session_destroy();
    }

}