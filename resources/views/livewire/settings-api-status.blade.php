<div>
    <div class="flex justify-center flex-col gap-5">
        @if($coinGeckoStatus['gecko_says'] == '(V3) To the Moon!')
            <span class="bg-gray-100 w-72 rounded-lg p-3 text-center">CoinGecko - <span class="text-green-400">Online</span></span>
        @else
            <span class="bg-gray-100 w-72 rounded-lg p-3 text-center">CoinMarketCap API - <span class="text-red-400">Online</span></span>
        @endif
        @if($coinMarketStatus['status']['error_code'] == 0)
            <span class="bg-gray-100 w-72 rounded-lg p-3 text-center">CoinMarketCap API - <span class="text-green-400">Online</span></span>
        @else
            <span class="bg-gray-100 w-72 rounded-lg p-3 text-center">CoinMarketCap API - <span class="text-red-400">Online</span></span>
        @endif
    </div>
</div>
