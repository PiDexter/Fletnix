<?php

namespace app\src\session;

class FlashMessage
{
    private const ERROR = 'error';
    private const WARNING = 'warning';
    private const SUCCESS = 'success';
    private const INFO = 'info';

    public const TYPES = [
        self::ERROR,
        self::WARNING,
        self::SUCCESS,
        self::INFO
    ];

    public static function set($type, $message): void
    {
        $_SESSION['message'][$type][] = (string) $message;
    }

    public static function error($message): void
    {
        self::set(self::ERROR, (string) $message);
    }

    public static function warning($message): void
    {
        self::set(self::WARNING, (string) $message);
    }

    public static function success($message)
    {
        $_SESSION[self::SUCCESS][] = (string) $message;
    }

    public static function info($message)
    {
        $_SESSION[self::INFO][] = (string) $message;
    }

    public static function get()
    {
        $messages = [];
        foreach (self::TYPES as $flashType) {
            $messages[] = $_SESSION['message'][$flashType];
            unset($_SESSION['message'][$flashType]);
        }
        var_dump($messages);
        return implode('<br/>', $messages);
    }

    public static function display($type)
    {
        // Wanneer er geen messages in de sessie bestaan
        if (!isset($_SESSION['message'][$type])) {
            return false;
        }

        $messages = $_SESSION['message'][$type];
        unset($_SESSION['message']);

        return implode('<br/>', $messages);
    }

    public static function hasFlashMessage(): bool
    {
        return isset($_SESSION['message']);
    }

    public static function isTypeOf($type): bool
    {
        return isset($_SESSION['message'][$type]);
    }
}