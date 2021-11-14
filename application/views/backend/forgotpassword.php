<!DOCTYPE html>
<html>
  <head>
    <title>Admin Login</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/themes/backend/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/themes/backend/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/themes/backend/assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/themes/backend/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">

      <form class="form-signin">
        <h3 class="form-signin-heading">Enter Your Email-id</h3>
        <input type="text" class="input-block-level" placeholder="Email address">
        <button class="btn btn-large btn-primary" type="submit">Get Password</button>
        <p>&nbsp;</p>
        <p><a href="<?php echo site_url($this->config->item('backend').'/login');?>">Login Now</a></p>
      </form>

    </div> <!-- /container -->
    <script src="<?php echo base_url(); ?>assets/themes/backend/vendors/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/backend/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>