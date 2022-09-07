<div>
    <div class="flex flex-col ">
        @foreach ($invoices as $invoice)
            {{ $invoice->invoice_link }}
        @endforeach
    </div>

    <button wire:click="generateSingleInvoice">generate invoice</button>
</div>
