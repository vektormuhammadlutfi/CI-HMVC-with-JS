<form action="#" id="form-edit" role="form">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group form-md-line-input">
                <input type="text" class="form-control" name="name" value="<?php echo $group->name; ?>" />
                <label for="form_control_1">Group Name
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group form-md-line-input">
                <input type="text" class="form-control" name="description" value="<?php echo $group->description; ?>" />
                <label for="form_control_1">Decsription
                    <span class="required">*</span>
                </label>
                <span class="help-block">Please enter a description ...</span>
            </div>
        </div>
        <div class="col-md-12 text-right">
            <div class="form-group">
                <button type="submit" name="id" value="<?php echo $group->id;  ?>" class="btn btn-outline green submit"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Keluar</button>
            </div>
        </div>
    </div>
</form>