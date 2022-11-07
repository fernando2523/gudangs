<form id="form_edit" class="was-validated" enctype="multipart/form-data" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:7%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">EDIT RESELLER</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body was-validated">
                    <div>
                        <input type="hidden" id="e_id">
                        <input type="hidden" id="e_id_reseller" name="e_id_reseller">
                        <input type="text" id="e_img2" name="e_img2">
                    </div>

                    <div class="row form-group">
                        <div class="col-8 form-group mb-3">
                            <label class="form-label">Name Reseller</label>
                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                name="e_nama" id="e_nama" required placeholder="Please provide a name supplier"
                                autocomplete="OFF">
                        </div>

                        <div class="col-4 form-group mb-3">
                            <label class="form-label">No Telp</label>
                            <input class="form-control form-control-sm text-theme is-invalid" type="number"
                                name="e_tlp" id="e_tlp" required placeholder="Please provide a No Telp"
                                autocomplete="OFF">
                        </div>

                        <div class="col-4">
                        </div>
                        <div class="col-4 form-group position-relative mb-2 profile-img" align="center">
                            <img class="mb-2 rounded" id="e_img" name="e_img" width="200" height="200">
                            <input type="file" style="width: 200px;" class="form-control form-control-sm"
                                name="file">
                        </div>
                        <div class="card-arrow">
                            <div class="card-arrow-top-left"></div>
                            <div class="card-arrow-top-right"></div>
                            <div class="card-arrow-bottom-left"></div>
                            <div class="card-arrow-bottom-right"></div>
                        </div>
                        <div class="col-4">
                        </div>
                    </div>
                    <div class="form-group mt-3" align="right">
                        <button class="btn btn-theme" type="button" onclick="submitformedit()">Save</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
