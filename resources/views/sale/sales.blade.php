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
    <form id="form_pay" action="/savesales" method="POST">
        @csrf
        <div class="row">
            <!-- DATA ASSSET -->
            <div class="col-xl-5">
                <div class="row mb-3">
                    <div class="col-6">
                        <select class="form-select fw-bold  form-select-sm text-theme" id="select_store" name="store" required>
                            <option value="" disabled selected>Pilih Store..</option>
                            @foreach ($getstore as $stores)
                                <option data-ware="{{ $stores->id_ware }}" value="{{ $stores->store }}">{{ $stores->store }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="r_warehouse" id="r_warehouse">
                    </div>

                    <div class="col-6">
                        <select class="form-select  fw-bold  form-select-sm text-theme" id="cashier" name="cashier" required>
                            <option value="" disabled selected>Pilih Kasir..</option>
                            @foreach ($getkasir as $kasir)
                                <option value="{{ $kasir->name }}">{{ $kasir->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- List Product --}}
                <div class="card">
                    <div class="card-body p-3" id="card-catalog" style="height: 550px;">
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
                                    <input type="text" class="form-control text-theme fw-bold form-control-sm ps-35px" id="search_product" placeholder="Search products.." disabled/>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <style>
                            /* Hide scrollbar for Chrome, Safari and Opera */
                            .scroll-hide::-webkit-scrollbar {
                                display: none;
                            }

                            /* Hide scrollbar for IE, Edge and Firefox */
                            .scroll-hide {
                            -ms-overflow-style: none;  /* IE and Edge */
                            scrollbar-width: none;  /* Firefox */
                            }
                        </style>
                        {{-- Load Product --}}
                        <div class="row scroll-hide load_data" id="product_catalog" style="overflow-y: scroll;height: 83%;padding-bottom:40%;">
                            <div align="center" id="opening" style="margin: auto;">
                                Silahkan Pilih Store
                            </div>
                        </div>
                        {{-- Load Product --}}
                    </div>
                    <div class="card-arrow">
                        <div class="card-arrow-top-left"></div>
                        <div class="card-arrow-top-right"></div>
                        <div class="card-arrow-bottom-left"></div>
                        <div class="card-arrow-bottom-right"></div>
                    </div>
                </div>
                 {{-- End List Product --}}

                {{-- Script Ajax Load Product --}}
                
	            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                <script type="text/javascript">
                    var page = 1;
                    var heigh = $('#product_catalog').height();
                    var warehouse = '';

                    $("#select_store").change(function() {
                        
                        $("#opening").css("display", "none");
                        var ware = $(this).find(':selected').data("ware");
                        warehouse = ware;
                        $('#r_warehouse').val(warehouse);
                        loadMoreData(page, ware);
                        
                        $("#search_product").prop( "disabled", false );
                        $("#search_product").addClass( "border-theme" );
                    });

                    // $("#search_product").change(function() {
                    //     console.log(this.value);
                    // });
                    
                    $("#search_product").bind("enterKey",function(e) {
                        console.log(this.value);
                        loadMoreData(page, warehouse);
                    });

                    $('#search_product').keyup(function(e){
                        if(e.keyCode == 13)
                        {
                            $(this).trigger("enterKey");
                        }
                    });

                    $('#product_catalog').scroll(function() {
                        if($('#product_catalog').scrollTop()+550 > heigh) {
                            page++;
                            loadMoreData(page, warehouse);
                            heigh= heigh+heigh;
                            console.log('PAGE '+page);
                            console.log($('#product_catalog').scrollTop()+150);
                            console.log(heigh);
                        }
                            
                    });
                
                    function loadMoreData(page, warehouse){
                        $.ajax({
                            url: "/tablesale?page="+ page,
                            type: "POST",
                            data: {
                                warehouse: warehouse,
                            },
                            beforeSend: function () {
                            }
                        })
                        .done(function (response) {
                            // if (response.length == 0) {
                            //     $('.auto-load').html("We don't have more data to display :(");
                            //     return;
                            // }
                            $(".load_data").append(response);
                        })
                        .fail(function (jqXHR, ajaxOptions, thrownError) {
                            console.log('Server error occured');
                        });
                    }
                </script>
                {{-- End Script Ajax Load Product --}}


            </div>
            <!-- END -->
            <div class="col-xl-7">

                <div class="row mb-3">
                    <div class="col-7">
                        <select class="form-select fw-bold  form-select-sm text-theme" id="customer" name="customer" required>
                            <option value="" disabled selected>Customer..</option>
                            <option value="RETAIL">RETAIL</option>
                            <option value="RESELLER">RESELLER</option>
                            <option value="GROSIR">GROSIR</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <?php 
                            $datenow = Carbon\Carbon::now()->format('Y-m-d');;
                        ?>
                        <input class="form-control  fw-bold  form-control-sm text-lime text-center" type="text" name="r_tanggal" value="{{ $datenow }}" readonly>
                    </div>
                    <div class="col-3">
                        <input class="form-control fw-bold form-control-sm text-lime text-center" type="text" name="r_idinvoice" value="#5465406460564" readonly>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-3 bg-dark bg-opacity-50" style="height: 370px;">

                        <div class="input-group mb-4 row">
                            <div class="col-4 text-center" style="padding-top: 5px;">
                                <span class="flex-grow-1 fw-bold "><i class="fa fa-search opacity-5"></i> CURRENT SALE <span id="counter_span">(0)</span></span>
                                <input type="hidden" id="count" name="count" value="0">
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
                        <style>
                            thead, tbody {
                                display: block;
                            }
                            tbody {
                                height: 67%;       /* Just for the demo          */
                                overflow-y: auto;    /* Trigger vertical scroll    */
                                overflow-x: hidden;  /* Hide the horizontal scroll */
                            }
                        </style>
                        <table id="table" class="table table-striped " style="margin-top: -12px;width: 100% !important;height: 100%;">
                            <thead style="font-size: 11px;width: 100% !important;">
                                <tr>
                                    <th class="text-left" width="58.5%" style="color: #a8b6bc !important;">PRODUCT</th>
                                    <th class="text-center" width="15%" style="color: #a8b6bc !important;">QTY</th>
                                    <th class="text-center" width="15%" style="color: #a8b6bc !important;">PRICE</th>
                                    <th class="text-center" width="15%" style="color: #a8b6bc !important;">DISC</th>
                                    <th class="text-center" width="15%" style="color: #a8b6bc !important;">TOTAL
                                    </th>
                                    <th class="text-center" width="15%" style="color: #a8b6bc !important;">ACT</th>
                                </tr>
                            </thead>
                                <tbody id="table_cart" class="scroll-hide" style="font-size: 10px;width: 100% !important;">
                                  
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
                           
                            <div class="col-4" style="padding-left: 17px;">
                                <div class="row bagde border border-default">
                                    <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                        <span class="text-success fs-12px" style="width: 120px;">Sub Total
                                            : </span>
                                    </div>
                                    <div class="col-7" align="right" style="padding-top: 3px;">
                                        <span class="text-success fw-bold fs-12px" style="width: 120px;">Rp <span id="rh_subtotal">0</span></span>
                                    </div>
                                    <input type="hidden" value="0" id="rs_subtotal">
                                </div>

                                <div class="row bagde border border-default">
                                    <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                        <span class="text-yellow fs-12px" style="width: 120px;">Disc Items
                                            : </span>
                                    </div>
                                    <div class="col-7" align="right" style="padding-top: 3px;">
                                        <span class="text-yellow fw-bold fs-12px" style="width: 120px;">Rp <span id="rh_discitems">0</span></span>
                                    </div>
                                    <input type="hidden" value="0" id="rs_discitems">
                                </div>

                                <div class="row bagde border border-default">
                                    <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                        <span class="text-yellow fs-12px" style="width: 120px;">Disc Nota
                                            : </span>
                                    </div>
                                    <div class="col-7" align="right" style="padding-top: 3px;">
                                        <span class="text-yellow fw-bold fs-12px" style="width: 120px;">Rp <span id="rh_discnota">0</span></span>
                                    </div>
                                    <input type="hidden" value="0" id="rs_discnota" name="rs_discnota">
                                </div>

                                <div class="row bagde border border-default">
                                    <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                        <span class="text-indigo fs-12px" style="width: 120px;">Ongkir
                                            : </span>
                                    </div>
                                    <div class="col-7" align="right" style="padding-top: 3px;">
                                        <span class="text-indigo fw-bold fs-12px" style="width: 120px;">Rp <span id="rh_ongkir">0</span></span>
                                    </div>
                                    <input type="hidden" value="0" id="rs_ongkir" name="rs_ongkir">
                                </div>

                                <div class="row bagde border border-default">
                                    <div class="col-5" align="left" style="height: 27px;padding-top: 3px;">
                                        <span class="text-success fs-12px" style="width: 120px;">Payment
                                            : </span>
                                    </div>
                                    <div class="col-7" align="right" style="padding-top: 3px;">
                                        <span class="text-success fw-bold fs-12px" style="width: 120px;">Rp <span id="rh_payment">0</span></span>
                                    </div>
                                    <input type="hidden" value="0" id="rs_payment" name="rs_payment">
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="col-12 mb-3" style="display: none" id="show_reseller">
                                    <select class="form-select fw-bold form-select-sm text-theme" id="reseller_name" name="reseller_name" required>
                                        <option value="" disabled selected>Name Reseller..</option>
                                        @foreach ($getreseller as $reseller)
                                            <option value="{{ $reseller->id_reseller }}">{{ $reseller->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <button type="button" id="btn_ongkir" class="btn btn-default" style="width: 100%;" disabled onclick="ongkirModal()">ONGKIR</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-yellow" style="width: 100%;" onclick="discountModal()">DISCOUNT ALL</button>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-danger" style="width: 100%;" onclick="clear_cart()">X</button>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-success fw-bold fs-14px" style="width: 100%;" onclick="paymentModal()">PAY (Rp <span id="pay_ammount">0</span>)</button>
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

         {{-- Modal Payment --}}
         <div class="modal fade" id="paymentModal" style="margin-top: 3%;">
            <div class="modal-dialog" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                <h5 class="modal-title">Payment</h5>
                <button type="button" class="btn btn-outline-theme btn-sm" onclick="hide_payment_modal()">x</button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">Amount</div>
                    <center><h2>Rp <span id="s_grandtotal">0</span></h2></center>
                    <input type="hidden" value="" id="r_grandtotal" name="r_grandtotal">
                    <div class="mb-4 mt-4">Payment Method</div>
                    <div class="row mb-3" align="center">
                        <div class="col-3">
                            <img src="https://lokigudang.com/img/cash1.png" width="55%">
                        </div>
                        <div class="col-9">
                            <input class="form-control" type="text" placeholder="Cash Amount" min="0" id="r_cash" name="r_cash" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    
                    <div class="row mb-3" align="center">
                        <div class="col-3">
                            <img src="https://lokigudang.com/img/bca1.png" width="55%">
                        </div>
                        <div class="col-9">
                            <input class="form-control" type="text" placeholder="BCA Amount" id="r_bca" name="r_bca" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>

                    <div class="row mb-3" align="center">
                        <div class="col-3">
                            <img src="https://lokigudang.com/img/mandiri1.png" width="55%">
                        </div>
                        <div class="col-9">
                            <input class="form-control" type="text" placeholder="MANDIRI Amount" id="r_mandiri" name="r_mandiri" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>

                    <div class="row mb-3" align="center">
                        <div class="col-3">
                            <img src="https://lokigudang.com/img/banktransfer.png" width="55%">
                        </div>
                        <div class="col-9">
                            <input class="form-control" type="text" placeholder="Bank Transfer Amount" id="r_banktf" name="r_banktf" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        </div>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-theme" onclick="save_payment()">Pay</button>
                </div>
            </div>
            </div>
        </div>
        {{-- Modal Payment --}}

        {{-- Modal Ongkir --}}
        <div class="modal fade" id="ongkirModal" style="margin-top: 7%;">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Biaya Ongkir</h5>
                <button type="button" class="btn btn-theme btn-sm" onclick="hide_ongkir_modal()">x</button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="md_ongkir" placeholder="Masukan Biaya Ongkir">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="hide_ongkir_modal()">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_ongkir()">Save changes</button>
                </div>
            </div>
            </div>
        </div>
        {{-- Modal Ongkir --}}

        {{-- Modal Discount --}}
        <div class="modal fade" id="discountModal" style="margin-top: 7%;">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Discount Nota</h5>
                <button type="button" class="btn btn-theme btn-sm" onclick="hide_discountModal()">x</button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="md_discountnota" placeholder="Masukan Discount">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="hide_discountModal()">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_discount()">Save changes</button>
                </div>
            </div>
            </div>
        </div>
        {{-- Modal Discount --}}

        <!-- BEGIN #modalPosItem -->
        <div class="modal modal-pos fade" id="modalPosItem" style="margin-top: 3%;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0">
                    <div class="card">
                        <div class="card-body p-0">
                            <a href="#" onclick="hide_modal()" class="btn-close position-absolute top-0 end-0 m-4"></a>
                            <div class="modal-pos-product">
                                <div class="modal-pos-product-img">
                                    <div class="img"><img id="image_product" width="100%"></div>
                                    <input type="hidden" id="mdl_produk" name="mdl_produk" value="">
                                    <input type="hidden" id="mdl_id_produk" name="mdl_id_produk" value="">
                                    <input type="hidden" id="mdl_id_brand" name="mdl_id_brand" value="">
                                    <input type="hidden" id="mdl_quality" name="mdl_quality" value="">
                                    <input type="hidden" id="mdl_m_price" name="mdl_m_price" value="">
                                    <input type="hidden" id="mdl_selling_price" name="mdl_selling_price" value="">
                                </div>
                                <div class="modal-pos-product-info">
                                    <div class="h5 mb-2" id="md_nameproduct"></div>
                                    <div class="text-white text-opacity-50 mb-2" id="md_warehouse"></div>
                                    <div class="h6 mb-3" id="md_price"></div>
                                   
                                    <hr class="mx-n4" />
                                    <div class="mb-4">
                                        <div class="fw-bold mb-2">Size:</div>
                                        <style>
                                            .radio-toolbar input[type="radio"] {
                                            display: none;
                                            }

                                            .radio-toolbar label {
                                            display: inline-block;
                                            padding: 4px 11px;
                                            font-family: Arial;
                                            font-size: 16px;
                                            cursor: pointer;
                                            }

                                            .radio-toolbar input[type="radio"]:checked+label {
                                            color: black;
                                            background-color: aquamarine;
                                            }

                                            .radio-toolbar label {
                                                color: aquamarine;
                                                padding: 10px 15px 10px 15px;
                                                border: 1px solid;
                                                border-radius: 5px;
                                                margin-top: 5px;
                                                margin-bottom: 5px;
                                                font-size: 12px;
                                            }
                                        </style>
                                        <div class="radio-toolbar row" id="load_size">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="fw-bold mb-2">Qty:</div>
                                                <div class="d-flex mb-3">
                                                    <button type="button" class="btn btn-outline-theme" onclick="change_qty('minus')"><i class="fa fa-minus"></i></button>
                                                    <input type="text" class="form-control w-50px fw-bold mx-2 border-1 border-theme text-center" id="mdl_qty" value="1" readonly />
                                                    <button type="button" class="btn btn-outline-theme" onclick="change_qty('plus')"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="fw-bold mb-2">Discount Item:</div>
                                                <select class="form-select fw-bold border-theme text-theme" id="mdl_diskon_item">
                                                    <option value="0" selected>Rp 0</option>
                                                    <option value="10000">Rp 10.000</option>
                                                    <option value="20000">Rp 20.000</option>
                                                    <option value="30000">Rp 30.000</option>
                                                    <option value="40000">Rp 40.000</option>
                                                    <option value="50000">Rp 50.000</option>
                                                    <option value="60000">Rp 60.000</option>
                                                    <option value="70000">Rp 70.000</option>
                                                    <option value="80000">Rp 80.000</option>
                                                    <option value="90000">Rp 90.000</option>
                                                    <option value="100000">Rp 100.000</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <script>
                                        function change_qty(params) {
                                            var value = document.getElementById("mdl_qty").value;
                                            if (params=='minus') {
                                                if (value==1) {
                                                } else {
                                                    document.getElementById("mdl_qty").value= parseInt(value)-1;
                                                }
                                            } else if (params=='plus') {
                                                document.getElementById("mdl_qty").value=parseInt(value)+1;
                                            }
                                        }
                                    </script>
                                    <hr class="mx-n4" />
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="#" class="btn btn-default h4 mb-0 d-block rounded-0 py-3" onclick="hide_modal()">Cancel</a>
                                        </div>
                                        <div class="col-8">
                                            <a onclick="addCart()" class="btn btn-success d-flex justify-content-center align-items-center rounded-0 py-3 h4 m-0">Add to cart <i class="bi bi-plus fa-2x ms-2 my-n3"></i></a>
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
        </div>
        <!-- END #modalPosItem -->
        
    </form>

        <script>
            // $( document ).ready(function() {
            //     $('#modalPosItem').modal('show');
            // });

            $(document).on("dblclick", ".open-modal", function () {
                var cashier = $('#cashier').find(":selected").val();
                var customer = $('#customer').find(":selected").val();
                var reseller_name = $('#reseller_name').find(":selected").val();

                var md_nameproduct = $(this).data('md_nameproduct');
                var image_product = $(this).data('image_product');
                var id_produk = $(this).data('id_produk');
                var id_ware = $(this).data('id_ware');
                var id_brand = $(this).data('id_brand');
                var quality = $(this).data('quality');
                var m_price = $(this).data('m_price');

                var n_price = $(this).data('n_price');
                var r_price = $(this).data('r_price');
                var g_price = $(this).data('g_price');

                $('#mdl_produk').val(md_nameproduct);
                $('#mdl_id_produk').val(id_produk) ;
                $('#mdl_id_brand').val(id_brand) ;
                $('#mdl_quality').val(quality) ;
                $('#mdl_m_price').val(m_price) ;
                $("#md_nameproduct").html(md_nameproduct);
                $('#image_product').attr('src','/product/'+image_product);

                if (customer=='RETAIL') {
                    $('#mdl_selling_price').val(n_price) ;
                    $("#md_price").html('Rp '+new Intl.NumberFormat('ID-ID', { maximumSignificantDigits: 3 }).format(n_price));
                } else if (customer=='RESELLER')  {
                    $('#mdl_selling_price').val(r_price) ;
                    $("#md_price").html('Rp '+new Intl.NumberFormat('ID-ID', { maximumSignificantDigits: 3 }).format(r_price));
                } else if (customer=='GROSIR')  {
                    $('#mdl_selling_price').val(g_price) ;
                    $("#md_price").html('Rp '+new Intl.NumberFormat('ID-ID', { maximumSignificantDigits: 3 }).format(g_price));
                }
        
                if (cashier=='') {
                    alert('Silahkan Pilih Kasir');
                } else {
                    if (customer=='') {
                        alert('Silahkan Pilih Tipe Customer');
                    } else {
                        if (customer=='RESELLER' || customer=='GROSIR') {
                            if (reseller_name=='') {
                                alert('Silahkan Pilih Nama Reseller');
                            } else {
                                load_size(id_produk, id_ware);
                                $('#modalPosItem').modal('show');
                            }
                        } else {
                            load_size(id_produk, id_ware);
                            $('#modalPosItem').modal('show');
                        }
                    }
                }
        
                
            });

            function load_size(id_produk, id_ware) {
                $.ajax({
                    url: "/load_size",
                    type: "POST",
                    data: {
                        id_produk: id_produk,
                        id_ware: id_ware
                    },
                           
                    })
                    .done(function (response) {
                        $("#load_size").html(response);
                    })
                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        console.log('Server error occured');
                        });               
            }

            $('#customer').on('change', function() {
                clear_cart();
                if (this.value != 'RETAIL') {
                    $("#show_reseller").css("display", "block");
                    $("#btn_ongkir").prop( "disabled", false );
                    $("#btn_ongkir").removeClass( "btn-default" ).addClass( "btn-purple" );
                } else {
                    $("#show_reseller").css("display", "none");
                    $("#btn_ongkir").prop( "disabled", true );
                    $("#btn_ongkir").removeClass( "btn-purple" ).addClass( "btn-default" );
                }
            });

            function addCart()
            {
                var table = document.getElementById("table");
                var tbo = table.tBodies[0].rows.length;
                var length = parseInt(tbo)+1;

                document.getElementById("counter_span").innerHTML = "("+length+")"  ;
                document.getElementById("count").value = length ;
                
                if ($('input[name=mdl_size]:checked').length > 0) {
                    var mdl_size = document.querySelector('input[name="mdl_size"]:checked').value;
                    var mdl_produk = document.getElementById("mdl_produk").value;
                    var mdl_id_produk = document.getElementById("mdl_id_produk").value;
                    var mdl_id_brand = document.getElementById("mdl_id_brand").value;
                    var mdl_quality = document.getElementById("mdl_quality").value;
                    var mdl_m_price = document.getElementById("mdl_m_price").value;
                    var mdl_selling_price = document.getElementById("mdl_selling_price").value;
                    var mdl_qty = document.getElementById("mdl_qty").value;
                    var mdl_diskon_item  = parseInt(document.getElementById("mdl_diskon_item").value) * parseInt(mdl_qty);
                    var mdl_subtotal = (mdl_selling_price * mdl_qty) - mdl_diskon_item ;

                    document.getElementById("table_cart").insertRow(-1).innerHTML = `
                    <tr>
                        <td class="text-left fw-bold" style="width:60%;">
                            <span>`+mdl_produk+`</span><br>
                            <input type="hidden" id="r_produk" name="r_produk[]" value="`+mdl_produk+`">
                            <input type="hidden" id="r_id_produk" name="r_id_produk[]" value="`+mdl_id_produk+`">
                            <input type="hidden" id="r_id_brand" name="r_id_brand[]" value="`+mdl_id_brand+`">
                            <input type="hidden" id="r_quality" name="r_quality[]" value="`+mdl_quality+`">
                            <input type="hidden" id="r_m_price" name="r_m_price[]" value="`+mdl_m_price+`">
                            <input type="hidden" id="r_selling_price" name="r_selling_price[]" value="`+mdl_selling_price+`">
                            <input type="hidden" id="r_subtotal" name="r_subtotal[]" value="`+mdl_subtotal+`">
                            <input type="hidden" id="r_size" name="r_size[]" value="`+mdl_size+`">
                            <input type="hidden" id="r_qty" name="r_qty[]" value="`+mdl_qty+`">
                            <input type="hidden" id="r_diskon_item" name="r_diskon_item[]" value="`+mdl_diskon_item+`">
                        </td>
                        <td width="15%" class="text-center">`+mdl_qty+`x`+mdl_size+`</td>
                        <td width="15%" class="text-center">`+new Intl.NumberFormat('ID-ID', { maximumSignificantDigits: 3 }).format(mdl_selling_price)+`</td>
                        <td width="15%" class="text-center">`+new Intl.NumberFormat('ID-ID', { maximumSignificantDigits: 3 }).format(mdl_diskon_item)+`</td>
                        <td width="15%" class="text-center">`+new Intl.NumberFormat('ID-ID', { maximumSignificantDigits: 3 }).format(mdl_subtotal)+`</td>
                        <td width="10%" class="text-center"><button onclick="deleteRow(this)" type="button" class="btn btn-sm btn-danger">X</button></td>
                    </tr>
                    `;

                    document.getElementById("rh_subtotal").innerHTML = parseInt(document.getElementById("rs_subtotal").value) + parseInt(mdl_selling_price);
                    document.getElementById("rs_subtotal").value = parseInt(document.getElementById("rs_subtotal").value) + parseInt(mdl_selling_price);
                    /////////////////////////////
                    document.getElementById("rh_discitems").innerHTML = parseInt(document.getElementById("rs_discitems").value) + parseInt(mdl_diskon_item);
                    document.getElementById("rs_discitems").value = parseInt(document.getElementById("rs_discitems").value) + parseInt(mdl_diskon_item);
                    /////////////////////////////
                    document.getElementById("rh_payment").innerHTML = parseInt(document.getElementById("rs_subtotal").value) - (parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById("rs_discnota").value) + parseInt(document.getElementById("rs_ongkir").value));
                    document.getElementById("rs_payment").value =  parseInt(document.getElementById("rs_subtotal").value) - (parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById("rs_discnota").value) + parseInt(document.getElementById("rs_ongkir").value));
                    document.getElementById("pay_ammount").innerHTML = document.getElementById("rs_payment").value;
                    /////////////////////////////
                    document.getElementById("mdl_qty").value = 1;
                    document.getElementById("mdl_diskon_item").value = 0;
                    $('#modalPosItem').modal('hide');
                } else {
                    alert('Mohon Pilih Size');
                }
            }

            function hide_modal()
            {
                document.getElementById("mdl_qty").value = 1;
                document.getElementById("mdl_diskon_item").value = 0;
                $('#modalPosItem').modal('hide');
            }

            function deleteRow(r) {
                var i = r.parentNode.parentNode.rowIndex;
                var r = i-1;

                var subtotal = document.getElementsByName('r_selling_price[]')[r].value;
                var discitem = document.getElementsByName('r_diskon_item[]')[r].value;
                
                document.getElementById("rh_subtotal").innerHTML = parseInt(document.getElementById("rs_subtotal").value) - parseInt(subtotal);
                document.getElementById("rs_subtotal").value = parseInt(document.getElementById("rs_subtotal").value) - parseInt(subtotal);
                /////////////////////////////
                document.getElementById("rh_discitems").innerHTML = parseInt(document.getElementById("rs_discitems").value) - parseInt(discitem);
                document.getElementById("rs_discitems").value = parseInt(document.getElementById("rs_discitems").value) - parseInt(discitem);
                /////////////////////////////
                document.getElementById("rh_payment").innerHTML = parseInt(document.getElementById("rs_subtotal").value) - (parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById("rs_discnota").value) + parseInt(document.getElementById("rs_ongkir").value));
                document.getElementById("rs_payment").value =  parseInt(document.getElementById("rs_subtotal").value) - (parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById("rs_discnota").value) + parseInt(document.getElementById("rs_ongkir").value));
                document.getElementById("pay_ammount").innerHTML = document.getElementById("rs_payment").value;      

                document.getElementById("table").deleteRow(i);

                var table = document.getElementById("table");
                var tbo = table.tBodies[0].rows.length;
                var length = parseInt(tbo);
                document.getElementById("counter_span").innerHTML = "("+length+")" ;
                document.getElementById("count").value = length ;

                if (tbo == '0') {
                     /////////////////////////////
                    document.getElementById("rh_discnota").innerHTML = 0;
                    document.getElementById("rs_discnota").value = 0;
                    /////////////////////////////
                    document.getElementById("rh_ongkir").innerHTML = 0;
                    document.getElementById("rs_ongkir").value = 0;
                    /////////////////////////////
                    document.getElementById("rh_payment").innerHTML = 0;
                    document.getElementById("rs_payment").value =  0;
                    document.getElementById("pay_ammount").innerHTML = 0;   
                    /////////////////////////////   
                }
            }

            function ongkirModal() {
                var amount = document.getElementById("rs_payment").value;

                if (amount == '0') {
                    alert('Silahkan Masukan Pesanan Dahulu');
                } else {
                    $('#ongkirModal').modal('show');
                }
            }

            function hide_ongkir_modal() {
                $('#ongkirModal').modal('hide');
            }

            function save_ongkir() {
                /////////////////////////////
                document.getElementById("rh_ongkir").innerHTML = parseInt(document.getElementById("md_ongkir").value);
                document.getElementById("rs_ongkir").value = parseInt(document.getElementById("md_ongkir").value);
                /////////////////////////////
                document.getElementById("rh_payment").innerHTML = parseInt(document.getElementById("rs_subtotal").value) - (parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById("rs_discnota").value) + parseInt(document.getElementById("rs_ongkir").value));
                document.getElementById("rs_payment").value =  parseInt(document.getElementById("rs_subtotal").value) - (parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById("rs_discnota").value) + parseInt(document.getElementById("rs_ongkir").value));
                document.getElementById("pay_ammount").innerHTML = document.getElementById("rs_payment").value;
                /////////////////////////////
                $('#ongkirModal').modal('hide');
            }

            function discountModal() {
                var amount = document.getElementById("rs_payment").value;

                if (amount == '0') {
                    alert('Silahkan Masukan Pesanan Dahulu');
                } else {
                    $('#discountModal').modal('show');
                }
            }

            function hide_discountModal() {
                $('#discountModal').modal('hide');
            }

            function save_discount() {
                /////////////////////////////
                document.getElementById("rh_discnota").innerHTML = parseInt(document.getElementById("md_discountnota").value);
                document.getElementById("rs_discnota").value = parseInt(document.getElementById("md_discountnota").value);
                /////////////////////////////
                document.getElementById("rh_payment").innerHTML = parseInt(document.getElementById("rs_subtotal").value) - (parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById("rs_discnota").value) + parseInt(document.getElementById("rs_ongkir").value));
                document.getElementById("rs_payment").value =  parseInt(document.getElementById("rs_subtotal").value) - (parseInt(document.getElementById("rs_discitems").value) + parseInt(document.getElementById("rs_discnota").value) + parseInt(document.getElementById("rs_ongkir").value));
                document.getElementById("pay_ammount").innerHTML = document.getElementById("rs_payment").value;
                /////////////////////////////
                $('#discountModal').modal('hide');
            }

            function clear_cart() {
                document.getElementById("reseller_name").value = '';
                document.getElementById("counter_span").innerHTML = "(0)"  ;
                document.getElementById("count").value = 0 ;

                document.getElementById("rh_subtotal").innerHTML = 0 ;
                document.getElementById("rs_subtotal").value = 0 ;
                document.getElementById("rh_discitems").innerHTML = 0 ;
                document.getElementById("rs_discitems").value = 0 ;
                document.getElementById("rh_discnota").innerHTML = 0 ;
                document.getElementById("rs_discnota").value = 0 ;
                document.getElementById("rh_ongkir").innerHTML = 0 ;
                document.getElementById("rs_ongkir").value = 0 ;
                document.getElementById("rh_payment").innerHTML = 0 ;
                document.getElementById("rs_payment").value = 0 ;
                document.getElementById("pay_ammount").innerHTML = 0 ;

                $("#table > tbody").empty();
            }

            function paymentModal() {
                var amount = document.getElementById("rs_payment").value;
                document.getElementById("r_grandtotal").value = amount;
                document.getElementById("s_grandtotal").innerHTML = amount;

                if (amount == '0') {
                    alert('Silahkan Masukan Pesanan Dahulu');
                } else {
                    $('#paymentModal').modal('show');
                }

            }

            function hide_payment_modal() {
                $('#paymentModal').modal('hide');
            }

            function save_payment() {
                var cash = document.getElementById("r_cash").value === '' ? 0 : document.getElementById("r_cash").value;
                var bca = document.getElementById("r_bca").value === '' ? 0 : document.getElementById("r_bca").value;
                var mandiri = document.getElementById("r_mandiri").value === '' ? 0 : document.getElementById("r_mandiri").value;
                var banktf = document.getElementById("r_banktf").value === '' ? 0 : document.getElementById("r_banktf").value;

                var total_pay = parseInt(cash) + parseInt(bca) + parseInt(mandiri) + parseInt(banktf);

                var grandtotal = document.getElementById("r_grandtotal").value;

                if (total_pay != grandtotal) {
                    alert('Nominal tidak sesuai dengan Total Payment');
                } else {
                    document.getElementById("form_pay").submit();
                }
                
            }

            function cek_kosong(e) {
                // alert(e.value);
            }
        </script>

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
