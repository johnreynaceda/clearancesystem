<?php

namespace App\Http\Livewire\Adviser;

use Livewire\Component;
use Filament\Tables;
// use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
// use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\ClearanceRequirement;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use App\Models\Clearance;

class AdviserClearance extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

     protected function getTableQuery(): Builder
     {
     return ClearanceRequirement::query()->where('teacher_id', auth()->user()->teacher->id);
     }

     protected function getTableContentGrid(): ?array
     {
     return [
     'md' => 2,
     'xl' => 4,
     ];
     }

      protected function getTableColumns(): array
      {
      return [
            Split::make([
            TextColumn::make('title')->weight('bold')->color('success'),
            ]),
            View::make('filament-custom.clearance')
            // ->collapsible(),

      ];
      }

      protected function getTableHeaderActions()
      {
      return [
      Action::make('student')->label('New Clearance Requirement')->button()->icon('heroicon-o-plus')->size('sm')->color('gray')
      ->action(function ($record,$data): void {
       $clearance_id = Clearance::where('is_default', true)->first()->id;
        ClearanceRequirement::create([
            'clearance_id' => $clearance_id,
            'title' => $data['title'],
            'teacher_id' => auth()->user()->teacher->id,
            'requirements' => $data['requirements'],
        ]);

      })
      ->form([

      Grid::make(1)
      ->schema([
        TextInput::make('title'),
       Textarea::make('requirements')

      ])
      ])
      ];

      }

    public function render()
    {
        return view('livewire.adviser.adviser-clearance');
    }
}
