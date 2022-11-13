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

        {{-- <div class="modal fade" id="modaladd" data-bs-backdrop="static" style="padding-top:6%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD EXPENSES</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form class="was-validated" method="POST" action="{{ url('/store_expense/store_expenses/store') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="row form-group">
                                <div class="col-12 form-group position-relative mb-3">
                                    <label class="form-label">Store</label>
                                    <select class="form-select form-select-sm text-theme" name="store" required>
                                        @if (Auth::user()->role === 'SUPER-ADMIN')
                                            <option value="" disabled selected>Pilih Store</option>
                                            @foreach ($getstore as $gets)
                                                <option value="{{ $gets->store }}">{{ $gets->store }}
                                                </option>
                                            @endforeach
                                        @else
                                            @foreach ($getstore as $gets)
                                                @if (Auth::user()->id_store === $gets->id_store)
                                                    <option value="{{ $gets->store }}">{{ $gets->store }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon pilih store yang sesuai.
                                    </div>
                                </div>
                                <hr style="margin-top: 25px;">

                                <div class="col-12 form-group mb-3 mt-1">
                                    <label class="form-label">Store Expenses</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                        name="item" required placeholder="Mohon di isi nama pengeluaran"
                                        autocomplete="OFF">
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Desc</label>
                                    <textarea class="form-control form-control-sm text-theme is-invalid" type="text" name="desc"
                                        placeholder="Opsional.." autocomplete="OFF" rows="2"></textarea>
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Total Price</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                        name="total_price" required placeholder="0" autocomplete="OFF" type-currency="IDR">
                                </div>
                            </div>
                            <div class="form-group mt-3" align="right">
                                <button class="btn btn-theme" type="submit">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        <div class="row mb-3">
            <!-- TOTAL STOCK -->
            <div class="col-xl-2 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                            <div class="mb-1 text-default fw-bold text-center"">TOTAL ORDER</div>
                            <h4 class="text-white fs-14px text-center"">24 NOTA</h4>
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
            <div class="col-xl-2 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                        <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                            <div class="mb-1 text-default fw-bold text-center">TOTAL QTY</div>
                            <h4 class="text-white fs-14px text-center">224 PCS</h4>
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

            <div class="col-xl-2 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                        <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                            <div class="text-default mb-1 fw-bold text-center"">GROSS SALE</div>
                            <h4 class="text-white fs-14px text-center"">Rp 554.546.434</h4>
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

            <div class="col-xl-2 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                        <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                            <div class="text-default mb-1 fw-bold text-center"">EXPENSES</div>
                            <h4 class="text-indigo fs-14px text-center"">Rp 4.546.434</h4>
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

            <div class="col-xl-2 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                        <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                            <div class="text-default mb-1 fw-bold text-center"">DISCOUNT</div>
                            <h4 class="text-yellow fs-14px text-center"">Rp 11.846.434</h4>
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

            <div class="col-xl-2 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-10">
                        <div class="flex-fill" style="margin-top: 0px;margin-bottom: -5px;">
                            <div class="text-default mb-1 fw-bold text-center"">NET SALES</div>
                            <h4 class="text-info fs-14px text-center"">Rp 513.845.434</h4>
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
                                            placeholder="Search Order Retail.." />
                                    </div>
                                    <div style="width: 5%;">
                                        <button type="button" id="btn_search" class="btn btn-theme">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- tb awal --}}
                        <table class="table-sm mb-0" style="width: 100%">
                            <thead class="thead-custom">
                                <tr class="text-white">
                                    <th class="text-center text-white" width="2%">NO
                                    </th>
                                    <th class="text-center text-white" width="30%">
                                        PRODUCT
                                    </th>
                                    <th class="text-center text-white" width="5%">ID
                                    </th>
                                    <th class="text-center text-white" width="5%">
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
                            <tbody class="table-bordered" style="font-size: 11px;">

                                <tr>
                                    <td colspan="6" class="fw-bold " style="padding-top: 20px;">
                                        <span class="fs-12px text-success">RETAIL</span><br>
                                        <span class="fs-12px">1) </span>
                                        <span class="fs-12px text-success">#351354246404</span> | 2022-11-14<span
                                            style="padding-left: 5px;cursor: pointer;"><i
                                                class="fa fa-print fa-lg text-info me-2 ms-2"></i></span><span
                                            style="padding-left: 5px;cursor: pointer;"><i
                                                class="fa fa-times-circle fa-lg text-danger"></i></span><br>
                                        <span class="fs-11px text-white me-2">FOOTBOX</span><br>
                                        <span class="text-default">KASIR : Nando</span>
                                    </td>
                                    <td colspan="4" class="fw-bold fs-12px" align="right"
                                        style="padding-top: 20px;">
                                        <span><a class="btn  btn-primary btn-sm me-2 fw-bold text-white fs-10px"><i
                                                    class="bi bi-arrow-counterclockwise me-1 fa-1x"></i>TUKER
                                                SIZE</a></span>
                                        <span><a class="btn btn-danger btn-sm fw-bold text-white fs-10px"><i
                                                    class="fa fa-times me-1 fa-1x"></i>REFUND</a></span>
                                    </td>
                                </tr>

                                <tr class="tr-custom">
                                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                                        1
                                    </td>
                                    <td class="text-left fw-bold" style="border-right-width: 1px;">
                                        <a style="cursor: pointer;" onclick="openmodaldetail()">
                                            <span>SLIP ON CLASSICS BLACK WHITE</span>
                                        </a>
                                    </td>
                                    <td class="text-center" style="border-right-width: 1px;">
                                        1351351351
                                    </td>
                                    <td class="text-center text-lime fw-bold" style="border-right-width: 1px;">
                                        35
                                    </td>
                                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                                        2
                                    </td>
                                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                                        RP 350.000</td>
                                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                                        Rp 350.000
                                    </td>
                                    <td colspan="4" class="text-center fw-bold" style="border-right-width: 1px;">
                                        Rp 500.000
                                    </td>
                                </tr>

                                <tr class="tr-custom">
                                    <td colspan="7" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="text-center text-theme fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        CASH
                                    </td>
                                    <td class="text-center text-primary fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        BCA
                                    </td>
                                    <td class="text-center text-info fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        QRIS
                                    </td>
                                </tr>
                                <tr class="tr-custom">
                                    <td colspan="7" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="text-center fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        Rp 350.000
                                    </td>
                                    <td class="text-center fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        Rp 350.000
                                    </td>
                                    <td class="text-center fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        Rp 350.000
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Ongkir :
                                    </td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Rp 354.453
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Discount Nota :
                                    </td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Rp 354.453
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Amount :
                                    </td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Rp 354.453
                                    </td>
                                </tr>

                                <tr style="border-bottom: 3px solid #797979;">
                                    <td colspan="8" style="padding-top: 5px;padding-bottom: 20px;">
                                    </td>
                                </tr>

                                {{-- data reseller --}}
                                <tr>
                                    <td colspan="6" class="fw-bold " style="padding-top: 20px;">
                                        <span class="fs-12px text-yellow">RESELLER</span><br>
                                        <span class="fs-12px">2) </span>
                                        <span class="fs-12px text-yellow">#351354246404</span> | 2022-11-14<span
                                            style="padding-left: 5px;cursor: pointer;"><i
                                                class="fa fa-print fa-lg text-info me-2 ms-2"></i></span><span
                                            style="padding-left: 5px;cursor: pointer;"><i
                                                class="fa fa-times-circle fa-lg text-danger"></i></span><br>
                                        <span class="fs-11px text-white me-1">FOOTBOX</span> | <span
                                            class="ms-1 text-yellow">ASWIN
                                            SUBAGJA</span><br>
                                        <span class="text-default">KASIR : NANDO</span>
                                    </td>
                                    <td colspan="4" class="fw-bold fs-12px" align="right"
                                        style="padding-top: 20px;">
                                        <span><a class="btn btn-primary btn-sm me-2 fw-bold text-white fs-10px"><i
                                                    class="bi bi-arrow-counterclockwise me-1 fa-1x"></i>TUKER
                                                SIZE</a></span>
                                        <span><a class="btn btn-danger btn-sm fw-bold text-white fs-10px"><i
                                                    class="fa fa-times me-1 fa-1x"></i>REFUND</a></span>
                                    </td>
                                </tr>

                                <tr class="tr-custom">
                                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                                        1
                                    </td>
                                    <td class="text-left fw-bold" style="border-right-width: 1px;">
                                        <a style="cursor: pointer;" onclick="openmodaldetail()">
                                            <span>SLIP ON CLASSICS BLACK WHITE</span>
                                        </a>
                                    </td>
                                    <td class="text-center" style="border-right-width: 1px;">
                                        1351351351
                                    </td>
                                    <td class="text-center text-lime fw-bold" style="border-right-width: 1px;">
                                        35
                                    </td>
                                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                                        2
                                    </td>
                                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                                        RP 350.000</td>
                                    <td class="text-center fw-bold" style="border-right-width: 1px;">
                                        Rp 350.000
                                    </td>
                                    <td colspan="4" class="text-center fw-bold" style="border-right-width: 1px;">
                                        Rp 500.000
                                    </td>
                                </tr>

                                <tr class="tr-custom">
                                    <td colspan="7" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="text-center text-theme fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        CASH
                                    </td>
                                    <td class="text-center text-primary fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        BCA
                                    </td>
                                    <td class="text-center text-info fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        QRIS
                                    </td>
                                </tr>
                                <tr class="tr-custom">
                                    <td colspan="7" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="text-center fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        Rp 350.000
                                    </td>
                                    <td class="text-center fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        Rp 350.000
                                    </td>
                                    <td class="text-center fw-bold fs-11px"
                                        style="border-left-width: 1px;border-right-width: 1px;">
                                        Rp 350.000
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Ongkir :
                                    </td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Rp 354.453
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Discount Nota :
                                    </td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Rp 354.453
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" style="border-bottom: hidden;border-left: hidden;"></td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Amount :
                                    </td>
                                    <td class="fw-bold fs-12px" align="right"
                                        style="border-bottom: hidden;border-left: hidden;">
                                        Rp 354.453
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <br>
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

                        {{-- <table class="table-sm mb-0" style="width: 100%" data-search="true">
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
                        </table> --}}

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

        {{-- @include('store_expense.delete')
        @include('store_expense.edit') --}}

        {{-- <script>
            // edit
            function openmodaledit(id, id_costs, store, item, desc, total_price) {
                $('#modaledit').modal('show');
                document.getElementById('e_id').value = id;
                document.getElementById('e_id_costs').value = id_costs;
                document.getElementById('e_item').value = item;
                document.getElementById('e_totalprice').value = total_price;

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/expense_select_store') }}",
                    data: {
                        store: store,
                    },
                    success: function(data) {
                        $("#expense_select_store").html(data);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/expense_desc') }}",
                    data: {
                        desc: desc,
                    },
                    success: function(data) {
                        $("#expense_desc").html(data);
                    }
                });
            }

            function submitformedit() {
                var value = document.getElementById('e_id').value;
                document.getElementById('form_edit').action = "../store_expenses/editact/" + value;
                document.getElementById("form_edit").submit();
            }

            // delete
            function openmodaldelete(id) {
                $('#modaldelete').modal('show');
                document.getElementById('del_id').value = id;
            }

            function submitformdelete() {
                var value = document.getElementById('del_id').value;
                document.getElementById('form_delete').action = "../store_expenses/destroy/" + value;
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
        </script> --}}
        <script src="{{ URL::asset('assets/plugins/jquery/dist/jquery.js') }}"></script>
        <link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
            rel="stylesheet" />
        <script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

        <script src="{{ URL::asset('assets/daterangepicker/moment.min.js') }}"></script>
        <script src="{{ URL::asset('assets/daterangepicker/daterangepicker.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/daterangepicker/daterangepicker.css') }}" />
        {{-- <script type="text/javascript">
            $(document).ready(function() {
                var start = moment().startOf('month');
                var end = moment().endOf('month');

                document.getElementById('getbulan').value = start.format('YYYY-MMMM');
                var bulan = document.getElementById('getbulan').value;

                function cb(start, end) {
                    $('#reportrange span').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
                    load_data(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                    // load_data_barging(bulan.format('yyyy-MM'));
                }

                $('#reportrange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    }
                }, cb);

                $('#getbulan').datepicker({
                    format: "yyyy-MM",
                    startView: "year",
                    minViewMode: "months",
                    autoclose: true
                });

                cb(start, end);
                load_data_barging(bulan)

                $("#getbulan").change(function() {
                    load_data_barging(this.value)
                });

            });
        </script> --}}
    @endsection
