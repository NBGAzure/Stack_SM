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
                    <li class="breadcrumb-current-item">Edit Till Report</li>
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

                                <?php
                                    if(!empty($till_report))
                                {
                                ?>
                                <form method="post" action="<?php echo base_url();?>admin/Report/save_tillreportstock" id="form-contact1">
                                
                                  <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">

                                    <thead>
                                    <tr>
                                      <th class="va-m">Sr.No</th>
                                      <th class="va-m">Type</th>
                                      <th class="va-m">Today Quantity</th>
                                      <th class="va-m">Total(in dollar)</th>
                                      <th class="va-m">Previous Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $i=1;
                                          $j=0;
                                          foreach($till_report as $key=>$val)
                                          {
                                            //print_r($till_report);
                                            $uid = $this->session->userdata['uid'];
                                            $predate = date('Y-m-d', strtotime(' -1 day'));
                                            $prequ= "SELECT * from `report_stock` where `uid` = $uid and `quantity` != '' and `item_id`=".$val->itemid." and date(`created_date`)= '$predate' ";
                                            $prequ_data = $this->db->query($prequ)->row();
                                            //echo $this->db->last_query();
                                            // print_r($prequ_data);
                                        ?>
                                            <tr class="footable-even">
                                                <td><span class="footable-toggle"></span><?php echo $i;?></td>
                                                <td><?php echo $val->item;?><input type="hidden" name="item_id[]" value="<?php echo $val->itemid;?>"></td>
                                                <td><input type="text" name="quantity[]" value="<?php if(isset($val->quantity)){echo $val->quantity;}else{
                                                  echo "";}?>" /></td>
                                                <td><input type="text" id="total[]" name="total[]" value="<?php if(isset($val->total)){echo $val->total;}else{echo "0";}?>" style="background: none;border: none;" readonly/></td>
                                                <td><input id="previous_qun" name="previous_qun[]" value="<?php echo isset($prequ_data->total)?$prequ_data->total:0;?>" style="background: none;border: none;" readonly></td>
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
                                        <input type="submit" class="btn btn-primary btn-bordered ph40" value="SAVE">
                                    </div>
                                </form>

                                 <?php
                                    }
                                    else
                                    {
                                        echo 'No records found';
                                    }
                                 ?>
                            </div>
                            <!-- -------------- /Panel -------------- -->
                        </div>
                        <!-- -------------- /Contact Form -------------- -->

                       
                    </div>

                </div>
            </div>

        </section>
        <!-- -------------- /Content -------------- -->
