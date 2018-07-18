
<form action="#" id="form-create" role="form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="nm_customer" placeholder="Isikan nama Customer">
                    <label for="form_control_1">Nama Customer
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi Nama Customer</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="alamat" placeholder="Isikan alamat">
                    <label for="form_control_1">Alamat
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi alamat</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <select class="form-control" name="jenis_customer">
                        <option></option>
                        <option value="Personal"> Personal </option>
                        <option value="Business"> Business </option>
                    </select>
                    <label>Jenis Customer
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan pilih jenis Customer</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="email" placeholder="Isikan email">
                    <label for="form_control_1">E-mail
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi email</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="ktp" placeholder="Isikan ktp">
                    <label>KTP
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi No KTP</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="npwp" placeholder="Isikan npwp">
                    <label>NPWP
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi No NPWP</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="no_telp" placeholder="Isikan no telepon">
                    <label>No. Telepon</label>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                <dov class="pull-right">
                    <button type="submit" class="btn btn-outline green submit"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Keluar</button>
                </dov>
            </div>
        </div>
    </div>
</form>