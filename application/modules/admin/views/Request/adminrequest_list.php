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
                    <li class="breadcrumb-current-item">Admin Request List</li>
                </ol>
            </div>
            
        </header>
        <!-- -------------- /Topbar -------------- -->

        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">

            <div class="chute chute-center">
                 <div class="panel panel-visible" id="spy6">

                    <div class="panel-heading">
                        <span class="panel-title">Admin Request List</span>
                    </div>

                    <br/>
                    <div class="panel-body pn">
                        <div class="table-responsive">

                            <?php
                              if(!empty($adminrequest_data))
                              {
                            ?>
                             <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">

                                <thead>
                                <tr>
                                  <th class="va-m">Sr.No</th>
                                  <th class="va-m">Product Name</th>
                                  <th class="va-m">Department Name</th>
                                  <th class="va-m">Store Name</th>
                                  <th class="va-m">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      $i=1;
                                      foreach($adminrequest_data as $val)
                                      {
                                       
                                    ?>
                                        <tr class="footable-even">
                                            <td><span class="footable-toggle"></span><?php echo $i;?></td>
                                            <td><?php echo $val->product_name;?></td>
                                            <td><?php echo $val->department_name;?></td>
                                            <td><?php echo $val->store_name;?></td>
                                            <td><?php echo date("Y-m-d", strtotime($val->create_date));?></td>
                                        </tr>
                                    <?php
                                        $i++;
                                      }
                                    ?>
                                
                                </tbody>

                                <?php 
                                  $attributes = array('name' => 'frm');
                                  echo form_open('admin/Product/delete_product/',$attributes); 
                                ?>  
                                      <input name="list_id" type="hidden" value="" />
                                      <input name="mode" type="hidden" />
                                </form>

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
                                  <?php
                                    }
                                    else
                                    {
                                        echo 'No records found';
                                    }
                                 ?>
                                

                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- -------------- /Content -------------- -->
 <!-- -------------- Page Footer -------------- -->
        <footer id="content-footer" class="affix">
            <div class="row">
                <div class="col-md-6">
                    <span class="footer-legal">© 2019 All rights reserved. <a href="#">Therms of use</a> and <a
                            href="#">Privacy policy</a></span>
                </div>
                <div class="col-md-6 text-right">
                    <span class="footer-meta"></span>
                    <a href="#content" class="footer-return-top">
                        <span class="fa fa-angle-up"></span>
                    </a>
                </div>
            </div>
        </footer>
        <!-- -------------- /Page Footer -------------- -->

    </section>
    <!-- -------------- /Main Wrapper -------------- -->


</div>
<!-- -------------- /Body Wrap  -------------- -->
<!-- -------------- Scripts -------------- -->

<!-- -------------- jQuery -------------- -->
<script src="<?php echo base_url(); ?>assets/js/jquery/jquery-1.11.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- Datatables JS -------------- -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/datatables/media/js/dataTables.bootstrap.js"></script>


<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url(); ?>assets/js/plugins/highcharts/highcharts.js"></script>


<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url(); ?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url(); ?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.js"></script>
<script src="<?php echo base_url(); ?>assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/tables-data.js"></script>

<!-- -------------- /Scripts -------------- -->

<script type="text/javascript">
    <?php if($this->session->flashdata('success')){ ?>
        toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php }else if($this->session->flashdata('error')){  ?>
        toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php }else if($this->session->flashdata('warning')){  ?>
        toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
    <?php }else if($this->session->flashdata('info')){  ?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>

<script type="text/javascript">

function frm_submit(list_id,actval)
{

  document.frm.list_id.value = list_id;
  document.frm.mode.value = actval;
  //alert(actval);
 if(actval=='Delete')
 {

 var result = confirm("Are you sure you want to delete?");
  if (result) {
   document.frm.action = "<?php echo base_url()?>admin/Product/delete_product/<?php echo $val->product_id; ?>";
   document.frm.submit();
   return
   }
  }
} 

</script>

</body>

</html>