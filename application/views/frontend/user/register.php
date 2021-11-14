        <?php $this->load->view('frontend/includes/slider');?>
 
        <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	<div class="about_left artical">
                        	<h2 class="mainh2">Register<span></span></h2>
                            <span class="subhead">If you haven't register with us yet :</span>
                        </div>
                     <div class="errors">
					  <?php echo validation_errors(); ?>
                      </div>                        
                        <div class="row">
                        	<div class="col-lg-12 row">
                            	<div class="loginform">
 <script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>                                       
 
 					<form name="register_form" id="register_form" method="post" action="" enctype="multipart/form-data" class="frm">
					
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
                            <input type="text" value="<?php echo set_value('name'); ?>" id="name" name="name" class="form-control">
                        </div>
						
						<div class="col-lg-6">
                            <label for="username">Email <span>*</span></label>
                            <input type="text" value="<?php echo set_value('username'); ?>" id="username" name="username" class="form-control">
                        </div>
						
						<div class="col-lg-6">
                            <label for="password">Password <span>*</span></label>
                            <input type="password" value="<?php echo set_value('password'); ?>" id="password" name="password" class="form-control">
                        </div>
						
						<div class="col-lg-6">
                            <label for="cpassword">Confirm Password <span>*</span></label>
                            <input type="password" value="<?php echo set_value('cpassword'); ?>" id="cpassword" name="cpassword" class="form-control">
                        </div>
						
						<div class="col-lg-6">
                            <label for="contact_no">Contact No. <span>*</span></label>
                            <input type="text" value="<?php echo set_value('contact_no'); ?>" id="contact_no" name="contact_no" class="form-control">
                        </div>
						
						<div class="col-lg-6">
                            <label for="country">Country <span>*</span></label>
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
                            <input type="text" value="<?php echo set_value('specilization_area1'); ?>" id="specilization_area1" name="specilization_area1" class="form-control">
                        </div>
						
						
						
						<div class="col-lg-6"><label>Upload CV <span>(Optional)</span></label> <input type="file" name="ms_word_file" id="ms_word_file"> </div>
						
<?php /*?>
                        <div class="col-lg-12">
				<?php
                    require_once(APPPATH.'libraries/recaptcha-php-1.11/recaptchalib.php');
                    $publickey = "6LcazAwTAAAAAFFhefMl7LrfmzChIi0O-D1w7igJ"; // you got this from the signup page
                    echo recaptcha_get_html($publickey);
                ?>
            </div>
<?php */?>
						
						<div class="col-lg-12">
                        <label for="agree">Agreement <span>*</span></label>
                            
                            <p><input type="checkbox" value="1" id="agree" name="agree" <?php if(set_value('agree')) { echo ' checked="checked"'; } ?>> I have read and agree to abide by the <strong>OA Academic Press</strong><br /> <span class="terms"><a href="<?php echo site_url('page/terms-conditions');?>">Terms & Conditions</a> and <a href="<?php echo site_url('page/privacy-policy');?>">Privacy Policy</a></span></p>
                            <br />
            </div>
						<div class="col-lg-6"><input class="btn btn-primary" type="submit" id="submit" name="submit" value="Register" /></div>
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
.errors p
{
	color:#F00;	
}
</style>