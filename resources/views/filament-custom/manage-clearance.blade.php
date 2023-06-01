<li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center ">
    <div class="flex flex-1 flex-col py-4">
      <img class="mx-auto h-32 w-32 flex-shrink-0 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
      <h3 class="mt-6 text-sm font-bold uppercase text-gray-900">{{$getRecord()->student->lastname. ', '. $getRecord()->student->firstname}}</h3>
      <dl class="mt-1 flex flex-grow flex-col justify-between">
        <dt class="sr-only">Title</dt>
        <dd class="text-sm text-gray-500"> Submitted Date: {{$getRecord()->created_at->format('F m, Y')}}</dd>
        <dt class="sr-only">Role</dt>
        <dd class="mt-3 flex justify-center">
          <button wire:click="openSubmittion({{$getRecord()->id}})" class="flex space-x-1 fill-green-700 hover:text-red-600 hover:fill-red-600   items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
            <span>View Submittion</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"><path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path></svg>
        </button>
        </dd>
      </dl>
    </div>
  </li>