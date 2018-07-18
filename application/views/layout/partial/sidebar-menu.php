
<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
    <li class="sidebar-toggler-wrapper hide">
        <div class="sidebar-toggler">
            <span></span>
        </div>
    </li>
    <!-- END SIDEBAR TOGGLER BUTTON -->   
    <li class="nav-item <?php if($this->uri->segment(1)=="dashboard"){echo "active";}?>">
        <a href="<?php echo base_url() ?>dashboard" class="nav-item">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
        </a>
    </li>

    <li class="nav-item <?php if($this->uri->segment(1)==""){echo "active";}?>">
        <a href="<?php echo base_url() ?>" class="nav-item">
            <i class="icon-graph"></i>
            <span class="title">General Report</span>
        </a>
    </li>

    <!-- sperator -->
    <li class="heading">
        <h3 class="uppercase">Configuration</h3>
    </li>

<?php if(array_key_exists('Super Admin', $this->userLevel)) { ?>

    <li class="nav-item <?php if($this->uri->segment(1)=="formulir" or $this->uri->segment(1)=="registrasi"){echo "active ";echo "open";}?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-user-following"></i>
            <span class="title">Clients</span>
            <span class="arrow <?php if($this->uri->segment(1)=="formulir" or $this->uri->segment(1)=="registrasi"){echo "open";}?>"></span>
        </a>
        <ul class="sub-menu" <?php if($this->uri->segment(1)=="formulir" or $this->uri->segment(1)=="registrasi"){echo " style='display: block;' ";}?>>
            <li class="nav-item <?php if($this->uri->segment(1)=="formulir"){echo "active";}?>">
                <a href="<?php echo base_url(); ?>formulir" class="nav-link ">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Form</span>
                </a>
            </li>
            <li class="nav-item <?php if($this->uri->segment(1)=="registrasi"){echo "active";}?>">
                <a href="<?php echo base_url(); ?>registrasi" class="nav-link ">
                    <i class="icon-bulb"></i>
                    <span class="title">Registration</span>

                </a>
            </li>
        </ul>
    </li>
<?php } ?>

<?php if(array_key_exists('Super Admin', $this->userLevel)) { ?>
    <li class="nav-item <?php if($this->uri->segment(1)=="types_packaging"){echo "active";}?>">
        <a href="<?php echo base_url() ?>types_packaging" class="nav-item">
            <i class="icon-briefcase"></i>
            <span class="title">Types Packaging</span>
        </a>
    </li>
    <li class="nav-item <?php if($this->uri->segment(1)=="types_packaging"){echo "active";}?>">
        <a href="<?php echo base_url() ?>types_packaging" class="nav-item">
            <i class="fa fa-ship"></i>
            <span class="title">Types Shipments</span>
        </a>
    </li>
    <li class="nav-item <?php if($this->uri->segment(1)=="types_packaging"){echo "active";}?>">
        <a href="<?php echo base_url() ?>types_packaging" class="nav-item">
            <i class="icon-calculator"></i>
            <span class="title">Ship Calculations</span>
        </a>
    </li>

    <li class="nav-item <?php if($this->uri->segment(1)=="types_packaging"){echo "active";}?>">
        <a href="<?php echo base_url() ?>types_packaging" class="nav-item">
            <i class="icon-envelope"></i>
            <span class="title">Invoice</span>
        </a>
    </li>
<?php } ?>

    <!-- sperator -->
    <li class="heading">
        <h3 class="uppercase">Master Data</h3>
    </li>

<?php if(array_key_exists('Super Admin', $this->userLevel)) { ?>
    <li class="nav-item <?php if($this->uri->segment(1)=="schedule"){echo "active";}?>">
        <a href="<?php echo base_url(); ?>schedule">
            <i class="icon-calendar"></i>
            <span class="title">Schedule</span>
        </a>
    </li>
<?php } ?>

<?php if(array_key_exists('Super Admin', $this->userLevel)) { ?>
    <li class="nav-item <?php if($this->uri->segment(1)=="baggage" or $this->uri->segment(1)=="purchase"){echo "active ";echo "open";}?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-briefcase"></i>
            <span class="title">Inventory</span>
            <span class="arrow <?php if($this->uri->segment(1)=="baggage" or $this->uri->segment(1)=="purchase"){echo "open";}?>"></span>
        </a>
        <ul class="sub-menu" <?php if($this->uri->segment(1)=="baggage" or $this->uri->segment(1)=="purchase"){echo " style='display: block;' ";}?>>

            <li class="nav-item <?php if($this->uri->segment(1)=="baggage"){echo "active";}?>">
                <a href="<?php echo base_url(); ?>baggage" class="nav-link ">
                    <span class="title">Baggage</span>
                </a>
            </li>
            
            <li class="nav-item <?php if($this->uri->segment(1)=="purchase"){echo "active";}?>">
                <a href="<?php echo base_url(); ?>purchase" class="nav-link ">
                    <span class="title">Purchase Baggage</span>
                </a>
            </li>

            <li class="nav-item <?php if($this->uri->segment(1)=="baggage_mutation"){echo "active";}?>">
                <a href="<?php echo base_url(); ?>baggage_mutation" class="nav-link ">
                    <span class="title">Baggage Mutation</span>
                </a>
            </li>

        </ul>
    </li>
<?php } ?>

<?php if(array_key_exists('Super Admin', $this->userLevel)) { ?>
    <li class="nav-item <?php if($this->uri->segment(1)=="workarea"){echo "active";}?>">
        <a href="<?php echo base_url(); ?>workarea" class="nav-item">
            <i class="icon-pointer"></i>
            <span class="title">Work Area</span>
        </a>
    </li>


    <!-- sperator -->
    <li class="heading">
        <h3 class="uppercase">System Configuration</h3>
    </li>

    <li class="nav-item <?php if($this->uri->segment(1)=="users"){echo "active";}?>">
        <a href="<?php echo base_url(); ?>users" class="nav-item">
            <i class="icon-user"></i>
            <span class="title">Users</span>
        </a>
    </li>

    <li class="nav-item <?php if($this->uri->segment(1)=="groups"){echo "active";}?>">
        <a href="<?php echo base_url(); ?>groups" class="nav-item">
            <i class="icon-user"></i>
            <span class="title">Groups User</span>
        </a>
    </li>
<?php } ?>

</ul>
<!-- END SIDEBAR MENU -->