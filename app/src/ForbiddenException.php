<?php


namespace app\src;


use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'Je dient ingelogd te zijn om deze pagina te bekijken.';
    protected $code = 403;
}