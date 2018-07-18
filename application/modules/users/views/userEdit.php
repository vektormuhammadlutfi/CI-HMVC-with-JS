<form id="edit-user-form">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="fg-line">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="Enter first name" name="first_name" value="<?php echo $user->first_name; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Enter last name" name="last_name" value="<?php echo $user->last_name; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Phone</label>
                    <input type="text" class="form-control" placeholder="Enter phone number" name="phone" value="<?php echo $user->phone; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="fg-line">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="Enter username" disabled value="<?php echo $user->username; ?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="fg-line">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Enter email address" disabled  value="<?php echo $user->email; ?>">
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
                    <select name="kode_cabang" class="form-control" data-placeholder="Pilih Office">
                        <option disabled selected></option>
                        <?php
                        foreach ($office as $row) { ?>

                        <option <?php echo ($row->kd_cabang === $user->kode_cabang) ? 'selected' : ''; ?> value="<?php echo $row->kd_cabang; ?>"><?php echo $row->nm_cabang; ?></option>
                        
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>        
            <div class="form-group">
                <label for="multi-append" class="control-label">User Groups</label>
                <div class="input-group select2-bootstrap-append">
                    <select id="multi-append" name="level[]" class="form-control" multiple>
                        <option></option>
                        <?php
                            foreach ($groups as $group) { 
                            $currentGroups = $this->ion_auth->get_users_groups($user->id)->result();
                            $gID=$group->id;
                              $checked = "";
                              foreach($currentGroups as $grp) {
                                  if ($gID == $grp->id) {
                                      $checked= "selected";
                                  break;
                                  }
                              }
                            ?>
                            <option <?php echo $checked;?> value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-right">
            <div class="form-group">
                <button type="submit" class="btn btn-outline green submit" name="id" value="<?php echo $user->id; ?>"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Keluar</button>
            </div>
        </div>
    </div>
</form>