@extends('layouts.main')
@section('container')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center">
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/location/locations">PRODUCTS</a></li>
                    <li class="breadcrumb-item active">PRODUCTS PAGE</li>
                </ul>

                <h1 class="page-header">
                    Products
                </h1>
            </div>
            <div class="ms-auto">
            </div>

            {{-- <div class="ms-sm-3 mt-sm-0 mt-2"><a class="btn btn-outline-lime" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="bi bi-arrow-clockwise fa-fw me-1"></i> Stock Opname</a>
            </div> --}}
            <div class="ms-sm-3 mt-sm-0"><a class="btn btn-outline-theme" data-bs-toggle="modal"
                    data-bs-target="#modaladd"><i class="fa fa-plus-circle fa-fw me-1"></i> Add Product</a>
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

        <div class="modal fade" id="modaladd" data-bs-backdrop="static">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-theme">ADD PRODUCTS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="formadd" class="was-validated" method="POST" enctype="multipart/form-data"
                        action="{{ url('/product/products/store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row form-group">
                                <div class="col-4">
                                    <div class="row form-group">
                                        <div class="col-2 mt-2">
                                        </div>
                                        <div class="col-8 mt-2 form-group position-relative mb-2 profile-img"
                                            align="center">
                                            <script type="text/javascript">
                                                var loadeditFile = function(event) {
                                                    var previewimg = document.getElementById('previewimg');
                                                    previewimg.src = URL.createObjectURL(event.target.files[0]);
                                                };
                                            </script>
                                            <img class="mb-2" id="previewimg" width="247px"
                                                src="/product/defaultimg.png">
                                            <input type="file" class="form-control" id="file" name="file"
                                                onchange="loadeditFile(event)">
                                        </div>
                                        <div class="card-arrow">
                                            <div class="card-arrow-top-left"></div>
                                            <div class="card-arrow-top-right"></div>
                                            <div class="card-arrow-bottom-left"></div>
                                            <div class="card-arrow-bottom-right"></div>
                                        </div>
                                        <div class="col-2 mt-2">
                                        </div>
                                        <div class="col-12 form-group mb-3">
                                            <label class="form-label">Nama Produk</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                                name="produk" required placeholder="Silahkan masukan nama produk"
                                                autocomplete="OFF">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="row form-group">
                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Brand</label>
                                            <select class="form-select form-select-sm text-theme" name="id_brand" required>
                                                <option value="" disabled selected>Pilih Brand</option>
                                                @foreach ($getbrand as $gets)
                                                    <option value="{{ $gets->id_brand }}">{{ $gets->brand }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih nama brand yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-select form-select-sm text-theme" name="category" required>
                                                <option value="" disabled selected>Pilih Kategori</option>
                                                @foreach ($getcategory as $gets)
                                                    <option value="{{ $gets->sub_category }}">{{ $gets->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih category yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3 mt-3">
                                            <label class="form-label">Kualitas</label>
                                            <select class="form-select form-select-sm text-theme" name="quality" required>
                                                <option value="" disabled selected>Pilih Kualitas</option>
                                                <option value="LOKAL">LOKAL</option>
                                                <option value="IMPORT">IMPORT</option>
                                                <option value="ORIGINAL">ORIGINAL</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih kualitas yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3 mt-3">
                                            <label class="form-label">Warehouse</label>
                                            <select class="form-select form-select-sm text-theme" name="id_ware" required>
                                                <option value="" disabled selected>Pilih Warehouse</option>
                                                @foreach ($getware as $gets)
                                                    <option value="{{ $gets->id_ware }}">{{ $gets->warehouse }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih warehouse yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Modal</label>
                                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                                name="m_price" required placeholder="0" autocomplete="OFF"
                                                type-currency="IDR">
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Reseller</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="r_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Normal</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="n_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-6 form-group mb-3">
                                            <label class="form-label">Grosir</label>
                                            <input
                                                class="form-control form-select-sm form-control-sm text-theme is-invalid"
                                                type="text" name="g_price" required placeholder="0"
                                                autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-12 form-group position-relative mb-2">
                                            <label class="form-label">Supplier</label>
                                            <div class="position-relative text-center mb-3">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="type_po" id="type_po" required onchange="typepo()">
                                                    <option value="" disabled selected>Tipe PO</option>
                                                    <option value="baru">PO Baru</option>
                                                    <option value="lama">PO Lanjutan</option>
                                                </select>
                                            </div>
                                            <div class="position-relative text-center mb-3" style="display:none;"
                                                id="divlama">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="id_po_lama">
                                                    <option value="" disabled selected>Pilih DATA PO</option>
                                                    @foreach ($get_Supplier_Order as $orders)
                                                        @foreach ($getsupplier as $supps)
                                                            @if ($supps->id_sup === $orders->id_sup)
                                                                <option value="{{ $orders->idpo }}">{{ $orders->tanggal }}
                                                                    -
                                                                    {{ $supps->supplier }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="position-relative text-center" style="display:none;"
                                                id="divbaru">
                                                <select class="form-select form-select-sm text-theme text-center"
                                                    name="id_sup" id="id_sup">
                                                    <option value="" disabled selected>Pilih Supplier</option>
                                                    @foreach ($getsupplier as $gets)
                                                        <option value="{{ $gets->id_sup }}">{{ $gets->supplier }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <script>
                                                function typepo() {
                                                    var select = document.getElementById('type_po');
                                                    var value = select.options[select.selectedIndex].value;

                                                    if (value == 'baru') {
                                                        document.getElementById("divbaru").style.display = 'block';
                                                        document.getElementById("divlama").style.display = 'none';
                                                    } else if (value == 'lama') {
                                                        document.getElementById("divbaru").style.display = 'none';
                                                        document.getElementById("divlama").style.display = 'block';
                                                    }
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row form-group">
                                        <div class="col-12 form-group position-relative mb-3">
                                            <label class="form-label">Variation</label>
                                            <select class="form-select form-select-sm text-theme fs-12px"
                                                id="type_variasi" name="type_variasi" required>
                                                <option value="" disabled selected>Pilih Variation</option>
                                                <option value="SNEAKERS UNISEX">Sneakers Unisex 35-45</option>
                                                <option value="CUSTOM">Custom</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Pilih supplier yang sesuai.
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div id="hasil_variation" style="text-align: center;"></div>
                                            <script>
                                                function addpo() {
                                                    var tbody = document.getElementById('tbody_item');
                                                    var row = tbody.insertRow(1);
                                                    var size = row.insertCell(0);
                                                    var qty = row.insertCell(1);
                                                    var aksi = row.insertCell(2);

                                                    size.innerHTML = "<input class='form-control' type='text' name='size[]' style='width: 100%;height:100%;'>";
                                                    qty.innerHTML =
                                                        "<input class='form-control' onkeypress='return isNumberKey(event)' type='text' name='qty[]' style='width: 100%;height:100%;'>";
                                                    aksi.innerHTML = '<button type="button" class="btn btn-danger btn-sm" onclick="deleteRow(this)">X</button>';
                                                }

                                                function deleteRow(r) {
                                                    var i = r.parentNode.parentNode.rowIndex;
                                                    document.getElementById("variations").deleteRow(i);
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-1" align="right">
                                <button class="btn btn-theme" type="submit" onclick="submitadd()">Save</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $('#file').change(function() {

                if (file === "") {
                    document.getElementById("previewimg").src = '/product/defaultimg.png';
                } else {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $('#previewimg').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }

            });
        </script>

        <script type="text/javascript">
            $(document).ready(function() {

                function variation(variasi) {
                    $.ajax({
                        type: 'POST',
                        url: "{{ URL::to('/load_variation') }}",
                        data: {
                            variasi: variasi
                        },
                        success: function(data) {
                            $("#hasil_variation").html(data);
                        }
                    });
                }

                $('#type_variasi').change(function() {
                    var variasi = $(this).val();
                    variation(variasi);
                });
            });
        </script>

        @include('product.delete')
        @include('product.edit')

        <div class="row">
            <!-- DATA ASSSET -->
            @if (Auth::user()->role === 'SUPER-ADMIN')
                <div class="col-xl-3 mb-3">
                    <div class="card" style="margin-bottom: 15px;">
                        <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                            <div class="flex-fill" style="padding-top: 5px;padding-bottom: 3px;">
                                <div class="col-6 text-theme fw-bold">ARTIKEL</div>
                                <h4>{{ $get_totalproduk }}</h4>
                            </div>

                            <div class="opacity-5">
                                <i class="bi bi-box-seam fa-3x"></i>
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

                    <div class="card">
                        <div class="card-body d-flex align-items-center text-white m-5px bg-white bg-opacity-15">
                            <div class="flex-fill" style="padding-top: 5px;padding-bottom: 3px;">
                                <div class="col-6 text-theme fw-bold">QTY</div>
                                <h4>{{ $get_totalqty }}</h4>
                            </div>

                            <div class="opacity-5">
                                <i class="bi bi-boxes fa-3x"></i>
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

                <div class="col-xl-9 mb-3">
                    <div class="card">
                        <div class="card-body p-3" style="height: 225px;">
                            <div class="row" align="center">
                                @foreach ($getsproduct as $key => $utama)
                                    @foreach ($getnamewarehouse as $wares)
                                        @if ($utama->id_ware === $wares->id_ware)
                                            @foreach ($get_perware as $keys => $kedua)
                                                @if ($utama->id_ware === $kedua->id_ware)
                                                    <div class="col-4 mb-3">
                                                        <div class="card">
                                                            <div class="card-body p-3 bg-white bg-opacity-10">
                                                                <div class="d-flex fw-bold small mb-2">
                                                                    <span
                                                                        class="flex-grow-1 text-theme">{{ $wares->warehouse }}</span>
                                                                </div>
                                                                <div class="row align-items-center">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <h6 class="mb-0">
                                                                                {{ $kedua->countidproduk }}
                                                                            </h6>
                                                                            <h6 class="mb-0 fs-10px">ARTIKEL
                                                                            </h6>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <h6 class="mb-0">{{ $kedua->totalQty }}</h6>
                                                                            <h6 class="mb-0 fs-10px">QTY</h6>
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
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach
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
            @endif

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body p-3" style="height: auto;">
                        <!-- BEGIN input-group -->
                        <div class="d-flex fw-bold small mb-3">
                            <div class="col-9" style="margin-top: 7px;">
                                <span class="flex-grow-1">SEARCH PRODUCTS</span>
                            </div>
                            <div class="col-3">
                                @if (Auth::user()->role === 'SUPER-ADMIN')
                                    <select class="form-select form-select-sm text-theme fw-bold" id="select_ware"
                                        onchange="select()" style="width: 300px;">
                                        <option value="all_ware" selected>ALL WAREHOUSE..</option>
                                        @foreach ($selectWarehouse as $select)
                                            <option value="{{ $select->id_ware }}">{{ $select->warehouse }}</option>
                                        @endforeach
                                    </select>
                                @elseif (Auth::user()->role === 'HEAD-AREA')
                                    <select class="form-select form-select-sm text-theme fw-bold" id="select_ware"
                                        onchange="select()" style="width: 300px;">
                                        <option value="per_area" selected>Warehouse Area {{ $userware[0]->area }}..
                                        </option>
                                        @foreach ($userware as $users)
                                            @foreach ($selectWarehouse as $select)
                                                @if ($select->id_area === $users->id_area)
                                                    <option value="{{ $select->id_ware }}">{{ $select->warehouse }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                @else
                                    <select class="form-select form-select-sm text-theme fw-bold" id="select_ware"
                                        onchange="select()" style="width: 300px;">
                                        @foreach ($userware as $users)
                                            @foreach ($selectWarehouse as $select)
                                                @if ($select->id_ware === $users->id_ware)
                                                    <option value="{{ $select->id_ware }}" selected>
                                                        {{ $select->warehouse }}</option>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div id="detail_product">
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
        </div>

        <script>
            function select() {
                var select = document.getElementById('select_ware');
                var selected_ware = select.options[select.selectedIndex].value;
                load_ware(selected_ware);
            }

            $(document).ready(function() {
                var select = document.getElementById('select_ware');
                var selected_ware = select.options[select.selectedIndex].value;
                load_ware(selected_ware);
            });

            function load_ware(id_ware) {
                $.ajax({
                    type: 'GET',
                    url: "{{ URL::to('/detail_product') }}",
                    data: {
                        id_ware: id_ware,
                    },
                    success: function(data) {
                        $("#detail_product").html(data);
                    }
                });
            }
        </script>
    @endsection
