<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<table style="width:100%; border-collapse: collapse;" class="table table-bordered">
    <thead style="border-bottom: 1px solid black; border-top: 1px solid black;">
    <tr>
        <td style="font-size: 11px;"><b>Date</b></td>
        <td style="font-size: 11px;"><b>Time</b></td>
        <td style="font-size: 11px;"><b>Hotspot</b></td>
        <td style="font-size: 11px;"><b>Received Currency</b></td>
        <td style="font-size: 11px;"><b>Tag</b></td>
        <td style="font-size: 11px;"><b>HNT Mined</b></td>
        <td style="font-size: 11px;"><b>Customer HNT</b></td>
        <td style="font-size: 11px;"><b>Mined Price ($)</b></td>
        <td style="font-size: 11px;"><b>GBP Conversion Rate</b></td>
        <td style="font-size: 11px;"><b>Income (£)</b></td>
        <td style="font-size: 11px;"><b>Price Sold (£)</b></td>
        <td style="font-size: 11px;"><b>Profit (£)</b></td>
        <td style="font-size: 11px;"><b>Delta (£)</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices->invoice_data as $invoice_key)
        <tr>
            <td style="font-size: 11px; padding: 6px;">
                @if(array_key_exists('timestamp', $invoice_key))
                    {{ \Carbon\Carbon::parse($invoice_key['timestamp'])->format('d/m/Y') }}
                @endif
            </td>
            <td style="font-size: 11px; padding: 6px;">
                @if(array_key_exists('timestamp', $invoice_key))
                    {{ \Carbon\Carbon::parse($invoice_key['timestamp'])->format('h:i:s') }}
                @endif
            </td>
            <td style="font-size: 11px; padding: 6px; text-transform: capitalize;">
                @php
                $string = $invoices->invoice_data['miner-info']['data']['name'];
                $minerName = str_replace("-", " ", $string)
                @endphp
                {{ $minerName }}
            </td>
            <td style="font-size: 11px; padding: 6px;">
                HNT
            </td>
            <td style="font-size: 11px; padding: 6px;">
                mined
            </td>
            <td style="font-size: 11px; padding: 6px;">
                @if(array_key_exists('amount', $invoice_key))
                    @php
                        $totalAmountConversion = $invoice_key['amount'] / 100000000;
                    @endphp
                    {{ number_format($totalAmountConversion, 8) }}
                @endif
            </td>
            <td style="font-size: 11px; padding: 6px;">
                @if(array_key_exists('amount', $invoice_key))
                    @php
                        $splitAmount = $invoice_key['amount'] / 2;
                        $halfAmountConversion = $splitAmount / 100000000;
                    @endphp
                    {{ number_format($halfAmountConversion, 8) }}
                @endif
            </td>
            <td style="font-size: 11px; padding: 6px;">
                @if(array_key_exists('price', $invoice_key))
                    @php
                    $minedPriceConversion = $invoice_key['price'] / 100000000;
                    @endphp
                    ${{ number_format(round($minedPriceConversion, 2), 2) }}
                @endif
            </td>
            <td style="font-size: 11px; padding: 6px;">
                {{ $invoices->invoice_data['miner-info']['gbp-conversion'] }}
            </td>
            <td style="font-size: 11px; padding: 6px;">
                @if(array_key_exists('price', $invoice_key))
                    @php
                        $minedPriceConversion = $invoice_key['price'] / 100000000;
                        $priceInPounds = $minedPriceConversion * $invoices->invoice_data['miner-info']['gbp-conversion'];
                        $customerSplitHnt = $invoice_key['amount'];
                        $customerSplit = $customerSplitHnt / 100000000;
                        $income = $customerSplit * $priceInPounds;
                    @endphp
                    £{{ number_format($income,8) }}
                @endif
            </td>
            <td style="font-size: 11px; padding: 6px;">
                {{ $invoices->invoice_data['miner-info']['price-sold'] }}
            </td>
            <td style="font-size: 11px; padding: 6px;">
                @if(array_key_exists('price', $invoice_key))
                    @php
                        $minedPriceConversionProfit = $invoice_key['price'] / 100000000;
                        $priceInPoundsProfit = $minedPriceConversionProfit * $invoices->invoice_data['miner-info']['gbp-conversion'];
                        $customerSplitHntProfit = $invoice_key['amount'] / 2;
                        $customerSplitProfit = $customerSplitHntProfit / 100000000;
                        $profit = $customerSplitProfit * $priceInPoundsProfit;
                    @endphp
                    £{{ number_format($profit,8) }}
                @endif
            </td>
            <td style="font-size: 11px; padding: 6px;">
                @if(array_key_exists('price', $invoice_key))
                    @php
                        $minedPriceConversionProfit = $invoice_key['price'] / 100000000;
                        $priceInPoundsProfit = $minedPriceConversionProfit * $invoices->invoice_data['miner-info']['gbp-conversion'];
                        $customerSplitHntProfit = $invoice_key['amount'] / 2;
                        $customerSplitProfit = $customerSplitHntProfit / 100000000;
                        $profit = $customerSplitProfit * $priceInPoundsProfit;

                        $minedPriceConversion = $invoice_key['price'] / 100000000;
                        $priceInPounds = $minedPriceConversion * $invoices->invoice_data['miner-info']['gbp-conversion'];
                        $customerSplitHnt = $invoice_key['amount'];
                        $customerSplit = $customerSplitHnt / 100000000;
                        $income = $customerSplit * $priceInPounds;
                    @endphp
                    {{ number_format($profit - $income, 8) }}
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
