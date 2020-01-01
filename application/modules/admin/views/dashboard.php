 <section id="content_wrapper" style="margin-top: 67px;">
    <style type="text/css">
        li.dash_li{
            padding: 10px;
            background: #2a2f43;
            color: black !important;
            list-style-type: none;
            margin-bottom: 20px;
            width: 85%;
            text-align: center;
        }
        .sec{
            background: #e5eaee !important;
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
                    <li class="breadcrumb-active">
                        <a>Dashboard</a>
                    </li>
                    <li class="breadcrumb-link">
                        <a href="<?php echo base_url(); ?>admin/Home">Home</a>
                    </li>
                    <li class="breadcrumb-current-item">Dashboard</li>
                </ol>

            </div>
            <br/>
        </header>

        <div id="topbar" class="alt sec">
            <ol class="breadcrumb">
                <li class="breadcrumb-icon">
                    <a>
                        <span class="fa fa-power-off"></span>
                    </a>
                </li>
                <li class="breadcrumb-link">
                    <a href="<?php echo base_url();?>admin/Home/logout">Logout</a>
                </li>
            </ol>
        </div>
        <!-- -------------- /Topbar -------------- -->

        <!-- -------------- Content -------------- -->
        <section id="content" class="table-layout animated fadeIn">

            <!-- -------------- Column Center -------------- -->
            <div class="chute chute-center">

                <!-- -------------- Quick Links -------------- -->
                <div class="row">
                    <div class="col-sm-6 col-xl-6">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <!-- <div class="col-xs-5 ph10"><img src="<?php echo base_url()?>assets/img/pages/clipart0.png"
                                                                    class="img-responsive mauto" alt=""/></div> -->
                                    <div class="col-xs-2 pl5"></div>
                                    <div class="col-xs-10 pl5">
                                        <h6 class="text-muted">Departments</h6>

                                        <!-- <h2 class="fs50 mt5 mbn"><?php// echo $total_artists; ?></h2> -->
                                        <?php if($_SESSION['username']!='superadmin') {  ?>
                                            <?php //if(current_url() == site_url('admin/Productstock/productstock_list')) { $class = 'active';} else { $class =''; }  ?>
                                            <!-- <li class="<?php print $class; ?>">
                                               <a href="<?php echo site_url('admin/Productstock/productstock_list');?>">
                                                    <span class="fa fa-desktop"></span>
                                                    <span class="sidebar-title">Product Stock</span>
                                                </a>
                                            </li> -->
                                            <?php 
                                            $uid =$this->session->userdata['uid'];
                                            $query = $this->db->query("SELECT * from department WHERE `visible_for` = ".$uid." ");
                                            foreach ($query->result() as $val)  { ?>
                                            <li class="dash_li">
                                               <a href="<?php echo base_url()?>admin/Productstock/departmentproduct/<?php echo $val->dept_id; ?>">
                                                    <span class="sidebar-title"><?php echo $val->department_name;?></span>
                                                </a>
                                            </li>
                                            <?php  } ?>
                                        <?php  } ?>

                                        <?php if($_SESSION['username']=='superadmin') {  ?>
                                           
                                            <?php 
                                            $uid =$this->session->userdata['uid'];
                                            $query = $this->db->query("SELECT * from department");
                                            foreach ($query->result() as $val)  { ?>
                                            <li class="dash_li">
                                               <a><span class="sidebar-title"><?php echo $val->department_name;?></span></a>
                                            </li>
                                            <?php  } ?> 
                                        <?php  } ?>
                                    </div>
                                    <div class="col-xs-2 pl5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-sm-6 col-xl-6">
                        <div class="panel panel-tile">
                            <div class="panel-body">
                                <div class="row pv10">
                                    <div class="col-xs-2 p15">
                                        <!-- <img src="<?php echo base_url()?>assets/img/pages/clipart2.png" class="img-responsive mauto" alt=""/> -->
                                    </div>
                                    <div class="col-xs-10 pl5">
                                        <h6 class="text-muted">REQUEST</h6>

                                        <h2 class="fs50 mt5 mbn"><?php //echo $total_hosts; ?></h2>

                                         <?php if($_SESSION['username']!='superadmin') {  ?>
                                            
                                            <li class="dash_li">
                                               <a href="<?php echo base_url()?>admin/Request/request_list">
                                                    <span class="sidebar-title">Request</span>
                                                </a>
                                            </li>   
                                        <?php } ?>

                                         <?php if($_SESSION['username']=='superadmin') {  ?>
                                            
                                            <li class="dash_li">
                                               <a href="<?php echo base_url()?>admin/Request/adminrequest_list">
                                                    <span class="sidebar-title">Request</span>
                                                </a>
                                            </li>   
                                        <?php } ?>

                                    </div>

                                    <div class="col-xs-2 p15"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
            <!-- -------------- /Column Center -------------- -->
        </section>
        <!-- -------------- /Content -------------- -->
