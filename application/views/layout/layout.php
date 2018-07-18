<!DOCTYPE html>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <title><?php echo $module . ' | ' . $this->config->item('app_name'); ?></title>
         
         <?php $this->load->view('layout/partial/meta'); ?>
         <?php $this->load->view('layout/partial/style'); ?>
        
        <script>var base_url = '<?php echo base_url(); ?>';</script>
    </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md page-sidebar-fixed page-md page-header-top-fixed">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <?php $this->load->view('layout/partial/top-head'); ?>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <?php $this->load->view('layout/partial/sidebar-menu'); ?>
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <?php echo $content; ?>
                <!-- END CONTENT -->
               
            </div>
            <!-- END CONTAINER -->
            <!-- BEGIN FOOTER -->
            <?php $this->load->view('layout/partial/footer'); ?>
            <!-- END FOOTER -->
        </div>
        <!-- BEGIN QUICK NAV -->
        <?php $this->load->view('layout/partial/quick-nav'); ?>
        <!-- END QUICK NAV -->
         <?php $this->load->view('layout/partial/script'); ?>
    </body>

</html>