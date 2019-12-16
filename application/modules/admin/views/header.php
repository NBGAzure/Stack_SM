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

    <!-- -------------- Datatables CSS -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/datatables/media/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url();?>assets/js/plugins/datatables/extensions/Editor/css/dataTables.editor.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url();?>assets/js/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css">
    
    <!-- -------------- Popup CSS -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/plugins/magnific/magnific-popup.css">

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/skin/default_skin/css/theme.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/allcp/forms/css/forms.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/fav.png">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <!-- -------------- IE8 HTML5 support  -------------- -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
     <?php

    if(empty($_SESSION['username']))
    {
        redirect('admin/Login','refresh');
    }


    ?>
</head>
