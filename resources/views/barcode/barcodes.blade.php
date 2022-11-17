@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">BARCODE</a></li>
                    <li class="breadcrumb-item active">BARCODE PAGE</li>
                </ul>

                <h1 class="page-header">
                    Barcode
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
        </style>

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: 490px;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex row fw-bold small mb-3">
                            <div class="col-9" style="margin-top: 7px;">
                                <span class="flex-grow-1">DATA BARCODE</span>
                            </div>
                            <div class="col-3">
                                <select class="form-select form-select-sm fw-bold" id="">
                                    <option value="">PILIH WAREHOUSE..</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="flex-fill position-relative">
                                <div class="input-group">
                                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                        style="z-index: 1020;">
                                        <i class="fa fa-search opacity-5"></i>
                                    </div>
                                    <input type="text" class="form-control form-control-sm ps-35px" id="search_barcode"
                                        placeholder="Search products.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_barcode">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
                                    </th>
                                    <th class="text-center" width="40%" style="color: #a8b6bc !important;">NAME
                                    </th>
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">ID PRODUCT
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">WAREHOUSE
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

        @include('barcode.detail')

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
                var table = $('#tb_barcode').DataTable({
                    lengthMenu: [10],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablebarcode",
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
                        "render": function(data, type, row, meta) {
                            return '<span class="fw-bold fs-14px text-white">' + row
                                .produk +
                                '</span><br><span class="fw-bold"><span class="fw-bold">' +
                                row.brand +
                                '</span>';
                        },
                    }, {
                        data: 'id_produk',
                        name: 'id_produk',
                        class: 'text-center',
                        searchable: true,
                        "render": function(data, type, row, meta) {
                            return '<span class="fw-bold">' + row
                                .id_produk +
                                '</span>';
                        },
                    }, {
                        data: 'warehouse',
                        name: 'warehouse',
                        class: 'text-center',
                        searchable: true,
                        "render": function(data, type, row, meta) {
                            return '<span class="fw-bold text-success">' + row
                                .warehouse[0]['warehouse'] +
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
                            b = 1;
                            v = '';

                            while (i < length) {
                                if (row.warehouse[0]['id_ware'] === row.product_variation[
                                        i][
                                        'id_ware'
                                    ]) {
                                    if (row.product_variation[i]['qty'] === 0) {
                                        size = size + '<span class="text-danger"> ' +
                                            '[<i>' +
                                            row
                                            .product_variation[i]['size'] +
                                            '</i><span class="text-danger"> = </span><span class="text-danger fw-bold">' +
                                            row.product_variation[
                                                i][
                                                'qty'
                                            ] +
                                            '</span><span class="fw-bold text-danger">] </span>';

                                    } else {
                                        size = size + '<span class="text-lime">' + '[<i>' +
                                            row
                                            .product_variation[i]['size'] +
                                            '</i><span class="text-lime"> = </span><span class="text-lime fw-bold">' +
                                            row.product_variation[
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
                                    v = '1';
                                }
                                i++;
                            }
                            if (v === '1') {
                                return size;
                            } else {
                                return '<span class="fw-bold text-warning">STOK TIDAK TERSEDIA</span>';
                            }
                        },
                    }, {
                        data: 'action',
                        name: 'action',
                        class: 'text-center fw-bold',
                        "render": function(data, type, row) {
                            return '<span><a class="text-lime" style="cursor: pointer;" onclick="openmodalbarcode(' +
                                "'" + row.id_produk + "'" +
                                ',' + "'" + row.id_ware + "'" +
                                ',' + "'" + row.id_area + "'" +
                                ')"><i class="fa-xl bi bi-upc-scan"> </i></a> </span><span><a class="text-default" style="font-weight: bold;"></a></span>';
                        },
                    }, ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [5, 'desc']
                    ],
                    columnDefs: [{
                            orderable: false,
                            targets: [0]
                        },

                    ],
                });

                $('#search_barcode').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>

        <script>
            // edit
            function openmodalbarcode(id_produk, id_ware, id_area) {
                $('#modalbarcode').modal('show');

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/barcode_detail') }}",
                    data: {
                        id_produk: id_produk,
                        id_ware: id_ware,
                        id_area: id_area,
                    },
                    success: function(data) {
                        $("#barcode_detail").html(data);
                    }
                });
            }

            function submitformbarcode() {
                var value = document.getElementById('id_produk').value;
                document.getElementById('form_barcode').action = "../barcode/barcodeact/" + value;
                document.getElementById("form_barcode").submit();
            }
        </script>
    @endsection
