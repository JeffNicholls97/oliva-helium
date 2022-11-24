<div>
    <div class="flex h-full flex-col">
        <div class="w-full h-full grid grid-cols-12 gap-5">
            <div class="col-span-8">
                <p class="text-gray-500">{{ $address['first_name'] }} {{ $address['last_name'] }}<p>
                <div class="grid mt-10 grid-cols-3 gap-5">
                    <div wire:init='requestHotspotStats' class="col-span-1 p-5 border border-gray-100 bg-gray-50 rounded-lg">
                        @if($isLoadingAccountStats)
                            <div class="w-full h-7 rounded-md animate-pulse bg-gray-200">
                            </div>
                        @else
                        <div class="flex gap-5 items-center">
                            <div class="w-10 flex items-center h-10">
                                <span class="w-full flex justify-center items-center h-full bg-black rounded-full">
                                    <svg class="w-5 fill-current text-white h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M464 288h-416C21.5 288 0 309.5 0 336v96C0 458.5 21.5 480 48 480h416c26.5 0 48-21.5 48-48v-96C512 309.5 490.5 288 464 288zM320 416c-17.62 0-32-14.38-32-32s14.38-32 32-32s32 14.38 32 32S337.6 416 320 416zM416 416c-17.62 0-32-14.38-32-32s14.38-32 32-32s32 14.38 32 32S433.6 416 416 416zM464 32h-416C21.5 32 0 53.5 0 80v192.4C13.41 262.3 29.92 256 48 256h416c18.08 0 34.59 6.254 48 16.41V80C512 53.5 490.5 32 464 32z"/></svg>
                                </span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-gray-500 text-sm">Miner Status</p>
                                @if($minerStatus == 'online')
                                    <p class="flex text-lg font-bold items-center">{{$minerStatus}}<span class="w-2 h-2 rounded-full ml-3 bg-green-400"></span><p>
                                @else
                                <span class="flex items-center">{{$minerStatus}}<span class="block w-2 h-2 rounded-full ml-3 bg-red-400"></span><span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    <div wire:init='requestHotspotStats' class="col-span-1 p-5 border border-gray-100 bg-gray-50 rounded-lg">
                        @if($isLoadingAccountStats)
                            <div class="w-full h-7 rounded-md animate-pulse bg-gray-200">
                            </div>
                        @else
                        <div class="flex gap-5 items-center">
                            <div class="w-10 flex items-center h-10">
                                <span class="w-full flex justify-center items-center h-full bg-black rounded-full">
                                    <svg  class="w-5 fill-current text-white h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M62.62 2.339C78.1 8.97 86.9 27.63 80.27 44.01C69.79 69.9 64 98.24 64 128C64 157.8 69.79 186.1 80.27 211.1C86.9 228.4 78.1 247 62.62 253.7C46.23 260.3 27.58 252.4 20.95 236C7.428 202.6 0 166.1 0 128C0 89.87 7.428 53.39 20.95 19.99C27.58 3.612 46.23-4.293 62.62 2.339V2.339zM513.4 2.339C529.8-4.293 548.4 3.612 555.1 19.99C568.6 53.39 576 89.87 576 128C576 166.1 568.6 202.6 555.1 236C548.4 252.4 529.8 260.3 513.4 253.7C497 247 489.1 228.4 495.7 211.1C506.2 186.1 512 157.8 512 128C512 98.24 506.2 69.9 495.7 44.01C489.1 27.63 497 8.969 513.4 2.338V2.339zM477.1 466.8C484.4 482.8 477.3 501.8 461.2 509.1C445.2 516.4 426.2 509.3 418.9 493.2L398.3 448H177.7L157.1 493.2C149.8 509.3 130.8 516.4 114.8 509.1C98.67 501.8 91.56 482.8 98.87 466.8L235.9 165.2C228.4 154.7 224 141.9 224 128C224 92.65 252.7 64 288 64C323.3 64 352 92.65 352 128C352 141.9 347.6 154.7 340.1 165.2L477.1 466.8zM369.2 384L354.7 352H221.3L206.8 384H369.2zM250.4 288H325.6L288 205.3L250.4 288zM152 128C152 147.4 156 165.8 163.3 182.4C168.6 194.5 163.1 208.7 150.9 213.1C138.8 219.3 124.6 213.8 119.3 201.6C109.5 179 104 154.1 104 128C104 101.9 109.5 76.96 119.3 54.39C124.6 42.25 138.8 36.7 150.9 42.01C163.1 47.31 168.6 61.46 163.3 73.61C156 90.23 152 108.6 152 128V128zM472 128C472 154.1 466.5 179 456.7 201.6C451.4 213.8 437.2 219.3 425.1 213.1C412.9 208.7 407.4 194.5 412.7 182.4C419.1 165.8 424 147.4 424 128C424 108.6 419.1 90.24 412.7 73.61C407.4 61.46 412.9 47.32 425.1 42.01C437.2 36.7 451.4 42.25 456.7 54.39C466.5 76.96 472 101.9 472 128V128z"/></svg>
                                </span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-gray-500 text-sm">Transmit Scale</p>
                                @if(round($minerScale, 2) >= 0.85)
                                    <span class="flex text-lg font-bold items-center"><span class="w-2 h-2 rounded-full mr-3 bg-green-400"></span>{{ round($minerScale, 2) }}</span>
                                @elseif(round($minerScale, 2) >= 0.45)
                                    <span class="flex text-lg font-bold items-center"><span class="w-2 h-2 rounded-full mr-3 bg-orange-400"></span>{{ round($minerScale, 2) }}</span>
                                @else
                                    <span class="flex text-lg font-bold items-center"><span class="w-2 h-2 rounded-full mr-3 bg-red-400"></span>{{ round($minerScale, 2) }}</span>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    <div wire:init='requestHotspotStats' class="col-span-1 p-5 border border-gray-100 bg-gray-50 rounded-lg">
                        @if($isLoadingAccountStats)
                            <div class="w-full h-7 rounded-md animate-pulse bg-gray-200">
                            </div>
                        @else
                        <div class="flex gap-5 items-center">
                            <div class="w-10 flex items-center h-10">
                                <span class="w-full flex justify-center items-center h-full bg-black rounded-full">
                                    <svg class="w-5 fill-current text-white h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.1.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM266.3 48.25L232.5 73.6C227.2 77.63 224 83.95 224 90.67V99.72C224 106.5 229.5 112 236.3 112C238.7 112 241.1 111.3 243.1 109.9L284.9 82.06C286.9 80.72 289.3 80 291.7 80H292.7C298.9 80 304 85.07 304 91.31C304 94.31 302.8 97.19 300.7 99.31L280.8 119.2C275 124.1 267.9 129.4 260.2 131.9L233.6 140.8C227.9 142.7 224 148.1 224 154.2C224 157.9 222.5 161.5 219.9 164.1L201.9 182.1C195.6 188.4 192 197.1 192 206.1V210.3C192 226.7 205.6 240 221.9 240C232.9 240 243.1 233.8 248 224L252 215.9C254.5 211.1 259.4 208 264.8 208C269.4 208 273.6 210.1 276.3 213.7L292.6 235.5C294.7 238.3 298.1 240 301.7 240C310.1 240 315.6 231.1 311.8 223.6L310.7 221.3C307.1 214.3 310.7 205.8 318.1 203.3L339.3 196.2C346.9 193.7 352 186.6 352 178.6C352 168.3 360.3 160 370.6 160H400C408.8 160 416 167.2 416 176C416 184.8 408.8 192 400 192H379.3C372.1 192 365.1 194.9 360 200L355.3 204.7C353.2 206.8 352 209.7 352 212.7C352 218.9 357.1 224 363.3 224H374.6C380.6 224 386.4 226.4 390.6 230.6L397.2 237.2C398.1 238.1 400 241.4 400 244C400 246.6 398.1 249 397.2 250.8L389.7 258.3C386 261.1 384 266.9 384 272C384 277.1 386 282 389.7 285.7L408 304C418.2 314.2 432.1 320 446.6 320H453.1C460.5 299.8 464 278.3 464 256C464 144.6 376.4 53.64 266.3 48.25V48.25zM438.4 356.1C434.7 353.5 430.2 352 425.4 352C419.4 352 413.6 349.6 409.4 345.4L395.1 331.1C388.3 324.3 377.9 320 367.1 320C357.4 320 347.9 316.5 340.5 310.2L313.1 287.4C302.4 277.5 287.6 271.1 272.3 271.1H251.4C238.7 271.1 226.4 275.7 215.9 282.7L188.5 301C170.7 312.9 160 332.9 160 354.3V357.5C160 374.5 166.7 390.7 178.7 402.7L194.7 418.7C203.2 427.2 214.7 432 226.7 432H248C261.3 432 272 442.7 272 456C272 458.5 272.4 461 273.1 463.3C344.5 457.5 405.6 415.7 438.4 356.1L438.4 356.1zM164.7 100.7L132.7 132.7C126.4 138.9 126.4 149.1 132.7 155.3C138.9 161.6 149.1 161.6 155.3 155.3L187.3 123.3C193.6 117.1 193.6 106.9 187.3 100.7C181.1 94.44 170.9 94.44 164.7 100.7V100.7z"/></svg>
                                </span>
                            </div>
                            <div class="flex-grow">
                                <p class="text-gray-500 text-sm">Hotspot Location</p>
                                <div class="flex items-center">
                                    <p class="text-lg font-bold">{{ $minerCity }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                {{-- @dump($graphData) --}}
                <div class="mt-5 w-full p-5 border border-gray-100 bg-gray-50 rounded-lg">
                     {{-- @dump($minTime, $maxTime) --}}
                    <livewire:accounts-graph :coinvalue="$coinvalue" :address="$address" :account="$account" />
                </div>
            </div>
            <div class="col-span-4 bg-white border border-gray-100 rounded-lg p-5">
                <span class="bg-gray-50 mb-5 flex justify-between items-center block rounded-lg py-3 px-5">List Invoices <span class="w-8 text-sm text-red-500 ml-2 h-8 flex items-center justify-center p-2 rounded-full bg-gray-100">{{$totalInvoices}}</span></span>
                <livewire:account-invoice-list :address="$address" :account="$account"/>
            </div>
        </div>
        <div class="mt-5 flex-grow w-full h-full p-5 border border-gray-100 bg-gray-50 rounded-lg">
            <livewire:accounts-miner-transactions-all :coinvalue="$coinvalue" :address="$address" :account="$account" />
        </div>
    </div>
</div>
