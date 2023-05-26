<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends AppHttpException
{
    protected $code = '500';
    protected $message = "Ничего нет";
}
