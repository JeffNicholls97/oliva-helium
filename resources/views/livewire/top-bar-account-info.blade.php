<div wire:init='AccountInformationStats'>
    @if($isLoadingAccount)
    <div class="flex gap-x-10 items-center">
        <div class="w-40 h-7 rounded-md animate-pulse bg-gray-200">
        </div>
        <div class="w-40 h-7 rounded-md animate-pulse bg-gray-200">
        </div>
    </div>
    @else
        <div class="flex gap-x-10 items-center">
            <div class="flex">
                <span class="w-8 mr-2 h-8 flex items-center rounded-full justify-center bg-black">
                    <svg class="fill-current text-white w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M314.3 8.486C326.6-2.829 345.4-2.829 357.7 8.486L565.7 200.5C575.4 209.4 578.6 223.4 573.8 235.7C569 247.9 557.2 256 544 256H512V368C512 394.5 490.5 416 464 416H296.4C272.7 317.5 195.4 239.1 97.06 215.8C98.58 210.1 101.7 204.7 106.3 200.5L314.3 8.486zM304 192C295.2 192 287.1 199.2 287.1 208V272C287.1 280.8 295.2 288 304 288H368C376.8 288 384 280.8 384 272V208C384 199.2 376.8 192 368 192H304zM256 488C256 501.3 245.3 512 232 512C218.7 512 208 501.3 208 488C208 386.4 125.6 304 24 304C10.75 304 0 293.3 0 280C0 266.7 10.75 256 24 256C152.1 256 256 359.9 256 488zM0 480C0 462.3 14.33 448 32 448C49.67 448 64 462.3 64 480C64 497.7 49.67 512 32 512C14.33 512 0 497.7 0 480zM0 376C0 362.7 10.75 352 24 352C99.11 352 160 412.9 160 488C160 501.3 149.3 512 136 512C122.7 512 112 501.3 112 488C112 439.4 72.6 400 24 400C10.75 400 0 389.3 0 376z"/></svg>
                </span>
                <span class="font-normal flex items-center"><span class="font-bold mr-1">{{ $hotspotCount }}</span> Devices Online<span class="w-2 block ml-2 h-2 rounded-full bg-green-400"></span></span>
            </div>

            <div x-data="{ turnCurrency: false }" class="flex items-center">
                <span class="w-8 mr-2 h-8 flex items-center rounded-full justify-center bg-black">
                    <svg class="fill-current text-white w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M314.3 8.486C326.6-2.829 345.4-2.829 357.7 8.486L565.7 200.5C575.4 209.4 578.6 223.4 573.8 235.7C569 247.9 557.2 256 544 256H512V368C512 394.5 490.5 416 464 416H296.4C272.7 317.5 195.4 239.1 97.06 215.8C98.58 210.1 101.7 204.7 106.3 200.5L314.3 8.486zM304 192C295.2 192 287.1 199.2 287.1 208V272C287.1 280.8 295.2 288 304 288H368C376.8 288 384 280.8 384 272V208C384 199.2 376.8 192 368 192H304zM256 488C256 501.3 245.3 512 232 512C218.7 512 208 501.3 208 488C208 386.4 125.6 304 24 304C10.75 304 0 293.3 0 280C0 266.7 10.75 256 24 256C152.1 256 256 359.9 256 488zM0 480C0 462.3 14.33 448 32 448C49.67 448 64 462.3 64 480C64 497.7 49.67 512 32 512C14.33 512 0 497.7 0 480zM0 376C0 362.7 10.75 352 24 352C99.11 352 160 412.9 160 488C160 501.3 149.3 512 136 512C122.7 512 112 501.3 112 488C112 439.4 72.6 400 24 400C10.75 400 0 389.3 0 376z"/></svg>
                </span>
                <button x-on:click="turnCurrency = !turnCurrency" class="w-4 h-4 mr-2">
                    <svg :class="turnCurrency ? 'rotate-180' : ''" class="w-4 h-4 duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M0 224c0 17.7 14.3 32 32 32s32-14.3 32-32c0-53 43-96 96-96H320v32c0 12.9 7.8 24.6 19.8 29.6s25.7 2.2 34.9-6.9l64-64c12.5-12.5 12.5-32.8 0-45.3l-64-64c-9.2-9.2-22.9-11.9-34.9-6.9S320 19.1 320 32V64H160C71.6 64 0 135.6 0 224zm512 64c0-17.7-14.3-32-32-32s-32 14.3-32 32c0 53-43 96-96 96H192V352c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9l-64 64c-12.5 12.5-12.5 32.8 0 45.3l64 64c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V448H352c88.4 0 160-71.6 160-160z"/></svg>
                </button>
                <span x-show="turnCurrency == false" class="font-normal flex items-center"><span class="font-bold mr-1">{{ $hotspotBalance }}</span> Total HNT Balance</span>
                <span x-show="turnCurrency == true" class="font-normal flex items-center"><span class="font-bold mr-1">£{{ number_format($hotspotBalanceGbp, 2)  }}</span> Total HNT Balance in GBP</span>
            </div>
        </div>
    @endif
</div>
