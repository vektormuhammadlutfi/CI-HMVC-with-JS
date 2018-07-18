<div class="profile">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8 profile-info">
                   <h1 class="font-green sbold uppercase"><?php echo $main->merk.' '.$main->tipe; ?></h1>
                   <br>
                   <table class="table table-hover table-light">
                        <thead>
                            <tr>    
                                <th>No. Polisi</th>
                                <th>No. Mesin</th>
                                <th>No. Rangka</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>    
                                <td><?php echo $main->no_polisi ?></td>
                                <td><?php echo $main->no_mesin ?></td>
                                <td><?php echo $main->no_rangka ?></td>
                            </tr>
                        </tbody>
                   </table>
                   <table class="table table-light">
                        <thead>
                            <tr>    
                                <th>Merk/Tipe Kendaraan</th>
                                <th>Model</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>    
                                <td><?php echo $main->model ?></td>
                                <td><?php echo $main->merk.'/'.$main->tipe ?></td>
                                <td><?php echo $main->thn_kendaraan ?></td>
                            </tr>
                        </tbody>
                   </table>
                </div>
                <!--end col-md-8-->
                <div class="col-md-4">
                    <div class="portlet sale-summary box">
                        <div class="portlet-title">
                            <div class="caption font-red sbold"> Cabang : </div>
                            <div class="tools">
                                <a class="reload" href="javascript:;"> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="list-unstyled">
                                <li>
                                    <span class="label label-sm label-primary"></i> <?php echo $main->nama_cabang; ?>  </span> 
                                </li>
                                <li>
                                    <span class="sale-info"> 
                                        Tahun : </i> <?php echo $main->thn_kendaraan; ?>
                                    </span>
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
    <div class="row">
        <div class="col-md-12">
            <div class="tabbable-line tabbable-custom-profile">
               
            </div>
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