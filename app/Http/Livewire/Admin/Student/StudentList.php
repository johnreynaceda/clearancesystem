<?php

namespace App\Http\Livewire\Admin\Student;

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
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\DatePicker;
use DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class StudentList extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use LivewireAlert;
    public $create_modal = false;
    public $firstname, $middlename, $lastname, $birthdate, $age, $address, $contact_number, $grade_level_id, $strand_id;

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
        return Student::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('firstname')->label('FIRSTNAME')->sortable()->searchable(),
            TextColumn::make('middlename')->label('MIDDLENAME')->sortable()->searchable(),
            TextColumn::make('lastname')->label('LASTNAME')->sortable()->searchable(),
            TextColumn::make('birthdate')->date()->label('BIRTHDATE')->sortable()->searchable(),
            TextColumn::make('address')->label('ADDRESS')->sortable()->searchable(),
            TextColumn::make('contact_number')->label('PHONE NUMBER')->sortable()->searchable(),

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
                    TextInput::make('age')->label('Age')->required()->reactive(),
                    TextInput::make('address')->label('Address')->required(),
                    TextInput::make('contact_number')->label('Contact Number')->required(),
                ])
                ->columns(3),
            Fieldset::make('Grade Level & Strand')
                ->schema([
                    Select::make('grade_level_id')->label('Grade Level')
                        ->options(GradeLevel::pluck('name', 'id')),
                    Select::make('strand_id')->label('Strand')
                        ->options(Strand::pluck('name', 'id')),
                ])
                ->columns(2)
        ];
    }


    protected function getTableHeaderActions()
    {
        return [
            Action::make('student')->label('New Student')->button()->icon('heroicon-o-plus')->size('sm')->color('gray')->action(function () {
                $this->create_modal = true;
            })
            // ->action(function ($record,$data): void {
            //  $name = strtolower($data['firstname'].''.$data['lastname']);
            //       // dd($name);
            //      DB::beginTransaction();
            //       $user = User::create([
            //       'name' => $data['firstname']. '' . $data['lastname'],
            //       'email' => $name.'@gmail.com',
            //       'password' => bcrypt('password'),
            //       'role_id' => 4,
            //       ]);

            //       Student::create([
            //           'user_id' => $user->id,
            //        'firstname' => $data['firstname'],
            //       'middlename' => $data['middlename'],
            //       'lastname' => $data['lastname'],
            //       'birthdate' => $data['birthdate'],
            //       'age' => $data['age'],
            //       'address' => $data['address'],
            //       'contact_number' => $data['contact_number'],
            //       'grade_level_id' => $data['grade_level_id'],
            //       'strand_id' => $data['strand_id']
            //       ]);
            //      DB::commit();



            // })
            // ->form([
            //      Fieldset::make('Student Information')
            //      ->schema([
            //      TextInput::make('firstname')->label('First Name')->required(),
            //      TextInput::make('middlename')->label('Middle Name')->required(),
            //      TextInput::make('lastname')->label('Last Name')->required(),
            //      DatePicker::make('birthdate')->label('Date of Birth')->required()->reactive(),
            //      TextInput::make('age')->label('Age')->required()->reactive(),
            //      TextInput::make('address')->label('Address')->required(),
            //      TextInput::make('contact_number')->label('Contact Number')->required(),
            //      ])
            //      ->columns(3),
            //      Fieldset::make('Grade Level & Strand')
            //      ->schema([
            //      Select::make('grade_level_id')->label('Grade Level')
            //      ->options(GradeLevel::pluck('name', 'id')),
            //      Select::make('strand_id')->label('Strand')
            //      ->options(Strand::pluck('name', 'id')),
            //      ])
            //      ->columns(2)
            // ])->modalWidth('3xl')
        ];

    }

    public function createStudent()
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

            Student::create([
                'user_id' => $user->id,
                'firstname' => $this->firstname,
                'middlename' => $this->middlename,
                'lastname' => $this->lastname,
                'birthdate' => $this->birthdate,
                'age' => $this->age,
                'address' => $this->address,
                'contact_number' => $this->contact_number,
                'grade_level_id' => $this->grade_level_id,
                'strand_id' => $this->strand_id
            ]);
            DB::commit();
            $this->alert('success', 'Student Created', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
            $this->create_modal = false;
            $this->reset('firstname', 'middlename', 'lastname', 'birthdate', 'age', 'address', 'contact_number', 'grade_level_id', 'strand_id');
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
                                    TextInput::make('age')->label('Age')->required()->default($record->age),
                                    TextInput::make('address')->label('Address')->required()->default($record->address),
                                    TextInput::make('contact_number')->label('Contact Number')->required()->default($record->contact_number),
                                ])
                                ->columns(3),

                            Fieldset::make('Grade Level & Strand')
                                ->schema([
                                    Select::make('grade_level_id')->label('Grade Level')->default($record->grade_level_id)
                                        ->options(GradeLevel::pluck('name', 'id')),
                                    Select::make('strand_id')->label('Strand')->default($record->strand_id)
                                        ->options(Strand::pluck('name', 'id')),
                                ])
                                ->columns(2)
                        ];
                    },
                )->icon('heroicon-o-pencil')->button()->color('success')->modalHeading('Edit Student')->modalWidth('3xl'),
        ];


    }

    public function render()
    {
        return view('livewire.admin.student.student-list');
    }
}