<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laporan Penjualan') }}</title>

        <style>
            table{width:100%;border:1px solid #ccc;border-collapse:collapse}
            table th,
            table td{border:1px solid #ddd;border-width:1px 0;padding:5px 10px;font-size:14px}
            table thead tr:first-of-type th{text-transform: uppercase;letter-spacing:3px;font-size: 12px}
            table thead tr:last-of-type th{border-width:0 1px;}

            table thead tr:first-of-type th{border-width:0 1px;}

            table tbody tr:nth-child(odd){background-color:#e5e5e5}
            table .right{text-align:right}
            table .center{text-align:center}
            table .center{text-align:left}
            table tfoot th,
            table tfoot td{border-top-width: 2px}
            table tfoot th{text-align: right;}
            .show-phone{display:none}
        </style>
    </head>
    <body class="font-sans antialiased">
        <table id="loyalty-rewards" class="report responsive">
            <thead>
            <tr>
                <th scope="col" class="left">Transaction</th>
                <th scope="col" class="left">User</th>
                <th scope="col" class="left">Total</th>
                <th scope="col" class="left">Date</th>
                <th scope="col" class="right">Item</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                    <tr>
                        <td>
                            {{$dt->document_code}}-{{$dt->document_number}}
                        </td>
                        <td>
                            {{$dt->users[0]->user}}
                        </td>
                        <td>
                            {{rupiah($dt->total)}}
                        </td>
                        <td>
                            {{date('d F Y',  strtotime($dt->date))}}
                        </td>
                        <td class="right">
                        @foreach ($dt->details as $detail)
                            <p>
                                {{$detail->product[0]->product_name}} x {{$detail->quantity}}
                            </p>
                        @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
