<?php

namespace App\Orchid\Screens;

use App\Models\Pasta;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class PastasListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'pastas' => Pasta::withTrashed()->paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Пасты';
    }

    public $description = 'Список паст';

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('pastas', [
                TD::make('title', 'Название'),
                TD::make('content', 'Содержимое')->width(300)->defaultHidden(),
                TD::make('user_id', 'Автор')->render(function (Pasta $pasta){
                    return $pasta->user === null ? 'Аноном' :  $pasta->user->name;
                }),
                TD::make('access_type_id', 'Тип доступа')->render(function (Pasta $pasta){
                    return $pasta->accessType->title;
                }),
                TD::make('deleted_at', 'Срок годности')->render(function (Pasta $pasta){
                     return $pasta->deleted_at === null ? 'Существует' : 'Истёк';
                })
            ])
        ];
    }
}
