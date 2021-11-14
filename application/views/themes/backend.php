<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Admin Home Page</title>

        <script src="<?php echo base_url(); ?>assets/themes/backend/vendors/jquery-1.9.1.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/backend/bootstrap/js/bootstrap.min.js"></script>
                
<?php /*?>        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/themes/backend/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>assets/themes/backend/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>assets/themes/backend/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>assets/themes/backend/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/themes/backend/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script><?php */?>
        
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/themes/backend/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>assets/themes/backend/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>assets/themes/backend/assets/styles.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url(); ?>assets/themes/backend/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/themes/backend/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>        
    </head>
    
    <body>
		<?php $this->load->view('backend/includes/header');?>
		<?php echo $output;?>
    </body>

</html>