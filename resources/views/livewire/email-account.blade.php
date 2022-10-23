<div>
    <div x-cloak x-data="{ emailModal: false }">
        <div  class="w-full flex items-center justify-end">
            <button x-on:click="emailModal = !emailModal" class="bg-red-100 text-black p-3 rounded-lg">Send Intro Email</button>
        </div>
        <div x-show="emailModal" class="absolute bg-black/80 flex items-center justify-center inset-0 z-40 top-0 left-0">
            <div x-on:click.away="emailModal = false" class="max-w-xl w-full h-3/4 relative bg-white p-5 rounded-lg">
                <button x-on:click="emailModal = false" class="w-8 bg-white shadow-md group h-8 absolute top-0 right-0 -m-2 rounded-full flex items-center justify-center">
                    <svg class="w-5 group-hover:text-black duration-200 fill-current text-gray-300 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                </button>
                <div class="content">
                    <div class="flex flex-col gap-2">
                        <span class="text-sm text-gray-400">Please choose an account to send to</span>
                        <select wire:model="accountEmailId" class="w-full bg-gray-100 rounded-lg p-2">
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">
                                    {{ $account->miner_name }} - {{ $account->first_name }} {{ $account->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full mt-5">
                        <textarea rows="20" class="border w-full p-3 rounded-lg  border-gray-300" placeholder="email body" wire:model="emailBody"></textarea>
                    </div>
                    <button wire:loading.remove class="bg-[#FA4040] w-full py-3 text-white rounded-lg" wire:click="sendEmailIntro">{{ $submitMessage }}</button>
                    <div wire:loading.flex wire:target="sendEmailIntro" class="bg-[#FA4040] basic flex items-center justify-center w-full py-3 text-white rounded-lg"></div>
                </div>
            </div>
        </div>
    </div>

</div>
