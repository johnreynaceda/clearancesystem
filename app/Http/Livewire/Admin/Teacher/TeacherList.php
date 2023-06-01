<?php

namespace App\Http\Livewire\Admin\Teacher;

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
use App\Models\Student;
use App\Models\GradeLevel;
use App\Models\Strand;
use App\Models\Subject;
use App\Models\Teacher;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\DatePicker;
use DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\TeacherDesignation;
use Filament\Tables\Columns\BadgeColumn;


class TeacherList extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
     use LivewireAlert;

    protected function getTableQuery(): Builder
    {
    return Teacher::query();
    }
    protected function getTableColumns(): array
    {
    return [
    TextColumn::make('firstname')->label('FIRSTNAME')->sortable()->searchable(),
    TextColumn::make('middlename')->label('MIDDLENAME')->sortable()->searchable(),
    TextColumn::make('lastname')->label('LASTNAME')->sortable()->searchable(),
    TextColumn::make('birthdate')->date()->label('BIRTHDATE')->sortable()->searchable(),
    // TextColumn::make('address')->label('ADDRESS')->sortable()->searchable(),
    TextColumn::make('contact_number')->label('PHONE NUMBER')->sortable()->searchable(),
     BadgeColumn::make('teacherDesignations.assigned_as')
     ->enum([
     'Adviser' => 'ADVISER',
     'Subject Teacher' => 'SUBJECT TEACHER',
     ])->colors([
        'success' => 'Adviser',
        'primary' => 'Subject Teacher'
     ])

    ];
    }

    protected function getTableHeaderActions()
    {
    return [
    Action::make('student')->label('New Teacher')->button()->icon('heroicon-o-plus')->size('sm')->color('gray')
    ->action(function ($record,$data): void {
   
        DB::beginTransaction();
        Teacher::create([
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'birthdate' => $data['birthdate'],
            'address' => $data['address'],
            'contact_number' => $data['contact_number'],
        ]);
        DB::commit();



    })
    ->form([
    Fieldset::make('Student Information')
    ->schema([
    TextInput::make('firstname')->label('First Name')->required(),
    TextInput::make('middlename')->label('Middle Name')->required(),
    TextInput::make('lastname')->label('Last Name')->required(),
    DatePicker::make('birthdate')->label('Date of Birth')->required(),
    TextInput::make('address')->label('Address')->required(),
    TextInput::make('contact_number')->label('Contact Number')->required(),
    ])
    ->columns(3),
    ])->modalWidth('3xl'),

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
     Fieldset::make('Student Information')
     ->schema([
     TextInput::make('firstname')->label('First Name')->required()->default($record->firstname),
     TextInput::make('middlename')->label('Middle Name')->required()->default($record->middlename),
     TextInput::make('lastname')->label('Last Name')->required()->default($record->lastname),
     DatePicker::make('birthdate')->label('Date of Birth')->required()->default($record->birthdate),
     TextInput::make('address')->label('Address')->required()->default($record->address),
     TextInput::make('contact_number')->label('Contact Number')->required()->default($record->contact_number),
     ])
     ->columns(3),
     
     ];
     },
     )->icon('heroicon-o-pencil')->button()->color('success')->modalHeading('Edit Teacher')->modalWidth('3xl'),
     Tables\Actions\ActionGroup::make([
     Action::make('assign-teacher')->label('Assign As Adviser')->color('warning')->icon('heroicon-o-user-add')->hidden(
        function($record){
            return $record->user_id != null;
        }
     )->action(
        function($record,$data){
            $name = strtolower($record->firstname.''.$record->lastname);
            $user = User::create([
                'name' => $record->firstname. ' '. $record->lastname,
                'email' => $name.'@gmail.com',
                'password' => bcrypt('password'),
                'role_id' => 2,
            ]);
            $record->update([
                'user_id' => $user->id,
            ]);
            TeacherDesignation::create([
                'teacher_id' => $record->id,
                'assigned_as' => 'Adviser',
                'strand_id' => $data['strand_id'],
            ]);

            $this->alert('success', 'Adviser Assigned Successfully', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'timerProgressBar' => true,
            ]);

        }
     )->form([
       Grid::make(1)
       ->schema([
        Select::make('strand_id')->label('Strand')
        ->options(Strand::pluck('name', 'id'))
       ])
     ]
     )->modalWidth('xl'),
     Action::make('assign-subject-teacher')->label('Assign As Subject
     Teacher')->color('success')->icon('heroicon-o-user-add')->hidden(
     function($record){
     return $record->user_id != null;
     }
     )->action(
        function($record, $data){
             $name = strtolower($record->firstname.''.$record->lastname);
             $user = User::create([
             'name' => $record->firstname. ' '. $record->lastname,
             'email' => $name.'@gmail.com',
             'password' => bcrypt('password'),
             'role_id' => 3,
             ]);
             $record->update([
             'user_id' => $user->id,
             ]);
             TeacherDesignation::create([
             'teacher_id' => $record->id,
             'assigned_as' => 'Subject Teacher',
             'subject_id' => $data['subject_id'],
             ]);

             $this->alert('success', 'Subject Teacher Assigned Successfully', [
             'position' => 'center',
             'timer' => 3000,
             'toast' => false,
             'timerProgressBar' => true,
             ]);
        }
     )->form([
            Grid::make(1)
            ->schema([
            Select::make('subject_id')->label('Subject')
            ->options(Subject::pluck('name', 'id'))
            ])
     ])->modalWidth('xl'),
     Action::make('manage-advisee')->label('Manage Advisee')->color('primary')->icon('heroicon-o-user-group'),
    ]),
    ];
     


     }


    public function render()
    {
        return view('livewire.admin.teacher.teacher-list');
    }
}
