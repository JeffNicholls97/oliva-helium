<div>
    <div class="flex flex-col-reverse h-48 overflow-y-auto">
        @foreach ($invoices as $invoice)
            <div class="flex border-b border-gray-200 gap-x-5 py-3 items-center w-full">
                <div class="flex-grow rounded-lg">
                    <div class="flex flex-col">
                        <span class="text-gray-400 text-sm">#{{ str_pad($invoice->id, 4, '0', STR_PAD_LEFT) }} - {{ \Carbon\Carbon::parse($invoice->created_at)->format('M Y') }}@if($loop->last)<span class="text-red-500 text-sm"> <span class="text-gray-400">|</span> Latest Invoice</span>@endif</span>
                        <span class="text-sm">Invoice Generated <span>{{ \Carbon\Carbon::parse($invoice->created_at)->diffForHumans() }}</span></span>

                    </div>
                </div>
                <div class="w-20 flex items-center justify-end">
                    <a href="{{route('admin.download', $invoice->id)}}" class="block group hover:bg-red-500 hover:scale-90 duration-200  w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <svg class="w-5 fill-current group-hover:text-white duration-200 text-gray-300 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
