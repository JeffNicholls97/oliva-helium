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

                    <div class="w-full flex items-center justify-center">
                        <label class="w-32 h-32 flex flex-col items-center justify-center px-4 py-6 bg-white text-blue rounded-full shadow-lg border border-blue cursor-pointer hover:bg-red-500 hover:text-white">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-sm text-center">Upload Image</span>
                            <input type='file' wire:model="profilePicture" class="hidden" />
                        </label>
                    </div>
                    <div class="flex mt-10 relative items-center gap-5">
                        <div class="w-1/2">
                            <input id="first-name" placeholder="First Name" class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-rose-600" wire:model="firstName" type="text">
                            <label for="first-name" class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">First Name</label>
                        </div>
                        <div class="w-1/2 relative">
                            <input id="last-name" placeholder="Last Name" class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-rose-600" wire:model="lastName" type="text">
                            <label for="last-name" class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Last Name</label>
                        </div>
                    </div>
                    <div class="flex mt-5 items-center relative w-full">
                        <div class="w-full relative">
                            <input id="email" placeholder="Email Address" class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-rose-600" wire:model="emailAddress" type="text">
                            <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                        </div>
                    </div>
                    <div class="flex mt-5 items-center relative w-full">
                        <div class="w-full relative">
                            <input id="key" placeholder="Account Key" class="peer h-10 w-full border-b-2 border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-rose-600" wire:model="accountKey" type="text">
                            <label for="key" class="absolute left-0 -top-3.5 text-gray-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-2 peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Account Key</label>
                        </div>
                    </div>
                    <div class="flex mt-5 items-center relative w-full">
                        <div class="w-full relative">
                            <textarea placeholder="Enter Account Address" class="border-2 p-3 rounded-md w-full border-gray-300" wire:model="address"></textarea>
                        </div>
                    </div>
                    <div class="flex mt-5 items-center relative w-full">
                        <div class="w-full relative">
                            <p>Does this account receive funds in HNT or Cash?</p>
                            <input  class="border " wire:model="cash" type="checkbox">
                        </div>
                    </div>
                    <button class="p-3 mt-10 rounded-lg bg-red-500 text-white" type="submit">save</button>
                </form>
            </div>
        </div>  
    </div>

</div>
