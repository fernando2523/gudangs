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
                                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                        style="z-index: 1020;">
                                        <i class="fa fa-search opacity-5"></i>
                                    </div>
                                    <input type="text" class="form-control ps-35px" id="search_purchaseOrder"
                                        placeholder="Search Data Purchase Order.." />
                                </div>
                            </div>
                        </div>
                        <table class="table-sm mb-0" style="width: 100%">
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
        </script>
    @endsection
