<meta name="csrf-token" content="{{ csrf_token() }}">
<form id="form_edit" class="was-validated" enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-white">EDIT PRODUCT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <ul class="nav nav-tabs nav-tabs-v2" style="margin-top: -20px;">
                        <li class="nav-item me-4 fw-bold"><a href="#detail" class="nav-link active"
                                data-bs-toggle="tab">Detail</a></li>
                        <li class="nav-item me-4 fw-bold"><a href="#variation" class="nav-link"
                                data-bs-toggle="tab">Variation</a></li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="detail">
                            <div class="row form-group">
                                <input type="hidden" id="id">
                                <input type="hidden" id="id_produk" name="id_produk">
                                <input type="hidden" id="id_ware" name="id_ware">
                                {{-- <input type="text" id="img" name="img"> --}}

                                <div class="col-6">
                                    <div class="row form-group">

                                        <div class="col-12 mt-2 form-group position-relative mb-2 profile-img"
                                            align="center" id="edit_image">
                                        </div>
                                        <div class="card-arrow">
                                            <div class="card-arrow-top-left"></div>
                                            <div class="card-arrow-top-right"></div>
                                            <div class="card-arrow-bottom-left"></div>
                                            <div class="card-arrow-bottom-right"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="row form-group">
                                        <div class="col-12 form-group mb-3">
                                            <label class="form-label">Nama Produk</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="edit_produk" id="produk" required
                                                placeholder="Silahkan masukan nama produk" autocomplete="OFF">
                                        </div>
                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Brand</label>
                                            <select class="form-select form-select-sm text-theme" name="edit_id_brand"
                                                required>
                                                <option id="branddefault" selected>Pilih Brand</option>
                                                @foreach ($getbrand as $gets)
                                                    <option value="{{ $gets->brand }}">{{ $gets->brand }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih nama brand yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-6 form-group position-relative mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select class="form-select form-select-sm text-theme" name="edit_category"
                                                required>
                                                <option id="categorydefault" selected>Pilih Kategori</option>
                                                @foreach ($getcategory as $gets)
                                                    <option value="{{ $gets->sub_category }}">{{ $gets->sub_category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih kategory yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-12 form-group position-relative mb-3">
                                            <label class="form-label">Kualitas</label>
                                            <select class="form-select form-select-sm text-theme" name="edit_quality"
                                                required>
                                                <option id="qualitydefault" selected>Pilih Kualitas</option>
                                                <option value="LOKAL">LOKAL</option>
                                                <option value="IMPORT">IMPORT</option>
                                                <option value="ORIGINAL">ORIGINAL</option>
                                            </select>
                                            <div class="invalid-tooltip">
                                                Silahkan pilih kualitas yang sesuai.
                                            </div>
                                        </div>

                                        <div class="col-4 form-group mb-3">
                                            <label class="form-label">Reseller</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="edit_r_price" id="r_price" required
                                                placeholder="0" autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-4 form-group mb-3">
                                            <label class="form-label">Normal</label>
                                            <input class="form-control form-control-sm text-theme is-invalid"
                                                type="text" name="edit_n_price" id="n_price" required
                                                placeholder="0" autocomplete="OFF" type-currency="IDR">
                                        </div>
                                        <div class="col-4 form-group mb-3">
                                            <label class="form-label">Grosir</label>
                                            <input
                                                class="form-control form-select-sm form-control-sm text-theme is-invalid"
                                                type="text" name="edit_g_price" id="g_price" required
                                                placeholder="0" autocomplete="OFF" type-currency="IDR">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="variation">
                            <div class="row form-group" style="margin-left: 10%;margin-right: 10%">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-white" style="height: 10px;">SIZE</th>
                                            <th class="text-center text-white" style="height: 10px;">QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody id="edit_variation">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-2" align="right">
                        <button class="btn btn-theme" type="button" onclick="submitformedit()">Save</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
<script>
    // CSRF for all ajax call
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
