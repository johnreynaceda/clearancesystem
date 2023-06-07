@section('title', 'Dashboard')
<x-admin-layout>
    <dl class="mx-auto grid grid-cols-1 gap-px bg-gray-900/5 sm:grid-cols-2 lg:grid-cols-4">
  <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
    <dt class="text-sm font-bold leading-6 text-gray-700">TOTAL STUDENTS</dt>
    <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">{{\App\Models\Student::count()}}</dd>
  </div>
  <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
       <dt class="text-sm font-bold leading-6 text-gray-700">TOTAL ADVISERS</dt>
    <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">{{\App\Models\TeacherDesignation::whereNull('subject_id')->count()}}</dd>
  </div>
  <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
      <dt class="text-sm font-bold leading-6 text-gray-700">TOTAL SUBJECT TEACHERS</dt>
    <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">{{\App\Models\TeacherDesignation::whereNull('strand_id')->count()}}</dd>
  </div>
  <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
     <dt class="text-sm font-bold leading-6 text-gray-700">TOTAL USERS</dt>
    <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">{{\App\Models\User::count()}}</dd>
  </div>
</dl>

</x-admin-layout>