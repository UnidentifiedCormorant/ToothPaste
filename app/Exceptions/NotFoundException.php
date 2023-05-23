<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends AppHttpException
{
    protected $code = '404';
    protected $message = "Ничего нет";
}
