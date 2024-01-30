<?php

namespace Vimqu\Vimqu\Exceptions;

class InvalidTokenException extends \Exception
{
    protected $message = "Your token is invalid. Please create a new one.";
}