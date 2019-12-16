<!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper" style="margin-top: 67px;">
<?php 
    $id=(isset($productstock_data[0]->id)!='')?$productstock_data[0]->id:'';
    $product_id=(isset($productstock_data[0]->product_id)!='')?$productstock_data[0]->product_id:'';
    $product_name=(isset($productstock_data[0]->product_name)!='')?$productstock_data[0]->product_name:'';
    $dept_id=(isset($productstock_data[0]->dept_id)!='')?$productstock_data[0]->dept_id:'';
    $department_name=(isset($productstock_data[0]->department_name)!='')?$productstock_data[0]->department_name:'';
    $quantity=(isset($productstock_data[0]->quantity)!='')?$productstock_data[0]->quantity:'';
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
                    <li class="breadcrumb-current-item">Edit Product Stock</li>
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
                                    <span class="panel-title">EDIT PRODUCT STOCK</span>
                                </div>
                                <!-- -------------- /Panel Heading -------------- -->

                                <form method="post" action="<?php echo base_url();?>admin/Productstock/update_productstock" id="form-contact1">
                                    <input type="hidden" name="id" value="<?php echo $id?>" >
                                    <div class="panel-body pn">
                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <select id="product_id" name="product_id" class="gui-input">
                                                    <option value="<?php echo $product_id; ?>" selected><?php echo $product_name; ?></option>
                                                    <?php foreach ($product_data as $val) { ?>
                                                    <option value="<?php echo $val->product_id; ?>" ><?php echo $val->product_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </label>
                                        </div>

                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <!-- <input type="text" name="department_name" id="department_name" class="gui-input" placeholder="Department Name" style="padding-left: 5px;" required/> -->
                                                <select id="department_id" name="department_id" class="gui-input">
                                                    <option value="<?php echo $dept_id; ?>" selected><?php echo $department_name; ?></option>
                                                    <?php foreach ($department_data as $val) { ?>
                                                    <option value="<?php echo $val->dept_id; ?>" ><?php echo $val->department_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </label>
                                        </div>

                                        <div class="section">
                                            <label for="names" class="field prepend-icon">
                                                <input type="text" name="quantity" id="quantity" class="gui-input" value="<?php echo $quantity; ?>" style="padding-left: 5px;" required/>
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
