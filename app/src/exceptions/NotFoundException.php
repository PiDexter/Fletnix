<?php


namespace app\src\exceptions;


use Exception;

class NotFoundException extends Exception
{
    protected $message = 'Deze pagina bestaat niet.';
    protected $code = 404;
}