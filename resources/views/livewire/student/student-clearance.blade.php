<div x-data="{clearance: @entangle('clearance_modal')}">
    {{-- {{\App\Models\TeacherAdvisee::where('student_id', auth()->user()->student->id)->pluck('teacher_id')}} --}}
    <div>
        {{$this->table}}
    </div>
    <div x-show="clearance" x-cloak class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
  <!-- Background backdrop, show/hide based on slide-over state. -->
  <div class="fixed inset-0 bg-gray-600 opacity-50"></div>

  <div class="fixed inset-0 overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
      <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
        <!--
          Slide-over panel, show/hide based on slide-over state.

          Entering: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-full"
            To: "translate-x-0"
          Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
            From: "translate-x-0"
            To: "translate-x-full"
        -->
        <div x-show="clearance" x-cloak 
        x-transtion.enter="transform transition ease-in-out duration-500 sm:duration-700"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="pointer-events-auto w-screen max-w-2xl">
          <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
            <div class="flex-1">
              <!-- Header -->
              <div class="bg-gray-50 px-4 py-6 sm:px-6">
                <div class="flex items-start justify-between space-x-3">
                  <div class="space-y-1">
                    <h2 class="text-base font-bold uppercase leading-6 text-gray-900" id="slide-over-title">{{$clearance_data->title ?? ''}}</h2>
                    <p class="text-sm text-gray-500">Created By: {{($clearance_data->teacher->firstname ?? '') . ' ' . ($clearance_data->teacher->lastname ?? '') }} </p>
                  </div>
                  <div class="flex h-7 items-center">
                    <button wire:click="$set('clearance_modal', false)" type="button" class="text-gray-400 hover:text-gray-500">
                      <span class="sr-only">Close panel</span>
                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
             
              <div class="p-5">
                <div class="header">
                  Requirements:
                </div>
                <div class="mt-2">
                  {{$clearance_data->requirements ?? ''}}
                </div>

                 @if ($is_decline)
                 <div class="mt-3 border-t">
                  <span class="text-red-600">Status: Decline</span>
                   <h1>Reason:</h1>
                  <p>{{$reason }}</p>
                 </div>
              @endif

                <div class="mt-10">
                 {{$this->form}}
                </div>
              </div>
            </div>

            <!-- Action buttons -->
            <div class="flex-shrink-0 border-t border-gray-200 px-4 py-5 sm:px-6">
              <div class="flex justify-end space-x-3">
                <button wire:click="$set('clearance_modal', false)" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Cancel</button>
                <button wire:click="submitClearance"  class="inline-flex  justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit Requirement</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
