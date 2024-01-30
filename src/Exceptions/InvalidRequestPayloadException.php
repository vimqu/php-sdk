<?php

namespace Vimqu\Vimqu\Exceptions;

class InvalidRequestPayloadException extends \Exception
{
    public function __construct($message = "Invalid Request Payload", $code = 422, $previous = null, ?string $responseMessage = null)
    {
        parent::__construct(sprintf('%s. Message: %s', $message, $responseMessage), $code, $previous);
    }
}