<div >
    <div class="col-span-1 mt-2">
    <div class="flex w-full items-center justify-between space-x-6 ">
      <div class="flex-1 truncate">
        <div class="flex items-center space-x-1">
          <h3 class="truncate text-sm font-medium text-gray-900">by: </h3>
          <span class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{$getRecord()->teacher->firstname. ' '. $getRecord()->teacher->lastname}} - {{$getRecord()->teacher->teacherDesignations->first()->assigned_as}}</span>
        </div>
        <p class="mt-1 truncate text-sm text-gray-600">Created Date: {{$getRecord()->created_at->format('F m, Y')}}</p>
        <p class="text-sm">status:
       {{-- @if ($getRecord()->studentSubmittions->count() < 1)
         <span class="inline-flex items-center rounded-full bg-red-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">No Submittion</span>
         @elseif ($getRecord()->studentSubmittions->where('student_id', auth()->user()->student->id)->first()->status == 3)
         <span class="inline-flex items-center rounded-full bg-red-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Declined</span>
          @elseif ($getRecord()->studentSubmittions->where('student_id', auth()->user()->student->id)->first()->status == 2)
          <span class="inline-flex items-center rounded-full bg-red-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Accepted</span>
         @else
         <span class="inline-flex items-center rounded-full bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">Pending</span>
       @endif --}}

      @if ($getRecord()->studentSubmittions->where('student_id', auth()->user()->student->id)->first() == null)
            <span class="inline-flex items-center rounded-full bg-red-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">No Submittion</span>
       @elseif ($getRecord()->studentSubmittions->where('student_id', auth()->user()->student->id)->first()->status == 3)
         <span class="inline-flex items-center rounded-full bg-red-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Declined</span>
          @elseif ($getRecord()->studentSubmittions->where('student_id', auth()->user()->student->id)->first()->status == 2)
          <span class="inline-flex items-center rounded-full bg-red-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Accepted</span>
         @else
         <span class="inline-flex items-center rounded-full bg-gray-50 px-1.5 py-0.5 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">Pending</span>     
      @endif

        </p>
   {{-- @if ($getRecord()->studentSubmittions->where('student_id', auth()->user()->student->id)->first()->remark != null)
         <p class="mt-1 truncate text-sm text-red-600">Status: Declined</p>
   @endif --}}
      </div>
     <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 fill-[#146C94]" viewBox="0 0 24 24"><path d="M20 22H4C3.44772 22 3 21.5523 3 21V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM8 7V9H16V7H8ZM8 11V13H16V11H8ZM8 15V17H13V15H8Z"></path></svg>
    </div>
    <div class="mt-6">
        <button wire:click="openRequirement({{$getRecord()->id}})" class="flex bg-[#146C94] w-full px-4 py-1 rounded-lg justify-between font-medium text-white fill-white ">
            <span>Open Requirement</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"><path d="M10 6V8H5V19H16V14H18V20C18 20.5523 17.5523 21 17 21H4C3.44772 21 3 20.5523 3 20V7C3 6.44772 3.44772 6 4 6H10ZM21 3V11H19L18.9999 6.413L11.2071 14.2071L9.79289 12.7929L17.5849 5H13V3H21Z"></path></svg>
        </button>
    </div>
  </div>



</div>