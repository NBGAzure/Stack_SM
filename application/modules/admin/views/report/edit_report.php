<!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper" style="margin-top: 67px;">
<?php 
    $id=(isset($report_data[0]->id)!='')?$report_data[0]->id:'';
    $item=(isset($report_data[0]->item)!='')?$report_data[0]->item:'';
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
                    <li class="breadcrumb-current-item">Edit Report</li>
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
                                    <span class="panel-title">EDIT REPORT</span>
                                </div>
                                <!-- -------------- /Panel Heading -------------- -->

                                <form method="post" action="<?php echo base_url();?>admin/Report/update_report" id="form-contact1">
                                    <input type="hidden" name="id" value="<?php echo $id?>" >
                                    <div class="panel-body pn">
                                        
                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="text" name="item" id="item" class="gui-input" value="<?php echo $item; ?>" style="padding-left: 5px;" required/>
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
