<form action="#" id="form-edit" role="form">
    <div class="form-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group form-md-line-input">
                    <select class="form-control jenis-driver" name="jenis_driver">
                        <option></option>
                        <option value="carcarrier" <?php echo ($main->jenis_driver === 'carcarrier') ? 'selected' : ''; ?>>Driver Car Carrier</option>
                        <option value="logistics" <?php echo ($main->jenis_driver === 'logistics') ? 'selected' : ''; ?>>Driver Logistics</option>
                    </select>
                    <label>Jenis Driver
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan pilih jenis driver...</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-md-line-input">
                    <select class="form-control identitas" name="identitas_id">
                        <option></option>
                        <?php foreach ($midentitas as $identitas) { ?>
                        <option <?php echo ($main->identitas_id === $identitas->id) ? 'selected' : ''; ?>  value="<?php echo $identitas->id; ?>"><?php echo $identitas->nama_identitas; ?></option>
                        <?php } ?>
                    </select>
                    <label>Jenis Identitas
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan pilih jenis identitas...</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="no_identitas" value="<?php echo $main->no_identitas; ?>" />
                    <label for="form_control_1">No. Identitas
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isikan no identitas</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="nama" value="<?php echo $main->nama; ?>">
                    <label for="form_control_1">Nama Driver
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi Nama Driver</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <select class="form-control agama" name="agama_id">
                        <option></option>
                        <?php foreach ($magama as $agama) { ?>
                        <option <?php echo ($agama->id === $main->agama_id) ? 'selected' : ''; ?>  value="<?php echo $agama->id; ?>"><?php echo $agama->agama; ?></option>
                        <?php } ?>
                    </select>
                    <label>Agama
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan pilih agama...</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="tmp_lahir" value="<?php echo $main->tmp_lahir; ?>">
                    <label for="form_control_1">Tempat Lahir
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi tempat lahir</span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="tgl_lahir" value="<?php echo $main->tgl_lahir; ?>">
                    <label for="form_control_1">Tgl. Lahir 
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi tgl lahir</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="email" value="<?php echo $main->email; ?>">
                    <label for="form_control_1">E-mail
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi email</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="alamat" value="<?php echo $main->alamat; ?>">
                    <label>Alamat
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi alamat lengkap</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group form-md-line-input">
                    <select class="form-control sim" name="sim_id">
                        <option></option>
                        <?php foreach ($msim as $sim) { ?>
                        <option <?php echo ($sim->id === $main->sim_id) ? 'selected' : ''; ?>  value="<?php echo $sim->id; ?>"><?php echo $sim->jenis; ?></option>
                        <?php } ?>
                    </select>
                    <label>Jenis Sim
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan pilih jenis sim</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="no_sim" value="<?php echo $main->no_sim; ?>">
                    <label>No. SIM
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan no sim</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="tgl_exp_sim"  value="<?php echo $main->tgl_exp_sim; ?>">
                    <label for="form_control_1">Tgl. Masa Berlaku SIM 
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan isi tgl masa berlaku</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="telepon"  value="<?php echo $main->telepon; ?>">
                    <label>No. Telepon</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="hp"  value="<?php echo $main->hp; ?>">
                    <label>No. HP
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan no hp</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="gapok" value="<?php echo $main->gapok; ?>">
                    <label>Upah Per Bulan
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan masukkan gaji pokok</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-md-line-input">
                    <input type="text" class="form-control" name="no_rekening" value="<?php echo $main->no_rekening; ?>" >
                    <label>No. Rekening
                        <span class="required">*</span>
                    </label>
                    <span class="help-block">Silahkan masukkan no rekening</span>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <div class="form-actions">
        <div class="row">
            <div class="col-md-12">
                <dov class="pull-right">
                    <button type="submit" name="id" value="<?php echo $main->id; ?>" class="btn btn-outline green submit"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Keluar</button>
                </dov>
            </div>
        </div>
    </div>
</form>