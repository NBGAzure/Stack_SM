<?php 
  //if(current_url() == site_url('admin/Department/department_list')) { $class = 'tables-datatables';$class2='scroll';$class3='#nav-spy';$class4='300';} 
  //elseif(current_url() == site_url('admin/Product/product_list')) { $class = 'tables-datatables';$class2='scroll';$class3='#nav-spy';$class4='300';} 
  // elseif(current_url() == site_url('admin/Category/subcategory_list')) { $class = 'tables-datatables';$class2='scroll';$class3='#nav-spy';$class4='300';} 
  // elseif(current_url() == site_url('admin/Category/hostsubcategory_list')) { $class = 'tables-datatables';$class2='scroll';$class3='#nav-spy';$class4='300';} 
  // elseif (current_url() == site_url('admin/User_role/role_list')) {$class = 'tables-datatables';$class2='scroll';$class3='#nav-spy';$class4='300';}
  //else { $class ='dashboard-page';$class2='';$class3='';$class4='';}  
?>
<body class="dashboard-page" data-spy="" data-target="" data-offset="">



<!-- -------------- Body Wrap  -------------- -->
<div id="main">

    <!-- -------------- Header  -------------- -->
    <header class="navbar navbar-fixed-top bg-dark">
        <div class="navbar-logo-wrapper">
            <a class="navbar-logo-text" href="#">
                <b>SM</b>
            </a>
            <span id="sidebar_left_toggle" class="ad ad-lines"></span>
        </div>
        
        <ul class="nav navbar-nav navbar-right">
           
           
           
            <li class="dropdown dropdown-fuse">
                <a href="#" class="dropdown-toggle fw600" data-toggle="dropdown">
                    <span class="hidden-xs"><name>Hello, <?php print_r($this->session->userdata['username']); ?></name> </span>
                    <span class="fa fa-caret-down hidden-xs mr15"></span>
                    <!-- <img src="assets/img/avatars/profile_avatar.jpg" alt="avatar" class="mw55"> -->
                </a>
                <ul class="dropdown-menu list-group keep-dropdown w200" role="menu">
                    <!-- <li class="list-group-item">
                        <a href="<?php echo base_url();?>admin/Home/changeadminpassword" class="animated animated-short fadeInUp" style="padding: 12px 30px;">
                            <span class="fa fa-user"></span> Change Password </a>
                    </li> -->
                    <li class="dropdown-footer text-center">
                        <a href="<?php echo base_url();?>admin/Home/logout" class="btn btn-primary btn-sm btn-bordered">
                            <span class="fa fa-power-off pr5"></span> Logout </a>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- -------------- /Header  -------------- -->

    <!-- -------------- Sidebar  -------------- -->
    <aside id="sidebar_left" class="nano nano-light affix">

        <!-- -------------- Sidebar Left Wrapper  -------------- -->
        <div class="sidebar-left-content nano-content">

            <!-- -------------- Sidebar Header -------------- -->
            <header class="sidebar-header">

                <!-- -------------- Sidebar - Author -------------- -->
                <div class="sidebar-widget author-widget">
                    <div class="media">
                        <a class="media-left" href="#">
                            <img src="<?php echo base_url()?>assets/img/avatars/male-avatar1.png" class="img-responsive">
                        </a>

                        <div class="media-body">
                            <div class="media-author"><?php print_r($this->session->userdata['username']); ?></div>
                            <div class="media-links">
                                <a href="<?php echo base_url();?>admin/Home/logout">Logout</a>
                            </div>
                           
                        </div>
                    </div>
                </div>

            </header>
            <!-- -------------- /Sidebar Header -------------- -->
            <style type="text/css">
                .sidebar-menu > li > ul > li > a > span:nth-child(1) {
                    display: inline-block;
                }
                li.active{
                    background-color: #67d3e0 !important;
                }
                .sidebar-menu > li > ul > li:first-child > a {
                    padding-top: 0px;
                }
                body.sb-l-m .sidebar-menu > li.active > a > span:nth-child(1) {
                    color: #fafafa;
                }
            </style>

            <!-- -------------- Sidebar Menu  -------------- -->
            <ul class="nav sidebar-menu">
                <li class="sidebar-label pt30">Menu</li>


                
                <?php if(current_url() == site_url('admin/Home')) { $class = 'active';} else { $class =''; }  ?>
                <li class="<?php print $class; ?>">
                    <a class="" href="<?php echo site_url('admin/Home'); ?>">
                        <span class="fa fa-dashboard"></span>
                        <span class="sidebar-title">Dashboard</span>
                    </a>
                   
                </li>
                
                <?php if($_SESSION['username']=='superadmin') {  ?>
                    <li class="sidebar-label pt25">Modules</li>
                <?php } ?>

                <?php if($_SESSION['username']!='superadmin') {  ?>
                    <li class="sidebar-label pt25">Product Stock</li>
                <?php } ?>

                <?php if($_SESSION['username']=='superadmin') {  ?>
                <?php if(current_url() == site_url('admin/User/user_list')) { $class = 'active';} else { $class =''; }  ?>
                <li class="<?php print $class; ?>">
                   <a href="<?php echo site_url('admin/User/user_list');?>">
                        <span class="fa fa-desktop"></span>
                        <span class="sidebar-title">User</span>
                    </a>
                </li>
                <?php } ?>

                <?php if($_SESSION['username']=='superadmin') {  ?>

                <?php if(current_url() == site_url('admin/Store/store_list')) { $class = 'active';} else { $class =''; }  ?>
                <li class="<?php print $class; ?>">
                   <a href="<?php echo site_url('admin/Store/store_list');?>">
                        <span class="fa fa-desktop"></span>
                        <span class="sidebar-title">Store</span>
                    </a>
                </li>

                <?php if(current_url() == site_url('admin/Department/department_list')) { $class = 'active';} else { $class =''; }  ?>
                <li class="<?php print $class; ?>">
                   <a href="<?php echo site_url('admin/Department/department_list');?>">
                        <span class="fa fa-desktop"></span>
                        <span class="sidebar-title">Department</span>
                    </a>
                </li>
                <?php } ?>
                


                <?php if($_SESSION['username']=='superadmin') {  ?>
                <?php if(current_url() == site_url('admin/Product/product_list')) { $class = 'active';} else { $class =''; }  ?>
                <li class="<?php print $class; ?>">
                   <a href="<?php echo site_url('admin/Product/product_list');?>">
                        <span class="fa fa-desktop"></span>
                        <span class="sidebar-title">Product</span>
                    </a>
                </li>
                <?php } ?>

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
                    <li class="<?php //print $class; ?>">
                       <a href="<?php echo base_url()?>admin/Productstock/departmentproduct/<?php echo $val->dept_id; ?>">
                            <span class="fa fa-desktop"></span>
                            <span class="sidebar-title"><?php echo $val->department_name;?></span>
                        </a>
                    </li>
                    <?php  } ?>

                <?php } ?>


               
            </ul> 

            <!-- -------------- /Sidebar Menu  -------------- -->

            

        </div>
        <!-- -------------- /Sidebar Left Wrapper  -------------- -->

    </aside>
    <!-- -------------- /Sidebar -------------- -->
    <style type="text/css">
        ul.pagination.hide-if-no-paging a ,ul.pagination.hide-if-no-paging strong{
            padding: 3px 7px;
            font-size: 20px;
        }
        .pagination > li > a, .pagination > li > span, .pagination > li > strong {
            position: relative;
            float: left;
            padding: 2px 15px;
            line-height: 1.49;
            text-decoration: none;
            color: #67d3e0;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            margin-left: -1px;
        }
    </style>