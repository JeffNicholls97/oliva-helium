<div>
    <div class="flex mb-5 justify-between items-center gap-10">
        <div class="flex-grow">
            <p class="text-lg">Hotspot Activity (Rewards)</p>
            <p class="text-sm text-gray-400">Last Active - 1 Hour Ago</p>
        </div>
        <div class="w-72 flex items-center gap-2">
            <div class="basic" wire:loading.flex wire:target="requestMinerTransactionsForAccountCalenderInput">

            </div>
            <div wire:ignore>
                <div class="relative">
                    <input type="hidden" name="date" x-ref="date">
                    <input
                        type="text"
                        readonly
                        id="datepicker"
                        class="w-full pl-4 pr-10 py-3 leading-none rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium"
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
        <div>
            @if($newTran)
                @php
                foreach ($newTran as $key => $transaction) {
                    $arr = [];
                    array_push($arr, $transaction['amount']);
                  $estimatedTotal = array_sum($arr);
                }
                @endphp
            @endif
            Total for this period: {{ round($estimatedTotal, 4) }}
        </div>
        <div class="w-72 relative">
            <button wire:loading.remove class="bg-[#FA4040] w-full py-2 text-white rounded-lg" wire:click="generateSingleInvoice">Generate Invoice from {{ $startDate  }}</button>
            <div wire:loading.flex wire:target="generateSingleInvoice" class="bg-[#FA4040] basic flex items-center justify-center w-full py-2 text-white rounded-lg"></div>
        </div>
    </div>
    <div class="w-full h-72 overflow-y-scroll">
        <div class="w-full">
            <div class="table-header grid grid-cols-12 w-full bg-gray-100 rounded-lg p-3">
                <div class="col-span-4 font-bold">
                    Reward
                </div>
                <div class="col-span-2 font-bold">
                    Time
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
                @if($newTran)
                    @foreach ($newTran as $key => $transaction)
                        <div class="table-body even:bg-gray-50 table-header grid grid-cols-12 w-full rounded-lg p-3">
                            <div class="col-span-4">
                                <div class="flex items-center gap-4">
                                    <div>
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 80C512 98.01 497.7 114.6 473.6 128C444.5 144.1 401.2 155.5 351.3 158.9C347.7 157.2 343.9 155.5 340.1 153.9C300.6 137.4 248.2 128 192 128C183.7 128 175.6 128.2 167.5 128.6L166.4 128C142.3 114.6 128 98.01 128 80C128 35.82 213.1 0 320 0C426 0 512 35.82 512 80V80zM160.7 161.1C170.9 160.4 181.3 160 192 160C254.2 160 309.4 172.3 344.5 191.4C369.3 204.9 384 221.7 384 240C384 243.1 383.3 247.9 381.9 251.7C377.3 264.9 364.1 277 346.9 287.3C346.9 287.3 346.9 287.3 346.9 287.3C346.8 287.3 346.6 287.4 346.5 287.5L346.5 287.5C346.2 287.7 345.9 287.8 345.6 288C310.6 307.4 254.8 320 192 320C132.4 320 79.06 308.7 43.84 290.9C41.97 289.9 40.15 288.1 38.39 288C14.28 274.6 0 258 0 240C0 205.2 53.43 175.5 128 164.6C138.5 163 149.4 161.8 160.7 161.1L160.7 161.1zM391.9 186.6C420.2 182.2 446.1 175.2 468.1 166.1C484.4 159.3 499.5 150.9 512 140.6V176C512 195.3 495.5 213.1 468.2 226.9C453.5 234.3 435.8 240.5 415.8 245.3C415.9 243.6 416 241.8 416 240C416 218.1 405.4 200.1 391.9 186.6V186.6zM384 336C384 354 369.7 370.6 345.6 384C343.8 384.1 342 385.9 340.2 386.9C304.9 404.7 251.6 416 192 416C129.2 416 73.42 403.4 38.39 384C14.28 370.6 .0003 354 .0003 336V300.6C12.45 310.9 27.62 319.3 43.93 326.1C83.44 342.6 135.8 352 192 352C248.2 352 300.6 342.6 340.1 326.1C347.9 322.9 355.4 319.2 362.5 315.2C368.6 311.8 374.3 308 379.7 304C381.2 302.9 382.6 301.7 384 300.6L384 336zM416 278.1C434.1 273.1 452.5 268.6 468.1 262.1C484.4 255.3 499.5 246.9 512 236.6V272C512 282.5 507 293 497.1 302.9C480.8 319.2 452.1 332.6 415.8 341.3C415.9 339.6 416 337.8 416 336V278.1zM192 448C248.2 448 300.6 438.6 340.1 422.1C356.4 415.3 371.5 406.9 384 396.6V432C384 476.2 298 512 192 512C85.96 512 .0003 476.2 .0003 432V396.6C12.45 406.9 27.62 415.3 43.93 422.1C83.44 438.6 135.8 448 192 448z"/></svg>
                                    </div>
                                    <div>
                                        @php
                                            $individualAccountValue = substr($transaction['amount'] / 100000000, 0, 5);

                                            $overallFull = $individualAccountValue * $coinvalue['helium']['gbp'];
                                            $overallSplit = $overallFull / 2;
                                        @endphp
                                        {{ substr($transaction['amount'] / 100000000, 0, 5) }}
                                        £{{ number_format($overallFull, 2) }}
                                        £{{ number_format($overallSplit, 2) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div class="flex flex-col">
                                    <span>{{ \Carbon\Carbon::parse($transaction['timestamp'])->diffForHumans() }}</span>
                                    @if ($transaction['type'] == 'poc_witness')
                                        <span class="text-sm text-gray-400">Received rewards through witness</span>
                                    @else
                                        <span class="text-sm text-gray-400">Received rewards through challenge</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-2 relative flex items-center">

                            </div>
                            <div class="col-span-2">

                            </div>
                            <div class="col-span-2 flex items-center">

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="w-full flex h-full item-center justify-center">
                        API Timeout, Please refresh the page!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
