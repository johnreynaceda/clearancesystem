<?php

namespace App\Http\Livewire\Adviser\Student;

use Livewire\Component;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Models\Student;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\TeacherAdvisee;
use Filament\Forms\Components\Grid;
use App\Models\SubjectTeacherAdvisee;

class ManageStudent extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

     protected function getTableQuery(): Builder
     {
        if (auth()->user()->teacher->teacherDesignations->first()->assigned_as == 'Adviser') {
                 return TeacherAdvisee::query()->where('teacher_id', auth()->user()->teacher->id);
        }else{
            return SubjectTeacherAdvisee::query()->where('teacher_id', auth()->user()->teacher->id);
        }
     }

     protected function getTableColumns(): array
     {
     return [
     TextColumn::make('students.firstname')->label('FIRSTNAME')->sortable()->searchable(),
     TextColumn::make('students.lastname')->label('LASTNAME')->sortable()->searchable(),
    
     ];
     }

     protected function getTableHeaderActions()
     {
     return [
     Action::make('student')->label('Add Student')->button()->icon('heroicon-o-user-add')->size('sm')->color('gray')
     ->action(function ($record, $data): void {
       foreach ($data as $value) {
        foreach ($value as $item) {

            if (auth()->user()->teacher->teacherDesignations->first()->assigned_as == 'Adviser') {
                  TeacherAdvisee::create([
                  'teacher_id' => auth()->user()->teacher->id,
                  'student_id' => $item,
                  ]);
            }else{
                SubjectTeacherAdvisee::create([
                    'teacher_id' => auth()->user()->teacher->id,
                    'student_id' => $item,
                    ]);
            }
          
        }
       }
     })
     ->form([

     Grid::make(1)
     ->schema([
     Select::make('student')->multiple()->searchable()
     ->options(Student::get()->mapWithKeys(
        function($student){
            return [
                $student->id => $student->firstname. ' ' . $student->lastname,
            ];
        }
     ))
     ])
     ])

     ];

     }


    public function render()
    {
        return view('livewire.adviser.student.manage-student');
    }
}
