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
<style>
    input#pre_quantity {
        background: no-repeat;
        border: none;
    }
</style>
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
                                <form method="post" action="<?php echo base_url();?>admin/Productstock/editdepartproductstock" id="form-contact1">
                                  <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">

                                    <thead>
                                    <tr>
                                      <th class="va-m">Sr.No</th>
                                      <th class="va-m">Product</th>
                                      <!--<th class="va-m">Department</th>-->
                                      <th class="va-m">Previous Quantity</th>
                                      <th class="va-m">Today Quantity</th>
                                      <th class="va-m">Require</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $i=1;
                                          $j=0;
                                          foreach($productstock_dept as $val)
                                          {
                                            //print_r($productstock_dept);
                                            $uid = $this->session->userdata['uid'];
                                            $predate = date('Y-m-d', strtotime(' -1 day'));
                                            $prequ= "SELECT * from `product_stock` where `dept_id` = $val->dept_id and `product_id` = $val->product_id and `uid` = $uid and 'quantity' != '' and date(`create_date`)= '$predate' ";
                                            $prequ_data = $this->db->query($prequ)->row();
                                            // echo $this->db->last_query();
                                            // print_r($prequ_data);
                                        ?>
                                            <tr class="footable-even">
                                                <td><span class="footable-toggle"></span><?php echo $i;?></td>
                                                <td><?php echo $val->product_name;?><input type="hidden" name="product_id[]" value="<?php echo $val->product_id;?>"></td>
                                                <input type="hidden" name="dept_id" value="<?php echo $val->dept_id;?>">
                                                <!--<td><input type="hidden" name="dept_id" value="<?php echo $val->dept_id;?>"><?php echo $val->department_name;?></td>-->
                                                <!-- <td><?php echo isset($val->previous_quantity)?$val->previous_quantity:"";?></td> -->
                                                <td><input id="pre_quantity" name="pre_quantity[]" value="<?php echo isset($prequ_data->quantity)?$prequ_data->quantity:0;?>" readonly></td>
                                                <td><input type="text" name="quantity[]" value="<?php if(isset($val->quantity)){echo $val->quantity;}else{
                                                  echo "";}?>" required/></td>
                                                <td>
                                                    <!-- <input type="hidden" id="" name="check_val[]" value="0" /> -->
                                                    <!-- <input id='checkItemHidden[]' type='hidden' value='0' name='check_val[]'> -->
                                                    <input type="checkbox" id="checkItem[]" name="check_val[<?php echo $val->product_id;?>][]" value="1" <?php if(isset($val->check_val)){echo "checked = checked";}else{echo "";}?>>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                            $j++;
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
