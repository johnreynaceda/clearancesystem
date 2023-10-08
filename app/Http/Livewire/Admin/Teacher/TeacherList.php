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

    public $create_modal = false;
    public $firstname, $middlename, $lastname, $birthdate, $age, $address, $contact_number, $grade_level_id,
    $strand_id;

    public function updatedBirthdate()
    {
        $this->age = \Carbon\Carbon::parse($this->birthdate)->age;
        if ($this->age == 0) {
            $this->alert('error', 'Age must not be 0', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
            $this->birthdate == null;
            $this->age == null;
        }
    }

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
            BadgeColumn::make('teacherDesignations.assigned_as')->label('TEACHER DESIGNATION')
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
            Action::make('student')->label('New Teacher')->button()->icon('heroicon-o-plus')->size('sm')->color('gray')->action(function () {
                $this->create_modal = true;
            })
            // ->form([
            // Fieldset::make('Student Information')
            // ->schema([
            // TextInput::make('firstname')->label('First Name')->required(),
            // TextInput::make('middlename')->label('Middle Name')->required(),
            // TextInput::make('lastname')->label('Last Name')->required(),
            // DatePicker::make('birthdate')->label('Date of Birth')->required(),
            // TextInput::make('address')->label('Address')->required(),
            // TextInput::make('contact_number')->label('Contact Number')->required(),
            // ])
            // ->columns(3),
            // ])->modalWidth('3xl'),

        ];

    }

    protected function getFormSchema(): array
    {
        return [
            Fieldset::make('Student Information')
                ->schema([
                    TextInput::make('firstname')->label('First Name')->required(),
                    TextInput::make('middlename')->label('Middle Name')->required(),
                    TextInput::make('lastname')->label('Last Name')->required(),
                    DatePicker::make('birthdate')->label('Date of Birth')->required()->reactive(),
                    TextInput::make('address')->label('Address')->required(),
                    TextInput::make('contact_number')->label('Contact Number')->required(),
                ])
                ->columns(3),
        ];
    }

    public function createTeacher()
    {



        if ($this->age != 0) {
            $name = strtolower($this->firstname . '' . $this->lastname);
            // // dd($name);
            DB::beginTransaction();
            $user = User::create([
                'name' => $this->firstname . ' ' . $this->lastname,
                'email' => $name . '@gmail.com',
                'password' => bcrypt('password'),
                'role_id' => 4,
            ]);

            Teacher::create([
                'user_id' => $user->id,
                'firstname' => $this->firstname,
                'middlename' => $this->middlename,
                'lastname' => $this->lastname,
                'birthdate' => $this->birthdate,

                'address' => $this->address,
                'contact_number' => $this->contact_number,

            ]);
            DB::commit();
            $this->alert('success', 'Teacher Created', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
            $this->create_modal = false;
            $this->reset(
                'firstname',
                'middlename',
                'lastname',
                'birthdate',
                'age',
                'address',
                'contact_number',
                'grade_level_id',
                'strand_id'
            );
        } else {
            $this->alert('error', 'Age must not be 0', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
        }


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
                Action::make('assign-teacher')->label('Assign As Adviser')->color('warning')->icon('heroicon-o-user-add')->visible(
                    function ($record) {
                        return $record->user->role_id == 4;
                    }
                )
                    ->action(
                        function ($record, $data) {
                            $name = strtolower($record->firstname . '' . $record->lastname);
                            $record->user->update([
                                'role_id' => 2,
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
                    )->form(
                        [
                            Grid::make(1)
                                ->schema([
                                    Select::make('strand_id')->label('Strand')
                                        ->options(Strand::pluck('name', 'id'))
                                ])
                        ]
                    )->modalWidth('xl'),
                Action::make('assign-subject-teacher')->label('Assign As Subject
     Teacher')->color('success')->icon('heroicon-o-user-add')->visible(
                        function ($record) {
                            return $record->user->role_id == 4;
                        }
                    )
                    ->action(
                        function ($record, $data) {
                            $name = strtolower($record->firstname . '' . $record->lastname);
                            $record->user->update([
                                'role_id' => 3,
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
                // Action::make('manage-advisee')->label('Manage Advisee')->color('primary')->icon('heroicon-o-user-group'),
            ]),
        ];



    }


    public function render()
    {
        return view('livewire.admin.teacher.teacher-list');
    }
}