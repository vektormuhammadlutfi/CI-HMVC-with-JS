<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Tables</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Datatables</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="#">
                                <i class="icon-bell"></i> Action</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-shield"></i> Another action</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-user"></i> Something else here</a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#">
                                <i class="icon-bag"></i> Separated link</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title"> Ajax Datatables
            <small>basic datatable samples</small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <div class="note note-danger">
                    <p> NOTE: The below datatable is not connected to a real database so the filter and sorting is just simulated for demo purposes only. </p>
                </div>
                <!-- Begin: Demo Datatable 1 -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Ajax Datatable</span>
                        </div>
                        <div class="actions">
                            <button id="add-btn" class="btn sbold green"> Add New
                                        <i class="fa fa-plus"></i>
                                    </button>
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm active">
                                    <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                <label class="btn btn-transparent grey-salsa btn-outline btn-circle btn-sm">
                                    <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                            </div>
                            <div class="btn-group">
                                <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                    <i class="fa fa-share"></i>
                                    <span class="hidden-xs"> Tools </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> Export to Excel </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Export to CSV </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> Export to XML </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> Print Invoices </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <div class="table-actions-wrapper">
                                <span> </span>
                                <select class="table-group-action-input form-control input-inline input-small input-sm">
                                    <option value="">Select...</option>
                                    <option value="Cancel">Cancel</option>
                                    <option value="Cancel">Hold</option>
                                    <option value="Cancel">On Hold</option>
                                    <option value="Close">Close</option>
                                </select>
                                <button class="btn btn-sm green table-group-action-submit">
                                    <i class="fa fa-check"></i> Submit</button>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                <thead>
                            <tr role="row" class="heading">
                                <th width="5%"> No. </th>
                                <th width="15%"> Nama Customer </th>
                                <th width="200"> Alamat </th>
                                <th width="10%"> Jenis Customer </th>
                                <th width="10%"> KTP </th>
                                <th width="10%"> NPWP </th>
                                <th width="10%"> No Telp </th>
                                <th width="10%"> Email </th>
                                <th width="100"> Actions </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td><input type="text" class="form-control form-filter input-sm" name="nm_customer"> </td>
                                <td><input type="text" class="form-control form-filter input-sm" name="alamat"> </td>
                                <td>
                                    <select name="jenis_customer" class="form-control form-filter input-sm">
                                        <option value="">Select...</option>
                                        <option value="Personal">Personal</option>
                                        <option value="Business">Business</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control form-filter input-sm" name="ktp"> </td>
                                <td><input type="text" class="form-control form-filter input-sm" name="npwp"/> </td>
                                <td><input type="text" class="form-control form-filter input-sm" name="no_telp"/> </td>
                                <td><input type="text" class="form-control form-filter input-sm" name="email"/> </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> Search</button>
                                    </div>
                                    <button class="btn btn-sm red btn-outline filter-cancel">
                                        <i class="fa fa-times"></i> Reset</button>
                                </td>
                            </tr>
                        </thead>
                                <tbody> </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End: Demo Datatable 1 -->
                
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>