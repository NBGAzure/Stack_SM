<!DOCTYPE html>
<html>

<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>Stack Management</title>
    <meta name="keywords" content="HTML5, Bootstrap 3, Admin Template, UI Theme"/>
    <meta name="description" content="Alliance - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="ThemeREX">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- -------------- Fonts -------------- -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
          type='text/css'>

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/skin/default_skin/css/theme.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/fav.png">

    <!-- -------------- IE8 HTML5 support  -------------- -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="utility-page sb-l-c sb-r-c">

<!-- -------------- Body Wrap  -------------- -->
<div id="main" class="animated fadeIn">

    <!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper">

        <div id="canvas-wrapper">
            <canvas id="demo-canvas"></canvas>
        </div>
        <style type="text/css">
            .radio-custom input, .checkbox-custom input {
                opacity: 0;
                display: initial; 
                left: 1px;
                position: relative;
                z-index: 999;
            }
            .radio-custom label:before {
               left: -15px;
            }
            .radio-custom input[type=radio]:checked + label:after, .radio-custom input[type=checkbox]:checked + label:after {
                left: -10px !important;
            }
        </style>
        <!-- -------------- Content -------------- -->
        <section id="content">

            <!-- -------------- Login Form -------------- -->
            <div class="allcp-form theme-primary mw320" id="login">
                
                <div class="panel mw320">

                <?php echo validation_errors(); ?>
                <?php if($this->session->flashdata('flash_data')): ?>
                     <p style="color:#b93128"><?php echo $this->session->flashdata('flash_data'); ?></p>
                <?php endif; ?>
                     <form method="post" action="<?php echo base_url();?>admin/login" id="form-login">
                        <div class="panel-body pn mv10">

                            <div class="section">
                                <label for="username" class="field prepend-icon">
                                    <input type="text" name="username" id="username" class="gui-input"
                                           placeholder="Username" value="<?php echo isset($remember_user[0])?$remember_user[0]:'' ?>">
                                    <label for="username" class="field-icon">
                                        <i class="fa fa-user"></i>
                                    </label>
                                </label>
                            </div>
                            <!-- -------------- /section -------------- -->

                            <div class="section">
                                <label for="password" class="field prepend-icon">
                                    <input type="password" name="password" id="password" class="gui-input"
                                           placeholder="Password" value="<?php echo isset($remember_user[1])?$remember_user[1]:'' ?>">
                                    <label for="password" class="field-icon">
                                        <i class="fa fa-lock"></i>
                                    </label>
                                </label>
                            </div>
                            <!-- -------------- /section -------------- -->
                            <?php 
                                    if(isset($remember_user[0]) && !empty($remember_user[0])){
                                        $checked = "checked";
                                    }else{
                                        $checked = "";
                                    }
                                    ?>
                            <div class="section">
                                <div class="bs-component pull-left pt5">
                                    <div class="radio-custom radio-primary mb5 lh25">
                                         <input type="checkbox" name="remember_me" id="remember_me" value="1" class="flat" <?php echo $checked; ?> /> <label for="remember">Remember me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-bordered btn-primary pull-right">Log in</button>
                            </div>
                            <!-- -------------- /section -------------- -->

                        </div>
                        <!-- -------------- /Form -------------- -->
                    </form>
                   
                    
                </div>
                <!-- -------------- /Panel -------------- -->
            </div>
            <!-- -------------- /Spec Form -------------- -->

        </section>
        <!-- -------------- /Content -------------- -->

    </section>
    <!-- -------------- /Main Wrapper -------------- -->

</div>
<!-- -------------- /Body Wrap  -------------- -->

<!-- -------------- Scripts -------------- -->

<!-- -------------- jQuery -------------- -->
<script src="<?php echo base_url();?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- CanvasBG JS -------------- -->
<script src="<?php echo base_url();?>assets/js/plugins/canvasbg/canvasbg.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url();?>assets/js/utility/utility.js"></script>
<script src="<?php echo base_url();?>assets/js/main.js"></script>

<!-- -------------- Page JS -------------- -->
<script type="text/javascript">
    jQuery(document).ready(function () {

        "use strict";

        // Init Theme Core
        Core.init();

        // Init Demo JS
        Demo.init();

        // Init CanvasBG
        CanvasBG.init({
            Loc: {
                x: window.innerWidth / 5,
                y: window.innerHeight / 10
            }
        });

    });
</script>

<!-- -------------- /Scripts -------------- -->

</body>

</html>
