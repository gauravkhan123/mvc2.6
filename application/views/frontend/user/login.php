       
                <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	<div class="about_left artical">
                        	<h2 class="mainh2">Login<span></span></h2>
                            <span class="subhead">If you are already a Registered Member, Please login :</span>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-8">

									<script type="text/javascript">
                                    var RecaptchaOptions = {
                                    theme : 'clean'
                                    };
                                    </script>
                                        <form name="main_login" action="<?php echo site_url('user/login'); ?>" method="post" class="frm">
                <fieldset>
                  
                  <div class="form-group">
                    <div class="col-lg-6" for="inputEmail">
					<label for="name">Username</label>
                    	
                    </div>
                    <div class="col-lg-10">
                      <input type="text" value="<?php echo set_value('username'); ?>" id="username" name="username" class="form-control">
                      <?php echo form_error('username','<span class="error-advise">','</span>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-6" for="inputEmail">
					<label for="name">Password</label>
                    	
                    </div>
                    <div class="col-lg-10">
                      <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control">
                      <?php echo form_error('password','<span class="error-advise">','</span>'); ?> 
                    </div>
                  </div>
                  
                  <div class="form-group">
                  	<div class="col-lg-12">
					<br />
						<?php
                            require_once(APPPATH.'libraries/recaptcha-php-1.11/recaptchalib.php');
                            $publickey = "6LegEAYTAAAAAD6MeDa6YU2ZuyyOy1d5kxqn2fd_"; // you got this from the signup page
                            echo recaptcha_get_html($publickey);
                        ?>
                  </div></div>
                  
                  <div class="form-group">
                  	<div class="col-lg-12">
					<br />
                    	<input type="submit" name="submit" class="btn btn-primary"  value="Login"/>
                    </div>
                  </div>
                  
                 
                  
                </fieldset>
				
              </form>
			  <br />
 				<p><a href="<?php echo site_url('user/forgotpassword')?>">Forgot Password ?</a></p>
                  <p><a href="<?php echo site_url('user/register')?>">Register ?</a></p>
                            </div>
                        </div>
                        
                    </div>
                    <?php $this->load->view('frontend/includes/right');?> 
                </div>
            </div>
        </div>