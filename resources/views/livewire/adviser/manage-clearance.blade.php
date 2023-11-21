<div x-data="{ submittion: @entangle('submittion_modal'), decline: @entangle('decline_modal') }">
    <div>
        {{ $this->table }}
    </div>

    <div x-show="submittion" x-cloak class="relative z-10" aria-labelledby="slide-over-title" role="dialog"
        aria-modal="true">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div class="fixed inset-0 bg-gray-700 opacity-50"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <!--
          Slide-over panel, show/hide based on slide-over state.

          Entering: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-full"
            To: "translate-x-0"
          Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-0"
            To: "translate-x-full"
        -->
                    <div x-show="submittion" x-cloak
                        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                        class="pointer-events-auto w-screen max-w-md">
                        <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                            <div class="px-4 sm:px-6">
                                <div class="flex items-start justify-between">
                                    <h2 class="text-base font-semibold leading-6 text-gray-900" id="slide-over-title">
                                        Student Submittion
                                    </h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button" wire:click="$set('submittion_modal', false)"
                                            class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative mt-6 flex-1  px-4 sm:px-6">
                                <div class="md:flex md:items-center md:justify-between border-b pb-2 md:space-x-5">
                                    <div class="flex items-start space-x-5">
                                        <div class="flex-shrink-0">
                                            <div class="relative">
                                                <img class="h-16 w-16 rounded-full object-cover"
                                                    src="{{ Storage::url($student_data->student->student_profile ?? '') }}"
                                                    alt="">
                                                <span class="absolute inset-0 rounded-full shadow-inner"
                                                    aria-hidden="true"></span>
                                            </div>
                                        </div>
                                        <!--
      Use vertical padding to simulate center alignment when both lines of text are one line,
      but preserve the same layout if the text wraps without making the image jump around.
    -->
                                        <div class="pt-1.5">
                                            <h1 class="text-xl font-bold  text-gray-900">
                                                {{ ($student_data->student->firstname ?? '') . ' ' . ($student_data->student->lastname ?? '') }}
                                            </h1>
                                            <p class="text-sm font-medium text-gray-500">Submitted Date:
                                                {{ $student_data->created_at ?? '' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <header class="font-bold text-lg text-gray-700">
                                        Uploaded Files
                                    </header>
                                    <dd class="mt-4 text-sm text-gray-900 sm:col-span-2 sm:mt-3">
                                        <ul role="list"
                                            class="divide-y divide-gray-100 rounded-md border border-gray-200">
                                            @foreach ($student_data->uploadedRequirements ?? [] as $item)
                                                <li
                                                    class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
                                                    <div class="flex w-0 flex-1 items-center">
                                                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                            <span
                                                                class="truncate font-medium">{{ $item->file_name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4 flex-shrink-0">
                                                        <a href="{{ Storage::url($item->path) }}" target="_blank"
                                                            class="font-medium text-indigo-600 hover:text-indigo-500">View</a>
                                                        {{-- <button wire:click="downloadFile({{ $item->id }})"
                              class="font-medium text-indigo-600 hover:text-indigo-500">Download</button> --}}
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </dd>
                                </div>
                                <div class="mt-5 flex justify-end space-x-2">
                                    <button wire:click="declineSubmittion({{ $student_data->id ?? '' }})"
                                        class="inline-flex  justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Decline</button>
                                    <button wire:click="acceptSubmittion({{ $student_data->id ?? '' }})"
                                        class="inline-flex  justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Accept</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div x-show="decline" x-cloak class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
        <div x-show="decline" x-cloak x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
                <div x-show="decline" x-cloak x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">


                    <div class="">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Reason to
                                    decline</h3>

                            </div>
                        </div>
                        <div class="mt-2 ">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 fill-gray-600"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM7 12C7 14.7614 9.23858 17 12 17C14.7614 17 17 14.7614 17 12H15C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12H7Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="relative">
                                        <div
                                            class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-red-600">
                                            <label for="comment" class="sr-only">Add your comment</label>
                                            <textarea rows="3" name="comment" id="comment" wire:model.defer="reason"
                                                class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                placeholder="Add your comment..."></textarea>

                                            <!-- Spacer element to match the height of the toolbar -->
                                            <div class="py-2" aria-hidden="true">
                                                <!-- Matches height of button in toolbar (1px border + 36px content height) -->
                                                <div class="py-px">
                                                    <div class="h-9"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">

                                            <div class="flex-shrink-0">
                                                <button wire:click="proceedDecline"
                                                    class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Decline</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
