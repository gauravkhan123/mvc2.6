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

      <form class="form-signin" method="post" name="backend-login" id="backend-login" action="<?php echo site_url($this->config->item('backend').'/login');?>">
      <?php $this->load->view('backend/includes/message');?>
        <h3 class="form-signin-heading">Please sign in</h3>
        <input type="text" class="input-block-level" placeholder="Email address" name="username" id="username">
        <input type="password" class="input-block-level" placeholder="Password" name="password" id="password">
        <!--<label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>-->
        <button class="btn btn-large btn-primary" type="submit" name="submit" value="submit">Sign in</button>
        <p>&nbsp;</p>
        <p><a href="<?php echo site_url($this->config->item('backend').'/forgotpassword');?>">Forgot Passowrd?</a></p>
      </form>

    </div> <!-- /container -->
    <script src="<?php echo base_url(); ?>assets/themes/backend/vendors/jquery-1.9.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/themes/backend/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>