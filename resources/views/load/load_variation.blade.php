@if ($search === 'SNEAKERS UNISEX')
    <table class="table table-bordered table-sm" id="variations" id="hasil_variation">
        <thead>
            <tr>
                <th class="text-center text-dark" style="height: 10px;">Size</th>
                <th class="text-center text-dark" style="height: 10px;">Qty</th>
            </tr>
        </thead>

        <tbody id="tbody_item">
            <tr>
                <td style="width: 10%;">
                    <input class="form-control text-center text-dark" type="text" name="size[]" value="35"
                        readonly style="width: 100%;height: 15px;">
                </td>
                <td style="width: 10%;">
                    <input class="form-control text-center text-info" type="text" name="qty[]" value="0"
                        onkeypress="return isNumberKey(event)" style="width: 100%;height: 15px;font-weight: bold;"
                        autocomplete="off">
                </td>
            </tr>
        </tbody>
    </table>
@else
    <table class="table table-bordered table-sm" id="variations" id="hasil_variation">
        <thead>
            <tr>
                <th class="text-center text-dark" style="height: 10px;">Size</th>
                <th class="text-center text-dark" style="height: 10px;">Qty</th>
            </tr>
        </thead>

        <tbody id="tbody_item">
            <tr>
                <td style="width: 10%;">
                    <input class="form-control text-center text-dark" type="text" name="size[]" value="35"
                        readonly style="width: 100%;height: 15px;">
                </td>
                <td style="width: 10%;">
                    <input class="form-control text-center text-info" type="text" name="qty[]" value="0"
                        onkeypress="return isNumberKey(event)" style="width: 100%;height: 15px;font-weight: bold;"
                        autocomplete="off">
                </td>
            </tr>
        </tbody>
    </table>
@endif
