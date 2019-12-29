<!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper" style="margin-top: 67px;">
<?php 
    $product_id=(isset($product_data[0]->product_id)!='')?$product_data[0]->product_id:'';
    $product_name=(isset($product_data[0]->product_name)!='')?$product_data[0]->product_name:'';
    $dept_id=(isset($product_data[0]->dept_id)!='')?$product_data[0]->dept_id:'';
    $department_name =(isset($product_data[0]->department_name)!='')?$product_data[0]->department_name:'';

    $str_id=(isset($product_data[0]->str_id)!='')?$product_data[0]->str_id:'';
    $store_name =(isset($product_data[0]->store_name)!='')?$product_data[0]->store_name:'';
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
                    <li class="breadcrumb-current-item">Edit Product</li>
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
                                    <span class="panel-title">EDIT PRODUCT</span>
                                </div>
                                <!-- -------------- /Panel Heading -------------- -->

                                <form method="post" action="<?php echo base_url();?>admin/Product/update_product" id="form-contact1">
                                    <input type="hidden" name="product_id" value="<?php echo $product_id?>" >
                                    <div class="panel-body pn">
                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="text" name="product_name" id="product_name" class="gui-input" placeholder="Product Name" style="padding-left: 5px;" value="<?php echo $product_name?>" required/>
                                            </label>
                                        </div>

                                        <div class="section">
                                            <select class="form-control" name="dept_id" id="dept_id" placeholder="Department Name">
                                                <option value="<?php print $dept_id; ?>" selected/><?php print $department_name; ?></option>
                                                <option value="">------</option>
                                                <?php foreach($results as $department){?>
                                                  <option value="<?php print $department->dept_id; ?>"><?php print $department->department_name; ?></option>
                                                <?php  } ?>
                                            </select>
                                        </div>

                                        <div class="section">
                                            <select class="form-control" name="str_id" id="str_id" placeholder="Store Name">
                                                <option value="<?php print $str_id; ?>" selected/><?php print $store_name; ?></option>
                                                <option value="">------</option>
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
