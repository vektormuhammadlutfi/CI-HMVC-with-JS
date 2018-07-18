<form id="add-user-form">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="fg-line">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="Enter first name" name="first_name">
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Enter last name" name="last_name">
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Phone</label>
                    <input type="text" class="form-control" placeholder="Enter phone number" name="phone">
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Enter username" name="username">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="fg-line">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Enter email address" name="email">
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Enter password" name="password" id="password">
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" placeholder="Confirm password" name="password_confirm">
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Cabang</label>
                    <select id="kode_cabang" name="kode_cabang" class="form-control" data-placeholder="Pilih Office">
                        <option disabled selected></option>
                        <?php
                        foreach ($office as $row) { ?>

                        <option value="<?php echo $row->kd_cabang; ?>"><?php echo $row->nm_cabang; ?></option>
                        
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Level</label>
                    <select class="form-control" data-placeholder="Select user level" name="level">
                        <option disabled selected></option>
                        <?php foreach($groups as $group): ?>
                        <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right">
            <div class="form-group">
                <button type="submit" class="btn btn-outline green submit"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Keluar</button>
            </div>
        </div>
    </div>
</form>


