<div class="h-full">
    <div x-cloak x-data="{ rewardTotal: 'yearly' }" class="w-full h-full bg-gray-100 rounded-lg p-5">
        <div class="border-b border-gray-300 flex items-center justify-between pb-3">
            <span class="text-lg font-bold">Leaderboard Ranking</span>
            <div class="flex gap-3 items-center">
                <button x-on:click="rewardTotal = 'seven'" class="px-3 py-1 text-xs bg-white rounded-full">7 Days</button>
                <button x-on:click="rewardTotal = 'fourteen'" class="px-3 py-1 text-xs bg-white rounded-full">14 Days</button>
                <button x-on:click="rewardTotal = 'thirty'" class="px-3 py-1 text-xs bg-white rounded-full">30 Days</button>
                <button x-on:click="rewardTotal = 'yearly'" class="px-3 py-1 text-xs bg-white rounded-full">Year</button>
            </div>
        </div>
        <div class="bg-white flex flex-col rounded-lg p-5 mt-3">
            @foreach($accounts->sortByDesc('yearly_reward') as $key => $account)
                <div class="flex justify-between overflow-hidden relative odd:bg-gray-100 items-center rounded-lg p-3">
                    @if($loop->index == 0)
                        <span class="absolute bg-yellow-300 w-2 h-full left-0"></span>
                    @elseif($loop->index == 1)
                        <span class="absolute bg-gray-300 w-2 h-full left-0"></span>
                    @elseif($loop->index == 2)
                        <span class="absolute bg-yellow-900 w-2 h-full left-0"></span>
                    @else

                    @endif
                    <div class="flex ml-4 items-center">
                        <div class="w-8">
                            @if($account->account_image)
                                <img class="rounded-full object-cover w-8 h-8" src="{{asset($account->account_image)}}" alt="">
                            @else
                                <img class="rounded-full object-cover w-8 h-8" src="{{asset('images/user-default.png')}}" alt="">
                            @endif
                        </div>
                        <div class="flex ml-2 flex-col">
                            @php
                                $minerName = str_replace("-", " ", $account->miner_name);
                            @endphp
                            <span class="text-sm capitalize">{{ $minerName }}</span>
                            <span class="text-xs text-gray-400">{{ $account->first_name }} {{ $account->last_name }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span x-show="rewardTotal == 'yearly'" class="text-sm">{{ $account->yearly_reward }}</span>
                        <span x-show="rewardTotal == 'thirty'" class="text-sm">{{ $account->thirty_day_reward }}</span>
                        <span x-show="rewardTotal == 'fourteen'" class="text-sm">{{ $account->fourteen_day_reward }}</span>
                        <span x-show="rewardTotal == 'seven'" class="text-sm">{{ $account->seven_day_reward }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
