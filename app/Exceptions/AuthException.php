<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthException extends AppHttpException
{
    protected $code = '404';
    protected $message = "Вы не авторизованы";
}
