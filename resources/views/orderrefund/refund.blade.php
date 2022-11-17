@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">REFUND ORDERS</a></li>
                    <li class="breadcrumb-item active">REFUND ORDERS PAGE</li>
                </ul>

                <h1 class="page-header">
                    History Refund Order
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
                    <div class="card-body p-3">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1 text-yellow">DATA REFUND ORDER</span>
                            <a href="#" data-toggle="card-expand"
                                class="text-white text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                        </div>
                        <div class="input-group mb-4">
                            <div class="flex-fill position-relative">
                                <div class="input-group">
                                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                        style="z-index: 1020;">
                                        <i class="fa fa-search opacity-5"></i>
                                    </div>
                                    <input type="text" class="form-control ps-35px" id="search_refund"
                                        placeholder="Search.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm table-bordered mb-0" style="width: 100%" id="tb_refund">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center" width="2%" style="color: #a8b6bc !important;">NO
                                    </th>
                                    <th class="text-center" width="3%" style="color: #a8b6bc !important;">STORE
                                    </th>
                                    <th class="text-center" width="7%" style="color: #a8b6bc !important;">TANGGAL
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">WAREHOUSE
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">CUSTOMER
                                    </th>
                                    <th class="text-center" width="40%" style="color: #a8b6bc !important;">NOTA
                                    </th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">USER
                                    </th>
                                    <th class="text-center" width="5%" style="color: #a8b6bc !important;">RINCIAN
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

        @include('orderrefund.detail')

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
                var table = $('#tb_refund').DataTable({
                    lengthMenu: [10],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablerefund",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'id',
                            class: 'text-center fw-bold',
                            searchable: false
                        }, {
                            data: 'stores',
                            name: 'stores',
                            class: 'text-center fw-bold',
                            searchable: true,
                            "render": function(data, type, row) {
                                return '<span><img src="/order/black-square.jpg" alt="" width="100" height="100" class="rounded"></span>';
                            },
                        }, {
                            data: 'tanggal',
                            name: 'tanggal',
                            class: 'text-center fw-bold',
                            searchable: true
                        }, {
                            data: 'warehouses',
                            name: 'warehouses',
                            class: 'text-center fw-bold',
                            searchable: true,
                            "render": function(data, type, row) {
                                return '<span>' + row.warehouses[0]['warehouse'] + '</span>';
                            },
                        }, {
                            data: 'customer',
                            name: 'customer',
                            class: 'text-center text-theme fw-bold',
                            searchable: true,
                            "render": function(data, type, row) {
                                if (row.customer === "RETAIL") {
                                    return '<span class="text-success">' + row.customer + '</span>';
                                } else {
                                    return '<span class="text-yellow">' + row.customer + '</span>';
                                }
                            },
                        }, {
                            data: 'id_invoice',
                            name: 'id_invoice',
                            class: 'text-center fw-bold',
                            searchable: true
                        },
                        {
                            data: 'users',
                            name: 'users',
                            class: 'text-center fw-bold',
                            searchable: true
                        },
                        {
                            data: 'action',
                            name: 'action',
                            class: 'text-center',
                            "render": function(data, type, row) {
                                return '<span><a class="text-info" style="cursor: pointer;margin-right: 10px;" onclick="openrincian(' +
                                    "'" + row.id_invoice + "'" +
                                    ',' +
                                    "'" + row.desc + "'" +
                                    ')"><i class="fas fa-xl bi bi-eye-fill"></i></a></span>';
                            },
                        },
                    ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [1, 'desc']
                    ],
                    columnDefs: [{
                            orderable: false,
                            targets: [5]
                        },

                    ],
                });

                $('#search_refund').on('keyup', function() {
                    table.search(this.value).draw();
                });
            });
            // end
        </script>

        <script>
            function openrincian(id_invoice, desc) {
                $('#modalrincian').modal('show');
                document.getElementById('id_invoice').innerHTML = id_invoice;
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/rincian_refund') }}",
                    data: {
                        id_invoice: id_invoice,
                        desc: desc,
                    },
                    success: function(data) {
                        $("#rincian_refund").html(data);
                    }
                });
            }
        </script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
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
        </script> --}}
    @endsection
