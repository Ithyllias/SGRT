<?php
/**
 * Created by PhpStorm.
 * User: 0838330
 * Date: 2016-05-26
 * Time: 12:05
 */

namespace App\Exceptions;


class NotAllowedException extends \Exception
{
    /**
     * @var int
     */
    protected $statusCode = 403;

    /**
     * @param string  $message
     * @param int $statusCode
     */
    public function __construct($message = 'An error occurred', $statusCode = null)
    {
        parent::__construct($message);

        if (! is_null($statusCode)) {
            $this->setStatusCode($statusCode);
        }
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return int the status code
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}