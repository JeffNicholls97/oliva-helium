<div>
    <div class="w-full flex flex-col">
        <div class="table-header h-12 gap-10 top-0 grid grid-cols-12 w-full bg-gray-100 border border-gray-200 rounded-lg p-3">
            <div class="col-span-3 text-sm text-gray-400 font-bold">
                Account
            </div>
            <div class="col-span-2 text-sm text-gray-400 font-bold">
                Total
            </div>
            <div class="col-span-2 text-sm text-left text-gray-400 font-bold">
                Cash
            </div>
            <div class="col-span-2 text-sm text-gray-400 font-bold">
                Date Generated
            </div>
            <div class="col-span-3 text-right text-sm text-gray-400 font-bold">
                Actions
            </div>
        </div>
        <div class="w-full h-full overflow-y-auto">
            @foreach ($invoices->sortByDesc('created_at') as $invoice)
                <div class="table-body even:bg-gray-50 gap-10 table-header grid grid-cols-12 w-full rounded-lg p-3">
                    <div class="col-span-3">
                        <div class="flex h-full flex-col text-gray-400 text-sm">
                            @php
                                $account = App\Models\Accounts::where('id', $invoice->accounts_id)->get()->first();
                                $minerName = str_replace("-", " ", $account->miner_name);
                            @endphp
                            <span class="text-xs text-black capitalize">{{ $minerName }}</span>
                            <span class="text-xs text-gray-400">{{ $account->first_name }} {{ $account->last_name }}</span>
                        </div>
                    </div>
                    <div class="col-span-2 relative flex items-center">
                        <div class="w-3/4 text-gray-400 text-sm">
                            {{--                            {{ $invoice->invoice_data }}--}}
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
                    <div class="col-span-2 flex items-center">
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
                            {{ \Carbon\Carbon::parse($invoice->created_at)->diffForHumans() }}
                        </div>
                    </div>
                    <div class="col-span-3 gap-3 flex justify-end items-center">
                        <a class="w-full text-sm border-2 border-red-500 py-2 text-center bg-red-500 rounded-lg text-white" href="{{route('admin.download', ['id' => $invoice->id, 'account' => $account])}}">Download Invoice</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
