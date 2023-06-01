<?php

namespace App\Http\Livewire\Admin\Clearance;

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
use App\Models\Clearance;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Toggle;

class ClearanceList extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

     protected function getTableQuery(): Builder
     {
     return Clearance::query();
     }

      protected function getTableColumns(): array
      {
      return [
      TextColumn::make('title')->label('TITLE')->sortable()->searchable(),
      ToggleColumn::make('is_default')->label('Is
      Default')->onColor('success')->offColor('danger')->onIcon('heroicon-s-lightning-bolt')
      ->offIcon('heroicon-s-user')
      ];
      }

      protected function getTableHeaderActions()
      {
      return [
      Action::make('student')->label('New Clearance')->button()->icon('heroicon-o-plus')->size('sm')->color('gray')
      ->action(function ($record,$data): void {
      Clearance::create([
      'title' => $data['title'],
      'is_default' => $data['is_default'],
      ]);

      })
      ->form([

      Grid::make(1)
      ->schema([
      TextInput::make('title')->label('Title')->required(),
        Toggle::make('is_default')->onColor('success')->offColor('danger')->onIcon('heroicon-s-lightning-bolt')
        ->offIcon('heroicon-s-user')
      ])
      ])->modalWidth('xl')
      ];

      }

    public function render()
    {
        return view('livewire.admin.clearance.clearance-list');
    }
}
