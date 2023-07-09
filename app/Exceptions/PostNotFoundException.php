<?php
namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class PostNotFoundException extends HttpException
{
    public function __construct($message = "Příspěvek nebyl nalezen.")
    {
        parent::__construct(404, $message);
    }
}
