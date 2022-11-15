@foreach ($data as $key => $datas)
    <tr>
        @if ($datas->id_reseller === '-')
            <td align="center"><span class="fs-13px mt-2">{{ $key + 1 }}) </span></td>
            <td colspan="5" class="fw-bold pt-3 pb-3">
                <div align="left">
                    <span class="fs-12px text-white">{{ $datas->id_invoice }}</span> | {{ $datas->tanggal }}<span
                        style="padding-left: 5px;cursor: pointer;"><i
                            class="fa fa-print fa-lg text-info me-2 ms-2"></i></span><span
                        style="padding-left: 5px;cursor: pointer;"><i
                            class="fa fa-times-circle fa-lg text-danger"></i></span><br>
                    <span class="fs-11px text-white">{{ $datas->store[0]['store'] }}</span> | <span
                        class="fs-11px text-white">RETAIL</span><br>
                    <span class="badge bg-default text-dark">KASIR : {{ $datas->users }}</span>
                </div>
            </td>
        @else
            <td align="center"><span class="fs-13px mt-2">{{ $key + 1 }}) </span></td>
            <td colspan="5" class="fw-bold pt-3 pb-3">
                <div align="left">
                    <span class="fs-12px text-yellow">{{ $datas->id_invoice }}</span> | {{ $datas->tanggal }}<span
                        style="padding-left: 5px;cursor: pointer;"><i
                            class="fa fa-print fa-lg text-info me-2 ms-2"></i></span><span
                        style="padding-left: 5px;cursor: pointer;"><i
                            class="fa fa-times-circle fa-lg text-danger"></i></span><br>
                    <span class="fs-11px text-white">{{ $datas->store[0]['store'] }}</span> | <span
                        class="fs-11px text-yellow">RESELLER
                        :</span><span class="ms-1 text-yellow">{{ $datas->id_reseller }}</span><br>
                    <span class="badge bg-default text-dark">KASIR : NANDO</span>
                </div>
            </td>
        @endif
        <td colspan="4" class="fw-bold fs-12px" align="right" style="padding-top: 20px;">
            <span><a class="btn  btn-primary btn-sm me-2 fw-bold text-white fs-10px"><i
                        class="bi bi-arrow-counterclockwise me-1 fa-1x"></i>TUKER
                    SIZE</a></span>
            <span><a class="btn btn-danger btn-sm fw-bold text-white fs-10px"><i
                        class="fa fa-times me-1 fa-1x"></i>REFUND</a></span>
        </td>
    </tr>
    {{-- Looping --}}
    @for ($i = 0; $i < count($datas->details); $i++)
        <tr class="tr-custom">
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                {{ $i + 1 }}
            </td>
            <td class="text-left fw-bold" style="border-right-width: 1px;">
                <a style="cursor: pointer;" onclick="openmodaldetail()">
                    <span>{{ $datas->details[$i]['produk'] }}
                        {{ $datas->details[$i]['id'] }}</span>
                </a>
            </td>
            <td class="text-center" style="border-right-width: 1px;">
                {{ $datas->details[$i]['id_produk'] }}
            </td>
            <td class="text-center text-lime fw-bold" style="border-right-width: 1px;">
                {{ $datas->details[$i]['size'] }}
            </td>
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                {{ $datas->details[$i]['qty'] }}
            </td>
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                @currency($datas->details[$i]['selling_price'])
            </td>
            <td class="text-center fw-bold" style="border-right-width: 1px;">
                @currency($datas->details[$i]['diskon_item'])
            </td>
            <td colspan="4" class="text-center fw-bold" style="border-right-width: 1px;">
                @currency($datas->details[$i]['subtotal'])
            </td>
        </tr>
    @endfor
    {{-- Looping --}}
    <tr class="tr-custom">
        <td colspan="7" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="text-center text-theme fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            CASH
        </td>
        <td class="text-center text-primary fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            BCA
        </td>
        <td class="text-center text-info fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            QRIS
        </td>
    </tr>
    <tr class="tr-custom">
        <td colspan="7" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="text-center fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            @currency($datas->cash)
        </td>
        <td class="text-center fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            @currency($datas->bca)
        </td>
        <td class="text-center fw-bold fs-11px" style="border-left-width: 1px;border-right-width: 1px;">
            @currency($datas->qris)
        </td>
    </tr>

    <tr>
        <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            Ongkir :
        </td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            @currency($datas->ongkir)
        </td>
    </tr>
    <tr>
        <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            Discount Nota :
        </td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            @currency($datas->diskon_all)
        </td>
    </tr>
    <tr>
        <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            Amount :
        </td>
        <td class="fw-bold fs-12px" align="right" style="border-bottom: hidden;border-left: hidden;">
            @currency($datas->grandtotal)
        </td>
    </tr>

    <tr style="border-bottom: 3px solid #797979;">
        <td colspan="8" style="padding-top: 5px;padding-bottom: 20px;">
        </td>
    </tr>
@endforeach
@if ($count == 0)
    <tr style="width: 100%">
        <td colspan="10" align="center">
            No More Data...
        </td>
    </tr>
    <input type="hidden" name="last_id[]" value="last">
@else
    <input type="hidden" name="last_id[]" value="{{ $datas->id }}">
@endif
