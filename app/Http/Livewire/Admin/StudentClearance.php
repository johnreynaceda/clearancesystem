<?php

namespace App\Http\Livewire\Admin;

use App\Models\Student;
use App\Models\StudentSubmittion;
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
use Filament\Tables\Columns\BadgeColumn;

class StudentClearance extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    public $student_id;
    public $student_submittion;


    protected function getTableQuery(): Builder
    {
        return StudentSubmittion::when($this->student_id, function ($student) {
            return $student->where('student_id', $this->student_id);
        });
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('student')->label('FULLNAME')->formatStateUsing(
                function ($record) {
                    return $record->student->firstname . ' ' . $record->student->lastname;
                }
            )->sortable()->searchable(),
            TextColumn::make('clearanceRequirement.title')->label('CLEARANCE REQUIREMENT')->sortable()->searchable(),
            TextColumn::make('clearanceRequirement')->label('TEACHER')->formatStateUsing(
                function ($record) {
                    return $record->clearanceRequirement->teacher->firstname . ' ' . $record->clearanceRequirement->teacher->lastname;
                }
            )->sortable()->searchable(),
            BadgeColumn::make('status')->label('STATUS')
                ->enum([
                    1 => 'Pending',
                    2 => 'Accepted',
                ])->colors([
                        'warning' => 1,
                        'success' => 2,
                    ])->icons([
                        'heroicon-o-status-online',
                    ])
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('student_id')->label('STUDENT')->reactive()
                ->options(
                    Student::get()->mapWithKeys(function ($student) {
                        return [
                            $student->id => strtoupper($student->firstname . ' ' . $student->lastname),
                        ];
                    })
                )
        ];
    }

    public function updatedStudentId()
    {
        $this->student_submittion = StudentSubmittion::where('student_id', $this->student_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.student-clearance');
    }
}
