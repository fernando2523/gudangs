        <?php $items = 0; ?>
        @foreach ($datapo as $data)
            <?php $items++; ?>
            <tr>
                <td colspan="6" class="fw-bold " style="padding-top: 20px;">
                    <span class="fs-12px">{{ $items }})</span>
                    <span class="fs-12px text-lime">#{{ $data->tanggal }} - {{ $data->idpo }}
                    </span>
                    <span style="padding-left: 5px;"><i class="fa fa-times-circle fa-lg text-danger"></i>
                    </span>
                </td>
                <td colspan="2" class="fw-bold fs-12px" align="right" style="padding-top: 20px;">
                    <span>USER : {{ $data->users }}</span>
                </td>
            </tr>
            <?php
            $total_qty = 0;
            $total_cost = 0;
            ?>
            @for ($i = 0; $i < count($data->suppliers_details); $i++)
                <?php
                $total_qty = $total_qty + $data->suppliers_details[$i]['qty'];
                $total_cost = $total_cost + $data->suppliers_details[$i]['subtotal'];
                ?>
                <tr class="tr-custom">
                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                        {{ $i + 1 }}
                    </td>
                    <td class="text-left fw-bold" style="border-right-width: 1px;">
                        <a style="cursor: pointer;">{{ $data->suppliers_details[$i]['produk'] }}</a>
                    </td>
                    <td class="text-center" style="border-right-width: 1px;">
                        <span>
                            <a style="cursor: pointer;">
                                <i class="fas fa-lg fa-edit text-info"></i>
                            </a>
                            <a>
                                <i class="fas fa-lg fa-times-circle text-danger"></i>
                            </a>
                        </span>
                    </td>

                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                        {{ $data->suppliers_details[$i]['tipe_order'] }}
                    </td>

                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                        {{ $data->suppliers_details[$i]['id_sup'] }}
                    </td>
                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                        {{ $data->suppliers_details[$i]['qty'] }}
                    </td>
                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                        @currency($data->suppliers_details[$i]['m_price'])
                    </td>
                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                        @currency($data->suppliers_details[$i]['subtotal'])
                    </td>

                </tr>
            @endfor

            <tr class="tr-custom">
                <td colspan="5" style="border-bottom: hidden;border-left: hidden;"></td>
                <td class="text-center fw-bold fs-12px" style="border-left-width: 1px;border-right-width: 1px;">
                    QTY
                </td>
                <td colspan="2" class="text-right fw-bold fs-12px"
                    style="border-left-width: 1px;border-right-width: 1px;" align="right">
                    <span style="margin-right: 25px;">TOTAL COST</span>
                </td>
            </tr>
            <tr class="tr-custom">
                <td colspan="5" style="border-bottom: hidden;border-left: hidden;"></td>
                <td class="text-center text-white fw-bold fs-12px"
                    style="border-left-width: 1px;border-right-width: 1px;">
                    {{ $total_qty }}
                </td>
                <td colspan="2" class="text-right text-white fw-bold fs-12px"
                    style="border-left-width: 1px;border-right-width: 1px;" align="right">
                    <span style="margin-right: 25px;">@currency($total_cost)</span>
                </td>
            </tr>

            <tr style="border-bottom: 3px solid #797979;">
                <td colspan="8" style="padding-top: 5px;padding-bottom: 20px;">
                </td>
            </tr>
        @endforeach
