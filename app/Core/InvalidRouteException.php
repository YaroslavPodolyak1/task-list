<?php

class InvalidRouteException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct('Route not found');
    }
}