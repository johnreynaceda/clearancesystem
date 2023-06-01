<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Filament\Tables;
// use Illuminate\Contracts\View\View;
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
use App\Models\SubjectTeacherAdvisee;
use DB;

class StudentClearance extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    public $assigned_clearances = [];
    public $clearance_modal = false;
    public $clearance_data = [];

    public $is_decline = false;
    public $reason;
    public $attachment = [];

    protected function getTableQuery(): Builder
    {
    return ClearanceRequirement::query()->whereIn('teacher_id',$this->assigned_clearances);
    
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
     View::make('filament-custom.student-clearance')

     ];
     }

     public function openRequirement($requirement_id){
        $this->clearance_data = ClearanceRequirement::where('id', $requirement_id)->first();
        $this->clearance_modal = true;
        if ($this->clearance_data->studentSubmittions->count() < 1) {
          $this->is_decline = false;

        }elseif ($this->clearance_data->studentSubmittions->where('student_id',
        auth()->user()->student->id)->first()->remark != null) {
           $this->is_decline = true;
           $this->reason = $this->clearance_data->studentSubmittions->where('student_id',
           auth()->user()->student->id)->first()->remark;
        }else{
          $this->is_decline = false;
        }
        
        // dd($this->clearance_data->studentSubmittions->count());
        // if ($this->clearance_data->studentSubmittions->where('student_id', auth()->user()->student->id)->first()->remark !=
        // null) {
        //   $this->is_decline = true;
        //   $this->reason = $this->clearance_data->studentSubmittions->where('student_id',
        //   auth()->user()->student->id)->first()->remark;
        //   # code...
        // }else{
        //   $this->is_decline = false;
        // }
     }

     public function submitClearance(){
     
       $this->validate([
         'attachment' => 'required',
       ]);
       DB::beginTransaction();
       if (StudentSubmittion::where('student_id', auth()->user()->student->id)->where('clearance_requirement_id',
       $this->clearance_data->id)->count() < 1) {
         $submit = StudentSubmittion::create([
         'clearance_requirement_id' => $this->clearance_data->id,
         'student_id' => auth()->user()->student->id,
         ]);

         foreach ($this->attachment as $key => $value) {
         UploadedRequirement::create([
         'student_submittion_id' => $submit->id,
         'file_name' => $value->getClientOriginalName(),
         'path' => $value->storeAs('Uploaded_Requirements', $value->getClientOriginalName())
         ]);
         }
       }else{
        $data = StudentSubmittion::where('student_id', auth()->user()->student->id)->where('clearance_requirement_id',$this->clearance_data->id)->first();
        $data->update([
          'remark' => null,
          'status' => 1
        ]);
       }
     
       DB::commit();
       $this->clearance_modal = false;
       
     }

     protected function getFormSchema(): array
     {
     return [
        FileUpload::make('attachment')->label('Attach your file
        here:')->required()->multiple()->storeFileNamesIn('attachment_file_names'),
     ];
     }


    public function render()
    {
        $teacherIds = [
          TeacherAdvisee::where('student_id',auth()->user()->student->id)->pluck('teacher_id')->first(),
          SubjectTeacherAdvisee::where('student_id',auth()->user()->student->id)->pluck('teacher_id')->first()
        ];
      
        $this->assigned_clearances = $teacherIds;
        return view('livewire.student.student-clearance');
    }
}
