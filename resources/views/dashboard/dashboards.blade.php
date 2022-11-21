@extends('layouts.main')
@section('container')
    <div id="load_dashboard" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">DASHBOARD</a></li>
                    <li class="breadcrumb-item active">DASHBOARD PAGE</li>
                </ul>

                <h1 class="page-header">
                    Dashboard
                </h1>
            </div>
            <div class="ms-auto">
                <div class="mt-3">
                    <select class="form-select fw-bold text-theme" id="" style="width: 250px;">
                        <option value="">ALL STORE..</option>
                    </select>
                </div>
            </div>
            <div class="ms-sm-3 mt-2">
                <div id="reportrange" class="btn btn-outline-theme d-flex align-items-center mt-2">
                    <span class="text-truncate">&nbsp;tanggal sekarang &nbsp;</span>
                    <i class="fa fa-caret-down ms-auto"></i>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- BEGIN col-3 -->
            <div class="col-xl-12 col-lg-6">
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <!-- BEGIN card -->
                        <div class="card mb-3">

                            <div class="card-body row">
                                <div class="col-8">
                                    <div class="d-flex fw-bold small mb-3">
                                        <span class="flex-grow-1">SALES</span>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <h3 class="mb-0 fs-14px">{{ $get_sales }} Sales</h3>
                                    </div>
                                </div>
                                <div class="col-3" align="right">
                                    <i class="bi bi-receipt-cutoff fa-3x  text-theme"></i>
                                </div>
                            </div>

                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                            <!-- END card-arrow -->
                        </div>
                        <!-- END card -->
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card mb-3">

                            <div class="card-body row">
                                <div class="col-8">
                                    <div class="d-flex fw-bold small mb-3">
                                        <span class="flex-grow-1">QTY</span>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        <h3 class="mb-0 fs-14px">{{ $get_qty }} Pcs</h3>
                                    </div>
                                </div>
                                <div class="col-3" align="right">
                                    <i class="bi bi-box fa-3x  text-theme"></i>
                                </div>
                            </div>

                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                            <!-- END card-arrow -->
                        </div>
                        <!-- END card -->
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card mb-3">

                            <div class="card-body row">
                                <div class="col-8">
                                    <div class="d-flex fw-bold small mb-3">
                                        <span class="flex-grow-1">EXPENDITURE</span>
                                    </div>
                                    <div class="row align-items-center mb-2">
                                        @if ($get_expense > 0)
                                            <h3 class="mb-0 fs-14px">@currency($get_expense)</h3>
                                        @else
                                            <h3 class="mb-0 fs-14px">Rp 0</h3>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3" align="right">
                                    <i class="bi bi-cash-stack fa-3x  text-theme"></i>
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

                    <div class="col-xl-3 col-lg-6">
                        <!-- BEGIN card -->
                        <div class="card mb-3">

                            <div class="card-body row">
                                <div class="col-8">
                                    <div class="d-flex fw-bold small mb-3">
                                        <span class="flex-grow-1">REVENUE</span>
                                    </div>
                                    <div class="row align-items-center mb-0">
                                        @if (count($get_payment) > 0)
                                            @if ($getTotalpayment > 0)
                                                <h3 class="mb-0 fs-14px">@currency($getTotalpayment)</h3>
                                            @else
                                                <h3 class="mb-0 fs-14px">Rp 0</h3>
                                            @endif
                                        @else
                                            <h3 class="mb-0 fs-14px">Rp 0</h3>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-3" align="right">
                                    <i class="bi bi-currency-dollar fa-3x text-theme"></i>
                                </div>
                            </div>

                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                            <!-- END card-arrow -->
                        </div>
                        <!-- END card -->
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-6">
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <!-- BEGIN card -->
                        <div class="card mb-3">
                            <!-- BEGIN card-body -->
                            <div class="card-body" align="center">
                                <!-- BEGIN title -->
                                <div class="d-flex fw-bold small mb-3">
                                    <span class="flex-grow-1 text-success">CASH</span>
                                </div>
                                <!-- END title -->
                                <!-- BEGIN stat-lg -->
                                <div class="row align-items-center mb-2">
                                    <div class="col-12">
                                        @if (count($get_payment) > 0)
                                            @if ($get_payment[0]->cashs > 0)
                                                <h3 class="mb-0 fs-14px">@currency($get_payment[0]->cashs)</h3>
                                            @else
                                                <h3 class="mb-0 fs-14px">Rp 0</h3>
                                            @endif
                                        @else
                                            <h3 class="mb-0 fs-14px">Rp 0</h3>
                                        @endif
                                    </div>
                                </div>
                                <!-- END stat-lg -->
                            </div>
                            <!-- END card-body -->

                            <!-- BEGIN card-arrow -->
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                            <!-- END card-arrow -->
                        </div>


                        <!-- END card -->
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <!-- BEGIN card -->
                        <div class="card mb-3">
                            <!-- BEGIN card-body -->
                            <div class="card-body" align="center">
                                <!-- BEGIN title -->
                                <div class="d-flex fw-bold small mb-3">
                                    <span class="flex-grow-1 text-info">BCA</span>
                                </div>
                                <!-- END title -->
                                <!-- BEGIN stat-lg -->
                                <div class="row align-items-center mb-2">
                                    <div class="col-12">
                                        @if (count($get_payment) > 0)
                                            @if ($get_payment[0]->bcas > 0)
                                                <h3 class="mb-0 fs-14px">@currency($get_payment[0]->bcas)</h3>
                                            @else
                                                <h3 class="mb-0 fs-14px">Rp 0</h3>
                                            @endif
                                        @else
                                            <h3 class="mb-0 fs-14px">Rp 0</h3>
                                        @endif
                                    </div>
                                </div>
                                <!-- END stat-lg -->
                                <!-- BEGIN stat-sm -->
                                <!-- END stat-sm -->
                            </div>
                            <!-- END card-body -->

                            <!-- BEGIN card-arrow -->
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                            <!-- END card-arrow -->
                        </div>


                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card mb-3">
                            <!-- BEGIN card-body -->
                            <div class="card-body" align="center">
                                <!-- BEGIN title -->
                                <div class="d-flex fw-bold small mb-3">
                                    <span class="flex-grow-1" style="color: cyan;">QRIS</span>
                                </div>
                                <!-- END title -->
                                <!-- BEGIN stat-lg -->
                                <div class="row align-items-center mb-2">
                                    <div class="col-12">
                                        @if (count($get_payment) > 0)
                                            @if ($get_payment[0]->qriss > 0)
                                                <h3 class="mb-0 fs-14px">@currency($get_payment[0]->qriss)</h3>
                                            @else
                                                <h3 class="mb-0 fs-14px">Rp 0</h3>
                                            @endif
                                        @else
                                            <h3 class="mb-0 fs-14px">Rp 0</h3>
                                        @endif
                                    </div>
                                </div>
                                <!-- END stat-lg -->
                                <!-- BEGIN stat-sm -->
                                <!-- END stat-sm -->
                            </div>
                            <!-- END card-body -->

                            <!-- BEGIN card-arrow -->
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                            <!-- END card-arrow -->
                        </div>
                        <!-- END card -->
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="card mb-3">
                            <!-- BEGIN card-body -->
                            <div class="card-body" align="center">
                                <div class="d-flex fw-bold small">
                                    <span class="flex-grow-1 text-lime">TOTAL PAYMENT</span>
                                </div>
                                <div class="row align-items-center mb-2 mt-3">
                                    <div class="col-12">
                                        @if (count($get_payment) > 0)
                                            @php
                                                $totalpayment = intval($get_payment[0]->cashs) + intval($get_payment[0]->bcas) + intval($get_payment[0]->qriss);
                                            @endphp
                                            @if ($totalpayment > 0)
                                                <h3 class="mb-0 fs-14px">@currency($totalpayment)</h3>
                                            @else
                                                <h3 class="mb-0 fs-14px">Rp 0</h3>
                                            @endif
                                        @else
                                            <h3 class="mb-0 fs-14px">Rp 0</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- END card-body -->

                            <!-- BEGIN card-arrow -->
                            <div class="card-arrow">
                                <div class="card-arrow-top-left"></div>
                                <div class="card-arrow-top-right"></div>
                                <div class="card-arrow-bottom-left"></div>
                                <div class="card-arrow-bottom-right"></div>
                            </div>
                            <!-- END card-arrow -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-3">
                    <div class="card-body" style="height: 460px;">
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">TOP 10 PRODUCTS</span>
                            <a href="#" data-toggle="card-expand"
                                class="text-white text-opacity-50 text-decoration-none"><i
                                    class="bi bi-fullscreen"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless mb-2px small text-nowrap">
                                <tbody>
                                    @foreach ($getTop_product as $topProduct)
                                        <tr>
                                            <td width="70%">
                                                <span class="d-flex align-items-center"
                                                    style="font-size: 11px;font-weight: bold;">
                                                    <i class="bi bi-circle-fill fs-6px text-success me-2"></i>
                                                    {{ $topProduct->produk }}
                                                </span>
                                            </td>
                                            <td class="text-right" align="right" width="20%"
                                                style="font-weight: bold;">
                                                <small>{{ $topProduct->id_brand }}</small>
                                            </td>
                                            <td align="right" width="10%">
                                                <span
                                                    class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-100px"
                                                    style="min-height: 18px;font-size: 10px;">
                                                    {{ $topProduct->qtys }} Pcs
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <ul align="right" class="mt-3">
                                <a type="button" href="/fuel/history" class="btn btn-outline-theme btn-sm">See
                                    All</a>
                            </ul>
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

            <div class="col-xl-6">
                <div class="card mb-3">
                    <div class="card-body" style="height: 460px;">
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">TOP 10 RESELLER</span>
                            <a href="#" data-toggle="card-expand"
                                class="text-white text-opacity-50 text-decoration-none"><i
                                    class="bi bi-fullscreen"></i></a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless mb-2px small text-nowrap">
                                <tbody>
                                    @foreach ($getTop_reseller as $topReseller)
                                        <tr>
                                            <td width="80%">
                                                <span class="d-flex align-items-center"
                                                    style="font-size: 11px;font-weight: bold;">

                                                    <i class="bi bi-circle-fill fs-6px text-success me-2"></i>
                                                    {{ $topReseller->id_reseller }}
                                                </span>
                                            </td>
                                            <td align="right" width="20%">
                                                <span
                                                    class="badge d-block bg-success bg-opacity-75 rounded-0 pt-5px w-150px"
                                                    style="min-height: 18px;font-size: 10px;">
                                                    {{ $topProduct->qtys }} Pcs
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <ul align="right" class="mt-3">
                                <a type="button" href="/fuel/history" class="btn btn-outline-theme btn-sm">See All</a>
                            </ul>
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

        {{-- <div class="row">
            <div class="col-xl-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex fw-bold small mb-3">
                            <span class="flex-grow-1">REPORT EARNING</span>
                        </div>
                        <div class="ratio ratio-21x9 mb-3">
                            <div id="chart-server"></div>
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
        </div> --}}
    </div>

    <script src="{{ URL::asset('assets/plugins/jquery/dist/jquery.js') }}"></script>
    <link href="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet" />
    <script src="{{ URL::asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var start = moment().startOf('month');
            var end = moment().endOf('month');

            // document.getElementById('getbulan').value = start.format('YYYY-MMMM');
            // var bulan = document.getElementById('getbulan').value;

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

            // $('#getbulan').datepicker({
            //     format: "yyyy-MM",
            //     startView: "year",
            //     minViewMode: "months",
            //     autoclose: true
            // });

            cb(start, end);
            load_data_barging(bulan)

            // $("#getbulan").change(function() {
            //     load_data_barging(this.value)
            // });

        });

        // function load_data(start, end){
        //     $.ajax({
        //         type:'POST',
        //         url:"{{ URL::to('/load_data') }}",
        //         data:{
        //             start: start,
        //             end: end,
        //         },
        //         success:function(data){
        //             $('#data_load').html(data);
        //         }
        //     });
        // }

        // function load_data_barging(bulan){
        //     $.ajax({
        //         type:'POST',
        //         url:"{{ URL::to('/load_data_barging') }}",
        //         data:{
        //             bulan: bulan,
        //         },
        //         success:function(data){
        //             $('#data_load_barging').html(data);
        //         }
        //     });
        // }
    </script>


    <script src="{{ URL::asset('assets/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ URL::asset('assets/daterangepicker/daterangepicker.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/daterangepicker/daterangepicker.css') }}" />
@endsection
