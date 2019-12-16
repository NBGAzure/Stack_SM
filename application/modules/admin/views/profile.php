 <section id="content_wrapper" style="margin-top: 67px;">


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
                    <li class="breadcrumb-current-item">Profile</li>
                </ol>
            </div>
            
        </header>
        <!-- -------------- /Topbar -------------- -->

        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">

            <!-- -------------- Column Center -------------- -->
           <div class="chute chute-center">
                <div class="">

                    <div class="tab-content mw900 center-block center-children">

                        <!-- -------------- Contact Form -------------- -->
                        <div class="allcp-form theme-info tab-pane mw600 active" id="contact" role="tabpanel">
                            <div class="panel">
                                
                                <!-- -------------- /Panel Heading -------------- -->

                                <!-- -------------- Quick Links -------------- -->
                                <div class="row">
                                    
                                    <form method="post" action="<?php echo base_url();?>admin/Home/insert_role" id="form-contact1">
                                       <div class="panel-body pn">
                                        <div class="section" style="text-align: center;">
                                            <img id="image" src="http://via.placeholder.com/150x150" style="border-radius:50%"/>
                                                <input type="file" id="myfile" style="display: none;"/>
                                        </div>
                                       </div>

                                       <div class="panel-body pn" style="margin-top: 0px;">
                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="text" name="role_name" id="role_name" class="gui-input" placeholder="Name" style="padding-left: 5px;">
                                                <!-- <label for="names" class="field-icon">
                                                    <i class="fa fa-user"></i>
                                                </label> -->
                                            </label>
                                         </div>
                                        </div>

                                        <div class="panel-body pn" style="margin-top: 0px;">
                                         <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="Password" name="role_name" id="role_name" class="gui-input" placeholder="password" style="padding-left: 5px;">
                                                <!-- <label for="names" class="field-icon">
                                                    <i class="fa fa-user"></i>
                                                </label> -->
                                            </label>
                                         </div>
                                        </div>

                                        <div class="panel-body pn" style="margin-top: 0px;">
                                         <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="email" name="role_name" id="role_name" class="gui-input" placeholder="Email" style="padding-left: 5px;">
                                                <!-- <label for="names" class="field-icon">
                                                    <i class="fa fa-user"></i>
                                                </label> -->
                                            </label>
                                         </div>
                                        </div>

                                        <div class="panel-body pn" style="margin-top: 0px;">
                                         <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="phone" name="role_name" id="role_name" class="gui-input" placeholder="Phone" style="padding-left: 5px;">
                                                <!-- <label for="names" class="field-icon">
                                                    <i class="fa fa-user"></i>
                                                </label> -->
                                            </label>
                                         </div>
                                        </div>

                                        <div class="section text-center">
                                            <input type="submit" class="btn btn-primary btn-bordered ph40" value="Submit">
                                        </div>

                                    </form>

                                </div>

                            </div>
                            <!-- -------------- /Panel -------------- -->
                        </div>
                        <!-- -------------- /Contact Form -------------- -->

                       
                    </div>

                </div>
            </div>
            <!-- -------------- /Column Center -------------- -->
        </section>
        <!-- -------------- /Content -------------- -->

        
