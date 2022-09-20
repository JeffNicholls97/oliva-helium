<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<table class="table table-bordered">
    <thead>
    <tr>
        <td><b>amount</b></td>
        <td><b>type</b></td>
        <td><b>hash</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices->invoice_data as $invoice_key)
        <tr>
            <td>
                {{$invoice_key['amount']}}
            </td>
            <td>
                {{$invoice_key['type']}}
            </td>
            <td>
                {{$invoice_key['account']}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
