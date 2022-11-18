@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">ORDERS</a></li>
                    <li class="breadcrumb-item active">RETAIL PAGE</li>
                </ul>

                <h1 class="page-header">
                    Orders Retail
                </h1>
            </div>
            <div class="ms-auto">
                <div id="reportrange" class="btn btn-outline-theme d-flex align-items-center mt-2">
                    <span class="text-truncate">&nbsp;tanggal sekarang &nbsp;</span>
                    <i class="fa fa-caret-down ms-auto"></i>
                </div>
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

        <div class="row mb-3">
            <div class="col-3">
                <div class="row">
                    <div class="col-xl-6 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="mb-1 text-default fw-bold text-center">NOTA</div>
                                    <h4 class="text-white fs-12px text-center">{{ number_format($nota, 0, ',', '.') }} NOTA
                                    </h4>
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
                    <!-- END -->
                    <div class="col-xl-6 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="mb-1 text-default fw-bold text-center">QTY</div>
                                    <h4 class="text-white fs-12px text-center">{{ number_format($qty, 0, ',', '.') }} PCS
                                    </h4>
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

            <div class="col-9">
                <div class="row">
                    <div class="col-xl-2 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">ONGKIR</div>
                                    <h4 class="text-default fs-12px text-center">@currency($ongkir)</h4>
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

                    <div class="col-xl-3 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">GROSS SALE</div>
                                    <h4 class="text-white fs-12px text-center">@currency($gross_sale)</h4>
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

                    <div class="col-xl-2 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">EXPENSES</div>
                                    <h4 class="text-red fs-12px text-center">@currency($expenses)</h4>
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

                    <div class="col-xl-2 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">DISCOUNT</div>
                                    {{-- <h4 class="text-yellow fs-12px text-center">@currency($discount)</h4> --}}
                                    <h4 class="text-yellow fs-12px text-center">{{ $discount }}</h4>
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

                    <div class="col-xl-3 mb-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                                <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                                    <div class="text-default mb-1 fw-bold text-center">NET SALES</div>
                                    <h4 class="text-info fs-12px text-center">@currency($net_sales)</h4>
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
        </div>

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: auto;">
                        <!-- BEGIN input-group -->
                        <div class="input-group mb-2">
                            <div class="flex-fill position-relative">
                                <div class="input-group">

                                    <div style="width: 94%;margin-right:1%;">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                            style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                        <style>
                                            #search_purchaseOrder::-webkit-search-cancel-button {}
                                        </style>
                                        <input type="search" class="form-control ps-35px" id="search"
                                            placeholder="Search Order.." />
                                    </div>
                                    <div style="width: 5%;">
                                        <button type="button" id="btn_search" class="btn btn-theme">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            .thead-custom {
                                font-size: 11px;
                                background-color: darkslategray;
                            }

                            .tr-custom {
                                font-size: 11px;
                                border-left-width: 1px;
                                border-right-width: 1px;
                                border-bottom-width: 1px;
                                border-top-width: 1px;
                            }
                        </style>
                        <div class="mt-2 mb-2" id="search_var" style="display: none;">
                            <button id="clear_search" class="btn btn-sm btn-theme ms-1 me-1">Clear Search</button>
                            <span>Searching : <span id="query_search"></span></span>
                        </div>
                        {{-- tb awal --}}
                        <table class="table-sm mb-0 mt-2" style="width: 100%">
                            <thead class="thead-custom">
                                <tr class="text-white">
                                    <th class="text-center text-white" width="2%">NO
                                    </th>
                                    <th class="text-center text-white" width="30%">
                                        PRODUCT
                                    </th>
                                    <th class="text-center text-white" width="7%">ID PRODUCT
                                    </th>
                                    <th class="text-center text-white" width="3%">
                                        SIZE
                                    </th>
                                    <th class="text-center text-white" width="3%">
                                        QTY
                                    </th>
                                    <th class="text-center text-white" width="7%">PRICE
                                    </th>
                                    <th class="text-center text-white" width="7%">
                                        DISC ITEM
                                    </th>
                                    <th colspan="3" class="text-center text-white" width="25%">SUB
                                        TOTAL
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered" style="font-size: 11px;" id="load_tborder">
                            </tbody>
                        </table>
                        <br>
                        {{-- tb awal --}}
                        <center>
                            {{-- <button type="button" class="btn btn-sm btn-outline-theme" id="load_more">Load
                                More</button> --}}
                            <input type="hidden" id="validate" value="0">
                        </center>
                    </div>
                    <!-- Data Loader -->
                    {{-- <div class="auto-load text-center">
                        <div class="spinner-border"></div>
                    </div> --}}
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

        <form class="was-validated" method="POST" action="/cancel_order">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <div class="modal fade" id="cancel_order" data-bs-backdrop="static" style="padding-top:5%;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-warning">DELETE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
                            <p>Delete Order?</p>
                        </div>
                        <input type="hidden" id="id_invoice" name="id_invoice">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-warning" type="submit">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <form class="" method="POST" action="/refund_order">
            @csrf
            <div class="modal fade" id="refund_order" data-bs-backdrop="static" style="padding-top:5%;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-success">REFUND PRODUCT <span id="s_idinvoice"></span></h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" style="font-weight: bold;" id="load_refund">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-theme" type="submit">Refund</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form class="" method="POST" action="/retur_order">
            @csrf
            <div class="modal fade" id="retur_order" data-bs-backdrop="static" style="padding-top:5%;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-success">RETUR PRODUCT <span id="s_idinvoice"></span></h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" style="font-weight: bold;" id="load_retur">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-theme" type="submit">Retur</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            function cancel_order(id_invoice) {
                document.getElementById('id_invoice').value = id_invoice;
                $('#cancel_order').modal('show');
            }

            function refund_order(id_invoice, count) {
                document.getElementById('s_idinvoice').innerHTML = id_invoice;

                $.ajax({
                    url: "/load_refund",
                    type: "POST",
                    data: {
                        id_invoice: id_invoice,
                        count: count
                    },
                    beforeSend: function() {
                        $("#load_refund").html(`<div class="text-center w-100">
                            <div class="m-auto spinner-border"></div>
                        </div>`);
                    },
                    success: function(data) {
                        $("#load_refund").html(data);
                    }
                });

                $('#refund_order').modal('show');
            }

            function retur_order(id_invoice, count) {
                document.getElementById('s_idinvoice').innerHTML = id_invoice;

                $.ajax({
                    url: "/load_retur",
                    type: "POST",
                    data: {
                        id_invoice: id_invoice,
                        count: count
                    },
                    beforeSend: function() {
                        $("#load_retur").html(`<div class="text-center w-100">
                            <div class="m-auto spinner-border"></div>
                        </div>`);
                    },
                    success: function(data) {
                        $("#load_retur").html(data);
                    }
                });

                $('#retur_order').modal('show');
            }
        </script>

        <script>
            var query_awal = '';
            var id_awal = 0;

            $(document).ready(function() {
                load_tborders(query_awal, 1, id_awal);
            });

            $("#btn_search").click(function() {
                var query = $('#search').val();
                if (query != '') {
                    document.getElementById('validate').value = 0;
                    page = 1;
                    val_last = '';
                    load_tborders(query, page, id_awal);
                    $("#search_var").css("display", "block");
                    $("#query_search").html(query);
                } else {
                    alert('Masukan Query Pencarian');
                }
            });

            $("#clear_search").click(function() {
                document.getElementById('validate').value = 0;
                page = 1;
                val_last = '';
                load_tborders('', page, id_awal);
                $("#search_var").css("display", "none");
                $("#search").val('');
            });

            function load_tborders(querys, pages, start_data) {
                $("#load_tborder").html('');
                $.ajax({
                    type: 'GET',
                    url: "/load_tborders",
                    data: {
                        querys: querys,
                        last_id: start_data,
                        pages: pages
                    },
                    beforeSend: function() {
                        $("#load_tborder").html(
                            `<tr style="width:100%;">
                                <td colspan="8" align="center" style="padding: 30px 0px 20px 0px;">
                                    <div class="spinner-border"></div>
                                </td>
                            </tr>`);
                    },
                    success: function(data) {
                        $("#load_tborder").html(data);
                    }
                });
            }

            var page = 1;
            var val_last = '';

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
                    var validate = document.getElementById('validate').value;
                    if (validate == '0' && val_last != 'last') {
                        document.getElementById('validate').value = 1;
                        index = parseInt(page) - 1;
                        page++;
                        var last_id = document.getElementsByName('last_id[]')[index].value;
                        val_last = last_id;
                        var query = $('#search').val();
                        if (val_last != 'last') {
                            loadmore_tborders(query, page, last_id);
                        }
                    }
                }
            });

            function loadmore_tborders(querys, pages, start_data) {
                $.ajax({
                    type: 'GET',
                    url: "/load_tborders",
                    data: {
                        querys: querys,
                        last_id: start_data,
                        pages: pages
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        document.getElementById('validate').value = 0;
                        $("#load_tborder").append(data);
                    }
                });
            }
        </script>
    @endsection
