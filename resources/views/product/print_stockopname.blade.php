<style>
    table,
    td,
    th {
        border: 1px solid;
    }

    th {
        height: 40px;
    }

    td {
        height: 25px;
    }

    table {
        text-align: center;
        width: 100%;
        border-collapse: collapse;
        font-size: 10px;
    }
</style>

<title>Stock Opname</title>

<h2>LIST PRODUCT {{ $product[0]['warehouse'][0]['warehouse'] }}</h2>
{{-- <img src="{{ URL::asset('assets/img/footbox.png') }}" width="100" height="100"> --}}

<table>
    <thead>
        <tr style="background-color: rgb(180, 178, 178);">
            <th style="width: 5%;font-size: 15px;">No.</th>
            <th style="width: 9%;font-size: 15px;">BRAND</th>
            <th style="width: 8%;font-size: 15px;">ID PRODUK</th>
            <th style="width: 35%;font-size: 15px;">PRODUK</th>
            <th colspan="11" style="width: 35%;font-size: 15px;">SIZE</th>
            <th style="width: 5%;font-size: 15px;">QTY</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($product as $key => $data)
            <?= $key++ ?>

            @for ($i = 0; $i < count($data['print_variation']); $i++)
                @if ($data['print_variation'][$i]['id_ware'] === $data->id_ware and $data['print_variation'][$i]['c_size'] > 0)
                    <tr>
                        <td rowspan="3" style="width: 5%;font-weight: bold;">
                            {{ $key }}</td>
                        <td rowspan="3" style="width: 8%;font-weight: bold;">{{ $data->brand }}</td>
                        <td rowspan="3" style="width: 9%;font-weight: bold;">{{ $data->id_produk }}</td>
                        <td rowspan="3" style="width: 35%;font-weight: bold;">
                            {{ $data->produk }}</td>
                        <?= $count = 0 ?>
                        @foreach ($variations as $sizess)
                            @if ($sizess->id_produk === $data->id_produk)
                                <?= $count++ ?>
                                <td
                                    style="width: 4%;font-weight: bold;border-top: 0px;background-color: rgb(180, 178, 178);">
                                    <p>{{ $sizess->size }}</p>
                                </td>
                            @endif
                        @endforeach

                        @if ($count < 11)
                            <?php $col = 11 - $count; ?>
                            <td colspan="{{ $col }}"
                                style="font-weight: bold;border-top: 0px;background-color: rgb(180, 178, 178);">
                                <p></p>
                            </td>
                        @endif

                        <td style="width: 5%;font-weight: bold;border-top: 0px;background-color: rgb(180, 178, 178);">
                            <p>TOTAL</p>
                        </td>
                    </tr>
                    <tr style="background-color: rgb(238, 255, 83);">
                        <?= $totalqty = 0 ?>
                        @foreach ($variations as $qtys)
                            @if ($qtys->id_produk === $data->id_produk)
                                <?= $totalqty = $totalqty + $qtys->qty ?>
                                <td style="width: 4%;font-weight: bold;border-top: 0px;">
                                    <p>{{ $qtys->qty }}</p>
                                </td>
                            @endif
                        @endforeach

                        @if ($count < 11)
                            <?php $col = 11 - $count; ?>
                            <td colspan="{{ $col }}" style="font-weight: bold;border-top: 0px;">
                                <p></p>
                            </td>
                        @endif
                        <td style="width: 5%;font-weight: bold;border-top: 0px;">
                            <p>{{ $totalqty }}</p>
                        </td>
                    </tr>
                    <tr>
                        @foreach ($variations as $qtys)
                            @if ($qtys->id_produk === $data->id_produk)
                                <td style="width: 4%;font-weight: bold;border-top: 0px;">
                                </td>
                            @endif
                        @endforeach

                        @if ($count < 11)
                            <?php $col = 11 - $count; ?>
                            <td colspan="{{ $col }}" style="font-weight: bold;border-top: 0px;">
                                <p></p>
                            </td>
                        @endif
                        <td style="width: 5%;font-weight: bold;border-top: 0px;">
                        </td>
                    </tr>
                @else
                @endif
            @endfor
        @endforeach

    </tbody>
</table>
