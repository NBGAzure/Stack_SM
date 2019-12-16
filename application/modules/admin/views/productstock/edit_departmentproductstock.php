<!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper" style="margin-top: 67px;">
<?php 
    $id=(isset($productstock_dept[0]->id)!='')?$productstock_dept[0]->id:'';
    $product_id=(isset($productstock_dept[0]->product_id)!='')?$productstock_dept[0]->product_id:'';
    $product_name=(isset($productstock_dept[0]->product_name)!='')?$productstock_dept[0]->product_name:'';
    $dept_id=(isset($productstock_dept[0]->dept_id)!='')?$productstock_dept[0]->dept_id:'';
    $department_name=(isset($productstock_dept[0]->department_name)!='')?$productstock_dept[0]->department_name:'';
    $pre_quantity=(isset($productstock_quan[0]->quantity)!='')?$productstock_quan[0]->quantity:'';
    $quantity=(isset($product_quan[0]->quantity)!='')?$product_quan[0]->quantity:'';
    
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

                    <div class="tab-content center-block center-children">

                        <!-- -------------- Contact Form -------------- -->
                        <div class="allcp-form theme-info tab-pane active" id="contact" role="tabpanel">
                            <div class="panel">
                                <!-- <div class="panel-heading">
                                    <span class="panel-title">EDIT PRODUCT STOCK</span>
                                </div> -->
                                <!-- -------------- /Panel Heading -------------- -->

                                <form method="post" action="<?php echo base_url();?>admin/Productstock/editdepartproductstock" id="form-contact1">
                                  <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">

                                    <thead>
                                    <tr>
                                      <th class="va-m">Sr.No</th>
                                      <th class="va-m">Product</th>
                                      <th class="va-m">Department</th>
                                      <th class="va-m">Previous Quantity</th>
                                      <th class="va-m">Today Quantity</th>
                                      <th class="va-m">Require</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $i=1;
                                          //print_r($productstock_dept);
                                          // print_r($product_quan);
                                          //exit;
                                          foreach($productstock_dept as $val)
                                            //foreach(array_combine($productstock_dept, $product_quan) as $val => $quan)
                                           {
                                           
                                        ?>
                                            <tr class="footable-even">
                                                <td><span class="footable-toggle"></span><?php echo $i;?></td>
                                                <td><?php echo $val->product_name;?><input type="hidden" name="product_id[]" value="<?php echo $val->product_id;?>"></td>
                                                <td><input type="hidden" name="dept_id" value="<?php echo $val->dept_id;?>"><?php echo $val->department_name;?></td>
                                                <td><?php echo isset($val->previous_quantity)?$val->previous_quantity:"";?></td>
                                                <td><input type="text" name="quantity[]" value="<?php if(isset($val->quantity)){echo $val->quantity;}else{
                                                  echo "";}?>"></td>
                                                <td><input type="checkbox" id="checkItem" name="check_val[]" value="1"<?php if(isset($val->check_val)){echo "checked = cheched";}else{echo "";}?>>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                          }
                                        ?>
                                    
                                    </tbody>

                                      <tfoot class="footer-menu">
                                        <tr>
                                          <td colspan="5">
                                            <nav class="text-right">  
                                              <ul class="pagination hide-if-no-paging">
                                                <?php if (isset($links)) { ?>
                                                <li class="footable-page"><?php echo $links ?></li>
                                                <?php } ?>
                                              </ul>
                                            </nav>
                                          </td> 
                                        </tr>
                                      </tfoot>
                                      
                                    </table>

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
