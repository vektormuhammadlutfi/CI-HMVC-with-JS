<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="index.html">Dashboard</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">Hotel</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Hotel</span>
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
                            <span class="caption-subject font-dark sbold uppercase">Data Hotel</span>
                        </div>
                        <div class="actions">
                            <button id="add-btn" class="btn sbold green"> Tambah
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
                        <div class="col-md-6">
			                <h2>Chain Dropdown Example</h2>
			                <form action="<?php echo site_url('master_indonesia/aksi_form') ?>" method="post">
			                    <div class="form-group">
			                        <label>Provinsi</label>
			                        <select class="form-control" name="provinsi" id="provinsi">
			                            <option value="">Please Select</option>
			                            <?php
			                            foreach ($provinsi as $prov) {
			                                ?>
			                                <option <?php echo $provinsi_selected == $prov->id ? 'selected="selected"' : '' ?> 
			                                    value="<?php echo $prov->id ?>"><?php echo $prov->name_provinces ?></option>
			                                <?php
			                            }
			                            ?>
			                        </select>
			                    </div>
			                    <div class="form-group">
			                        <label>Kota</label>
			                        <select class="form-control" name="kota" id="kota">
			                            <option value="">Please Select</option>
			                            <?php
			                            foreach ($kota as $kot) {
			                                ?>
			                                <!--di sini kita tambahkan class berisi id provinsi-->
			                                <option <?php echo $kota_selected == $kot->province_id ? 'selected="selected"' : '' ?> 
                                            data-chained="<?php echo $kot->province_id ?>" value="<?php echo $kot->id ?>"><?php echo $kot->name_regencies ?> <?php echo $kot->id_kota; ?></option>
			                                <?php
			                            }
			                            ?>
			                        </select>
			                    </div>
			                    
			                    <div class="form-group">
			                        <input type="submit" class="btn btn-primary" value="Simpan">
			                    </div>
			                </form>
			            </div>
                    </div>
                </div>
                <!-- End: Demo Datatable 1 -->
                
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

