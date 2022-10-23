<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        .center-text {
            display:block;
            margin:0 auto;
            text-align: center;
        }
        .page{
            display:flex;
            align-items:center;
        }
        table#minertable tr:nth-child(even) {
            background-color:#f0f0f0;
        }
        @page { margin: 50px; }
        #footer {
            position: fixed;
            left: 50%;
            bottom: 0;
            text-align: center;
            color:grey;
        }
        #footer .page:after {
            content: counter(page);
        }
        li {
            padding: 5px;
        }
    </style>
</head>
<body>
<div id="footer">
    <p class="page"></p>
</div>
{{-- Page 1 --}}
<div class="page">
    @php
        $string = $invoices->invoice_data['miner-info']['data']['name'];
        $date = $invoices->invoice_date;
        $dateFormat = \Carbon\Carbon::parse($date)->format('F - Y');
        $minerName = str_replace("-", " ", $string)
    @endphp
    <span class="center-text" style="font-size: 30px; margin-top: 100px;">Invoice - <span style="text-transform: capitalize">{{ $minerName }}</span></span>
    <img src="/var/www/html/public/images/oliva_logo.jpg">
    <span class="center-text" style="font-size: 20px; margin-top:20px; ">Oliva Team</span>
    <span class="center-text" style="font-size: 20px; margin-top: 5px;">{{ $dateFormat }}</span>
</div>
<div class="page-break"></div>
<div class="page">
    <h2 style="">Contents</h2>
    <ul style="list-style-type: decimal;">
        <li style="margin-bottom: 10px;">Introduction .................................................. 3</li>
        <li style="margin-bottom: 10px;">Summarised Invoice ..................................... 4</li>
        <li>Complete Invoice .......................................... 5</li>
    </ul>
</div>
<div class="page-break"></div>
<div class="page">
    <h2 style="">1. <span style="margin-left: 20px;">Introduction</span></h2>
    Hi {{ $accountPass->first_name }} {{ $accountPass->last_name }}! This document will take you through your earnings for the hotspot <span style="text-transform: capitalize;">{{ $minerName }}</span>, at the address: {{ $accountPass->housing_address }}. This invoice
    will cover the month of {{ $dateFormat }}. In this document we will provide you with all the figures you need to complete your tax returns. We will send you invoices
    every month, to allow you to keep track of your running tax total. During April we will send you a complete invoice for the tax year, this will just compile each months
    invoice, saving you from doing the calculations
    <br>
    Your invoice is split into two sections:
    <ul style="list-style-type: decimal;">
        <li style="margin-bottom: 10px;">Summarised invoice</li>
        <li>Complete Invoice</li>
    </ul>
    <br>
    The Summarised Invoice provides you with the figures you will need to complete your tax return. Whereas, the Complete Invoice is an in depth view of each time your
    hotspot mined HNT, this allows you to see a breakdown of each transaction your hotspot was involved in. The figures found in the Summarised Invoice are derived
    from the complete invoice - which is explained later in this document.
    <br>
    <br>
    Below are some useful links, to government documentation, that will assist you in paying your taxes. Read through these links thoroughly.
    <br>
    <div style="margin-top:20px;">
        <a style="display:block;margin-top:10px;" href="https://www.gov.uk/guidance/check-if-you-need-to-pay-tax-when-you-receive-cryptoassets">Paying Tax when you Receive Crypto Assets</a>
        <a style="display:block;margin-top:10px;" href="https://www.gov.uk/guidance/check-if-you-need-to-pay-tax-when-you-sell-cryptoassets">Paying Tax when you Sell Crypto Assets</a>
        <a style="display:block;margin-top:10px;" href="https://www.gov.uk/hmrc-internal-manuals/cryptoassets-manual">Crypto Assests Manual</a>
    </div>
