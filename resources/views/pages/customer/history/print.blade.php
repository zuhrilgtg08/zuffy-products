<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Print Invoice</title>

        <style type="text/css">
            * {
                font-family: Verdana, Arial, sans-serif;
            }

            table {
                font-size: small;
            }

            tfoot tr td {
                font-weight: bold;
                font-size: x-small;
            }

            .red {
                background-color: #dcf118;
            }
        </style>
    </head>

    <body>
        <table width="100%">
            <tr>
                <td align="top"><img src="{{ public_path('assets/frontend/images/master-logo.png') }}" alt="" width="100" /></td>
                <td align="right">
                    <h3>Zuffy-Store eCommerce</h3>
                    <pre>
                        Zuffy-Store Official
                        Jl Bubutan, Surabaya, Jawa Timur
                        zuffystore90@gmail.com
                    </pre>
                </td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td><strong>From:</strong> Zuffy-Store Official</td>
                <td align="right">
                    <strong>To:</strong> {{ auth()->user()->name }}
                    <span>
                        <strong>Province:</strong>
                        {{ $datas[0]->checkout->province->name_province }}
                    </span>
                    <br/>
                    <strong>City</strong>
                    {{ $datas[0]->checkout->cities->nama_kab_kota }}
                    <span>
                        <strong>Address</strong>
                        {{ $datas[0]->checkout->alamat }}
                    </span>
                </td>
            </tr>
        </table>

        <br />

        <table width="100%">
            <thead style="background-color: #60e47d;">
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($datas as $dt)
                    <tr>
                        <th scope="row">{{ $no++ }}</th>
                        <th scope="row">{{ $dt->checkout->uuid }}</th>
                        <td>{{ $dt->product->name_product }}</td>
                        <td align="center">{{ $dt->quantity }} Item</td>
                        <td align="center">@currency($dt->product->price_product)</td>
                    </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Subtotal: </td>
                    <td align="right">@currency($datas[0]->checkout->total_amount)</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Shipping: </td>
                    <td align="right">@currency($datas[0]->checkout->harga_ongkir)</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Total Payment: </td>
                    <td align="right" class="red">@currency($datas[0]->checkout->total_amount + $datas[0]->checkout->harga_ongkir)</td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>