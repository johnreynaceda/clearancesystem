<?php

namespace App\Http\Livewire\Admin\GradeLevel;

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
use App\Models\GradeLevel;
use Filament\Forms\Components\Grid;

class GradeLevelList extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return GradeLevel::query();
    }

     protected function getTableColumns(): array
     {
        return [
            TextColumn::make('name')->label('GRADE LEVEL')->sortable()->searchable(),
        ];
     }

     protected function getTableHeaderActions()
     {
        return [
            Action::make('student')->label('New Grade Level')->button()->icon('heroicon-o-plus')->size('sm')->color('gray')
            ->action(function ($record,$data): void {
                GradeLevel::create([
                    'name' => $data['name'],
                ]);

            })
            ->form([

            Grid::make(1)
            ->schema([
            TextInput::make('name')->label('Name')->required(),

            ])
            ])->modalWidth('xl')

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
            Grid::make(1)
            ->schema([
            TextInput::make('name')->label('Name')->required()->default($record->name),
            
            ])
            ];
            },
            )->icon('heroicon-o-pencil')->button()->color('success')->modalHeading('Edit Grade level')->modalWidth('xl'),
        ];


      }


    public function render()
    {
        return view('livewire.admin.grade-level.grade-level-list');
    }
}
