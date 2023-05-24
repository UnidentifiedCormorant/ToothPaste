<?php

namespace App\Exceptions;

use Exception;

class BanException extends AppHttpException
{
    protected $code = '404';
    protected $message = 'Вы забанены';
}
