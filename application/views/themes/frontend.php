
	<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
        <title></title>         
        <meta name="description" content="" />
        <meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="<?php echo base_url();?>assets/themes/frontend/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/themes/frontend/css/qa.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/themes/frontend/css/qa-responsive.css" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		 <!--animation-->
    <script src="<?php echo base_url();?>assets/themes/frontend/js/wow.min.js"></script>
    <script>
       new WOW().init();
     </script>
    <!--end animation-->

   <!--nav-->
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>assets/themes/frontend/js/script.js"></script>
   <!--end nav-->
   
   <!--slider-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/themes/frontend/slider2/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/themes/frontend/slider2/css/custom.css" />
		<script type="text/javascript" src="<?php echo base_url();?>assets/themes/frontend/slider2/js/modernizr.custom.79639.js"></script>

<!--end slider-->
   
    </head>
    <body>
        
        
	<div class="qmain">

	
	<?php echo $this->load->get_section('header'); ?>
	<?php echo $output;?>
	<?php echo $this->load->get_section('footer'); ?>
            </div> 
       <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/themes/frontend/js/bootstrap.min.js"></script>
    </body>
</html>