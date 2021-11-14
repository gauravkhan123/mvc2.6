        <?php $this->load->view('frontend/includes/slider');?>
 <script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>    
        <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	<div class="about_left artical">
                        	<h2 class="mainh2">Contact Us<span></span></h2>
                            <span class="subhead">Please fill the following form to contact us:</span>
                        </div>
                     <div class="errors">
					  <?php echo validation_errors(); ?>
                      </div>                        
                        <div class="row">
                        	<div class="col-lg-12 row">
                            	<div class="loginform">
                                	<form name="contact" id="contact" method="post" action="" class="frm">
                                    <fieldset>
                                        <div class="col-lg-6">
                                            <label>Name</label>
                                            <input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>" class="form-control">
                                        </div>
                                     	<div class="col-lg-6">
                                            <label>Company / Affiliation</label>
                                          <input type="text" name="affiliation" id="affiliation" value="<?php echo set_value('affiliation'); ?>" class="form-control">
                                        </div>
                                        <div class="col-lg-6">
                                           <label>Email ID</label>
                                       		<input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control">
                                        </div>                                        
                                        <div class="col-lg-6">
                                            <label>Contact No.</label>
                                          <input type="text" name="contact_no" id="contact_no" value="<?php echo set_value('contact_no'); ?>" class="form-control">
                                        </div>
                                        <div class="col-lg-6 " for="inputEmail">
                                            <label>Comments</label>
                                          <textarea type="text" id="comments" name="comments" class="form-control"><?php echo set_value('comments'); ?></textarea>
                                        </div>
                                        <div class="cl"></div>                                        
                                        <div class="col-lg-12">
                                        	<label>Security Code</label>
											<?php
                                                require_once(APPPATH.'libraries/recaptcha-php-1.11/recaptchalib.php');
                                                $publickey = "6LegEAYTAAAAAD6MeDa6YU2ZuyyOy1d5kxqn2fd_"; // you got this from the signup page
                                                echo recaptcha_get_html($publickey);
                                            ?> 
                                        </div>                                        
                                        <div class="cl"></div>
                            			<div class="col-lg-4">
										<br />
                  						<input class="btn btn-primary" type="submit" id="submit" name="submit" value="Submit" />
                        				</div>
                                      </fieldset>
              						</form>
                   				</div>
                			 </div>

                        </div>
                        
                    </div>
                    <?php 
					if(get_settings('10')) 
					{
						?>
                    <div class="col-lg-3 col-sm-6">
						<?php echo get_settings('9');?>
                    </div>
                    <?php
					}
					?>
                </div>
            </div>
        </div>
<style>
#recaptcha_area
{
	clear:both;
}
.errors p
{
	color:#F00;	
}
</style>