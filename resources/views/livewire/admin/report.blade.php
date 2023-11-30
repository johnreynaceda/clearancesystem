<div x-data>
    <div>{{ $this->form }}</div>
    <div class="mt-5 border-t py-5 px-2">
        <div>
            <div x-ref="printContainer">
                <header class="flex space-x-2 items-end">
                    <img src="{{ asset('images/logo.png') }}" class="h-20" alt="">
                    <div>
                        <h1 class="font-bold text-xl">CARMEN NATIONAL HIGH SCHOOL</h1>
                        <h1 class="text-sm">ONLINE CLEARANCE PROCESSING SYSTEM</h1>
                    </div>
                </header>
                @if ($report == 'Students')
                    <div class="mt-8">
                        <h1 class="font-bold text-xl text-center">STUDENT REPORTS</h1>
                    </div>
                    <div class="mt-8">
                        <p class="mb-1">List below are the students who cleared their clearance.</p>
                        <table id="example" class="table-auto " style="width:100%">
                            <thead class="font-normal">
                                <tr>

                                    <th class="border text-left px-2 text-sm font-BOLD text-gray-600 py-2">STUDENT
                                        FULLNAME</th>
                                    <th class="border text-left px-2 text-sm font-BOLD text-gray-600 py-2">STRAND
                                    </th>
                                    <th class="border text-left px-2 text-sm font-BOLD text-gray-600 py-2">DATE
                                        SUBMITTED
                                    </th>
                                    <th class="border text-left px-2 text-sm font-BOLD text-gray-600 py-2">STATUS
                                    </th>


                                </tr>
                            </thead>
                            <tbody class="">

                                @foreach (\App\Models\StudentSubmittion::where('status', 2)->get() as $item)
                                    <tr>
                                        <td class="border text-gray-600  px-3 py-1">
                                            {{ $item->student->firstname . ' ' . $item->student->lastname }}</td>
                                        <td class="border text-gray-600  px-3 py-1">{{ $item->student->strand->name }} -
                                            {{ $item->student->gradeLevel->name }} </td>
                                        </td>
                                        <td class="border text-gray-600  px-3 py-1">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}
                                        </td>
                                        <td class="border text-gray-600  px-3 py-1">Cleared
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @elseif($report == 'Advisers')
                    <div class="mt-8">
                        <h1 class="font-bold text-xl text-center">ADVISERS REPORTS</h1>
                    </div>
                    <div class="mt-8">
                        <p class="mb-1">List below are the Advisers</p>
                        <table id="example" class="table-auto " style="width:100%">
                            <thead class="font-normal">
                                <tr>

                                    <th class="border text-left px-2 text-sm font-BOLD text-gray-600 py-2">ADVISER
                                        FULLNAME</th>
                                    <th class="border text-left px-2 text-sm font-BOLD text-gray-600 py-2">STRAND
                                    </th>


                                </tr>
                            </thead>
                            <tbody class="">

                                @foreach (\App\Models\TeacherDesignation::where('strand_id', '!=', null)->get() as $item)
<tr>
                    <td class="border text-gray-600  px-3 py-1">
                      {{ $item->teacher->firstname . ' ' . $item->teacher->lastname }}</td>
                    <td class="border text-gray-600  px-3 py-1">{{ $item->strand->name }}</td>
                    </td>

                  </tr>
@endforeach

              </tbody>
            </table>
          </div>
@elseif($report == 'Subject Teacher')
<div class="mt-8">
            <h1 class="font-bold text-xl text-center">SUBJECT TEACHER REPORTS</h1>
          </div>
          <div class="mt-8">
            <p class="mb-1">List below are the Subject Teacher</p>
            <table id="example" class="table-auto " style="width:100%">
              <thead class="font-normal">
                <tr>

                  <th class="border text-left px-2 text-sm font-BOLD text-gray-600 py-2">SUBJECT TEACHER FULLNAME</th>
                  <th class="border text-left px-2 text-sm font-BOLD text-gray-600 py-2">SUBJECT
                  </th>


                </tr>
              </thead>
              <tbody class="">

                @foreach (\App\Models\TeacherDesignation::where('subject_id', '!=', null)->get() as $item)
                                    <tr>
                                        <td class="border text-gray-600  px-3 py-1">
                                            {{ $item->teacher->firstname . ' ' . $item->teacher->lastname }}</td>
                                        <td class="border text-gray-600  px-3 py-1">{{ $item->subject->name }}</td>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @else
                @endif
            </div>
        </div>

        <div class="mt-5 flex justify-end">
            @if ($report)
                <button class="bg-gray-600  text-white font-bold py-2 px-4 rounded"
                    @click="printOut($refs.printContainer.outerHTML);">
                    Print
                </button>
            @endif
        </div>
    </div>
</div>
