@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">PURCHASE ORDER</a></li>
                    <li class="breadcrumb-item active">PURCHASE ORDER PAGE</li>
                </ul>

                <h1 class="page-header">
                    Purchase Order
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
        <div class="modal fade" id="modaldetail" data-bs-backdrop="static" style="padding-top:12%;">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">RINCIAN ORDER</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/purchase/purchaseorder/store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group" id="load_purchase_order">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <!-- TOTAL STOCK -->
            <div class="col-xl-6 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1 fw-bold">TOTAL PURCHASE ORDER</div>
                            <h4 class="text-theme">{{ $totalpo }}</h4>
                        </div>
                        <div class="opacity-5">
                            <i class="bi bi-tags-fill fa-3x"></i>
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
            <div class="col-xl-6 mb-6">
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

                                    <div style="width: 94%;margin-right:1%;">
                                        <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                            style="z-index: 1020;">
                                            <i class="fa fa-search opacity-5"></i>
                                        </div>
                                        <style>
                                            #search_purchaseOrder::-webkit-search-cancel-button {}
                                        </style>
                                        <input type="search" class="form-control ps-35px" id="search_purchaseOrder"
                                            placeholder="Search Data Purchase Order.." />
                                    </div>
                                    <div style="width: 5%;">
                                        <button type="button" id="btn_search" class="btn btn-theme">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- tb awal --}}
                        {{-- <table class="table-sm mb-0" style="width: 100%">
                            <thead class="thead-custom">
                                <tr class="text-white">
                                    <th class="text-center text-white" width="2%">NO
                                    </th>
                                    <th class="text-center text-white" width="50%">
                                        PRODUCT
                                    </th>
                                    <th class="text-center text-white" width="4%">ACT
                                    </th>
                                    <th class="text-center text-white" width="5%">
                                        TYPE
                                    </th>
                                    <th class="text-center text-white" width="10%">
                                        SUPPLIER
                                    </th>
                                    <th class="text-center text-white" width="3%">QTY
                                    </th>
                                    <th class="text-center text-white" width="10%">
                                        COST
                                    </th>
                                    <th class="text-center text-white" width="12%">SUB
                                        TOTAL
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered" style="font-size: 11px;">
                                @foreach ($datapo as $items => $data)
                                    <?php $items++; ?>
                                    <tr>
                                        <td colspan="6" class="fw-bold " style="padding-top: 20px;">
                                            <span class="fs-12px">{{ $items }})</span> <span
                                                class="fs-12px text-lime">#{{ $data->tanggal }} -
                                                {{ $data->idpo }}</span>
                                            <span style="padding-left: 5px;"><i
                                                    class="fa fa-times-circle fa-lg text-danger"></i></span>
                                        </td>
                                        <td colspan="2" class="fw-bold fs-12px" align="right"
                                            style="padding-top: 20px;">
                                            <span>USER : {{ $data->users }}</span>
                                        </td>
                                    </tr>
                                    <?php $i = 0; ?>
                                    @foreach ($datapoDetail as $item => $detail)
                                        @if ($detail->idpo === $data->idpo)
                                            <?php $i++; ?>
                                            <tr class="tr-custom">
                                                <td class="text-center fw-bold" style="border-right-width: 1px;">
                                                    {{ $i }}
                                                </td>
                                                <td class="text-left fw-bold" style="border-right-width: 1px;">
                                                    <a style="cursor: pointer;"
                                                        onclick="openmodaldetail('{{ $detail->idpo }}','{{ $detail->id_produk }}','{{ $detail->id_ware }}','{{ $detail->produk }}')">
                                                        <span>{{ $detail->id_produk }}</span><br>
                                                        <span>{{ $detail->produk }} | {{ $detail->brand }}</span>
                                                    </a>
                                                </td>
                                                <td class="text-center" style="border-right-width: 1px;">
                                                    <span>
                                                        <a style="cursor: pointer;"
                                                            onclick="openmodaledit('{{ $detail->id }}','{{ $detail->idpo }}','{{ $detail->id_produk }}','{{ $detail->id_ware }}','{{ $detail->produk }}','{{ $detail->id_sup }}','{{ $detail->m_price }}','{{ $detail->tipe_order }}')">
                                                            <i class="fas fa-lg fa-edit text-info"></i>
                                                        </a>
                                                        <a>
                                                            <i class="fas fa-lg fa-times-circle text-danger"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                                @if ($detail->tipe_order === 'RELEASE')
                                                    <td class="text-center text-lime fw-bold"
                                                        style="border-right-width: 1px;">
                                                        {{ $detail->tipe_order }}
                                                    </td>
                                                @else
                                                    <td class="text-center text-yellow fw-bold"
                                                        style="border-right-width: 1px;">
                                                        {{ $detail->tipe_order }}
                                                    </td>
                                                @endif
                                                <td class="text-center fw-bold" style="border-right-width: 1px;">
                                                    @foreach ($supplier as $sups)
                                                        @if ($sups->id_sup === $detail->id_sup)
                                                            {{ $sups->supplier }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-center fw-bold" style="border-right-width: 1px;">
                                                    {{ $detail->qty }}</td>
                                                <td class="text-center fw-bold" style="border-right-width: 1px;">
                                                    @currency($detail->m_price)
                                                </td>
                                                <td class="text-center fw-bold" style="border-right-width: 1px;">
                                                    @currency($detail->subtotal)
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr class="tr-custom">
                                        <td colspan="5" style="border-bottom: hidden;border-left: hidden;"></td>
                                        <td class="text-center fw-bold fs-12px"
                                            style="border-left-width: 1px;border-right-width: 1px;">
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
                                            @foreach ($datatotalqty as $kuantity)
                                                @if ($kuantity->idpo === $data->idpo)
                                                    {{ $kuantity->total_qty }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td colspan="2" class="text-right text-white fw-bold fs-12px"
                                            style="border-left-width: 1px;border-right-width: 1px;" align="right">
                                            @foreach ($datasubtotal as $item => $subs)
                                                @if ($subs->idpo === $data->idpo)
                                                    <span style="margin-right: 25px;">@currency($subs->subtotals)</span>
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 3px solid #797979;">
                                        <td colspan="8" style="padding-top: 10px;padding-bottom: 20px;">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br> --}}
                        {{-- tb awal --}}
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

                        <table class="table-sm mb-0" style="width: 100%" data-search="true">
                            <thead class="thead-custom">
                                <tr class="text-white">
                                    <th class="text-center text-white" width="2%">NO
                                    </th>
                                    <th class="text-center text-white" width="50%">
                                        PRODUCT
                                    </th>
                                    <th class="text-center text-white" width="4%">ACT
                                    </th>
                                    <th class="text-center text-white" width="5%">
                                        TYPE
                                    </th>
                                    <th class="text-center text-white" width="10%">
                                        SUPPLIER
                                    </th>
                                    <th class="text-center text-white" width="3%">QTY
                                    </th>
                                    <th class="text-center text-white" width="10%">
                                        COST
                                    </th>
                                    <th class="text-center text-white" width="12%">SUB
                                        TOTAL
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tb_po">
                            </tbody>
                        </table>

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

        <form class="was-validated" method="POST" action="/deleted_po">
            <input type="hidden" name="_method" value="PATCH">
            @csrf
            <div class="modal fade" id="modaldelete" data-bs-backdrop="static" style="padding-top:3%;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-warning">DELETE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
                            <p>Are You Sure Want To Delete This Item?</p>
                        </div>
                        <input type="hidden" id="d_idpo" name="d_idpo">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-warning" type="submit">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form class="was-validated" method="POST" action="/deleteitem_po">
            @csrf
            <div class="modal fade" id="modalitemdelete" data-bs-backdrop="static" style="padding-top:3%;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-warning">DELETE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center text-warning" style="padding-bottom: 0px;font-weight: bold;">
                            <p>Are You Sure Want To Delete This Item?</p>
                        </div>
                        <input type="hidden" id="d_id" name="d_id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button class="btn btn-outline-warning" type="submit">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="showQty" data-bs-backdrop="static" style="margin-top:3%;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-success"><span id="name_produk"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <div id="load_details">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-default" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <form method="POST" action="/edit_po">
            @csrf
            <div class="modal fade" id="editPo" data-bs-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="modal-title text-warning">Edit : <span id="name_produk_edit"></span></span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body text-center" style="padding-bottom: 0px;">
                            <div id="edit_details">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-default"
                                data-bs-dismiss="modal">Cancel</button>
                            <button id="btn_edit" class="btn btn-outline-warning" type="submit">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <script>
            function deleteModal(idpo) {
                document.getElementById('d_idpo').value = idpo;
                $('#modaldelete').modal('show');
            }

            function deleteitemModal(id) {
                document.getElementById('d_id').value = id;
                $('#modalitemdelete').modal('show');
            }

            function showQty(id_produk, idpo, id_ware, produk) {
                $("#name_produk").html(produk);
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_details_po') }}",
                    data: {
                        id_produk: id_produk,
                        idpo: idpo,
                        id_ware: id_ware
                    },
                    beforeSend: function() {
                        $("#load_details").html('<div class="spinner-border"></div>');
                    },
                    success: function(data) {
                        $("#load_details").html(data);
                    }
                });

                $('#showQty').modal('show');
            }

            function editPo(id_produk, idpo, id_ware, produk) {
                $("#name_produk_edit").html(produk);
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_edit_po') }}",
                    data: {
                        id_produk: id_produk,
                        idpo: idpo,
                        id_ware: id_ware
                    },
                    beforeSend: function() {
                        $("#edit_details").html('<div class="spinner-border"></div>');
                        $("#btn_edit").prop("disabled", true);
                    },
                    success: function(data) {
                        $("#btn_edit").prop("disabled", false);
                        $("#edit_details").html(data);
                    }
                });

                $('#editPo').modal('show');
            }
        </script>

        @include('purchase.edit')

        <script>
            // edit
            function openmodaldetail(idpo, id_produk, id_ware, produk) {
                $('#modaldetail').modal('show');

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_purchase_order') }}",
                    data: {
                        idpo: idpo,
                        id_produk: id_produk,
                        id_ware: id_ware,
                        produk: produk,
                    },
                    success: function(data) {
                        $("#load_purchase_order").html(data);
                    }
                });
            }

            function openmodaledit(id, idpo, id_produk, id_ware, produk, id_sup, m_price, tipe_order) {
                $('#modaledit').modal('show');
                document.getElementById('e_id').value = id;

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/purchase_variation') }}",
                    data: {
                        idpo: idpo,
                        id_produk: id_produk,
                        id_ware: id_ware,
                        produk: produk,
                        id_sup: id_sup,
                        m_price: m_price,
                        tipe_order: tipe_order,
                    },
                    success: function(data) {
                        $("#purchase_edit").html(data);
                    }
                });
            }

            // delete
            function openmodaldelete(id, id_produk) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
                document.getElementById('del_id_produk').value = id_produk;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../purchase/destroy/" + value;
                document.getElementById("form_delete").submit();
            }

            // Load Table PO
            function load_po() {
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
            }
            // Load Table PO
        </script>

        {{-- Tb Load PO --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            var query_awal = '';
            var page = 1;

            $(document).ready(function() {
                load_tb_po(query_awal, 1);
            });

            $('#search_purchaseOrder').on('input', function(e) {
                if ('' == this.value) {
                    load_tb_po(query_awal, 1);
                }
            });

            $('#btn_search').click(function() {
                var query = $('#search_purchaseOrder').val();
                load_tb_po(query, 1);
            });

            function load_tb_po(querys, pages) {
                $("#tb_po").html('');
                $.ajax({
                    type: 'GET',
                    url: "/load_tb_po?page=" + pages,
                    data: {
                        querys: querys
                    },
                    beforeSend: function() {
                        $("#tb_po").html(
                            `<tr style="width:100%;">
                                <td colspan="8" align="center" style="padding: 30px 0px 20px 0px;">
                                    <div class="spinner-border"></div>
                                </td>
                            </tr>`);
                    },
                    success: function(data) {
                        $("#tb_po").html(data);
                    }
                });
            }

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() + 100 >= $(document).height()) {
                    page++;
                    var query = $('#search_purchaseOrder').val();
                    loadmore_tb_po(query, page);
                }
            });

            function loadmore_tb_po(querys, page) {
                $.ajax({
                        url: "/load_tb_po?page=" + page,
                        type: "GET",
                        data: {
                            querys: querys
                        },
                        beforeSend: function() {
                            $('.auto-load').show();
                        }
                    })
                    .done(function(response) {
                        if (response.length == 0) {
                            $('.auto-load').html("We don't have more data to display :(");
                            return;
                        }
                        $('.auto-load').hide();
                        $("#tb_po").append(response);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                    });
            }
        </script>
        {{-- Tb Load PO --}}
    @endsection
