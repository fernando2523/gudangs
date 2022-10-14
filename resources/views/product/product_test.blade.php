<table>
    <tr>
        <th>product Name</th>
        <th>Size</th>
    </tr>
    @foreach ($products as $data)
    <tr>
        <td> {{ $data->produk}}</td>
        <td>
            @foreach ($data->product_variation as $variation)
            {{$variation['size']}} = {{$variation['qty']}}
            @endforeach
        </td>
    </tr>
    @endforeach

</table>