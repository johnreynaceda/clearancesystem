<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Filament\Forms;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class Report extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $report;

    protected function getFormSchema(): array 
    {
        return [
         Select::make('report')->label('Select Report')->reactive()
    ->options([
        'Students' => 'Students',
        'Advisers' => 'Advisers',
        'Subject Teacher' => 'Subject Teacher',
    ])
        ];
    } 

    public function render()
    {
        return view('livewire.admin.report');
    }
}
