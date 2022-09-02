<div>
    <div class="flex w-full items-end" style="height:6rem; min-height:6rem; max-height: 6rem;">
        <div class="grid flex-grow w-full grid-cols-12 gap-5">
            <div class="col-span-2">
                <p class="text-sm text-gray-400">Earnings (GBP)</p>
                <p class="text-xl">{{ round($graphValues['data']['total'],4) }}<p>
                    @php
                        $hntAccountValue = round($graphValues['data']['total'],4);

                        $overallFull = $hntAccountValue * $coinvalue['helium']['gbp'];
                        $overallSplit = $overallFull / 2;
                    @endphp
                <p class="text-sm text-gray-400">£{{ number_format($overallFull, 2) }}</p>
                <p class="text-sm text-gray-400">after split £{{ number_format($overallSplit, 2) }}</p>
                
            </div>
            <div class="col-span-10 flex flex-col justify-between">
                <div class="w-full flex justify-end gap-5">
                    <button class="bg-gray-200 rounded-full px-3 py-1 text-sm" wire:click="$set('timeLength', 7)">7 Days</button>
                    <button class="bg-gray-200 rounded-full px-3 py-1 text-sm" wire:click="$set('timeLength', 14)">14 Days</button>
                    <button class="bg-gray-200 rounded-full px-3 py-1 text-sm" wire:click="$set('timeLength', 30)">30 Days</button>
                </div>
                <div class="w-full justify-end items-end border-b border-gray-300 flex gap-3">
                    @foreach ($graphData['data'] as $bar)
                    @php
                        $timestamp = $bar['timestamp'];
                        $renderedTime = Carbon\Carbon::parse($timestamp)->format('M-d');
                    @endphp
                        <span data-tippy-content="Earnings - {{ round($bar['total'],3) }} HNT / {{ $renderedTime }}" style="max-height: 100px; height:{{ round($bar['total'],3) * 100 }}px;" class="w-7 bar-chart bg-[#fa4040]"></span>
                    @endforeach
                    <script>
                        tippy('[data-tippy-content]', {
                            arrow: true,
                            animation: 'fade',
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
