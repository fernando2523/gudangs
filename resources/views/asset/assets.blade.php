@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">ASSETS</a></li>
                    <li class="breadcrumb-item active">ASSETS PAGE</li>
                </ul>

                <h1 class="page-header">
                    Assets
                </h1>
            </div>
            <div class="ms-auto">
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

            .thead-custom {
                font-size: 11px;
                background-color: darkslategray;
            }

            .tr-custom {
                border-left-width: 1px;
                border-right-width: 1px;
                border-bottom-width: 1px;
            }
        </style>

        <div class="row mb-3">
            <!-- TOTAL STOCK -->
            <div class="col-xl-3 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1 fw-bold">TOTAL QTY</div>
                            <h4 class="text-theme">{{ $qtyasset[0]->totalqty }}</h4>
                        </div>
                        <div class="opacity-5">
                            <i class="fa fa-cube fa-3x"></i>
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
            <div class="col-xl-3 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1 fw-bold">QTY RELEASE</div>
                            @if ($qtyrelease[0]->qtyreleases === null or $qtyrelease[0]->qtyreleases === '0')
                                <h4 class="text-theme">0</h4>
                            @else
                                <h4 class="text-theme">{{ $qtyrelease[0]->qtyreleases }}</h4>
                            @endif
                        </div>
                        <div class="opacity-5">
                            <i class="bi bi-award fa-3x"></i>
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
            <div class="col-xl-3 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1 fw-bold">QTY REPEAT</div>
                            @if ($qtyrepeat[0]->qtyrepeats === null or $qtyrepeat[0]->qtyrepeats === '0')
                                <h4 class="text-theme">0</h4>
                            @else
                                <h4 class="text-theme">{{ $qtyrepeat[0]->qtyrepeats }}</h4>
                            @endif
                        </div>
                        <div class="opacity-5">
                            <i class="bi bi-award-fill fa-3x"></i>
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
            <!-- END -->
            <div class="col-xl-3 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1 fw-bold">CAPITAL AMOUNT</div>
                            <h4 class="text-theme">@currency($totalmodal)</h4>
                        </div>
                        <div class="opacity-5">
                            <i class="bi bi-cash-stack fa-3x"></i>
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
        </div>

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: auto;">
                        <!-- BEGIN input-group -->
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
                                    <th class="text-left" width="28%" style="color: #a8b6bc !important;">NAME
                                    </th>
                                    </th>
                                    <th class="text-center" width="8%" style="color: #a8b6bc !important;">ID PRODUCT
                                    </th>
                                    <th class="text-center" width="7%" style="color: #a8b6bc !important;">RELEASE
                                    </th>
                                    <th class="text-center" width="7%" style="color: #a8b6bc !important;">REPEAT
                                    </th>
                                    <th class="text-center" width="7%" style="color: #a8b6bc !important;">STOCK
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">ASSETS
                                    </th>
                                    <th class="text-center" width="3%" style="color: #a8b6bc !important;">ACT
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

        {{-- @include('purchase.edit') --}}

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
                    ajax: "/tableassets",
                    columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        class: 'text-center fw-bold',
                        searchable: false
                    }, {
                        data: 'produk',
                        name: 'produk',
                        class: 'text-left',
                        searchable: true,
                        "render": function(data, type, row) {
                            return '<span class="fw-bold">' + row.produk + '</span>';
                        },
                    }, {
                        data: 'id_produk',
                        name: 'id_produk',
                        class: 'text-center fw-bold',
                        searchable: true,
                    }, {
                        data: 'tipe_order',
                        name: 'tipe_order',
                        class: 'text-center',
                        searchable: true,
                        "render": function(data, type, row, meta) {
                            if (row.tipe_order === "RELEASE") {
                                return row.qty;
                            }
                        },
                    }, {
                        data: 'tipe_order',
                        name: 'tipe_order',
                        class: 'text-center',
                        searchable: true,
                        "render": function(data, type, row, meta) {
                            if (row.tipe_order === "REPEAT") {
                                return row.qty;
                            }
                        },
                    }, {
                        data: 'product_variation_asset',
                        name: 'product_variation_asset',
                        class: 'text-center',
                        searchable: true,
                        "render": function(data, type, row) {
                            totalqty = 0;
                            for (i = 0; i < row.product_variation_asset.length; i++) {
                                totalqty = parseInt(totalqty) + parseInt(row
                                    .product_variation_asset[i][
                                        'qty'
                                    ]);
                            }
                            return totalqty;
                        },
                    }, {
                        data: 'm_price',
                        name: 'm_price',
                        class: 'text-center',
                        searchable: true,
                        // Edit Tian
                        "render": function(data, type, row) {
                            let rupiah = Intl.NumberFormat('id-ID');

                            totalqty = 0;
                            for (i = 0; i < row.product_variation_asset.length; i++) {
                                totalqty = parseInt(totalqty) + parseInt(row
                                    .product_variation_asset[i][
                                        'qty'
                                    ]);
                            }
                            totalmodal = totalqty * parseInt(row.m_price);

                            return 'Rp ' + rupiah.format(totalmodal);
                        },
                    }, {
                        data: 'action',
                        name: 'action',
                        class: 'text-center fw-bold',
                        "render": function(data, type, row) {
                            return '<span><a class="text-theme" style="cursor: pointer;" onclick="openmodaledit()"><i class="fas fa-xl bi bi-eye-fill"></i></a>';
                        },
                    }, ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [0, 'desc']
                    ],
                    columnDefs: [{
                            orderable: false,
                            targets: [3]
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
            function openmodaledit(id, id_produk, id_ware, produk, m_price, brand) {
                $('#modaledit').modal('show');
                document.getElementById('id').value = id;
                document.getElementById("produk").innerHTML = produk;
                document.getElementById("brand").innerHTML = brand;


                var convert_m_price = m_price;
                var number_string = convert_m_price.toString(),
                    sisa = number_string.length % 3,
                    hasil_m_price = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '' : '';
                    hasil_m_price += separator + ribuan.join('.');
                }


                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_repeatorder') }}",
                    data: {
                        id: id,
                        id_produk: id_produk,
                        id_ware: id_ware,
                        produk: produk,
                        m_price: hasil_m_price,
                        brand: brand,
                    },
                    success: function(data) {
                        $("#repeatorder").html(data);
                    }
                });
            }

            function submitformedit() {
                if (document.forms["form_edit"]["type_po"].value == "") {
                    alert("SILAHKAN PILIH TIPE PO, TERLEBIH DAHULU.");
                    document.forms["form_edit"]["type_po"].focus();
                    return false;
                }

                var value = document.getElementById('id').value;
                document.getElementById('form_edit').action = "../repeat/repeats/" + value;
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
                document.getElementById('form_delete').action = "../repeat/destroy/" + value;
                document.getElementById("form_delete").submit();
            }
        </script> --}}
    @endsection
