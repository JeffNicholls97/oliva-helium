<div>
    <div class="w-full flex flex-col">
        <div class="table-header h-12 gap-10 top-0 grid grid-cols-12 w-full bg-gray-100 border border-gray-200 rounded-lg p-3">
            <div class="col-span-1 text-sm text-gray-400 font-bold">
                ID
            </div>
            <div class="col-span-3 text-sm text-gray-400 font-bold">
                Account
            </div>
            <div class="col-span-2 text-sm text-gray-400 font-bold">
                Total Amount Earned
            </div>
            <div class="col-span-1 text-sm text-left text-gray-400 font-bold">
                Cash
            </div>
            <div class="col-span-2 text-sm text-gray-400 font-bold">
                Invoice Date
            </div>
            <div class="col-span-3 text-right text-sm text-gray-400 font-bold">
                Actions
            </div>
        </div>
        <div class="w-full h-full overflow-y-auto">
            @foreach ($invoices as $invoice)
                <div class="table-body even:bg-gray-50 gap-10 table-header grid grid-cols-12 w-full rounded-lg p-3">
                    <div class="col-span-1">
                        <div class="flex text-gray-400 text-sm items-center gap-4">
                            {{ $invoice->id }}
                        </div>
                    </div>
                    <div class="col-span-3">
                        <div class="flex text-gray-400 text-sm items-center gap-4">
                            @php
                                $account = App\Models\Accounts::where('id', $invoice->accounts_id)->get()->first();
                                $minerName = str_replace("-", " ", $account->miner_name);
                            @endphp
                            <div>
                                <img class="rounded-full object-cover w-10 h-10" src="{{asset($account->account_image)}}" alt="">
                            </div>
                            <div class="flex ml-2 flex-col">
                                <span class="text-sm capitalize">{{ $minerName }}</span>
                                <span class="text-xs text-gray-400">{{ $account->first_name }} {{ $account->last_name }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2 relative flex items-center">
                        <div class="w-3/4 text-gray-400 text-sm">
                            @php
                                $sumArr = [];
                                foreach($invoice->invoice_data as $key => $invoiceEarn) {
                                    if(array_key_exists('amount', $invoiceEarn)) {
                                        array_push($sumArr, $invoiceEarn['amount']);
                                        $estimatedTotal = array_sum($sumArr);
                                        $estimatedTotalFinal = $estimatedTotal / 100000000;
                                    }
                                }
                                $gbpConversion = $estimatedTotalFinal * $invoice->invoice_data['miner-info']['price-sold'] / 2;
                            @endphp
                            @if($invoice->cash)
                                £{{ number_format($gbpConversion, 2) }}
                            @else
                                {{ $estimatedTotalFinal / 2 }} <span class="text-xs">HNT</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center">
                        <div class="w-full text-sm text-gray-400">
                            @if($invoice->cash)
                                <div class="flex gap-2 items-center">
                                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M144 160.4c0-35.5 28.8-64.4 64.4-64.4c6.9 0 13.8 1.1 20.4 3.3l81.2 27.1c16.8 5.6 34.9-3.5 40.5-20.2s-3.5-34.9-20.2-40.5L249 38.6c-13.1-4.4-26.8-6.6-40.6-6.6C137.5 32 80 89.5 80 160.4V224H64c-17.7 0-32 14.3-32 32s14.3 32 32 32H80v44.5c0 17.4-4.7 34.5-13.7 49.4L36.6 431.5c-5.9 9.9-6.1 22.2-.4 32.2S52.5 480 64 480H320c17.7 0 32-14.3 32-32s-14.3-32-32-32H120.5l.7-1.1C136.1 390 144 361.5 144 332.5V288H256c17.7 0 32-14.3 32-32s-14.3-32-32-32H144V160.4z"/></svg>
                                    </div>
                                    <span>Cash</span>
                                </div>
                            @else
                                <div class="flex gap-2 items-center">
                                    <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 fill-current text-gray-300" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 193 193" style="enable-background:new 0 0 193 193;" xml:space="preserve"><path class="st0" d="M122.2,50.2c5.6-5.6,14.8-5.6,20.4,0c5.6,5.6,5.6,14.8,0,20.4c-3.3,3.3-7.7,4.7-12.2,4.1c-0.2,0-0.4,0-0.7,0  c-1.3-0.2-2.7,0-4.1,0.6c-1.9,0.9-3.2,2.4-3.9,4.2c-0.7,1.8-0.6,3.8,0.2,5.6c4.8,10.4,2.6,23-5.6,31.1c-8.2,8.2-20.7,10.4-31.1,5.6  c-1.9-0.9-3.9-0.9-5.7-0.2c-1.8,0.7-3.3,2-4.1,3.8c-0.5,1.2-0.8,2.4-0.7,3.7c0,0.2,0,0.5,0,0.7c0.8,4.6-0.8,9.3-4,12.6  c-5.6,5.6-14.8,5.6-20.4,0c-2.7-2.7-4.2-6.3-4.2-10.2c0-3.8,1.5-7.5,4.2-10.2c3.3-3.3,7.7-4.7,12.2-4.1c0.1,0,0.1,0,0.2,0  c0.5,0.1,1,0.2,1.5,0.2c1.1,0,2.1-0.2,3.1-0.7c1.9-0.9,3.2-2.4,3.8-4.1c0.7-1.8,0.7-3.9-0.2-5.8c-4.8-10.5-2.6-23,5.6-31.1  c8.2-8.2,20.7-10.4,31.1-5.6c1.8,0.9,3.9,0.9,5.7,0.2c1.8-0.7,3.3-2,4.2-3.8c0.7-1.4,0.8-3,0.6-4.5v0  C117.4,58.2,118.9,53.5,122.2,50.2z M107.9,107.8c6.2-6.2,6.2-16.3,0-22.6c-6.2-6.2-16.3-6.2-22.6,0c-6.2,6.2-6.2,16.3,0,22.6  C91.6,114,101.7,114,107.9,107.8z M96.5,0C149.8,0,193,43.2,193,96.5c0,53.3-43.2,96.5-96.5,96.5S0,149.8,0,96.5  C0,43.2,43.2,0,96.5,0z M147.9,76c8.5-8.5,8.5-22.3,0-30.9c-8.5-8.5-22.3-8.5-30.9,0c-3.2,3.2-5.1,7.1-6,11.1  c-15.5-5.8-33.2-2.1-45,9.7C54.2,77.7,50.5,95.5,56.4,111c-4.1,0.8-8,2.8-11.2,6c-8.5,8.5-8.5,22.3,0,30.9c8.5,8.5,22.3,8.5,30.9,0  c3.2-3.2,5.2-7.2,6-11.3c4.8,1.8,9.8,2.7,14.8,2.7c11.1,0,22-4.3,30.1-12.4c11.8-11.8,15.5-29.4,9.8-44.8  C140.8,81.1,144.7,79.1,147.9,76z"></path></svg>
                                    </div>
                                    <span>HNT</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-span-2 flex items-center">
                        <div class="w-full text-sm text-gray-400">
                            {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('F - Y')}}
                        </div>
                    </div>
                    <div class="col-span-3 gap-3 flex justify-end items-center">
                        @php
                            $account = App\Models\Accounts::where('id', $invoice->accounts_id)->get()->first();
                        @endphp

                        <button wire:click="openEmailModal({{ $account->id }}, {{ $invoice->id }})" class="flex group h-8 duration-300 hover:border-gray-300 border-transparent border w-8 items-center justify-center bg-gray-200 rounded-lg">
                            <svg class="w-4 group-hover:text-black group-hover:scale-110 duration-300 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                        </button>
                        <a href="{{route('admin.download', ['id' => $invoice->id, 'account' => $account])}}" class="flex group h-8 duration-300 hover:border-gray-300 border-transparent border w-8 items-center justify-center bg-gray-200 rounded-lg" href="{{route('admin.accounts.show', $account->id)}}">
                            <svg class="w-4 group-hover:text-black group-hover:scale-110 duration-300 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM64 224H88c30.9 0 56 25.1 56 56s-25.1 56-56 56H80v32c0 8.8-7.2 16-16 16s-16-7.2-16-16V320 240c0-8.8 7.2-16 16-16zm24 80c13.3 0 24-10.7 24-24s-10.7-24-24-24H80v48h8zm72-64c0-8.8 7.2-16 16-16h24c26.5 0 48 21.5 48 48v64c0 26.5-21.5 48-48 48H176c-8.8 0-16-7.2-16-16V240zm32 112h8c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16h-8v96zm96-128h48c8.8 0 16 7.2 16 16s-7.2 16-16 16H304v32h32c8.8 0 16 7.2 16 16s-7.2 16-16 16H304v48c0 8.8-7.2 16-16 16s-16-7.2-16-16V304 240c0-8.8 7.2-16 16-16z"/></svg>
                        </a>
                        <button wire:click="deleteInvoice({{$invoice->id}})" class="flex group h-8 duration-300 hover:border-gray-300 border-transparent border w-8 items-center justify-center bg-gray-200 rounded-lg" href="{{route('admin.accounts.show', $account->id)}}">
                            <svg class="w-4 group-hover:text-red-500 group-hover:scale-110 duration-300 h-4 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                        </button>
                        @if($invoice->invoice_sent)
                            <svg wire:click="unsetTick({{ $invoice->id }})" class="w-6 hover:text-red-200 cursor-pointer h-6 fill-current text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                        @else
                            <svg class="w-6 h-6 fill-current text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm79 143c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

        <div x-data="{ openEditModal: @entangle('emailModal') }" class="email-modal">
            <div x-cloak x-show="openEditModal">
                <div class="absolute bg-black/80 flex items-center justify-center inset-0 z-40 top-0 left-0">
                    <div class="max-w-xl w-full h-3/4 relative bg-white p-5 rounded-lg">
                        <button x-on:click="openEditModal = false" class="w-8 bg-white shadow-md group h-8 absolute top-0 right-0 -m-2 rounded-full flex items-center justify-center">
                            <svg class="w-5 group-hover:text-black duration-200 fill-current text-gray-300 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/></svg>
                        </button>
                        <div class="flex gap-5 flex-col">
                            @if($editEmailData)
                                <span class="text-sm bg-gray-100 rounded-md text-center px-5 py-2">To: {{ $editEmailData->email_address }}</span>
                                <input class="peer h-10 w-full border-b border-gray-200 text-gray-900 placeholder-transparent focus:outline-none focus:border-rose-600" placeholder="subject" wire:model="emailSubject" type="text" />
                                <textarea rows="20" class="border p-3 rounded-lg  border-gray-300" placeholder="email body" wire:model="emailBody"></textarea>
                                <button wire:loading.remove class="bg-[#FA4040] w-full py-3 text-white rounded-lg" wire:click="sendEmail({{ $editEmailData->id }})">{{ $submitMessage }}</button>
                                <div wire:loading.flex wire:target="sendEmail" class="bg-[#FA4040] basic flex items-center justify-center w-full py-3 text-white rounded-lg"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
