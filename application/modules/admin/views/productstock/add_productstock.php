<!-- -------------- Main Wrapper -------------- -->
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
                    <li class="breadcrumb-current-item">Add Product Stock</li>
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
                                    <span class="panel-title">ADD PRODUCT STOCK</span>
                                </div>
                                <!-- -------------- /Panel Heading -------------- -->

                                <form method="post" action="<?php echo base_url();?>admin/Productstock/insert_productstock" id="form-contact1">
                                    <div class="panel-body pn">
                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <!-- <input type="text" name="product_name" id="product_name" class="gui-input" placeholder="Product Name" style="padding-left: 5px;" required/> -->
                                                <select id="product_id" name="product_id" class="gui-input">
                                                    <option value="" selected>----select----</option>
                                                    <?php foreach ($product_data as $val) { ?>
                                                    <option value="<?php echo $val->product_id; ?>"><?php echo $val->product_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </label>
                                        </div>


                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <!-- <input type="text" name="department_name" id="department_name" class="gui-input" placeholder="Department Name" style="padding-left: 5px;" required/> -->
                                                <select id="department_id" name="department_id" class="gui-input">
                                                    <option value="" selected>----select----</option>
                                                    <?php foreach ($department_data as $val) { ?>
                                                    <option value="<?php echo $val->dept_id; ?>"><?php echo $val->department_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </label>
                                        </div>


                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="text" name="quantity" id="quantity" class="gui-input" placeholder="Quantity" style="padding-left: 5px;" required/>
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
