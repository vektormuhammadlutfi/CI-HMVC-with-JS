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
            <small>data driver </small>
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
                        <div class="actions">
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
                        </div>
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
                            <!--<div class="table-actions-wrapper">
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
                            </div>-->
                            <table style="width:150% !important" class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                <thead>
                                    <tr role="row" class="heading">
                                        <!--<th width="2%">
                                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                                <span></span>
                                            </label>
                                        </th>-->
                                        <th width="5%"> No. </th>
                                        <th width="15%"> Tgl Lahir </th>
                                        <th width="200"> Nama Driver </th>
                                        <th> Jenis SIM </th>
                                        <th> Tgl. Exp SIM </th>
                                        <th> No. Kontak </th>
                                        <th> Jenis Driver </th>
                                        <th> Status </th>
                                        <th> Aktif </th>
                                        <th width="200"> Actions </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td> </td>
                                        <td>
                                            <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="tgl_start" placeholder="From">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="tgl_end" placeholder="To">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="nama"> </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="jns_sim"> </td>
                                        <td>
                                            <div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="tgl_exp_from" placeholder="From">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                            <div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
                                                <input type="text" class="form-control form-filter input-sm" readonly name="tgl_exp_to" placeholder="To">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm default" type="button">
                                                        <i class="fa fa-calendar"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="jenis_driver" /> 
                                        </td>
                                        <td>
                                            <select name="jenis_driver" class="form-control form-filter input-sm">
                                                <option value="">Select...</option>
                                                <option value="carcarrier">Driver Car Carrier</option>
                                                <option value="logistics">Driver Logistics</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="status" class="form-control form-filter input-sm">
                                                <option value="">Select...</option>
                                                <option value="1">Ready</option>
                                                <option value="2">Izin</option>
                                                <option value="3">Match</option>
                                                <option value="4">Onjob</option>
                                            </select>
                                        </td>
                                        <td></td>
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
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>