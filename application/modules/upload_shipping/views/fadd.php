<form id="form-import" enctype="multipart/form-data">
    <div class="form-body">
        <div class="col-md-12">
            
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="input-group input-large">
                <div class="form-control uneditable-input input-fixed input-large" data-trigger="fileinput">
                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                    <span class="fileinput-filename"> </span>
                </div>
                <span class="input-group-addon btn default btn-file">
                    <span class="fileinput-new"> Select file </span>
                    <span class="fileinput-exists"> Change </span>
                    <input type="file" name="file" required accept=".xls, .xlsx">
                </span>
                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
            </div>
        </div>   
       <br><br><br>
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