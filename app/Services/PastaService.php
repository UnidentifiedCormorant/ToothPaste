<?php

namespace App\Services;

use App\Models\Pasta;
use Illuminate\Support\Facades\Auth;

class PastaService
{
    /**
     * @param mixed $data
     * @return Pasta
     */
    public function store(mixed $data) : Pasta
    {
        if (Auth::check())
        {
            $data['user_id'] = auth()->user()->id;
        }

        $data['hash'] = substr(md5(time() + rand(1, 10000)), 0, 16);

        return Pasta::create($data);
    }

}
