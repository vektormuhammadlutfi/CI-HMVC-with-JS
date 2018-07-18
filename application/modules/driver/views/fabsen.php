<div class="profile">
    <div class="row">
        <div class="col-md-3">
            <ul class="list-unstyled profile-nav">
                <li>
                    <img src="<?php echo base_url('assets/img/people19.png'); ?>" class="img-responsive pic-bordered" alt="" />
                </li>
                <!--<li>
                    <a href="javascript:;"> Projects </a>
                </li>
                <li>
                    <a href="javascript:;"> Messages
                        <span> 3 </span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;"> Friends </a>
                </li>
                <li>
                    <a href="javascript:;"> Settings </a>
                </li>-->
            </ul>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-8 profile-info">
                    <h1 class="font-green sbold uppercase"><?php echo $main->nama; ?></h1>
                    <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt laoreet dolore magna aliquam tincidunt erat volutpat laoreet dolore magna aliquam
                        tincidunt erat volutpat. </p>
                    <p>
                        <a href="javascript:;"> <?php echo $main->email; ?> </a>
                    </p>
                    <ul class="list-inline">
                        <li>
                            <i class="fa fa-map-marker"></i> <?php echo $main->tmp_lahir; ?> </li>
                        <li>
                            <i class="fa fa-calendar"></i> <?php echo tgl_indo($main->tgl_lahir); ?> </li>
                    </ul>
                </div>
                <!--end col-md-8-->
                <div class="col-md-4">
                    <div class="portlet sale-summary box">
                        <div class="portlet-title">
                            <div class="caption font-red sbold"> Data Absensi : </div>
                            <div class="tools">
                                <a class="reload" href="javascript:;"> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="list-unstyled">
                                <li>
                                    <span class="sale-info"> <span class="label label-sm label-<?php echo $main->absensi_label; ?>"><?php echo $main->absensi_name; ?> </span> </span>
                                </li>
                                <li>
                                    <span class="sale-info"> <?php echo tgl_indo($main->absensi_date); ?> </span>
                                </li>
                                <li>
                                    <select name="absensi_id" class="form-control" placeholder="-Pilih Status-">
                                        <option value="">-Pilih Status-</option>
                                        <option value="1">Ready</option>
                                        <option value="2">Izin</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--end col-md-4-->
            </div>
            <!--end row-->
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button type="button" class="btn red btn-outline" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
</div>