<form action="#" id="form-create" role="form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="kd_cabang" placeholder="Masukkan Kode Cabang">
                    <label for="form_control_1">Kode Cabang
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Masukkan Kode Cabang</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="nm_cabang" placeholder="Nama Cabang">
                    <label for="form_control_1">Nama Cabang<span class="required">*</span>
                    </label>
                    <span class="help-block">Nama Cabang</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="alamat" placeholder="Masukkan Alamat ">
                    <label for="form_control_1">Alamat
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Masukkan Alamat</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="no_telp" placeholder="Masukkan Nomor Telepon">
                    <label for="form_control_1">Nomor Telepon</label>
                    <span class="help-block">Masukkan Nomor Telepon</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <select class="form-control provinsi" name="prov" id="prov">
                        <option></option>
                        <?php foreach ($provinsi as $prov) { ?>
                            <option <?php echo $provinsi_selected == $prov->id ? 'selected="selected"' : '' ?> 
                                value="<?php echo $prov->id ?>"><?php echo $prov->name_provinces ?></option>
                        <?php } ?>
                    </select>
                    <label>Provinsi<span class="required">*</span>
                    </label>
                    <span class="help-block">Masukkan Provinsi</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <select class="form-control kota" name="kota" id="kota">
                        <option value="0"></option>
                    </select>
                    <label>Kota
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Masukkan Kota</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="pimpinan" placeholder="Masukkan Nama Pimpinan">
                    <label>Nama Pimpinan<span class="required">*</span>
                    </label>
                    <span class="help-block">Masukkan Nama Pimpinan</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" id="biaya_sewa_hotel" class="form-control" name="no_hp_pimpinan" placeholder="Masukkan No. Hp. Pimpinan">
                    <label>No. Hp. Pimpinan<span class="required">*</span>
                    </label>
                    <span class="help-block">Masukkan No. Hp. Pimpinan</span>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" id="biaya_pesawat_kepusat" class="form-control" name="biaya_pesawat_kepusat" placeholder="Masukkan Biaya Pesawat Kepusat">
                    <label>Biaya Pesawat Kepusat<span class="required">*</span>
                    </label>
                    <span class="help-block">Masukkan Biaya Pesawat Kepusat</span>
                </div>
            </div> -->
            <div class="col-md-12">
                <div class="form-group form-md-line-input">
                    <input type="text" id="rekening" class="form-control" name="rekening" placeholder="Masukkan Rekening">
                    <label>Rekening<span class="required">*</span>
                    </label>
                    <span class="help-block">Masukkan Rekening</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">                
                <div class="form-group form-md-line-input">
                    <select class="form-control marketing" name="referensi_cabang">
                        <option value="0">-</option>
                        <?php foreach ($marketing as $mkt) { ?>
                        <option value="<?php echo $mkt->id; ?>"><?php echo $mkt->nik; ?> - <?php echo $mkt->nm_marketing; ?></option>
                        <?php } ?>
                    </select>
                    <label>Referensi Cabang
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan Pilih Referensi Cabang</span>
                </div>
            </div> 
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <select class="form-control jeniskelamin" name="jenis_cabang">
                        <option value="Biasa">Biasa</option>
                        <option value="Mandiri">Mandiri</option>
                    </select>
                    <label>Jenis Cabang
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan pilih jenis Cabang</span>
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