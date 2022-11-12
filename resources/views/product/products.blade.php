@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">PRODUCTS</a></li>
                    <li class="breadcrumb-item active">PRODUCTS PAGE</li>
                </ul>

                <h1 class="page-header">
                    Products
                </h1>
            </div>
            <div class="ms-auto">
            </div>

            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-lime" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="bi bi-arrow-clockwise fa-fw me-1"></i> Stock Opname</a>
            </div>
            <div class="ms-sm-3 mt-sm-0"><a class="btn btn-outline-theme" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Product</a>
            </div>
        </div>
        <style>
            .button-hover {
                padding: 0.5%;
                border-radius: 5px;
            }

            .button-hover:hover {
                background-color: rgba(255, 255, 255, .15);
            }

            .datepicker.datepicker-dropdown {
                z-index: 200000 !important;
            }
        </style>

        <div class="modal fade" id="modaladd" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD PRODUCTS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formadd" class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/product/products/store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-4">
                                    <div class="row form-group">
                                        <div class="col-2 mt-2">
                                        </div>
                                        <div class="col-8 mt-2 form-group position-relative mb-2 profile-img"
                                            align="center">
                                            <script type="text/javascript">
                                                var loadeditFile = function(event) {
                                                    var previewimg = document.getElementById('previewimg');
                                                    previewimg.src = URL.createObjectURL(event.target.files[0]);
                                                };
                                            </script>
                                            <img class="mb-2" id="previewimg" width="247px"
                                                src="/product/defaultimg.png">
                                            <input type="file" class="form-control" id="file" name="file"
                                                onchange="loadeditFile(event)">
                                        </div>
                                        <div class="card-arrow">
                                            <div class="card-arrow-top-left"></div>
                                            <div class="card-arrow-top-right"></div>
                                            <div class="card-arrow-bottom-left"></div>
                                            <div class="card-arrow-bottom-right"></div>
                                        </div>
                                        <div class="col-2 mt-2">
                                        </div>
                                        <div class="col-12 form-group mb-3">
                                            <label class="form-label">Nama Produk</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                                name="produk" required placeholder="Silahkan masukan nama produk"
                                                autocomplete="OFF">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="row form-group">
                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Brand</label>
                                            <select class="form-select form-select-sm text-theme" name="id_brand" required>
                                                <option value="" disabled selected>Pilih Brand</option>
                                                @foreach ($getbrand as $gets)
                                                    <option value="{{ $gets->id_brand }}">{{ $gets->brand }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih nama brand yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-select form-select-sm text-theme" name="category" required>
                                                <option value="" disabled selected>Pilih Kategori</option>
                                                @foreach ($getcategory as $gets)
                                                    <option value="{{ $gets->sub_category }}">{{ $gets->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih category yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3 mt-3">
                                            <label class="form-label">Kualitas</label>
                                            <select class="form-select form-select-sm text-theme" name="quality" required>
                                                <option value="" disabled selected>Pilih Kualitas</option>
                                                <option value="LOKAL">LOKAL</option>
                                                <option value="IMPORT">IMPORT</option>
                                                <option value="ORIGINAL">ORIGINAL</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih kualitas yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3 mt-3">
                                            <label class="form-label">Warehouse</label>
                                            <select class="form-select form-select-sm text-theme" name="id_area" required>
                                                <option value="" disabled selected>Pilih Warehouse</option>
                                                @foreach ($getware as $gets)
                                                    <option value="{{ $gets->id_area }}">{{ $gets->warehouse }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih warehouse yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Modal</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                                name="m_price" required placeholder="0" autocomplete="OFF"
                                                type-currency="IDR">
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Reseller</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="r_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Normal</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="n_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Grosir</label>
                                            <input
                                                class="form-control form-select-sm form-control-sm text-theme is-invalid"
                                                type="text" name="g_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-12 form-group position-relative mb-2">
                                            <label class="form-label">Supplier</label>
                                            <div class="position-relative text-center mb-3">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="type_po" id="type_po" required onchange="typepo()">
                                                    <option value="" disabled selected>Tipe PO</option>
                                                    <option value="baru">PO Baru</option>
                                                    <option value="lama">PO Lanjutan</option>
                                                </select>
                                            </div>
                                            <div class="position-relative text-center mb-3" style="display:none;"
                                                id="divlama">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="id_po_lama">
                                                    <option value="" disabled selected>Pilih DATA PO</option>
                                                    @foreach ($get_Supplier_Order as $orders)
                                                        @foreach ($getsupplier as $supps)
                                                            @if ($supps->id_sup === $orders->id_sup)
                                                                <option value="{{ $orders->idpo }}">{{ $orders->tanggal }}
                                                                    -
                                                                    {{ $supps->supplier }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="position-relative text-center" style="display:none;"
                                                id="divbaru">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="id_sup" id="id_sup">
                                                    <option value="" disabled selected>Pilih Supplier</option>
                                                    @foreach ($getsupplier as $gets)
                                                        <option value="{{ $gets->id_sup }}">{{ $gets->supplier }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <script>
                                                function typepo() {
                                                    var select = document.getElementById('type_po');
                                                    var value = select.options[select.selectedIndex].value;

                                                    if (value == 'baru') {
                                                        document.getElementById("divbaru").style.display = 'block';
                                                        document.getElementById("divlama").style.display = 'none';
                                                    } else if (value == 'lama') {
                                                        document.getElementById("divbaru").style.display = 'none';
                                                        document.getElementById("divlama").style.display = 'block';
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row form-group">
                                        <div class="col-12 form-group position-relative mb-3">
                                            <label class="form-label">Variation</label>
                                            <select class="form-select form-select-sm text-theme fs-12px"
                                                id="type_variasi" name="type_variasi" required>
                                                <option value="" disabled selected>Pilih Variation</option>
                                                <option value="SNEAKERS UNISEX">Sneakers Unisex 35-45</option>
                                                <option value="CUSTOM">Custom</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Pilih supplier yang sesuai.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div id="hasil_variation" style="text-align: center;"></div>
                                            <script>
                                                function addpo() {
                                                    var tbody = document.getElementById('tbody_item');
                                                    var row = tbody.insertRow(1);
                                                    var size = row.insertCell(0);
                                                    var qty = row.insertCell(1);
                                                    var aksi = row.insertCell(2);

                                                    size.innerHTML = "<input class='form-control' type='text' name='size[]' style='width: 100%;height:100%;'>";
                                                    qty.innerHTML =
                                                        "<input class='form-control' onkeypress='return isNumberKey(event)' type='text' name='qty[]' style='width: 100%;height:100%;'>";
                                                    aksi.innerHTML = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">X</button>';
                                                }

                                                function deleteRow(r) {
                                                    var i = r.parentNode.parentNode.rowIndex;
                                                    document.getElementById("variations").deleteRow(i);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-1" align="right">
                                <button class="btn btn-theme" type="submit" onclick="submitadd()">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('#file').change(function() {

                if (file === "") {
                    document.getElementById("previewimg").src = '/product/defaultimg.png';
                } else {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#previewimg').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }

            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {

                function variation(variasi) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ URL::to('/load_variation') }}",
                        data: {
                            variasi: variasi
                        },
                        success: function(data) {
                            $("#hasil_variation").html(data);
                        }
                    });
                }

                $('#type_variasi').change(function() {
                    var variasi = $(this).val();
                    variation(variasi);
                });
            });
        </script>

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-3 mb-3">
                <div class="card" style="margin-bottom: 15px;">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 3px;">
                            <div class="col-6 text-theme fw-bold">ARTIKEL</div>
                            <h4>{{ $get_totalproduk }}</h4>
                        </div>

                        <div class="opacity-5">
                            <i class="bi bi-box-seam fa-3x"></i>
                        </div>
                    </div>

                    <!-- card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 3px;">
                            <div class="col-6 text-theme fw-bold">QTY</div>
                            <h4>{{ $get_totalqty }}</h4>
                        </div>

                        <div class="opacity-5">
                            <i class="bi bi-boxes fa-3x"></i>
                        </div>
                    </div>

                    <!-- card-arrow -->
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 mb-3">
                <div class="card">
                    <div class="card-body p-3" style="height: 225px;">
                        <div class="row" align="center">
                            @foreach ($getsproduct as $key => $utama)
                                @foreach ($getnamewarehouse as $wares)
                                    @if ($utama->id_area === $wares->id_area)
                                        @foreach ($get_perware as $keys => $kedua)
                                            @if ($utama->id_area === $kedua->id_area)
                                                <div class="col-4 mb-3">
                                                    <div class="card">
                                                        <div class="card-body p-3 bg-white bg-opacity-10">
                                                            <div class="d-flex fw-bold small mb-2">
                                                                <span
                                                                    class="flex-grow-1 text-theme">{{ $wares->warehouse }}</span>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <h6 class="mb-0">
                                                                            {{ $kedua->countidproduk }}</h6>
                                                                        <h6 class="mb-0 fs-10px">PCS
                                                                        </h6>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <h6 class="mb-0">{{ $kedua->totalQty }}</h6>
                                                                        <h6 class="mb-0 fs-10px">QTY</h6>
                                                                    </div>
                                                                </div>
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
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endforeach
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

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: auto;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">SEARCH PRODUCTS</span>
                            <a href="#" data-toggle="card-expand"
                                class="text-white text-opacity-50 text-decoration-none"><i
                                    class="bi bi-fullscreen"></i></a>
                        </div>
                        <div class="input-group mb-4">
                            <div class="flex-fill position-relative">
                                <div class="input-group">
                                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                        style="z-index: 1020;">
                                        <i class="fa fa-search opacity-5"></i>
                                    </div>
                                    <input type="text" class="form-control ps-35px" id="search_product"
                                        placeholder="Search products.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_product">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
                                    </th>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">IMAGE
                                    </th>
                                    <th class="text-center" width="40%" style="color: #a8b6bc !important;">NAME
                                    </th>
                                    </th>
                                    <th class="text-center" width="5%" style="color: #a8b6bc !important;">PRICE
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">DETAIL
                                    </th>
                                    <th class="text-center" width="20%" style="color: #a8b6bc !important;">SIZE
                                    </th>
                                    <th class="text-center" width="7%" style="color: #a8b6bc !important;">ACT
                                    </th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 11px;">
                            </tbody>
                        </table>
                    </div>
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                </div>
            </div>
            <!-- END -->
        </div>

        @include('product.delete')
        @include('product.edit')

        <link href="{{ URL::asset('/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
            rel="stylesheet" />
        <link href="{{ URL::asset('/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}"
            rel="stylesheet" />
        <link href="{{ URL::asset('/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}"
            rel="stylesheet" />

        <script src="{{ URL::asset('/assets/plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
        </script>

        <script type="text/javascript">
            $(function() {
                var table = $('#tb_product').DataTable({
                    lengthMenu: [10],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tableproduct",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            class: 'text-center fw-bold',
                            searchable: false
                        }, {
                            data: 'image_product',
                            name: 'image_product',
                            class: 'text-center',
                            "render": function(data, type, row) {
                                if (row.image_product[0]['img'] === "") {
                                    return '<span><img src="/product/defaultimg.png" alt="" width="100" height="100" class="rounded"></span><span class="fw-bold text-yellow"><br>' +
                                        row
                                        .id_produk + '</span>';
                                } else {
                                    return '<span><img src="/product/' + row.image_product[0]['img'] +
                                        '" alt="" width="95"  height="95" class="rounded"></span><span class="fw-bold text-yellow"><br>' +
                                        row
                                        .id_produk + '</span>';
                                }
                            },
                        }, {
                            data: 'produk',
                            name: 'produk',
                            class: 'text-left',
                            searchable: true,
                            "render": function(data, type, row, meta) {
                                return '<span class="fw-bold fs-14px text-white">' + row.produk +
                                    '</span><br><span class="fw-bold"><span class="fw-bold">' +
                                    row.category +
                                    '</span>';
                            },
                        },
                        {
                            data: 'n_price',
                            name: 'n_price',
                            class: 'text-center',
                            searchable: true,
                            "render": function(data, type, row, meta) {
                                let rupiah = Intl.NumberFormat('id-ID');

                                // return '<span class="badge border fw-bold" style="width: 120px;margin-bottom: 7px;margin-top: 3px;font-size: 11px;" >Cost : ' +
                                //     rupiah.format(row.supplier_order[0]['m_price']) +
                                return '</span> <br><span class="badge border fw-bold" style="width: 120px;margin-bottom: 7px;font-size: 11px;" >Normal : ' +
                                    rupiah.format(row.n_price) +
                                    '</span> <br><span class="badge border fw-bold" style="width: 120px;font-size: 11px;margin-bottom: 7px;" >Reseller : ' +
                                    rupiah.format(row.r_price) +
                                    '</span>  <br><span class="badge border fw-bold" style="width: 120px;font-size: 11px;margin-bottom: 3px;" >Grosir : ' +
                                    rupiah.format(row.g_price) + '</span>';
                            },
                        },
                        {
                            data: 'quality',
                            name: 'quality',
                            class: 'text-center',
                            searchable: true,
                            "render": function(data, type, row, meta) {
                                return '<span class="fw-bold text-indigo">' + row
                                    .warehouse[0]['warehouse'] +
                                    '</span><br><span class="fw-bold">' + row
                                    .quality +
                                    '</span>';
                            },
                        },
                        {
                            data: 'product_variation2',
                            name: 'product_variation2',
                            class: 'text-center',
                            searchable: true,
                            // Edit Tian
                            "render": function(data, type, row) {
                                size = '';
                                length = data.length;
                                // ware_count = data.warehouse.length;
                                i = 0;
                                b = 1;

                                while (i < length) {
                                    if (row.warehouse[0]['id_area'] === row.product_variation2[i][
                                            'id_area'
                                        ]) {
                                        if (row.product_variation2[i]['qty'] === 0) {
                                            size = size + '<span class="text-danger"> ' + '[<i>' +
                                                row
                                                .product_variation2[i]['size'] +
                                                '</i><span class="text-danger"> = </span><span class="text-danger fw-bold">' +
                                                row.product_variation2[
                                                    i][
                                                    'qty'
                                                ] +
                                                '</span><span class="fw-bold text-danger">] </span>';

                                        } else {
                                            size = size + '<span class="text-lime">' + '[<i>' + row
                                                .product_variation2[i]['size'] +
                                                '</i><span class="text-lime"> = </span><span class="text-lime fw-bold">' +
                                                row.product_variation2[
                                                    i][
                                                    'qty'
                                                ] +
                                                '</span><span class="fw-bold text-lime">] </span>';
                                        }
                                        if (b === 4) {
                                            size = size + '<br>';
                                            b = 0;
                                        }
                                        b++;
                                    } else {
                                        size = 'STOCK BELUM ADA';
                                    }
                                    i++;
                                }
                                return size;
                            },
                        },
                        {
                            data: 'action',
                            name: 'action',
                            class: 'text-center fw-bold',
                            "render": function(data, type, row) {
                                return '<span><a class="text-primary" style="cursor: pointer;" onclick="openmodaledit(' +
                                    "'" + row.id + "'" + ',' + "'" + row.id_produk + "'" + ',' + "'" +
                                    row.produk + "'" + ',' + "'" + row
                                    .brand + "'" + ',' + "'" + row.category + "'" + ',' + "'" + row
                                    .quality + "'" + ',' + "'" + row.m_price + "'" + ',' + "'" + row
                                    .r_price + "'" + ',' + "'" + row.n_price + "'" + ',' + "'" + row
                                    .g_price + "'" +
                                    ',' + "'" + row.id_area + "'" +
                                    ')"><i class="fas fa-xl fa-edit">  </i></a> </span><span><a class="text-default" style="font-weight: bold;">|</a> </span><span><a class="text-danger" style="cursor: pointer;" onclick="openmodaldelete(' +
                                    "'" + row.id + "'" +
                                    ',' + "'" + row.id_produk + "'" +
                                    ')"><i class="fas fa-xl fa-times-circle"></i></a></span>';
                            },
                        },
                    ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [0, 'desc']
                    ],
                    columnDefs: [{
                            orderable: false,
                            targets: [4]
                        },

                    ],
                });

                $('#search_product').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>



        <script>
            // edit
            function openmodaledit(id, id_produk, produk, brand, category, quality, m_price, r_price, n_price,
                g_price, id_area) {
                $('#modaledit').modal('show');
                document.getElementById('id').value = id;
                document.getElementById('id_produk').value = id_produk;

                document.getElementById('produk').value = produk;

                document.getElementById("branddefault").innerHTML = brand;
                document.getElementById("categorydefault").innerHTML = category;
                document.getElementById("qualitydefault").innerHTML = quality;

                var convert_m_price = m_price;
                var number_string = convert_m_price.toString(),
                    sisa = number_string.length % 3,
                    hasil_m_price = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '' : '';
                    hasil_m_price += separator + ribuan.join('.');
                }

                var convert_r_price = r_price;
                var number_string = convert_r_price.toString(),
                    sisa = number_string.length % 3,
                    hasil_r_price = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '' : '';
                    hasil_r_price += separator + ribuan.join('.');
                }

                var convert_n_price = n_price;
                var number_string = convert_n_price.toString(),
                    sisa = number_string.length % 3,
                    hasil_n_price = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '' : '';
                    hasil_n_price += separator + ribuan.join('.');
                }

                var convert_g_price = g_price;
                var number_string = convert_g_price.toString(),
                    sisa = number_string.length % 3,
                    hasil_g_price = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '' : '';
                    hasil_g_price += separator + ribuan.join('.');
                }

                document.getElementById('m_price').value = "Rp " + hasil_m_price;
                document.getElementById('r_price').value = "Rp " + hasil_r_price;
                document.getElementById('n_price').value = "Rp " + hasil_n_price;
                document.getElementById('g_price').value = "Rp " + hasil_g_price;
                document.getElementById('id_area').value = id_area;
                // document.getElementById('img').value = img;

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_edit_variation') }}",
                    data: {
                        id_area: id_area,
                        id_produk: id_produk
                    },
                    success: function(data) {
                        $("#edit_variation").html(data);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_image') }}",
                    data: {
                        id_produk: id_produk,
                    },
                    success: function(data) {
                        $("#edit_image").html(data);
                    }
                });
            }

            function submitformedit() {
                var value = document.getElementById('id').value;
                document.getElementById('form_edit').action = "../product/editact/" + value;
                document.getElementById("form_edit").submit();
            }

            // delete
            function openmodaldelete(id, id_produk) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
                document.getElementById('del_id_produk').value = id_produk;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../product/destroy/" + value;
                document.getElementById("form_delete").submit();
            }
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <script>
            document.querySelectorAll('input[type-currency="IDR"]').forEach((element) => {
                element.addEventListener('keyup', function(e) {
                    let cursorPostion = this.selectionStart;
                    let value = parseInt(this.value.replace(/[^,\d]/g, ''));
                    let originalLenght = this.value.length;
                    if (isNaN(value)) {
                        this.value = "";
                    } else {
                        this.value = value.toLocaleString('id-ID', {
                            currency: 'IDR',
                            style: 'currency',
                            minimumFractionDigits: 0
                        });
                        cursorPostion = this.value.length - originalLenght + cursorPostion;
                        this.setSelectionRange(cursorPostion, cursorPostion);
                    }
                });
            });
        </script>
    @endsection
