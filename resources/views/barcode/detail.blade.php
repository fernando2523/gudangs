<form id="form_barcode" class="was-validated" enctype="multipart/form-data" method="POST" action="/print/printtest">
    <input type="hidden" name="_method" value="PATCH">
    @csrf
    <div class="modal fade" id="modalbarcode" data-bs-backdrop="static" style="padding-top:7%;">
        <div class="modal-dialog modal-ml">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-theme">PRINT BARCODE <i class="fa-xl bi bi-upc-scan ms-1"></i></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div id="barcode_detail">

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-theme fw-bold" type="submit">PRINT <i
                            class="fa-xl bi bi-upc-scan ms-1"></i></button>
                </div>
            </div>
        </div>
    </div>
</form>
