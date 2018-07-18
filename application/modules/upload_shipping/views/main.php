<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Master</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#"><?php echo $module;?></a>
                    <i class="fa fa-circle"></i>
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
        <h1 class="page-title"> <?php echo $pageTitle?>
            <small>import data unit </small>
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- <div class="note note-danger">
                    <p> NOTE: The below datatable is not connected to a real database so the filter and sorting is just simulated for demo purposes only. </p>
                </div> -->
                <!-- Begin: Demo Datatable 1 -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase">Data <?php echo $pageTitle ?></span>
                        </div>
                        <!-- <div class="actions">
                            <button id="add-btn" class="btn sbold green"> Add New
                                <i class="fa fa-plus"></i>
                            </button>
                            
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
                        </div> -->
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-actions-wrapper">
                                <button id="add-btn" class="btn sbold green"> Upload
                                    <i class="fa fa-upload"></i>
                                </button>
                            </div>
                            
                            <table style="width:150% !important" class="table table-striped table-bordered table-hover table-checkable order-column" id="datatable_ajax">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th>
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                                <span></span>
                                            </label>
                                        </th>
                                        <th width="200"> Shipping Date </th>
                                        <th> Part Packing List </th>
                                        <th> Shipping Document </th>
                                        <th> Part Allocation</th>
                                        <th> Part Supply Request Date </th>
                                        <th> Allocation Date </th>
                                        <th> Picking Start </th>
                                        <th width="250"> Actions </th>
                                    </tr>
                                    <tr role="row" class="heading">
                                        <th></th>
                                        <th>
                                            <select name="office" class="form-control form-filter input-sm">
                                                <option value="">Select...</option>
                                                <?php foreach($cabang as $r){?>
                                                    <option value="<?php echo $r->kode_cabang?>"> <?php echo $r->nama_cabang?> </option>
                                                <?php } ?>
                                            </select>
                                        </th>
                                        <th><input type="text" class="form-control form-filter input-sm" name="no_polisi"></th>
                                        <th><input type="text" class="form-control form-filter input-sm" name="no_rangka"></th>
                                        <th><input type="text" class="form-control form-filter input-sm" name="merk"></th>
                                        <th><input type="text" class="form-control form-filter input-sm" name="model"></th>
                                        <th><input type="text" class="form-control form-filter input-sm" name="tipe"></th>
                                        <th><input type="text" class="form-control form-filter input-sm" name="tahun"></th>
                                        <th>
                                            <div class="margin-bottom-5">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                <i class="fa fa-search"></i> Search</button>
                                            <button class="btn btn-sm red btn-outline filter-cancel">
                                                <i class="fa fa-times"></i> Reset</button>
                                            </div>
                                        </th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                                <span></span>
                                            </label>
                                        </th>
                                        <th> Shipping Date </th>
                                        <th> Part Packing List </th>
                                        <th> Shipping Document </th>
                                        <th> Part Allocation</th>
                                        <th> Part Supply Request Date </th>
                                        <th> Allocation Date </th>
                                        <th> Picking Start </th>
                                        <th> Action </th>
                                    </tr>
                                </tfoot>
                            </table>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>