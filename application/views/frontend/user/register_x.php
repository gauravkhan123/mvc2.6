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
                        	<h2>Register</h2>
                            <span class="subhead">If you haven't register with us yet :</span>
                        </div>
                     <div class="errors">
					  <?php echo validation_errors(); ?>
                      </div>                        
                        <div class="row">
                        	<div class="col-lg-12 row">
                            	<div class="loginform">
                                	<form name="register_form" id="register_form" method="post" action="" enctype="multipart/form-data">
                                    <fieldset>

                                        <div class="col-lg-6">
                                            <label for="name">Role <span>*</span></label>                                        
							<select name="role" id="role" class="form-control">
                  <option value="" >Select</option>                                        
<option value="Author" <?php if("Author" === set_value('role',isset($data['role'])?$data['role']:'')) { echo 'selected="selected"'; } ?>>Author</option>
                  <option value="Author_Reviewer_Editor" <?php if("Author_Reviewer_Editor" === set_value('role',isset($data['role'])?$data['role']:'')) { echo 'selected="selected"'; } ?>>Author/Reviewer/Editor</option>  
                                  </select>
                                        </div>

                                        <div class="col-lg-6">
                                            <label for="name">Name <span>*</span></label>
                                            <input type="text" id="name" name="name" value="<?php echo set_value('name'); ?>" class="form-control">
                                        </div>
                                        <div class="col-lg-6">
                                           <label for="username">Email ID <span>*</span></label>
                                       		<input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" class="form-control">
                                        </div>  
                                        
                                         

                                        <div class="col-lg-6">
                                            <label for="contact_no">Contact No <span>*</span></label>
                                          <input type="text" name="contact_no" id="contact_no" value="<?php echo set_value('contact_no'); ?>" class="form-control">
                                        </div>
                                                                                
                                        <div class="col-lg-6">
                                            <label for="password">Password <span>*</span></label>
                                            <input type="password" id="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control">
                                
                                        </div>
                                                                          
                                        
                                        <div class="col-lg-6">
                                            <label for="cpassword">Confirm Password <span>*</span></label>
                                            <input type="password" id="cpassword" name="cpassword" value="<?php echo set_value('cpassword'); ?>" class="form-control">
                                        </div>                                       
                                                                        
                                        
                                        <div class="col-lg-6" for="inputEmail">
                                            <label class="logintext">Country <span>*</span></label>
                                        
                                           <select id="country" name="country" class="form-control">
                                                          <option value="" >Select</option>
 <?php if(!empty($countries))
            {
                foreach($countries as $value)
                {
            ?>                                              
                                                          <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == set_value('country',isset($data['country'])?$data['country']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
            <?php
                }
            }
            ?>                                               
                                                        </select>
                                        </div>   
                                        
                                        <div class="col-lg-6">
                                            <label for="specilization_area1">Specialization Area <span>*</span></label>
                                          <input type="text" name="specilization_area1" id="specilization_area1" value="<?php echo set_value('specilization_area1'); ?>" class="form-control">
                                        </div>                                                                             
                                        
                                      
                                        <div class="col-lg-6" for="inputEmail">
                                            <label class="logintext">Upload CV (Optional)</label>
                                        
                                        <div class="fileupload">
                                          <input type="file" name="ms_word_file" id="ms_word_file">
                                          </div>
                                        </div>                                      

                                        <div class="cl"></div>
                                        <div class="col-lg-9">
                                        	<label>Security Code</label>
											<?php
                                                require_once(APPPATH.'libraries/recaptcha-php-1.11/recaptchalib.php');
                                                $publickey = "6LegEAYTAAAAAD6MeDa6YU2ZuyyOy1d5kxqn2fd_"; // you got this from the signup page
                                                echo recaptcha_get_html($publickey);
                                            ?> 
                                        </div>        
                                                                                <div class="cl"></div>                                        
						
                                        <div class="col-lg-9" >
                                           <label for="agreement">Agreement</label>
                                            <p><input type="checkbox" value="1" id="agree" name="agree"> I have read and agree to abide by the <strong>Global Publication Hub</strong><br /> <span class="terms"><a href="<?php echo site_url('page/terms-conditions');?>" target="_blank">Terms & Conditions</a> and <a href="<?php echo site_url('page/privacy-policy');?>" target="_blank">Privacy Policy</a></span></p> 
                                        </div>                           
                                                                        
                                        <div class="cl"></div>
                            			<div class="col-lg-4">
                  						<input class="btn btn-primary" type="submit" id="submit" name="submit" value="Submit" />
                        				</div>
                  <div class="col-lg-9">                      
                  <p><a href="<?php echo site_url('user/login')?>">Login ?</a></p>
                  <p><a href="<?php echo site_url('user/forgotpassword')?>">Forgot Password ?</a></p>
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