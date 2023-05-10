<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'users';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', __('Name'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn(User $user) => new Persona($user->presenter())),

            TD::make('email', __('Email'))
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn(User $user) => ModalToggle::make($user->email)
                    ->modal('asyncEditUserModal')
                    ->modalTitle($user->presenter()->title())
                    ->method('saveUser')
                    ->asyncParameters([
                        'user' => $user->id,
                    ])),

            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(fn(User $user) => $user->updated_at->toDateTimeString()),

            TD::make(__('Permissions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn(User $user) => Button::make(__('Забанить'))
                    ->icon('ban')
                    ->confirm(__('Забаненный пользователь не сможет авторизоваться на сайте, и, соответственно, не сможет публиковать пасты от своего имени. Вы уверены, что хотите забанить этого пользователя?'))
                    ->method('changePermission', [
                        'id' => $user->id
                    ])),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn(User $user) => Button::make(__('Delete'))
                    ->icon('trash')
                    ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                    ->method('remove', [
                        'id' => $user->id,
                    ])
                ),


        ];
    }
}
