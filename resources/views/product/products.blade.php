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
                <a href="#" class="btn btn-outline-secondary"><i class="fa fa-upload fa-fw me-1 text-white"></i> Export
                    CSV</a>
            </div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-lime" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Stock Opname</a>
            </div>
            <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-theme" data-bs-toggle="modal"
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD PRODUCTS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" action="{{ url('/store/stores/storeadd') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row form-group">
                                <div class="col-6">
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
                                            <img class="mb-2" id="previewimg" width="200px"
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
                                                name="store" required placeholder="Please provide a name product"
                                                autocomplete="OFF">
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Brand</label>
                                            <select class="form-select form-select-sm text-theme" name="id_brand" required>
                                                <option value="" disabled selected>Choose Brand</option>
                                                @foreach ($getbrand as $gets)
                                                    <option value="{{ $gets->id_brand }}">{{ $gets->brand }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Select a valid Brand.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Category</label>
                                            <select class="form-select form-select-sm text-theme" name="category" required>
                                                <option value="" disabled selected>Choose Category</option>
                                                @foreach ($getcategory as $gets)
                                                    <option value="{{ $gets->sub_category }}">{{ $gets->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Select a valid Category.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Quality</label>
                                            <select class="form-select form-select-sm text-theme" name="quality" required>
                                                <option value="" disabled selected>Choose Quality</option>
                                                <option value="LOKAL">LOKAL</option>
                                                <option value="IMPORT">IMPORT</option>
                                                <option value="ORIGINAL">ORIGINAL</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Select a valid Quality.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Warehouse</label>
                                            <select class="form-select form-select-sm text-theme" name="id_ware" required>
                                                <option value="" disabled selected>Choose Warehouse</option>
                                                @foreach ($getware as $gets)
                                                    <option value="{{ $gets->id_ware }}">{{ $gets->warehouse }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Select a valid Warehouse.
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-6">
                                    <div class="row form-group">
                                        <div class="col-6 form-group mb-3 mt-1">
                                            <label class="form-label">Modal</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="number"
                                                name="m_price" required placeholder="0" autocomplete="OFF">
                                        </div>
                                        <div class="col-6 form-group mb-3 mt-1">
                                            <label class="form-label">Reseller</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="number" name="r_price" required placeholder="0"
                                                autocomplete="OFF">
                                        </div>
                                        <div class="col-6 form-group mb-3 mt-1">
                                            <label class="form-label">Normal</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="number" name="n_price" required placeholder="0"
                                                autocomplete="OFF">
                                        </div>
                                        <div class="col-6 form-group mb-3 mt-1">
                                            <label class="form-label">Grosir</label>
                                            <input
                                                class="form-control form-select-sm form-control-sm text-theme is-invalid"
                                                type="number" name="g_price" required placeholder="0"
                                                autocomplete="OFF">
                                        </div>

                                        <div class="col-12 form-group position-relative mb-3">
                                            <label class="form-label">Supplier</label>
                                            <select class="form-select form-select-sm text-theme fs-12px" name="supplier"
                                                required>
                                                <option value="" disabled selected>Choose Supplier</option>
                                                @foreach ($getsupplier as $gets)
                                                    <option value="{{ $gets->id_supplier }}">{{ $gets->supplier }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Select a valid Supplier.
                                            </div>
                                        </div>

                                        <div class="col-12 form-group position-relative mb-3">
                                            <label class="form-label">Variation</label>
                                            <select class="form-select form-select-sm text-theme fs-12px"
                                                id="type_variasi" name="type_variasi" required>
                                                <option value="" disabled selected>Choose Variation</option>
                                                <option value="SNEAKERS UNISEX">Sneakers Unisex</option>
                                                <option value="CUSTOM">Custom</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Select a valid Supplier.
                                            </div>
                                        </div>
                                        <div class="col-12">
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
                            <div class="form-group mt-3" align="right">
                                <button class="btn btn-theme" type="submit">Save</button>
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

                variation();

                function variation(variasi) {
                    $.ajax({
                        url: 'load/load_variations.php',
                        type: 'POST',
                        cache: false,
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
                    if (variasi != '') {
                        variation(variasi);
                    } else {
                        variation();
                    }
                });
            });
        </script>

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-3 mb-3">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 3px;">
                            <div class="mb-1">TOTAL PRODUCTS</div>
                            <h4>22,930</h4>
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
            </div>

            <div class="col-xl-9 mb-3">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row" align="center">

                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body p-3 bg-white bg-opacity-10">
                                        <div class="d-flex fw-bold small mb-1">
                                            <span class="flex-grow-1">DIPATIUKUR</span>
                                        </div>
                                        <div class="row align-items-center">
                                            <div>
                                                <h5 class="mb-0">4.351</h3>
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

                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body p-3 bg-white bg-opacity-10">
                                        <div class="d-flex fw-bold small mb-1">
                                            <span class="flex-grow-1">GUDANG SELATAN</span>
                                        </div>
                                        <div class="row align-items-center">
                                            <div>
                                                <h5 class="mb-0">4.351</h3>
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

                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body p-3 bg-white bg-opacity-10">
                                        <div class="d-flex fw-bold small mb-1">
                                            <span class="flex-grow-1">PADANG</span>
                                        </div>
                                        <div class="row align-items-center">
                                            <div>
                                                <h5 class="mb-0">4.351</h3>
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
                    <div class="card-body p-3" style="height: 490px;">
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
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">IMAGE
                                    </th>
                                    <th class="text-center" width="40%" style="color: #a8b6bc !important;">NAME
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">DETAIL
                                    </th>
                                    <th class="text-center" width="20%" style="color: #a8b6bc !important;">SIZE
                                    </th>
                                    <th class="text-center" width="5%" style="color: #a8b6bc !important;">ACT
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

        {{-- @include('store.delete')
        @include('store.edit') --}}

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
                        data: 'img',
                        name: 'img',
                        class: 'text-center',
                        "render": function(data, type, row) {
                            if (row.img === "") {
                                return '<span><img src="/product/defaultimg.png" alt="" width="75" height="75" class="rounded"></span>';
                            } else {
                                return '<span><img src="/product/' + row.img +
                                    '" alt="" width="75"  height="75" class="rounded"></span>';
                            }
                        },
                    }, {
                        data: 'produk',
                        name: 'produk',
                        class: 'text-left',
                        searchable: true,
                        "render": function(data, type, row, meta) {

                            return '<span class="fw-bold text-theme">' + row.produk +
                                '</span> | <span>' + row
                                .id_produk +
                                '</span><br><span class="fw-bold text-success">Cost &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ' +
                                row
                                .m_price +
                                '</span><br><span class="fw-bold text-white">Normal &nbsp;&nbsp;: ' +
                                row
                                .n_price +
                                '</span><br><span class="fw-bold text-danger">Reseller : ' +
                                row.r_price +
                                '</span><br><span class="fw-bold text-info">Grosir &nbsp;&nbsp;&nbsp;&nbsp;: ' +
                                row.g_price + '</span>';
                        },
                    }, {
                        data: 'id_ware',
                        name: 'id_ware',
                        class: 'text-center',
                        searchable: true,
                        "render": function(data, type, row) {

                            return '<span class="fw-bold">' + row.id_ware +
                                '</span><br><span class="fw-bold">' + row.quality +
                                '</span><br><span class="fw-bold">' + row.category +
                                '</span><br><span class="fw-bold">' + row.id_brand +
                                '</span>';
                        },
                    }, {
                        data: 'product_variation',
                        name: 'product_variation',
                        class: 'text-center',
                        searchable: true,
                        // Edit Tian
                        "render": function(data, type, row) {
                            size = '';
                            length = data.length;
                            i = 0;
                            while (i < length) {
                                size = size + '<span class="fw-bold text-theme">' + ' | ' + row
                                    .product_variation[i]['size'] + '=' + row.product_variation[i][
                                        'qty'
                                    ] + '</span>';
                                i++;
                            }

                            return size + '<span class="fw-bold text-theme"> |</span>';
                        },
                        // End Edit Tian

                    }, {
                        data: 'action',
                        name: 'action',
                        class: 'text-center fw-bold',
                        "render": function(data, type, row) {
                            return '<span><a class="text-primary" style="cursor: pointer;" ><i class="fas fa-xl fa-times-circle"></i></a></span>';
                        },
                    }, ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [1, 'desc']
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



        {{-- <script>
            // edit
            function openmodaledit(id, id_store, store, address, id_ware, warehouse) {
                $('#modaledit').modal('show');

                document.getElementById('e_id').value = id;
                document.getElementById('e_id_store').value = id_store;
                document.getElementById('e_store').value = store;
                document.getElementById('e_address').value = address;
                document.getElementById('e_id_ware').value = id_ware;


                document.getElementById("e_warehousedefault").innerHTML = "DEFAULT : " + warehouse;
            }

            function submitformedit() {
                var value = document.getElementById('e_id').value;
                document.getElementById('form_edit').action = "../store/editact/" + value;
                document.getElementById("form_edit").submit();
            }

            // delete
            function openmodaldelete(id) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../store/destroy/" + value;
                document.getElementById("form_delete").submit();
            }
        </script> --}}
    @endsection
