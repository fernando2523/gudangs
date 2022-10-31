@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">SALES</a></li>
                    <li class="breadcrumb-item active">SALES PAGE</li>
                </ul>

                {{-- <h1 class="page-header">
                    Sales
                </h1> --}}
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
                                        <option value="" disabled selected>Choose Store</option>
                                        @foreach ($getstore as $gets)
                                            <option value="{{ $gets->store }}">{{ $gets->store }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-tooltip">
                                        Mohon pilih warehouse yang sesuai.
                                    </div>
                                </div>
                                <hr style="margin-top: 25px;">

                                <div class="col-12 form-group mb-3 mt-1">
                                    <label class="form-label">Store Expenses</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                        name="item" required placeholder="Mohon di isi nama pengeluaran toko"
                                        autocomplete="OFF">
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Desc</label>
                                    <textarea class="form-control form-control-sm text-theme is-invalid" type="text" name="desc" required
                                        placeholder="Opsional.." autocomplete="OFF" rows="2"></textarea>
                                </div>

                                <div class="col-12 form-group mb-3">
                                    <label class="form-label">Total Price</label>
                                    <input class="form-control form-control-sm text-theme is-invalid" type="number"
                                        name="total_price" required placeholder="0" autocomplete="OFF">
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

        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-5">
                <div class="row mb-3">
                    <div class="col-6">
                        <select class="form-select fw-bold  form-select-sm text-theme" name="store" required>
                            <option value="" disabled selected>Pilih Store..</option>
                            @foreach ($getstore as $stores)
                                <option value="{{ $stores->store }}">{{ $stores->store }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6">
                        <select class="form-select  fw-bold  form-select-sm text-theme" name="store" required>
                            <option value="" disabled selected>Pilih Kasir..</option>
                            @foreach ($getkasir as $kasir)
                                <option value="{{ $kasir->name }}">{{ $kasir->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-3" style="height: 601px;">
                        <!-- BEGIN input-group -->
                        <div class="input-group mb-4 row">
                            <div class="col-4 text-center" style="padding-top: 5px;">
                                <span class="flex-grow-1 fw-bold ">FIND PRODUCT</span>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                        style="z-index: 1020;">
                                        <i class="fa fa-search opacity-5"></i>
                                    </div>
                                    <input type="text"
                                        class="form-control border-theme text-theme fw-bold form-control-sm ps-35px"
                                        id="" placeholder="Search products.." />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table class="table-sm mb-0" style="width: 15%" id="tb_sale">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-center " hidden width="8%" style="color: #a8b6bc !important;">IMAGE
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
            <div class="col-xl-7">

                <div class="row mb-3">
                    <div class="col-7">
                        <select class="form-select fw-bold  form-select-sm text-theme" name="store" required>
                            <option value="" disabled selected>Customer..</option>
                            <option value="RETAIL">RETAIL</option>
                            <option value="RESELLER">RESELLER</option>
                            <option value="GROSIR">GROSIR</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <input class="form-control  fw-bold  form-control-sm text-lime text-center" type="text"
                            name="item" value="2022-11-01" autocomplete="OFF">
                    </div>
                    <div class="col-3">
                        <input class="form-control fw-bold form-control-sm text-lime text-center" type="text"
                            name="item" value="#5465406460564" autocomplete="OFF">
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-3  bg-white bg-opacity-5" style="height: 466px;">

                        <div class="input-group mb-4 row">
                            <div class="col-4 text-center" style="padding-top: 5px;">
                                <span class="flex-grow-1 fw-bold "><i class="fa fa-search opacity-5"></i> CURRENT SALE
                                    (0)</span>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                    <div class="input-group-text position-absolute top-0 bottom-0 bg-none border-0 pe-0"
                                        style="z-index: 1020;">
                                        <i class="fa fa-search opacity-5"></i>
                                    </div>
                                    <input type="text"
                                        class="form-control border-theme text-theme fw-bold form-control-sm ps-35px"
                                        id="" placeholder="Search barcode.." />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <table class="table-sm table table-striped" style="width: 100%;margin-top: -12px;" id="">
                            <thead style="font-size: 11px;">
                                <tr>
                                    <th class="text-left" width="60%" style="color: #a8b6bc !important;">NAME</th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">PRICE</th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">DISC</th>
                                    <th class="text-center" width="10%" style="color: #a8b6bc !important;">TOTAL
                                    </th>
                                    <th class="text-center" width="5%" style="color: #a8b6bc !important;">ACT</th>
                                </tr>
                            </thead>

                            <tbody style="font-size: 10px;">
                                <tr>
                                    <td class="text-left fw-bold">
                                        <span>Vans Old Skool Style 36 Anaheim Factory Black White</span><br>
                                        <span>41 = 1x</span>
                                    </td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center text-danger">X</td>
                                </tr>
                                <tr>
                                    <td class="text-left fw-bold">
                                        <span>Vans Old Skool Style 36 Anaheim Factory Black White</span><br>
                                        <span>41 = 1x</span>
                                    </td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">X</td>
                                </tr>
                                <tr>
                                    <td class="text-left fw-bold">
                                        <span>Vans Old Skool Style 36 Anaheim Factory Black White</span><br>
                                        <span>41 = 1x</span>
                                    </td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">X</td>
                                </tr>
                                <tr>
                                    <td class="text-left fw-bold">
                                        <span>Vans Old Skool Style 36 Anaheim Factory Black White</span><br>
                                        <span>41 = 1x</span>
                                    </td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">X</td>
                                </tr>
                                <tr>
                                    <td class="text-left fw-bold">
                                        <span>Vans Old Skool Style 36 Anaheim Factory Black White</span><br>
                                        <span>41 = 1x</span>
                                    </td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">X</td>
                                </tr>
                                <tr>
                                    <td class="text-left fw-bold">
                                        <span>Vans Old Skool Style 36 Anaheim Factory Black White</span><br>
                                        <span>41 = 1x</span>
                                    </td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">X</td>
                                </tr>
                                <tr>
                                    <td class="text-left fw-bold">
                                        <span>Vans Old Skool Style 36 Anaheim Factory Black White</span><br>
                                        <span>41 = 1x</span>
                                    </td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">X</td>
                                </tr>
                                <tr>
                                    <td class="text-left fw-bold">
                                        <span>Vans Old Skool Style 36 Anaheim Factory Black White</span><br>
                                        <span>41 = 1x</span>
                                    </td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">X</td>
                                </tr>
                                <tr>
                                    <td class="text-left fw-bold">
                                        <span>Vans Old Skool Style 36 Anaheim Factory Black White</span><br>
                                        <span>41 = 1x</span>
                                    </td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">0</td>
                                    <td class="text-center">313.131</td>
                                    <td class="text-center">X</td>
                                </tr>
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

                <div class="card mt-3">

                    <div class="card-body" style="height: auto;">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <select class="form-select  fw-bold  form-select-sm text-theme" name="store" required>
                                    <option value="" disabled selected>Reseller..</option>
                                    @foreach ($getreseller as $reseller)
                                        <option value="{{ $reseller->nama }}">{{ $reseller->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4" style="padding-left: 17px;">
                                <div class="row bagde border border-default">
                                    <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                        <span class="text-success fs-12px" style="width: 120px;">Amount
                                            : </span>
                                    </div>
                                    <div class="col-7" align="right" style="padding-top: 3px;">
                                        <span class="text-success fw-bold fs-12px" style="width: 120px;">Rp
                                            5.500.500</span>
                                    </div>
                                </div>

                                <div class="row bagde border border-default">
                                    <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                        <span class="text-yellow fs-12px" style="width: 120px;">Disc
                                            : </span>
                                    </div>
                                    <div class="col-7" align="right" style="padding-top: 3px;">
                                        <span class="text-yellow fw-bold fs-12px" style="width: 120px;">Rp 500.500</span>
                                    </div>
                                </div>

                                <div class="row bagde border border-default">
                                    <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                        <span class="text-indigo fs-12px" style="width: 120px;">Ongkir
                                            : </span>
                                    </div>
                                    <div class="col-7" align="right" style="padding-top: 3px;">
                                        <span class="text-indigo fw-bold fs-12px" style="width: 120px;">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-4">
                                        <button class="btn btn-purple" style="width: 100%;">ONGKIR</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-yellow" style="width: 100%;">DISCOUNT ALL</button>
                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-danger" style="width: 100%;">X</button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button class="btn btn-success fw-bold fs-14px" style="width: 100%;">Rp
                                            1.050.000</button>
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
                var table = $('#tb_sale').DataTable({
                    lengthMenu: [3],
                    responsive: true,
                    processing: false,
                    serverSide: true,
                    ajax: "/tablesale",
                    columns: [{
                        data: 'img',
                        name: 'img',
                        class: 'text-center',
                        searchable: true,
                        "render": function(data, type, row) {
                            if (row.img === "") {
                                return '<div class="card-body"><span><img src="/product/defaultimg.png" alt="" width="100" height="100" class="rounded"></span><span class="fw-bold"><br>' +
                                    row
                                    .id_produk +
                                    '</span><div class="card-arrow"><div class="card-arrow-top-left"></div><div class="card-arrow-top-right"></div><div class="card-arrow-bottom-left"></div><div class="card-arrow-bottom-right"></div></div>';
                            } else {
                                return '<span><img src="/product/' +
                                    row
                                    .img +
                                    '" alt="" width="95"  height="95" class="rounded"></span><br><span class="fw-bold">awdawd</span>';
                            }
                        },
                    }, ],
                    dom: 'tip',
                    // "ordering" : true,
                    order: [
                        [0, 'desc']
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [0]
                    }, ],
                });

                $('#search_sale').on('keyup', function() {
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
