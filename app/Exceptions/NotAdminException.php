<?php

namespace App\Exceptions;

use Exception;

class NotAdminException extends AppHttpException
{
    protected $code = '404';
    protected $message = 'У вас нет прав администратора';
}
