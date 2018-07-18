<!-- Start page header -->
<div class="header-content">
    <h2><i class="fa fa-users"></i><?php echo $title; ?><span>user identity</span></h2>
    <div class="breadcrumb-wrapper hidden-xs">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li class="active"><?php echo $title; ?></li>
        </ol>
    </div>
</div><!-- /.header-content -->
<!--/ End page header -->

<!-- Start body content -->
<div class="body-content animated fadeIn">
    <div class="row">
        <div class="col-md-4">
            <div class="panel rounded shadow panel-bg-warning">
                <div class="panel-body user-info">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-center">
                                <img class="img-circle img-bordered-primary profile-avatar" src="<?php echo base_url('uploads/' . $currentUser->avatar); ?>" alt="">
                            </li>
                            <li class="text-center">
                                <h3 style="color: #fff;" class="profile-fullname"><?php echo $currentUser->first_name . ' ' . $currentUser->last_name; ?></h3>
                                <p class="text-muted text-capitalize"><?php echo $currentUser->kdoffice; ?></p>
                            </li>
                            <li>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <strong class="text-inverse"><i class="fa fa-user margin-r-5"></i>  Username</strong>
                                        <a class="pull-right"><?php echo $currentUser->username; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-inverse"><i class="fa fa-envelope margin-r-5"></i>  Email</strong>
                                        <a class="pull-right"><?php echo $currentUser->email; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-inverse"><i class="fa fa-phone margin-r-5"></i>  Phone</strong>
                                        <a class="pull-right profile-phone"><?php echo $currentUser->phone; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <strong class="text-inverse"><i class="fa fa-home margin-r-5"></i>  Address</strong>
                                        <a class="pull-right profile-address"><?php echo $currentUser->address; ?></a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /.panel -->
        </div>
        <div class="col-md-8">
            <!-- Start default tabs -->
            <div class="panel panel-tab rounded shadow">
                <!-- Start tabs heading -->
                <div class="panel-heading no-padding">
                    <ul class="nav nav-tabs profile-tabs">
                        <li class="active">
                            <a href="#tab1-1" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-user"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#tab1-2" data-toggle="tab" aria-expanded="false">
                                <i class="fa fa-smile-o"></i>
                                <span>Change Avatar</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#tab1-3" data-toggle="tab" aria-expanded="false">
                                <i class="fa fa-lock"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                    </ul>
                </div><!-- /.panel-heading -->
                <!--/ End tabs heading -->

                <!-- Start tabs content -->
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tab1-1">
                            <?php echo form_open('users/profile/?', 'id="form-profile"'); ?>
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <div class="input-icon">
                                        <i class="fa fa-user"></i>
                                        <input type="text" class="form-control" id="firstname" name="first_name" placeholder="Enter your first name" value="<?php echo $currentUser->first_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <div class="input-icon">
                                        <i class="fa fa-user"></i>
                                        <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Enter your last name" value="<?php echo $currentUser->last_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <div class="input-icon">
                                        <i class="fa fa-phone"></i>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo $currentUser->phone; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <div class="input-icon">
                                        <i class="fa fa-home"></i>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" value="<?php echo $currentUser->address; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="change_profile" value="true" class="btn btn-theme pull-right submit">Save Changes</button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                        <div class="tab-pane fade" id="tab1-2">
                            <div class="avatar-container" id="crop-avatar">
                                <!-- Current avatar -->
                                <div class="avatar-view" title="Click to change avatar">
                                    <img src="<?php echo base_url('uploads/'. $currentUser->avatar); ?>" alt="Avatar">
                                </div>
                                <!-- Loading state -->
                                <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab1-3">
                            <?php echo form_open('users/profile/?', 'id="form-password"'); ?>
                                <div class="form-group">
                                    <label for="old_password">Current Password</label>
                                    <div class="input-icon">
                                        <i class="fa fa-unlock-alt"></i>
                                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter your current password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <div class="input-icon">
                                        <i class="fa fa-lock"></i>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter your new password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <div class="input-icon">
                                        <i class="fa fa-key"></i>
                                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Re-enter your new password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="change_password" value="true" class="btn btn-theme pull-right submit">Save Changes</button>
                                </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div><!-- /.panel-body -->
                <div class="indicator panel-indicator" style="display: none;"><span class="spinner"></span></div>
                <!--/ End tabs content -->
            </div><!-- /.panel -->
            <!--/ End default tabs -->
        </div>
    </div>
</div>
<!-- Cropping modal -->
<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="avatar-form" action="<?php echo base_url('user/cropper'); ?>" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">
                        <!-- Upload image and data -->
                        <div class="avatar-upload">
                            <input type="hidden" name="is_ajax" value="true">
                            <input type="hidden" class="avatar-src" name="avatar_src">
                            <input type="hidden" class="avatar-data" name="avatar_data">
                            <label for="avatarInput">Choose Photo</label>
                            <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                        </div>

                        <!-- Crop and preview -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="avatar-wrapper"></div>
                            </div>
                        </div>

                        <div class="row avatar-btns">
                            <div class="col-md-9">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="-90" title="Rotate -90 degrees">Rotate Left</button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="90" title="Rotate 90 degrees">Rotate Right</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" name="change_avatar" value="true" class="btn btn-primary btn-block avatar-save">Finish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="indicator modal-indicator" style="display: none;"><span class="spinner"></span></div>
    </div>
</div><!-- /.modal -->