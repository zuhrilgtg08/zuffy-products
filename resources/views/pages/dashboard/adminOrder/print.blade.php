<!DOCTYPE html>
<html lang="en">

    <head>
        <style>
            * {
                font-family: DejaVu Sans, sans-serif;
            }

            body {
                padding: 20px;
            }

            table {
                font-size: 1em;
                font-weight: 400;
                color: #000;
            }

            h2 {
                font-size: 1em;
                font-weight: 400;
            }

            h1 {
                font-size: 1.5em;

            }

            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
                font-size: 12px;
            }

            th {
                border: 1px solid #808080;
                background-color: #c3c3c3;
                text-align: center;
                padding: 8px;
            }

            td {
                border: 1px solid #747171;
                padding: 8px 8px 0px 8px;
            }

            tr:nth-child(even) {
                background-color: #F5F5F5;
            }
        </style>
    </head>

    <body>
        <center>
            <h1 style="text-decoration: underline;">DATA RIWAYAT PESANAN</h1>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pesanan</th>
                        <th>Nama Product</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Harga Ongkir</th>
                        <th>Total Harga</th>
                        <th>Payment Status</th>
                        <th>Tanggal Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ( $data as $dt )
                        <tr align="center">
                            <td>{{ $no++ }}</td>
                            <td>{{ $dt->checkout->uuid}}</td>
                            <td>{{ $dt->product->name_product}}</td>
                            <td>{{ $dt->quantity}} item</td>
                            <td>@currency($dt->product->price_product)</td>
                            <td>@currency($dt->checkout->harga_ongkir)</td>
                            <td>@currency($dt->checkout->harga_ongkir + $dt->checkout->total_amount)</td>
                            <td>{{ $dt->checkout->payment_status}}</td>
                            <td>{{ date('Y-m-d', strtotime($dt->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </center>
    </body>
</html>