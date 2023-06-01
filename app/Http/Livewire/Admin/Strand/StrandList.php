<?php

namespace App\Http\Livewire\Admin\Strand;

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
use App\Models\Strand;
use Filament\Forms\Components\Grid;

class StrandList extends Component implements Tables\Contracts\HasTable
{
     use Tables\Concerns\InteractsWithTable;

     protected function getTableQuery(): Builder
     {
     return Strand::query();
     }
     

     protected function getTableColumns(): array
     {
     return [
     TextColumn::make('name')->label('STRAND')->sortable()->searchable(),
     ];
     }

      protected function getTableHeaderActions()
      {
      return [
      Action::make('student')->label('New Strand')->button()->icon('heroicon-o-plus')->size('sm')->color('gray')
      ->action(function ($record,$data): void {
      Strand::create([
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
       )->icon('heroicon-o-pencil')->button()->color('success')->modalHeading('Edit Strand')->modalWidth('xl'),
       ];


       }

    public function render()
    {
        return view('livewire.admin.strand.strand-list');
    }
}
