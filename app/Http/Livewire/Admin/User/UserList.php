<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\Component;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Role;
use Filament\Forms\Components\Grid;
class UserList extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return User::query()->where('role_id','!=', 1);
    }

     protected function getTableColumns(): array
     {
         return [
            TextColumn::make('name')->label('NAME')->sortable()->searchable(),
            TextColumn::make('email')->label('EMAIL')->sortable()->searchable(),
            TextColumn::make('role.name')->label('ROLE')->sortable()->searchable(),
         ];
     }

    protected function getTableHeaderActions()
    {
    return [
    Action::make('student')->label('New User')->button()->icon('heroicon-o-user-add')->size('sm')->color('gray')
    ->action(function ($record, $data): void {
        $record->create([
            $data
        ]);
    })
    ->form([

        Grid::make(2)
        ->schema([
                TextInput::make('name')->label('Name')->required(),
                TextInput::make('email')->label('Email')->required(),
                TextInput::make('password')->label('Password')->password()->required(),
                Select::make('role_id')->label('Role')
                ->options(Role::pluck('name', 'id'))
        ])
         ])

    ];

    }

     protected function getTableActions(): array
     {
        return [
          
             Action::make('edit')->size('sm')
             ->label('Edit')->action(function ($record, $data) {
             $record->update($data);
             })->form(
             function ($record) {
             return [
           Grid::make(2)
           ->schema([
           TextInput::make('name')->label('Name')->required()->default($record->name),
           TextInput::make('email')->label('Email')->required()->default($record->email),
           TextInput::make('password')->label('Password')->password()->required(),
           Select::make('role_id')->default($record->role_id)
           ->options(Role::pluck('name', 'id'))
           ])
             ];
             },
             )->icon('heroicon-o-pencil')->button()->color('success')->modalHeading('Edit User')->modalWidth('xl'),
        ];

        
     }

    public function render()
    {
        return view('livewire.admin.user.user-list');
    }
}
