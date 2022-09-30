<div>
    <div class="flex mb-5 justify-between items-center gap-10">
        <div class="flex-grow">
            <p class="text-lg">Hotspot Activity (Rewards)</p>
            <p class="text-sm text-gray-400">Last Active - {{ \Carbon\Carbon::parse($lastActiveTime)->diffForHumans() }}</p>
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
                    $arr = [];
                    foreach ($newTran as $key => $transaction) {
                        array_push($arr, $transaction['amount']);
                        $estimatedTotal = array_sum($arr);
                        $estimatedTotalFinal = $estimatedTotal / 100000000;
                    }
                @endphp
            Total for this period: {{ number_format($estimatedTotalFinal, 3) }}
            @else
                Inactive Miner last seen X days ago
            @endif
        </div>
        <div>
            <input wire:model.lazy="priceSold" type="text">
        </div>
        <div class="w-72 relative">
            @if($priceSold)
            <button wire:loading.remove class="bg-[#FA4040] w-full py-2 text-white rounded-lg" wire:click="generateSingleInvoice">Generate Invoice from {{ $startDate }}</button>
            <div wire:loading.flex wire:target="generateSingleInvoice" class="bg-[#FA4040] basic flex items-center justify-center w-full py-2 text-white rounded-lg"></div>
            @else
                <div class="bg-[#FA4040] opacity-30 flex items-center justify-center w-full py-2 text-white rounded-lg">
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
                    Reward GBP (£)
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
                                        {{ $transaction['amount'] / 100000000 }}
                                        @php
//                                            $individualAccountValue = substr($transaction['amount'] / 100000000, 0, 5);
//                                            dd($individualAccountValue * $coinvalue['helium']['gbp']);
//                                            $overallFull = $individualAccountValue * $coinvalue['helium']['gbp'];
//                                            $overallSplit = $overallFull / 2;
                                        @endphp
{{--                                        {{ substr($transaction['amount'] / 100000000, 0, 5) }}--}}
{{--                                        £{{ number_format($overallFull, 2) }}--}}
{{--                                        £{{ number_format($overallSplit, 2) }}--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2">
                                {{ $transaction['amount'] * $coinvalue['helium']['gbp'] }}
                            </div>
                            <div class="col-span-2">
                                {{ $transaction['amount'] * $coinvalue['helium']['gbp'] / 2 }}
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
                    <div class="w-full flex h-full item-center justify-center">
                        API Timeout, Please refresh the page!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
