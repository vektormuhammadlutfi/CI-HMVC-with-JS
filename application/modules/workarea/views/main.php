<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Master Data</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Work Area</a>
                </li>
            </ul>
            
        </div>
        <!-- END PAGE BAR -->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <br>
                <!-- Begin: Demo Datatable 1 -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark sbold uppercase">Work Area</span>
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
                        <div class="">                            
                            <table class="table table-striped table-bordered table-hover table-checkable table-responsive" id="datatable_ajax">
                                <thead>
                                    <tr role="row" class="heading">
                                        <th width="5%">No</th>
                                        <th width="1%">Aksi</th>
                                        <th>Kode Cabang</th>
                                        <th>Nama Cabang</th>
                                        <th>Alamat</th>
                                        <th>Rekening</th>
                                        <th>No Telp. Cabang</th>
                                        <th>Kota</th>
                                        <th>Provinsi</th>
                                        <th>Pimpinan</th>
                                        <th>No Hp. Pimpinan</th>
                                        <!-- <th>Biaya Cabang Kepusat</th> -->
                                        <th>Referensi Cabang</th>
                                        <th>Jenis Cabang</th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td> </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom">
                                                    <i class="fa fa-search"></i></button>
                                            </div>
                                            <button class="btn btn-sm red btn-outline filter-cancel">
                                                <i class="fa fa-times"></i></button>
                                        </td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="kd_cabang"> </td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="nm_cabang"> </td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="alamat"> </td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="rekening"> </td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="no_telp"/> </td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="kota"> </td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="prov"> </td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="pimpinan"/> </td>
                                        <td><input type="text" class="form-control form-filter input-sm" name="no_hp_pimpinan"/> </td>
                                        <!-- <td><input type="text" class="form-control form-filter input-sm" name="biaya_pesawat_kepusat"/> </td> -->
                                        <td><input type="text" class="form-control form-filter input-sm" name="nm_marketing"/> </td>
                                        <td>
                                            <select class="form-control form-filter input-sm jeniskelamin" name="jenis_cabang">
                                                <option value="Biasa">Biasa</option>
                                                <option value="Mandiri">Mandiri</option>
                                            </select>
                                        </td>
                                        

                                    </tr>
                                </thead>
                                <tbody></tbody>
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