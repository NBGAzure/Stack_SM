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
                    <li class="breadcrumb-current-item">Add Product</li>
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
                                    <span class="panel-title">ADD PRODUCT</span>
                                </div>
                                <!-- -------------- /Panel Heading -------------- -->

                                <form method="post" action="<?php echo base_url();?>admin/Product/insert_product" id="form-contact1">
                                    <div class="panel-body pn">
                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="text" name="product_name" id="product_name" class="gui-input" placeholder="Product Name" style="padding-left: 5px;" required/>
                                            </label>
                                        </div>

                                        <div class="section">
                                            <select class="form-control" name="dept_id" id="dept_id" placeholder="Department Name">
                                                <option value="">---select department---</option>
                                                <?php foreach($results as $department){?>
                                                  <option value="<?php print $department->dept_id; ?>"><?php print $department->department_name; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>

                                        <div class="section">
                                            <select class="form-control" name="str_id" id="str_id" placeholder="Store Name">
                                                <option value="">---select store---</option>
                                                <?php foreach($storeresults as $store){?>
                                                  <option value="<?php print $store->str_id; ?>"><?php print $store->store_name; ?></option>
                                                <?php  } ?>
                                            </select>
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
