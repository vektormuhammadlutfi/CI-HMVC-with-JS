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
                    <p> <?php echo $main->no_identitas; ?></p>
                    <p> <?php echo $main->alamat; ?></p>
                    <p>
                        <a href="javascript:;"> <?php echo $main->email; ?> </a>
                    </p>
                    <ul class="list-inline">
                        <li>
                            <i class="fa fa-map-marker"></i> <?php echo $main->tmp_lahir; ?> 
                        </li>
                        <li>
                            <i class="fa fa-calendar"></i> <?php echo tgl_indo($main->tgl_lahir); ?> 
                        </li>
                        <li>
                            <i class="fa fa-phone"></i> <?php echo $main->hp; ?> 
                        </li>
                    </ul>
                </div>
                <!--end col-md-8-->
                <div class="col-md-4">
                    <div class="portlet sale-summary box">
                        <div class="portlet-title">
                            <div class="caption font-red sbold"> Status : </div>
                            <div class="tools">
                                <a class="reload" href="javascript:;"> </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <ul class="list-unstyled">
                                <li>
                                    <span class="sale-info"> 
                                        <?php if ($main->active=='1'){?>
                                            <span class="label label-sm label-primary"> AKTIF </span> 
                                        <?php } else {?>
                                            <span class="label label-sm label-danger"> NON AKTIF </span> 
                                        <?php } ?>
                                    </span>
                                </li>
                                <li>
                                    <span class="sale-info"> 
                                            <?php 
                                            if($main->jenis_driver=='logistics'){
                                                echo "Driver Logistics";
                                            }else{
                                                echo "Driver Car Carrier";
                                            }
                                            ?>
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
                <ul class="nav nav-tabs">
                    <!-- <li class="active">
                        <a href="#tab_1_11" data-toggle="tab"> Tugas Terakhir </a>
                    </li> -->
                    <!--<li>
                        <a href="#tab_1_22" data-toggle="tab"> Data Lembur </a>
                    </li>
                    <li>
                        <a href="#tab_1_22" data-toggle="tab"> Data Pembayaran </a>
                    </li>-->
                </ul>
                <div class="tab-content">
                    <!-- <div class="tab-pane active" id="tab_1_11">
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <i class="fa fa-briefcase"></i> Company </th>
                                        <th class="hidden-xs">
                                            <i class="fa fa-question"></i> Descrition </th>
                                        <th>
                                            <i class="fa fa-bookmark"></i> Amount </th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="javascript:;"> Pixel Ltd </a>
                                        </td>
                                        <td class="hidden-xs"> Server hardware purchase </td>
                                        <td> 52560.10$
                                            <span class="label label-success label-sm"> Paid </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="javascript:;"> Smart House </a>
                                        </td>
                                        <td class="hidden-xs"> Office furniture purchase </td>
                                        <td> 5760.00$
                                            <span class="label label-warning label-sm"> Pending </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="javascript:;"> FoodMaster Ltd </a>
                                        </td>
                                        <td class="hidden-xs"> Company Anual Dinner Catering </td>
                                        <td> 12400.00$
                                            <span class="label label-success label-sm"> Paid </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="javascript:;"> WaterPure Ltd </a>
                                        </td>
                                        <td class="hidden-xs"> Payment for Jan 2013 </td>
                                        <td> 610.50$
                                            <span class="label label-danger label-sm"> Overdue </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="javascript:;"> Pixel Ltd </a>
                                        </td>
                                        <td class="hidden-xs"> Server hardware purchase </td>
                                        <td> 52560.10$
                                            <span class="label label-success label-sm"> Paid </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="javascript:;"> Smart House </a>
                                        </td>
                                        <td class="hidden-xs"> Office furniture purchase </td>
                                        <td> 5760.00$
                                            <span class="label label-warning label-sm"> Pending </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="javascript:;"> FoodMaster Ltd </a>
                                        </td>
                                        <td class="hidden-xs"> Company Anual Dinner Catering </td>
                                        <td> 12400.00$
                                            <span class="label label-success label-sm"> Paid </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                    <!--tab-pane-->
                    <div class="tab-pane" id="tab_1_22">
                        <!-- <div class="tab-pane active" id="tab_1_1_1">
                            <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                <ul class="feeds">
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-success">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> You have 4 pending tasks.
                                                        <span class="label label-danger label-sm"> Take action
                                                            <i class="fa fa-share"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> Just now </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-success">
                                                            <i class="fa fa-bell-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> New version v1.4 just lunched! </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date"> 20 mins </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-danger">
                                                        <i class="fa fa-bolt"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> Database server #12 overloaded. Please fix the issue. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 24 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 30 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-success">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 40 mins </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-warning">
                                                        <i class="fa fa-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New user registered. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 1.5 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-success">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> Web server hardware needs to be upgraded.
                                                        <span class="label label-inverse label-sm"> Overdue </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 2 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-default">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 3 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-warning">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 5 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 18 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-default">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 21 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 22 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-default">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 21 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 22 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-default">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 21 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 22 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-default">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 21 hours </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-info">
                                                        <i class="fa fa-bullhorn"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> New order received. Please take care of it. </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date"> 22 hours </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                    <!--tab-pane-->
                </div>
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