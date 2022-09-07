<div>
    <div class="w-full">
        <div class="table-header grid grid-cols-12 w-full bg-gray-100 rounded-lg p-3">
            <div class="col-span-4 font-bold">
                Client
            </div>
            <div class="col-span-2 font-bold">
                Address
            </div>
            <div class="col-span-2 font-bold">
                Account Key
            </div>
            <div class="col-span-2 font-bold">
                Current HNT (30 Days)
            </div>
            <div class="col-span-2 font-bold">
                Actions
            </div>
        </div>
        <div class="">
            @foreach ($accounts as $account)
                <div class="table-body even:bg-gray-50 table-header grid grid-cols-12 w-full rounded-lg p-3">
                    <div class="col-span-4">
                        <div class="flex items-center gap-4">
                            <div>
                                <img class="rounded-full object-cover w-10 h-10" src="{{asset($account->account_image)}}" alt="">
                            </div>
                            <div class="flex flex-col">
                                <span>{{ $account->first_name }} {{ $account->last_name }}</span>
                                <span class="text-sm text-gray-400">{{$account->email_address}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <div class="w-full text-sm text-gray-400">
                            {{ $account->housing_address }}
                        </div>
                    </div>
                    <div x-data="{ key: '' }"  class="col-span-2 relative flex items-center">
                        <div class="w-3/4 truncate text-ellipsis text-sm text-black">
                            {{ $account->address_key }}
                        </div>
                        <button x-clipboard.raw="{{ $account->address_key }}" class="w-10 account-key group cursor-pointer absolute top-0 h-10 flex duration-200 items-center justify-center bg-transparent hover:bg-black rounded-full right-0">
                            <svg class="w-5 text-gray-300 group-hover:text-white fill-current h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M384 96L384 0h-112c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48H464c26.51 0 48-21.49 48-48V128h-95.1C398.4 128 384 113.6 384 96zM416 0v96h96L416 0zM192 352V128h-144c-26.51 0-48 21.49-48 48v288c0 26.51 21.49 48 48 48h192c26.51 0 48-21.49 48-48L288 416h-32C220.7 416 192 387.3 192 352z"/></svg>
                        </button>
                    </div>
                    <div class="col-span-2">

                    </div>
                    <div class="col-span-2 flex items-center">
                        <a class="bg-black text-sm text-white rounded-lg px-4 py-2" href="{{route('admin.accounts.show', $account->id)}}">View Account</a>
                        <button wire:click="deleteAccountData( {{ $account->id }} )" class="bg-red-500 text-white rounded-lg px-4 py-2">Delete</button>
                        <button wire:click="editAccountData( {{ $account->id }} )" class="bg-green-500 text-white rounded-lg px-4 py-2">Edit</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>