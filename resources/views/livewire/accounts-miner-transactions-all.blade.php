<div>
    <div class="flex mb-5 justify-between items-center gap-5">
        <div class="flex-grow">
            <p class="text-lg">Hotspot Activity (Rewards)</p>
            <p class="text-sm text-gray-400">Last Active - {{ \Carbon\Carbon::parse($lastActiveTime)->diffForHumans() }}</p>
        </div>
        <div class="w-72 flex items-center gap-2">
            <div class="basic" wire:loading.flex wire:target="requestMinerTransactionsForAccountCalenderInput"></div>
            <div class="w-full" wire:ignore>
                <div class="relative">
                    <input type="hidden" name="date" x-ref="date">
                    <input
                        type="text"
                        readonly
                        id="datepicker"
                        class="w-full cursor-pointer pl-4 pr-10 h-12 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                        placeholder="Select date">

                    <div class="absolute top-0 right-0 px-3 py-2">
                        <svg class="h-6 w-6 text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                </div>
                <script>
                    const picker = new easepick.create({
                      element: document.getElementById('datepicker'),
                      css: [
                        'https://cdn.jsdelivr.net/npm/@easepick/core@1.2.0/dist/index.css',
                        'https://cdn.jsdelivr.net/npm/@easepick/range-plugin@1.2.0/dist/index.css',
                        'https://cdn.jsdelivr.net/npm/@easepick/preset-plugin@1.2.0/dist/index.css',
                      ],
                      autoApply: false,
                      plugins: [RangePlugin, PresetPlugin],
                      setup(picker) {
                        picker.on('select', (e) => {
                            let startDate =  picker.getStartDate();
                            let endDate =  picker.getEndDate();
                            @this.set('startDate', startDate.format('YYYY-MM-DD'));
                            @this.set('endDate', endDate.format('YYYY-MM-DD'));
                        });
                        },
                      RangePlugin: {
                        tooltip: true,
                      },
                      PresetPlugin: {
                        position: 'left',
                      },
                    });
                </script>
            </div>
            <input wire:model="startDate" type="hidden">
            <input wire:model="endDate" type="hidden">
        </div>
        <div class="relative w-72">
            @if($newTran)
                @php
                    $arr = [];
                    foreach ($newTran as $key => $transaction) {
                        array_push($arr, $transaction['amount']);
                        $estimatedTotal = array_sum($arr);
                        $estimatedTotalFinal = $estimatedTotal / 100000000;
                    }
                @endphp
            <div x-data="{ turnCurrencyMiner: false }" class="w-full flex items-center relative pl-12 bg-white pr-2 h-12 leading-none rounded-lg shadow-sm">
                <div class="w-7 h-7 absolute top-1/2 -translate-y-1/2 left-2 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg x-show="turnCurrencyMiner == true" class="w-3 h-3 fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M144 160.4c0-35.5 28.8-64.4 64.4-64.4c6.9 0 13.8 1.1 20.4 3.3l81.2 27.1c16.8 5.6 34.9-3.5 40.5-20.2s-3.5-34.9-20.2-40.5L249 38.6c-13.1-4.4-26.8-6.6-40.6-6.6C137.5 32 80 89.5 80 160.4V224H64c-17.7 0-32 14.3-32 32s14.3 32 32 32H80v44.5c0 17.4-4.7 34.5-13.7 49.4L36.6 431.5c-5.9 9.9-6.1 22.2-.4 32.2S52.5 480 64 480H320c17.7 0 32-14.3 32-32s-14.3-32-32-32H120.5l.7-1.1C136.1 390 144 361.5 144 332.5V288H256c17.7 0 32-14.3 32-32s-14.3-32-32-32H144V160.4z"/></svg>
                    <svg x-show="turnCurrencyMiner == false" :class="turnCurrencyMiner ? 'rotate-180' : ''" class="w-3 h-3 duration-300 fill-current text-gray-300" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 193 193" style="enable-background:new 0 0 193 193;" xml:space="preserve">
                        <path class="st0" d="M122.2,50.2c5.6-5.6,14.8-5.6,20.4,0c5.6,5.6,5.6,14.8,0,20.4c-3.3,3.3-7.7,4.7-12.2,4.1c-0.2,0-0.4,0-0.7,0  c-1.3-0.2-2.7,0-4.1,0.6c-1.9,0.9-3.2,2.4-3.9,4.2c-0.7,1.8-0.6,3.8,0.2,5.6c4.8,10.4,2.6,23-5.6,31.1c-8.2,8.2-20.7,10.4-31.1,5.6  c-1.9-0.9-3.9-0.9-5.7-0.2c-1.8,0.7-3.3,2-4.1,3.8c-0.5,1.2-0.8,2.4-0.7,3.7c0,0.2,0,0.5,0,0.7c0.8,4.6-0.8,9.3-4,12.6  c-5.6,5.6-14.8,5.6-20.4,0c-2.7-2.7-4.2-6.3-4.2-10.2c0-3.8,1.5-7.5,4.2-10.2c3.3-3.3,7.7-4.7,12.2-4.1c0.1,0,0.1,0,0.2,0  c0.5,0.1,1,0.2,1.5,0.2c1.1,0,2.1-0.2,3.1-0.7c1.9-0.9,3.2-2.4,3.8-4.1c0.7-1.8,0.7-3.9-0.2-5.8c-4.8-10.5-2.6-23,5.6-31.1  c8.2-8.2,20.7-10.4,31.1-5.6c1.8,0.9,3.9,0.9,5.7,0.2c1.8-0.7,3.3-2,4.2-3.8c0.7-1.4,0.8-3,0.6-4.5v0  C117.4,58.2,118.9,53.5,122.2,50.2z M107.9,107.8c6.2-6.2,6.2-16.3,0-22.6c-6.2-6.2-16.3-6.2-22.6,0c-6.2,6.2-6.2,16.3,0,22.6  C91.6,114,101.7,114,107.9,107.8z M96.5,0C149.8,0,193,43.2,193,96.5c0,53.3-43.2,96.5-96.5,96.5S0,149.8,0,96.5  C0,43.2,43.2,0,96.5,0z M147.9,76c8.5-8.5,8.5-22.3,0-30.9c-8.5-8.5-22.3-8.5-30.9,0c-3.2,3.2-5.1,7.1-6,11.1  c-15.5-5.8-33.2-2.1-45,9.7C54.2,77.7,50.5,95.5,56.4,111c-4.1,0.8-8,2.8-11.2,6c-8.5,8.5-8.5,22.3,0,30.9c8.5,8.5,22.3,8.5,30.9,0  c3.2-3.2,5.2-7.2,6-11.3c4.8,1.8,9.8,2.7,14.8,2.7c11.1,0,22-4.3,30.1-12.4c11.8-11.8,15.5-29.4,9.8-44.8  C140.8,81.1,144.7,79.1,147.9,76z"></path>
                    </svg>
                </div>
                <span class="text-gray-600" x-show="turnCurrencyMiner == false">{{ number_format($estimatedTotalFinal, 3) }}</span>
                <span class="text-gray-600" x-show="turnCurrencyMiner == true">{{ number_format($estimatedTotalFinal, 3) * $coinvalue }}</span>
                <button x-on:click="turnCurrencyMiner = !turnCurrencyMiner" class="w-7 h-7 absolute group top-1/2 -translate-y-1/2 right-2 rounded-lg flex items-center justify-center">
                    <svg :class="turnCurrencyMiner ? 'rotate-180' : ''" class="w-3 group-hover:text-black h-3 duration-300 fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"></path></svg></button>
            </div>
            @else
                Inactive Miner in the last 24 hours
            @endif
        </div>
        <div class="relative w-72">
            <div class="w-7 h-7 absolute top-1/2 -translate-y-1/2 left-2 bg-gray-100 rounded-lg flex items-center justify-center">
                <svg class="w-3 h-3 fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M144 160.4c0-35.5 28.8-64.4 64.4-64.4c6.9 0 13.8 1.1 20.4 3.3l81.2 27.1c16.8 5.6 34.9-3.5 40.5-20.2s-3.5-34.9-20.2-40.5L249 38.6c-13.1-4.4-26.8-6.6-40.6-6.6C137.5 32 80 89.5 80 160.4V224H64c-17.7 0-32 14.3-32 32s14.3 32 32 32H80v44.5c0 17.4-4.7 34.5-13.7 49.4L36.6 431.5c-5.9 9.9-6.1 22.2-.4 32.2S52.5 480 64 480H320c17.7 0 32-14.3 32-32s-14.3-32-32-32H120.5l.7-1.1C136.1 390 144 361.5 144 332.5V288H256c17.7 0 32-14.3 32-32s-14.3-32-32-32H144V160.4z"/></svg>
            </div>
            <input placeholder="Enter Selling Price" class="w-full pl-12 pr-2 h-12 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium" wire:model.lazy="priceSold" type="text">
        </div>
        <div class="w-72 relative">
            @if($priceSold)
            <button wire:loading.remove class="bg-[#FA4040] w-full py-3 text-white rounded-lg" wire:click="generateSingleInvoice">Generate Invoice from {{ $startDate }}</button>
            <div wire:loading.flex wire:target="generateSingleInvoice" class="bg-[#FA4040] basic flex items-center justify-center w-full py-3 text-white rounded-lg"></div>
            @else
                <div class="bg-[#FA4040] opacity-30 flex items-center justify-center w-full py-3 text-white rounded-lg">
                    Enter Price you are selling at
                </div>
            @endif
        </div>
    </div>
    <div class="w-full h-72 overflow-y-scroll">
        <div class="w-full">
            <div class="table-header gap-10 top-0 z-20 grid grid-cols-12 w-full bg-gray-100 border border-gray-200 rounded-lg p-3">
                <div class="col-span-1 text-sm text-gray-400 font-bold">
                    ID
                </div>
                <div class="col-span-2 text-sm text-gray-400 font-bold">
                    Reward Total (HNT)
                </div>
                <div class="col-span-2 text-sm text-gray-400 font-bold">
                    Reward Total GBP (£)
                </div>
                <div class="col-span-2 text-sm text-gray-400 font-bold">
                    Customer Reward (£)
                </div>
                <div class="col-span-2 text-sm text-gray-400 font-bold">
                    Time of Mine
                </div>
                <div class="col-span-3 text-sm text-gray-400 font-bold">
                    Network Average
                </div>
            </div>
            <div class="">
                @if($newTran)
                    @foreach ($newTran as $key => $transaction)
                        <div class="table-body even:bg-gray-50 table-header grid grid-cols-12 gap-10 w-full rounded-lg p-3">
                            <div class="col-span-1">
                                <span class="text-sm text-gray-400">#{{ $loop->iteration }}</span>
                            </div>
                            <div class="col-span-2">
                                <div class="flex items-center gap-4">
                                    <div>
                                        @php
                                            $fullAmount = $transaction['amount'] / 100000000;
                                            $printAmount = number_format($fullAmount, 4);
                                        @endphp
                                        {{ $printAmount }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                @php
                                    $fullAmountGbp = $transaction['amount'] / 100000000;
                                    $fullAmountGbpConversion = $fullAmountGbp * $coinvalue;
                                    $printAmountGbp = number_format($fullAmountGbpConversion, 4);
                                @endphp
                                £{{ $printAmountGbp }}
                            </div>
                            <div class="col-span-2">
                                £{{ $printAmountGbp / 2 }}
                            </div>
                            <div class="col-span-2">
                                <div class="flex flex-col">
                                    <span>{{ \Carbon\Carbon::parse($transaction['timestamp'])->diffForHumans() }}</span>
                                    @if ($transaction['type'] == 'poc_witness')
                                        <span class="text-sm text-gray-400">Witness Reward</span>
                                    @else
                                        <span class="text-sm text-gray-400">Challenge Reward</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-3 flex items-center">
                                <div class="w-full relative h-4 rounded-full bg-gray-300 border-gray-400">
                                    <span class="w-[40%] rounded-l-full h-full bg-red-200 absolute inset-0"></span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="w-full h-72 flex h-full item-center justify-center">
                        API Timeout, Please refresh the page!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
