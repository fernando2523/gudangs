@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/location/locations">ASSETS</a></li>
                <li class="breadcrumb-item active">ASSETS PAGE</li>
            </ul>

            <div class="row">
                <div class="col-6">
                    <h1 class="page-header">
                        Assets (FIFO METHOD)
                    </h1>
                </div>
                <div align="right" class="col-6">
                    <div class="mb-4">
                        @if (Auth::user()->role === 'SUPER-ADMIN')
                            <select class="form-select form-select-sm text-theme fw-bold" id="select_ware"
                                onchange="select()" style="width: 250px;">
                                <option value="all_ware" selected>ALL WAREHOUSE..</option>
                                @foreach ($selectWarehouse as $select)
                                    <option value="{{ $select->id_ware }}">{{ $select->warehouse }}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-select form-select-sm text-theme fw-bold" id="select_ware"
                                onchange="select()" style="width: 250px;">
                                @foreach ($userware as $users)
                                    @foreach ($selectWarehouse as $select)
                                        @if ($select->id_ware === $users->id_ware)
                                            <option value="{{ $select->id_ware }}" selected>{{ $select->warehouse }}
                                            </option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="ms-auto">
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

            <div class="col-xl-2 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1 fw-bold">RELEASE</div>
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
            <div class="col-xl-2 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1 fw-bold">REPEAT</div>
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
            <div class="col-xl-2 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1 fw-bold">TRANSFER</div>
                            @if ($qtytransfer[0]->qtytransfers === null or $qtytransfer[0]->qtytransfers === '0')
                                <h4 class="text-theme">0</h4>
                            @else
                                <h4 class="text-theme">{{ $qtytransfer[0]->qtytransfers }}</h4>
                            @endif
                        </div>
                        <div class="opacity-5">
                            <i class="fa fa-exchange-alt fa-2x"></i>
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

            <!-- TOTAL STOCK -->
            <div class="col-xl-3 mb-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                        <div class="flex-fill" style="padding-top: 5px;padding-bottom: 0px;">
                            <div class="mb-1 fw-bold">STOCK ASSETS QUANTITY</div>
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
                            <div class="mb-1 fw-bold">ASSETS VALUATION</div>
                            <h4 class="text-theme">
                                <?php $totalmodal = 0; ?>
                                @foreach ($assets_valuation as $assets_valuations)
                                    @php
                                        $totalmodal = $totalmodal + $assets_valuations->qty * $assets_valuations->supplier[0]['m_price'];
                                    @endphp
                                @endforeach

                                @currency($totalmodal)
                            </h4>
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

        <div id="load_tb_assets"></div>

        @include('asset.detail')

        <script>
            var id_ware = $('#select_ware').val();

            $(document).ready(function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_tb_assets') }}",
                    data: {
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#load_tb_assets").html(data);
                    }
                });
            });

            function select() {
                var id_ware = $('#select_ware').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_tb_assets') }}",
                    data: {
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#load_tb_assets").html(data);
                    }
                });
            }

            function openmodaldetail(id_produk) {
                $('#modaldetail').modal('show');

                $.ajax({
                    type: 'POST',
                    url: "{{ URL::to('/load_detail_asset') }}",
                    data: {
                        id_produk: id_produk,
                    },
                    success: function(data) {
                        $("#load_detail_asset").html(data);
                    }
                });
            }
        </script>
    @endsection
