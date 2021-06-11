<?php


namespace app\src\exceptions;


use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'Only logged in users can see this page.';
    protected $code = 403;
}