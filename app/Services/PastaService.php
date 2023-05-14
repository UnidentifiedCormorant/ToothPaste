<?php

namespace App\Services;

use App\Classes\WordsWrapper;
use App\Models\Pasta;
use Illuminate\Support\Facades\Auth;

class PastaService
{
    /**
     * Добавляет пасту в базу данных
     *
     * @param mixed $data
     * @return Pasta
     */
    public function store(mixed $data, string $language) : Pasta
    {
        if (Auth::check())
        {
            $data['user_id'] = auth()->user()->id;
        }

        $ww = new WordsWrapper($data['content']);

        $data['content'] = $ww->wrap($language);
        $data['hash'] = substr(md5(time() + rand(1, 10000)), 0, 16);

        return Pasta::create($data);
    }

}
