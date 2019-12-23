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
<script src="<?php echo base_url()?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>

<!-- -------------- HighCharts Plugin -------------- -->
<script src="<?php echo base_url()?>assets/js/plugins/highcharts/highcharts.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/c3charts/d3.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/c3charts/c3.min.js"></script>

<!-- -------------- Simple Circles Plugin -------------- -->
<script src="<?php echo base_url()?>assets/js/plugins/circles/circles.js"></script>

<!-- -------------- Maps JSs -------------- -->
<script src="<?php echo base_url()?>assets/js/plugins/jvectormap/jquery.jvectormap.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js"></script>

<!-- -------------- FullCalendar Plugin -------------- -->
<script src="<?php echo base_url()?>assets/js/plugins/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url()?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>

<!-- -------------- Date/Month - Pickers -------------- -->
<script src="<?php echo base_url()?>assets/allcp/forms/js/jquery-ui-monthpicker.min.js"></script>
<script src="<?php echo base_url()?>assets/allcp/forms/js/jquery-ui-datepicker.min.js"></script>

<!-- -------------- Magnific Popup Plugin -------------- -->
<script src="<?php echo base_url()?>assets/js/plugins/magnific/jquery.magnific-popup.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url()?>assets/js/demo/demo.js"></script>
<script src="<?php echo base_url()?>assets/js/main.js"></script>

<!-- -------------- Widget JS -------------- -->
<script src="<?php echo base_url()?>assets/js/demo/widgets.js"></script>
<script src="<?php echo base_url()?>assets/js/demo/widgets_sidebar.js"></script>
<script src="<?php echo base_url()?>assets/js/pages/dashboard1.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

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
  jQuery('#image').click(function(){
    jQuery('#myfile').click()
  });

  // Material Select Initialization
$(document).ready(function() {
    $('select').selectpicker();

});


if ($(window).width() < 1024) {
    $('body').addClass('sb-l-o sb-r-c mobile-view sb-l-m chute-rescale sb-l-disable-animation onload-check');
} else {
    $('body').removeClass('sb-l-o sb-r-c mobile-view sb-l-m chute-rescale sb-l-disable-animation onload-check');
}
</script>
</body>

</html>