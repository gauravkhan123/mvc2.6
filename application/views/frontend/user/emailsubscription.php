       
                <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	<div class="about_left artical">
                        	<h2 class="mainh2">Email Subscription<span></span></h2>
                           
                        </div>
                          <div class="errors">
					  <?php echo validation_errors(); ?>
                      </div> 
                        <div class="row">
                        	<div class="col-lg-8">

									<script type="text/javascript">
                                    var RecaptchaOptions = {
                                    theme : 'clean'
                                    };
                                    </script>
                                        <form name="main_login" action="<?php echo site_url('user/emailsubscription'); ?>" method="post" class="frm">
                <fieldset>
                  
                  <div class="form-group">
                    <div class="col-lg-6" for="inputEmail">
					<label for="name">Name</label>
                    	
                    </div>
                    <div class="col-lg-10">
                      <input type="text" value="<?php echo set_value('name'); ?>" id="name" name="name" class="form-control">
                      <?php echo form_error('username','<span class="error-advise">','</span>'); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-6" for="inputEmail">
					<label for="name">Email</label>
                    	
                    </div>
                    <div class="col-lg-10">
                      <input type="email" id="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control">
                      <?php echo form_error('password','<span class="error-advise">','</span>'); ?> 
                    </div>
                  </div>
                  
               	
                  
                  <div class="form-group">
                  	<div class="col-lg-12">
					<br />
                    	<input type="submit" name="submit" class="btn btn-primary"  value="Submit"/>
                    </div>
                  </div>
                  
                 
                  
                </fieldset>
				
              </form>
			  
                            </div>
                        </div>
                        
                    </div>
                    <?php $this->load->view('frontend/includes/right');?> 
                </div>
            </div>
        </div>