<?php

namespace App\Http\Livewire\Adviser;

use Livewire\Component;
use Filament\Tables;
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
use App\Models\TeacherAdvisee;
use App\Models\ClearanceRequirement;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\View;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use App\Models\StudentSubmittion;
use App\Models\UploadedRequirement;
use DB;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class ManageClearance extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use LivewireAlert;
    public $submittion_modal = false;
    public $decline_modal = false;
    public $student_data = [];
    public $reason;
    public $submittion_id;

    

    public function mount(){
        $this->submittion_id = request('id');
    }


    protected function getTableQuery(): Builder
    {
    return StudentSubmittion::query()->where('clearance_requirement_id', $this->submittion_id)->where('status', 1);
    
    }

    protected function getTableContentGrid(): ?array
    {
        return [
        'md' => 2,
        'xl' => 5,
        ];
    }

    protected function getTableColumns(): array
    {
    return [
   
    View::make('filament-custom.manage-clearance')

    ];
    }

    public function openSubmittion($id){
        $this->student_data = StudentSubmittion::where('id', $id)->first();
        $this->submittion_modal = true;
    }

    public function downloadFile($id){
        $file = UploadedRequirement::where('id', $id)->first();
         return Storage::download($file->path);

    }

    public function render()
    {
        return view('livewire.adviser.manage-clearance');
    }

    public function acceptSubmittion($id){
        $data = StudentSubmittion::where('id', $id)->first();
        $data->update([
            'status' => 2,
        ]);
          $this->alert('success', 'Accept requirements successfully', [
          'position' => 'center',
          'timer' => 3000,
          'toast' => false,
          'timerProgressBar' => true,
          ]);

          $this->submittion_modal = false;
    }

    public function declineSubmittion($id){
        $this->decline_modal = true;
    }

    public function proceedDecline(){
        $this->validate([
            'reason' => 'required',
        ]);
        $data = $this->student_data;
        $data->update([
            'status' => 3,
            'remark' => $this->reason,
        ]);

        $uploaded = $this->student_data->uploadedRequirements;
        foreach ($uploaded as $key => $item) {
            $item->update([
                'status' => 2
            ]);
        }

          $this->alert('success', 'Decline requirements successfully.', [
          'position' => 'center',
          'timer' => 3000,
          'toast' => false,
          'timerProgressBar' => true,
          ]);
          $this->decline_modal = false;
          $this->submittion_modal = false;
    }
}
