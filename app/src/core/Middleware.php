<?php


namespace app\src\core;



abstract class Middleware
{
    abstract public function handle();
}