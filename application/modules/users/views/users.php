<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Setting</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Users</a>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- END PAGE HEADER-->
        <br>
        <div class="row">
            <div class="col-md-12">
                <!-- Begin: Demo Datatable 1 -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark sbold uppercase">Data Users</span>
                        </div>
                        <div class="actions">
                            <button id="add-btn" class="btn sbold green"> Add
                                <i class="fa fa-plus"></i>
                            </button>
                            
                            <div class="btn-group">
                                <a class="btn red btn-outline btn-circle" href="javascript:;" data-toggle="dropdown">
                                    <i class="fa fa-share"></i>
                                    <span class="hidden-xs"> Export </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;"> Excel </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;"> PDF </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="javascript:;"> Print </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_ajax">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%"> No. </th>
                                        <th width="100"> Nama Lengkap </th>
                                        <th> Username </th>
                                        <th> Email </th>
                                        <th> No. Telepon </th>
                                        <th> Terakhir Login </th>
                                        <th> Status </th>
                                        <th width="200"> Aksi </th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td> </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="full_name" placeholder="Nama" /> </td>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="username" placeholder="Username" /> </td>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-sm" name="email" placeholder="Email" /> </td>
                                        </td>
                                        <td> <input type="text" class="form-control form-filter input-sm" name="phone" placeholder="No. Telepon" /> </td>
                                        <td>
                                            <input type="date" class="form-control form-filter input-sm" name="last_login_from"> <br>
                                            <input type="date" class="form-control form-filter input-sm" name="last_login_to"> 
                                        </td>
                                         <td>    
                                            <select name="status" class="form-control form-filter input-sm">
                                                <option value="">Select</option>
                                                <option value="1">Aktif</option>
                                                <option value="0">Disaktif</option>
                                            </select>
                                        </td>
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