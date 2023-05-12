<?php

namespace App\Orchid\Screens;

use App\Models\Complaint;
use App\Models\User;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ComplaintsListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'complaints' => Complaint::all()
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Жалобы';
    }

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
            Layout::table('complaints', [
                TD::make('user_id', 'Автор жалобы')->render(function (Complaint $complaint)
                {
                    return $complaint->user === null ? 'Аноном' : $complaint->user->name;
                }),
                TD::make('pasta_id', 'Паста')->render(function (Complaint $complaint)
                {
                    return $complaint->pasta->title;
                }),
                TD::make('content', 'Содержание'),
            ])
        ];
    }
}