</div>
<div class="page-break"></div>
<div class="page">
    <h2 style="">2. <span style="margin-left: 20px;">Summarised Invoice</span></h2>
    <p>Below is a table summarising your hotspots earnings for {{ $dateFormat }}. Here we will describe what the figures in each row represent:</p>
    <ul style="list-style-type: decimal;">
        <li>
            Customer HNT
            <ul style="list-style-type: bullet;">
                <li>
                    The total number of HNT your hotspot mined for the month.
                </li>
            </ul>
        </li>
        <li>
            Income (£)
            <ul style="list-style-type: bullet;">
                <li>
                    The total value, in GBP , of your HNT at the time it was mined.
                </li>
            </ul>
        </li>
        <li>
            Profit (£)
            <ul style="list-style-type: bullet;">
                <li>
                    The total value, in GBP, of your HNT at the time we sold it - the value we transfer to you.
                </li>
            </ul>
        </li>
        <li>
            Delta (£)
            <ul style="list-style-type: bullet;">
                <li>
                    The difference between the Income (£) and Profit (£) values.
                    <ul style="list-style-type: none;">
                        <li>
                             - If this value is negative then your HNT was sold for less than its total value at the time it was mined (Income (£)) - meaning you took a ‘loss’ on the
                            sale.
                        </li>
                        <li>
                             - If this value is positive then your HNT was sold for more than its total value at the time it was mined (Income (£)) - meaning you gained a ‘profit’ on
                            your sale.
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    <div style="width:250px; margin-top:70px;" class="sum-table">
        <div>
            @php
                $totalArr = [];
                $sumCustomer = 0;
                    foreach ($invoices->invoice_data as $invoiceTotal) {
                        if(array_key_exists('amount', $invoiceTotal)){
                            $sumCustomer += $invoiceTotal['amount'];
                            $splitAmountTotal = $sumCustomer / 2;
                            $halfAmountConversionTotal = $splitAmountTotal / 100000000;


                            $totalArr['customer_hnt'] = $halfAmountConversionTotal;
                        }
                    }
                    $income = $totalArr['customer_hnt'] * $invoices->invoice_data['miner-info']['gbp-conversion'];
                    $profit = $invoices->invoice_data['miner-info']['price-sold'] * $totalArr['customer_hnt'];
            @endphp
            <table style="border-collapse: collapse; width:100%;">
                <tr style="border-top: 2px solid black; border-bottom: 2px solid black;">
                    <td></td>
                    <td>Total</td>
                </tr>
                <tr>
                    <td>Customer HNT</td>
                    <td>{{ number_format($totalArr['customer_hnt'], 8) }}</td>
                </tr>
                <tr>
                    <td>Income</td>
                    <td>{{ number_format($income, 2) }}</td>
                </tr>
                <tr>
                    <td>Profit</td>
                    <td>{{ number_format($profit, 2) }}</td>
                </tr>
                <tr>
                    <td>Delta</td>
                    <td>{{ number_format($profit - $income, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="page-break"></div>
<div class="page">
    <h2 style="">3. <span style="margin-left: 20px;">Complete Invoice</span></h2>
    <ul style="list-style-type: decimal;">
        <li>
            Date:
            <ul style="list-style-type: bullet;">
                <li>The date the HNT was mined.</li>
            </ul>
        </li>
        <li>
            Hotspot:
            <ul style="list-style-type: bullet;">
                <li>Your hotspots name.</li>
            </ul>
        </li>
        <li>
            Received Currency:
            <ul style="list-style-type: bullet;">
                <li>The currency you received - HNT.</li>
            </ul>
        </li>
        <li>
            Tag:
            <ul style="list-style-type: bullet;">
                <li>The currency you received - HNT.</li>
            </ul>
        </li>
        <li>
            HNT Mined:
            <ul style="list-style-type: bullet;">
                <li>The total amount of HNT your Hotspot earnt.</li>
            </ul>
        </li>
        <li>
           Customer HNT:
            <ul style="list-style-type: bullet;">
                <li>Your share of the HNT - 50%.</li>
            </ul>
        </li>
        <li>
            Mined Price($):
            <ul style="list-style-type: bullet;">
                <li>The price of that specific HNT, in dollars, at the time it was mined.</li>
            </ul>
        </li>
        <li>
            GBP Conversion Rate:
            <ul style="list-style-type: bullet;">
                <li>The conversion rate from USD to GBP, at the time that specific HNT was mined.</li>
            </ul>
        </li>
        <li>
            Income (£):
            <ul style="list-style-type: bullet;">
                <li>The total value, in GBP , of your HNT at the time it was mined.</li>
            </ul>
        </li>
        <li>
            Price Sold (£):
            <ul style="list-style-type: bullet;">
                <li>The price of HNT, in GBP, at the time we sold your HNT.</li>
            </ul>
        </li>
        <li>
            Profit (£):
            <ul style="list-style-type: bullet;">
                <li>The total value, in GBP, of your HNT at the time we sold it - the value we transfer to you.</li>
            </ul>
        </li>
        <li>
            Delta (£):
            <ul style="list-style-type: bullet;">
                <li>The difference between the Income (£) and Profit (£) values.</li>
                <ul style="list-style-type: none;">
                    <li>
                        - If this value is negative then your HNT was sold for less than its total value at the time it was mined (Income (£)) - meaning you took a ‘loss’ on the sale
                    </li>
                    <li>
                        - If this value is positive then your HNT was sold for more than its total value at the time it was mined (Income (£)) - meaning you gained a ‘profit’ on
                        your sale.
                    </li>
                </ul>
            </ul>
        </li>
    </ul>
</div>
<div class="page-break"></div>
<table id="minertable" style="width:100%; border-collapse: collapse;" class="table table-bordered">
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
        @if($loop->last)

        @else
            <tr class="odd-rows">
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
                            $customerSplitHnt = $invoice_key['amount'] / 2;
                            $customerSplit = $customerSplitHnt / 100000000;
                            $income = $customerSplit * $priceInPounds;

                        @endphp
                        £{{ number_format($income,8) }}
                    @endif
                </td>
                <td style="font-size: 11px; padding: 6px;">
                    @if($invoices->cash == 1)
                        {{ $invoices->invoice_data['miner-info']['price-sold'] }}
                    @else
                        0.00
                    @endif
                </td>
                <td style="font-size: 11px; padding: 6px;">
                    @if(array_key_exists('price', $invoice_key))
                        @php
                            $minedPriceConversionProfit = $invoices->invoice_data['miner-info']['price-sold'];
                            $customerSplitHntProfit = $invoice_key['amount'] / 2;
                            $customerSplitProfit = $minedPriceConversionProfit * $customerSplitHntProfit / 100000000;

                        @endphp
                        £{{ number_format($customerSplitProfit,8) }}
                    @endif
                </td>
                <td style="font-size: 11px; padding: 6px;">
                    @if(array_key_exists('price', $invoice_key))
                        @php
                            $minedPriceConversion = $invoice_key['price'] / 100000000;
                            $priceInPounds = $minedPriceConversion * $invoices->invoice_data['miner-info']['gbp-conversion'];
                            $customerSplitHnt = $invoice_key['amount'] / 2;
                            $customerSplit = $customerSplitHnt / 100000000;
                            $income = $customerSplit * $priceInPounds;

                            $minedPriceConversionProfit = $invoices->invoice_data['miner-info']['price-sold'];
                            $customerSplitHntProfit = $invoice_key['amount'] / 2;
                            $profit = $minedPriceConversionProfit * $customerSplitHntProfit / 100000000;
                        @endphp
                        {{ number_format($profit - $income, 8) }}
                    @endif
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
</body>
</html>
