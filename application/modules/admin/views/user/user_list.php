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
                    <li class="breadcrumb-current-item">User List</li>
                </ol>
            </div>
            
        </header>
        <!-- -------------- /Topbar -------------- -->

        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">

            <div class="chute chute-center">
                 <div class="panel panel-visible" id="spy6">

                    <div class="panel-heading">
                        <span class="panel-title">User List</span>

                        <div class="pull-right hidden-xs">
                            <code><a class="btn-dark" href="<?php echo base_url()?>admin/User/adduser" style="padding: 10px;">Add User</a></code>
                        </div>
                    </div>
                    <div class="panel-body pn">
                        <div class="table-responsive">

                            <?php
                              if(!empty($user_data))
                              {
                            ?>
                             <table class="table table-striped table-hover" id="datatable2" cellspacing="0" width="100%">

                                <thead>
                                <tr>
                                  <th class="va-m">User Id</th>
                                  <th class="va-m">Name</th>
                                  <th class="va-m">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      $i=1;
                                      foreach($user_data as $val)
                                      {
                                       
                                    ?>
                                        <tr class="footable-even">
                                            <td><span class="footable-toggle"></span><?php echo $val->uid;?></td>
                                            <td><?php echo $val->username;?></td>
                                            <td>
                                                <a class="btn-primary" href="<?php echo base_url()?>admin/User/edituser/<?php echo $val->uid; ?>" id="edit" title='Edit' style="padding: 5px 15px;margin-right: 10px;">Edit</a>
                                                <a class="btn-danger" href="javascript:frm_submit(<?php print $val->uid?>,'Delete');" id="delete" title='Delete' style="padding: 5px 15px;margin-right: 10px;">Delete</a> 
                                                <a class="btn-success user_model_view" id="user_model_view_<?php echo $val->uid; ?>" data-id="<?php echo $val->uid; ?>" title='View' style="padding: 5px;cursor: pointer;">View</a>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                      }
                                    ?>
                                
                                </tbody>

                                <?php 
                                  $attributes = array('name' => 'frm');
                                  echo form_open('admin/User/delete_user/',$attributes); 
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


        <!-- Modal -->
        <div class="modal fade" id="user_model_view" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">User Details</h4>
                </div>
                <div class="modal-body">
                  <div id="error_msg" style="display:none;">Data not found.</div>
                  <table class="table table-bordered table-hover model_table" id="userTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Department</th>
                        <th>Quantity</th>
                      </tr>
                    </thead>

                     <tbody></tbody>
                    <!-- <tr>
                      <td id="product"></td>
                      <td id="department"></td>
                      <td id="quantity"></td>
                    </tr> -->
                    
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
        </div>
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
<script src="<?php echo base_url()?>assets/js/pages/management-tools-modals.js"></script>

<!-- -------------- /Scripts -------------- -->
<script>
$("document").ready(function(){
    $(".user_model_view").on("click",function(){
        $user_id = $(this).data('id');
        
        //alert($user_id);
        //$('#user_model_view').modal('show');
        $.ajax({
          type:"POST",
          url:"<?php echo base_url(); ?>admin/User/ajax_user_details",
          data:"uid="+$user_id,
          success:function(data){
              //console.log(data);
              //alert(data);
              //exit;
              if(data == 0)
              {
                $("#error_msg").show();
                $(".model_table").hide();
              }else
              {
                $("#error_msg").hide();
                $('#user_model_view').modal('show');

                var json = JSON.parse(data);
                var length = Object.keys(json).length;

                
                for(var i=0; i<length; i++){

                  var product_name = json[i].product_name;
                  //alert(product_name);
                  var department_name = json[i].department_name;
                  var quantity = json[i].quantity;

                  var tr_str = "<tr>" +
                      "<td align='center'>" + (i+1) + "</td>" +
                      "<td align='center'>" + product_name + "</td>" +
                      "<td align='center'>" + department_name + "</td>" +
                      "<td align='center'>" + quantity + "</td>" +
                      "</tr>";

                  $("#userTable tbody").append(tr_str);
                }
              }
            }
        });
        $("#userTable tbody").empty();
    });
});
</script>

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
   document.frm.action = "<?php echo base_url()?>admin/User/delete_user/<?php echo $val->uid; ?>";
   document.frm.submit();
   return
   }
  }
} 

</script>

</body>

</html>