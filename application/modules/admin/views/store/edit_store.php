<!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper" style="margin-top: 67px;">
<?php 
    $str_id=(isset($store_data[0]->str_id)!='')?$store_data[0]->str_id:'';
    $store_name=(isset($store_data[0]->store_name)!='')?$store_data[0]->store_name:'';
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
                    <li class="breadcrumb-current-item">Edit Store</li>
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
                                    <span class="panel-title">EDIT STORE</span>
                                </div>
                                <!-- -------------- /Panel Heading -------------- -->

                                <form method="post" action="<?php echo base_url();?>admin/store/update_store" id="form-contact1">
                                    <input type="hidden" name="str_id" value="<?php echo $str_id?>" >
                                    <div class="panel-body pn">
                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="text" name="store_name" id="store_name" class="gui-input" placeholder="Store Name" style="padding-left: 5px;" value="<?php echo $store_name?>" required/>
                                                <!-- <label for="names" class="field-icon">
                                                    <i class="fa fa-user"></i>
                                                </label> -->
                                            </label>
                                        </div>

                                        <!-- <div class="section">
                                            <label>Visible For:</label><br/>
                                            <select class="selectpicker" name="visible_for[]" multiple data-live-search="true">
                                              <?php foreach($userdata as $user){?>
                                                  <option value="<?php print $user->uid; ?>"><?php print $user->username; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div> -->
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
