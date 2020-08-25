<?php


namespace Source\Exceptions;


/**
 * Class HttpException
 * @package Source\Exceptions
 */
class HttpException extends \Exception
{
    /**
     * HttpException constructor.
     * @param $message
     * @param $code
     * @param Exception|null $previous
     */
    public function __construct($message, $code, Exception $previous = null)
    {
        http_response_code($code);
        parent::__construct($message, $code, $previous);
    }
}