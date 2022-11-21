<div class="row">
    <div class="col-12" align="center">
        <span><img src="/product/defaultimg.png" alt="" width="300" height="300" class="rounded"></span>
    </div>
    <div class="col-12 mt-2 mb-3" align="center">
        <span>
            <label class="fw-bold">SLIP ON CLASSICS BLACK WHITE</label><br>
            <label class="fw-bold text-theme">1535325235</label>
        </span>
    </div>
    <hr>
    <div class="col-12" align="center">
        <div class="form-group mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="tipe_print" type="radio" id="check_custom" checked
                    value="custom" / onclick="selectprint()">
                <label class="form-check-label fw-bold" for="check_custom">CUSTOM PRINT</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="tipe_print" type="radio" id="check_bypo" value="bypo" /
                    onclick="selectprint()">
                <label class="form-check-label fw-bold" for="check_bypo">PURCHASE ORDER</label>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="card">
        <div class="card-body bg-white bg-opacity-10">
            <div class=" row">
                <div class="col-12" id="divsize">
                    <div class="row">
                        <div class="col-6">
                            <select class="form-select form-select-sm fw-bold text-success" name="size_custom">
                                <option value="" disabled selected>SIZE</option>
                                @foreach ($get_variation as $varias)
                                    <option value="{{ $varias->size }}">{{ $varias->size }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select form-select-sm fw-bold  text-success" name="qty">
                                <option value="0" disabled selected>QTY</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="display:none;" id="divpo">
                    <div class="row">
                        <div class="col-6">
                            <select class="form-select form-select-sm fw-bold  text-success" required name="idpo"
                                id="idpo" onchange="selectpo()">
                                <option value="" disabled selected>ID PURCHASE ORDER</option>
                                @foreach ($get_idpo as $gets_idpo)
                                    <option value="{{ $gets_idpo->idpo }}">{{ $gets_idpo->idpo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select form-select-sm fw-bold text-success" required name="size"
                                id="select_size_po">
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="{{ $id_produk }}" id="v_id_produk" name="v_id_produk">
                <input type="hidden" value="{{ $id_ware }}" id="v_id_ware" name="v_id_ware">
            </div>
        </div>
        <div class="card-arrow">
            <div class="card-arrow-top-left"></div>
            <div class="card-arrow-top-right"></div>
            <div class="card-arrow-bottom-left"></div>
            <div class="card-arrow-bottom-right"></div>
        </div>
    </div>
</div>
</div>
<script>
    function selectprint() {
        var check_custom = document.getElementById("check_custom");
        var custom = check_custom.checked;

        var check_bypo = document.getElementById("check_bypo");
        var bypo = check_bypo.checked;

        if (custom) {
            document.getElementById("divsize").style.display = 'block';
            document.getElementById("divpo").style.display = 'none';
        } else if (bypo) {
            document.getElementById("divsize").style.display = 'none';
            document.getElementById("divpo").style.display = 'block';
        }
    }

    function selectpo() {
        var select = document.getElementById('idpo');
        var value = select.options[select.selectedIndex].value;
        var v_id_produk = document.getElementById('v_id_produk').value;
        var v_id_ware = document.getElementById('v_id_ware').value;

        $.ajax({
            type: 'POST',
            url: "{{ URL::to('/select_size_po') }}",
            data: {
                value: value,
                v_id_produk: v_id_produk,
                v_id_ware: v_id_ware,
            },
            success: function(data) {
                $("#select_size_po").html(data);
            }
        });
    }
</script>
