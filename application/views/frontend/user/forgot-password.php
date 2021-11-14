 <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	
                    <div class="col-lg-9 border-right col-sm-6">
                    	<div class="about_left artical">
                        	<h2 class="mainh2">Forgot Password<span></span></h2>
							<span class="subhead">Please enter your reigistered Email Id to retreive password :</span>
						</div>
						 <div class="row">
                        	<div class="col-lg-8">

									<script type="text/javascript">
                                    var RecaptchaOptions = {
                                    theme : 'clean'
                                    };
                                    </script>
                                        <form name="forgot_pass" id="forgot_pass" method="post" action="<?php echo site_url('user/forgotpassword');?>">
                <fieldset>
                  
                  <div class="form-group">
                    <div class="col-lg-6" for="inputEmail">
					<label for="name">Username</label>
                    	
                    </div>
                    <div class="col-lg-10">
                      <input type="text" value="<?php echo set_value('username'); ?>" id="username" name="username"class="form-control">
                            				<?php echo form_error('username','<span class="error-advise">','</span>'); ?>
										 
                    </div>
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
                    	<input type="submit" name="submit" id="submit" value="Get Password" class="btn btn-primary"/>
                 
                    </div>
                  </div>
                  
                
                </fieldset>
				
              </form>
			   <p><a href="<?php echo site_url('user/login')?>">Login ?</a></p>
                 <p><a href="<?php echo site_url('user/register')?>">Register ?</a></p>
                                    
                  
			  <br />
      
                            </div>
                        </div>
                        
                    
                    <?php $this->load->view('frontend/includes/right');?> 
                </div>
            </div>
        </div>