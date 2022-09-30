<div>
    <div x-data="{ accountModal: false }">
        <div  class="w-full flex items-center justify-end">
            <button x-on:click="accountModal = !accountModal" class="bg-red-500 text-white p-3 rounded-lg">Add Account</button>
        </div>
        <div x-show="accountModal" class="absolute bg-black/80 flex items-center justify-center inset-0 z-40 top-0 left-0">
            <div x-on:click.away="accountModal = false" class="max-w-xl w-full h-3/4 relative bg-white p-5 rounded-lg">
                <button x-on:click="accountModal = false" class="w-8 bg-white shadow-md group h-8 absolute top-0 right-0 -m-2 rounded-full flex items-center justify-center">
                    <svg class="w-5 group-hover:text-black duration-200 fill-current text-gray-300 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                </button>
                <form wire:submit.prevent='submitAccountData' class="flex flex-col" action="">

                    <div class="w-full gap-5 flex items-center justify-center">
                        @if ($profilePicture)
                            <img class="h-32 min-w-[8rem] min-h-[8rem] object-cover w-32 rounded-lg" src="{{ $profilePicture->temporaryUrl() }}">
                        @endif
                        <label class="w-full h-32 flex flex-col items-center justify-center px-4 py-6 bg-white text-blue rounded-lg border border-blue cursor-pointer hover:bg-gray-100 hover:text-black">
                            <svg class="w-8 h-8 fill-current text-gray-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            @if ($profilePicture)
                                <span class="mt-2 text-sm text-gray-400 text-center">Change Image</span>
                            @else
                                <span class="mt-2 text-sm text-gray-400 text-center">Upload Image</span>
                            @endif
                            <input type='file' wire:model="profilePicture" class="hidden" />
                        </label>
                    </div>
                    <div class="flex mt-10 relative items-center gap-5">
                        <div class="w-1/2">
                            <input id="first-name" placeholder="First Name" class="peer h-10 w-full border-b border-gray-200 text-gray-900 placeholder-transparent focus:outline-none focus:border-rose-600" wire:model="firstName" type="text">
                            <label for="first-name" class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">First Name</label>
                        </div>
                        <div class="w-1/2 relative">
                            <input id="last-name" placeholder="Last Name" class="peer h-10 w-full border-b border-gray-200 text-gray-900 placeholder-transparent focus:outline-none focus:border-rose-600" wire:model="lastName" type="text">
                            <label for="last-name" class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Last Name</label>
                        </div>
                    </div>
                    <div class="flex mt-5 items-center relative w-full">
                        <div class="w-full relative">
                            <input id="email" placeholder="Email Address" class="peer h-10 w-full border-b border-gray-200 text-gray-900 placeholder-transparent focus:outline-none focus:border-rose-600" wire:model="emailAddress" type="text">
                            <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                        </div>
                    </div>
                    <div class="flex mt-5 items-center relative w-full">
                        <div class="w-full relative">
                            <input id="key" placeholder="Account Key" class="peer h-10 w-full border-b border-gray-200 text-gray-900 placeholder-transparent focus:outline-none focus:border-rose-600" wire:model="accountKey" type="text">
                            <label for="key" class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Account Key</label>
                        </div>
                    </div>
                    <div class="flex mt-5 items-center relative w-full">
                        <div class="w-full relative">
                            <textarea placeholder="Enter Account Address" class="border focus:border-rose-600 focus:outline-none p-3 rounded-md w-full border-gray-200" wire:model="address"></textarea>
                        </div>
                    </div>
                    <div class="flex mt-5 items-center relative w-full">
                        <div class="w-full relative">
                            <ul class="grid gap-6 w-full md:grid-cols-4">
                                <li class="col-span-2">
                                    <input type="radio" wire:model="cash" id="react-option" value="1" class="hidden peer">
                                    <label for="react-option" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer peer-checked:border-red-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                        <div class="block">
                                            <svg class="fill-current mb-2 text-gray-400 w-7 h-7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M535 7.03C544.4-2.343 559.6-2.343 568.1 7.029L632.1 71.02C637.5 75.52 640 81.63 640 87.99C640 94.36 637.5 100.5 632.1 104.1L568.1 168.1C559.6 178.3 544.4 178.3 535 168.1C525.7 159.6 525.7 144.4 535 135L558.1 111.1L384 111.1C370.7 111.1 360 101.2 360 87.99C360 74.74 370.7 63.99 384 63.99L558.1 63.1L535 40.97C525.7 31.6 525.7 16.4 535 7.03V7.03zM104.1 376.1L81.94 400L255.1 399.1C269.3 399.1 279.1 410.7 279.1 423.1C279.1 437.2 269.3 447.1 255.1 447.1L81.95 448L104.1 471C114.3 480.4 114.3 495.6 104.1 504.1C95.6 514.3 80.4 514.3 71.03 504.1L7.029 440.1C2.528 436.5-.0003 430.4 0 423.1C0 417.6 2.529 411.5 7.03 407L71.03 343C80.4 333.7 95.6 333.7 104.1 343C114.3 352.4 114.3 367.6 104.1 376.1H104.1zM95.1 64H337.9C334.1 71.18 332 79.34 332 87.1C332 116.7 355.3 139.1 384 139.1L481.1 139.1C484.4 157.5 494.9 172.5 509.4 181.9C511.1 184.3 513.1 186.6 515.2 188.8C535.5 209.1 568.5 209.1 588.8 188.8L608 169.5V384C608 419.3 579.3 448 544 448H302.1C305.9 440.8 307.1 432.7 307.1 423.1C307.1 395.3 284.7 371.1 255.1 371.1L158.9 372C155.5 354.5 145.1 339.5 130.6 330.1C128.9 327.7 126.9 325.4 124.8 323.2C104.5 302.9 71.54 302.9 51.23 323.2L31.1 342.5V128C31.1 92.65 60.65 64 95.1 64V64zM95.1 192C131.3 192 159.1 163.3 159.1 128H95.1V192zM544 384V320C508.7 320 480 348.7 480 384H544zM319.1 352C373 352 416 309 416 256C416 202.1 373 160 319.1 160C266.1 160 223.1 202.1 223.1 256C223.1 309 266.1 352 319.1 352z"></path></svg>
                                            <div class="w-full text-lg font-semibold">Cash</div>
                                            <div class="w-full text-sm">This user will receive funds in cash format on payout day.</div>
                                        </div>
                                    </label>
                                </li>
                                <li class="col-span-2">
                                    <input type="radio" wire:model="cash" id="flowbite-option" value="0" class="hidden peer">
                                    <label for="flowbite-option" class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer peer-checked:border-red-600 hover:text-gray-600 peer-checked:text-gray-600 hover:bg-gray-50">
                                        <div class="block">
                                            <svg class="fill-current mb-2 text-gray-400 w-7 h-7" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 193 193" style="enable-background:new 0 0 193 193;" xml:space="preserve"><path class="st0" d="M122.2,50.2c5.6-5.6,14.8-5.6,20.4,0c5.6,5.6,5.6,14.8,0,20.4c-3.3,3.3-7.7,4.7-12.2,4.1c-0.2,0-0.4,0-0.7,0  c-1.3-0.2-2.7,0-4.1,0.6c-1.9,0.9-3.2,2.4-3.9,4.2c-0.7,1.8-0.6,3.8,0.2,5.6c4.8,10.4,2.6,23-5.6,31.1c-8.2,8.2-20.7,10.4-31.1,5.6  c-1.9-0.9-3.9-0.9-5.7-0.2c-1.8,0.7-3.3,2-4.1,3.8c-0.5,1.2-0.8,2.4-0.7,3.7c0,0.2,0,0.5,0,0.7c0.8,4.6-0.8,9.3-4,12.6  c-5.6,5.6-14.8,5.6-20.4,0c-2.7-2.7-4.2-6.3-4.2-10.2c0-3.8,1.5-7.5,4.2-10.2c3.3-3.3,7.7-4.7,12.2-4.1c0.1,0,0.1,0,0.2,0  c0.5,0.1,1,0.2,1.5,0.2c1.1,0,2.1-0.2,3.1-0.7c1.9-0.9,3.2-2.4,3.8-4.1c0.7-1.8,0.7-3.9-0.2-5.8c-4.8-10.5-2.6-23,5.6-31.1  c8.2-8.2,20.7-10.4,31.1-5.6c1.8,0.9,3.9,0.9,5.7,0.2c1.8-0.7,3.3-2,4.2-3.8c0.7-1.4,0.8-3,0.6-4.5v0  C117.4,58.2,118.9,53.5,122.2,50.2z M107.9,107.8c6.2-6.2,6.2-16.3,0-22.6c-6.2-6.2-16.3-6.2-22.6,0c-6.2,6.2-6.2,16.3,0,22.6  C91.6,114,101.7,114,107.9,107.8z M96.5,0C149.8,0,193,43.2,193,96.5c0,53.3-43.2,96.5-96.5,96.5S0,149.8,0,96.5  C0,43.2,43.2,0,96.5,0z M147.9,76c8.5-8.5,8.5-22.3,0-30.9c-8.5-8.5-22.3-8.5-30.9,0c-3.2,3.2-5.1,7.1-6,11.1  c-15.5-5.8-33.2-2.1-45,9.7C54.2,77.7,50.5,95.5,56.4,111c-4.1,0.8-8,2.8-11.2,6c-8.5,8.5-8.5,22.3,0,30.9c8.5,8.5,22.3,8.5,30.9,0  c3.2-3.2,5.2-7.2,6-11.3c4.8,1.8,9.8,2.7,14.8,2.7c11.1,0,22-4.3,30.1-12.4c11.8-11.8,15.5-29.4,9.8-44.8  C140.8,81.1,144.7,79.1,147.9,76z"></path></svg>
                                            <div class="w-full text-lg font-semibold">HNT</div>
                                            <div class="w-full text-sm">This user will receive funds in the default HNT format.</div>
                                        </div>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button class="p-3 mt-10 rounded-lg bg-red-500 text-white" type="submit">save</button>
                </form>
            </div>
        </div>
    </div>

</div>
