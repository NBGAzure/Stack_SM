<!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper" style="margin-top: 67px;">
<?php 
    $uid=(isset($user_data[0]->uid)!='')?$user_data[0]->uid:'';
    $user_name=(isset($user_data[0]->username)!='')?$user_data[0]->username:'';
?>

        <!-- -------------- Topbar -------------- -->
        <header id="topbar" class="alt">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="breadcrumb-icon">
                        <a>
                            <span class="fa fa-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-active">
                        <a>Dashboard</a>
                    </li>
                    <li class="breadcrumb-link">
                        <a href="<?php echo base_url(); ?>admin/Home">Home</a>
                    </li>
                    <li class="breadcrumb-current-item">Edit User</li>
                </ol>
            </div>
            
        </header>
        <!-- -------------- /Topbar -------------- -->

        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">

            <div class="chute chute-center">
                <div class="">

                    <div class="tab-content mw900 center-block center-children">

                        <!-- -------------- Contact Form -------------- -->
                        <div class="allcp-form theme-info tab-pane mw600 active" id="contact" role="tabpanel">
                            <div class="panel">
                                <div class="panel-heading">
                                    <span class="panel-title">EDIT USER</span>
                                </div>
                                <!-- -------------- /Panel Heading -------------- -->

                                <form method="post" action="<?php echo base_url();?>admin/User/update_user" id="form-contact1">
                                    <input type="hidden" name="uid" value="<?php echo $uid?>" >
                                    <div class="panel-body pn">
                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="text" name="user_name" id="user_name" class="gui-input" style="padding-left: 5px;" value="<?php echo $user_name?>" required/>
                                            </label>
                                        </div>

                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="password" name="user_pass" id="user_pass" class="gui-input" placeholder="Password" style="padding-left: 5px;" required/>
                                            </label>
                                        </div>
                                        <!-- -------------- /section -------------- -->
                                    </div>
                                    <!-- -------------- /Form -------------- -->
                                    <div class="section text-right">
                                        <input type="submit" class="btn btn-primary btn-bordered ph40" value="Submit">
                                    </div>
                                </form>
                            </div>
                            <!-- -------------- /Panel -------------- -->
                        </div>
                        <!-- -------------- /Contact Form -------------- -->

                       
                    </div>

                </div>
            </div>

        </section>
        <!-- -------------- /Content -------------- -->
