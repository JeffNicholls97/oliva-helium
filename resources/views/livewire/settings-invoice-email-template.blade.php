<div>
    <div class="w-full bg-gray-100 rounded-lg p-5">
        <div class="flex flex-col gap-1">
            <span class="text-sm text-gray-400">Variables to use</span>
            <span>[first_name], [last_name], [miner_name], [customer_hnt], [house_address], [invoice_date]</span>
        </div>
        <textarea wire:model.defer="email_template" class="w-full p-5 mt-5 rounded-lg" rows="15"></textarea>
        <button wire:click="InvoiceEmailTemplate" class="w-full p-3 bg-red-500 text-white rounded-lg mt-5">Save</button>
    </div>
</div>
