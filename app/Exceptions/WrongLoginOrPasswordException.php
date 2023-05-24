<?php

namespace App\Exceptions;

use Exception;

class WrongLoginOrPasswordException extends AppHttpException
{
    protected $code = '404';
    protected $message = 'Неверный логин или пароль';
}
