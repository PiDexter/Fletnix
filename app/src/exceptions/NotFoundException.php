<?php


namespace app\src\exceptions;


use Exception;

class NotFoundException extends Exception
{
    protected $message = 'This page does not exists';
    protected $code = 404;
}