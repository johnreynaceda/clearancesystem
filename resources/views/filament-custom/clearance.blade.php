<div>
    <div
        class=" relative before:absolute before:top-0 before:left-0 before:w-full before:h-px sm:before:w-px sm:before:h-full before:bg-gray-200 before:first:bg-transparent dark:before:bg-gray-700">
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 fill-[#146C94]" viewBox="0 0 24 24">
                <path
                    d="M5 20H19V22H5V20ZM12 18C7.58172 18 4 14.4183 4 10C4 5.58172 7.58172 2 12 2C16.4183 2 20 5.58172 20 10C20 14.4183 16.4183 18 12 18Z">
                </path>
            </svg>
            <div class="mt-3">

                <div class="flex items-center gap-x-2">
                    <p class="text-xs uppercase tracking-wide font-medium text-gray-600">
                        Total Submitted
                    </p>
                    <div class="hs-tooltip">
                        <div class="hs-tooltip-toggle">
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-sm dark:bg-slate-700"
                                role="tooltip">
                                The number of daily users
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-1 flex justify-between">
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-700 ">
                        {{ \App\Models\StudentSubmittion::where('clearance_requirement_id', $getRecord()->id)->where('status', 1)->count() }}
                    </h3>
                    <div class="grid grid-cols-2 divide-x gap-2">
                        <div class="flex items-center justify-center">
                            @if (auth()->user()->role_id == 2)
                                <a href="{{ route('adviser.manage.clearance', ['id' => $getRecord()->id, 'name' => $getRecord()->title]) }}"
                                    class="hover:fill-green-600 fill-gray-600 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                                        <path
                                            d="M10 6V8H5V19H16V14H18V20C18 20.5523 17.5523 21 17 21H4C3.44772 21 3 20.5523 3 20V7C3 6.44772 3.44772 6 4 6H10ZM21 3V12L17.206 8.207L11.2071 14.2071L9.79289 12.7929L15.792 6.793L12 3H21Z">
                                        </path>
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('subject-teacher.manage.clearance', ['id' => $getRecord()->id, 'name' => $getRecord()->title]) }}"
                                    class="hover:fill-green-600 fill-gray-600 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4">
                                        <path
                                            d="M10 6V8H5V19H16V14H18V20C18 20.5523 17.5523 21 17 21H4C3.44772 21 3 20.5523 3 20V7C3 6.44772 3.44772 6 4 6H10ZM21 3V12L17.206 8.207L11.2071 14.2071L9.79289 12.7929L15.792 6.793L12 3H21Z">
                                        </path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <div class="flex pl-2 items-center justify-center ">
                            <button class="fill-red-600 hover:fill-gray-600"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" class="h-4 w-4 ">
                                    <path
                                        d="M4 8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8ZM6 10V20H18V10H6ZM9 12H11V18H9V12ZM13 12H15V18H13V12ZM7 5V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V5H22V7H2V5H7ZM9 4V5H15V4H9Z">
                                    </path>
                                </svg></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
