<form id="form_edit" class="was-validated" method="POST" action="/">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modaledit" data-bs-backdrop="static" style="padding-top:12%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">EDIT STORE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <input type="hidden" id="e_id">
                        <input type="hidden" id="e_id_store">
                        <input type="hidden" id="e_id_ware" name="e_id_ware">
                    </div>

                    <div class="row form-group">
                        <div class="col-12 form-group mb-3">
                            <label class="form-label">Name Store</label>
                            <input class="form-control form-control-sm text-theme is-invalid" type="text"
                                name="e_store" id="e_store" required placeholder="Please provide a name store"
                                autocomplete="OFF">
                        </div>

                        <div class="col-12 form-group mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control form-control-sm text-theme is-invalid" type="text" name="e_address" id="e_address"
                                required placeholder="Please provide a Adress store" autocomplete="OFF" rows="2"></textarea>
                        </div>

                        <div class="col-12 form-group position-relative mb-3">
                            <label class="form-label">Warehouse</label>
                            <select class="form-select form-select-sm text-theme" name="e_id_ware" required>
                                <option id="e_warehousedefault" disabled selected>Choose Warehouse</option>
                                @foreach ($getwarehouse as $gets)
                                    <option value="{{ $gets->id_ware }}">{{ $gets->warehouse }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid Warehouse.
                            </div>
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
