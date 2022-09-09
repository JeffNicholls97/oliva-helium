<div>
    <div class="flex gap-2 flex-col">
        @foreach ($invoices as $invoice)
            <button wire:click="downloadInvoice({{$invoice->id}})"  class="bg-red-500 rounded-lg w-full p-3 text-white text-center">Download Invoice</button>
{{--            @foreach($invoice->invoice_data['data'] as $invoice_key)--}}
{{--                @dump($invoice_key)--}}
{{--            @endforeach--}}
        @endforeach
    </div>
</div>
