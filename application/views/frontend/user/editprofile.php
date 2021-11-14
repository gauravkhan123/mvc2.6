        <?php $this->load->view('frontend/includes/slider');?>
        <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	<div class="about_left artical">
						
                        	<h2 class="mainh2">Update Profile<span></span></h2>
                            <span class="subhead">Note: "Email Id" field is disabled and cannot be updated, <a href="<?php echo site_url('user/contact-us');?>">Contact Us</a> for the same:</span>
                        </div>
                     <div class="errors">
					  <?php echo validation_errors(); ?>
                      </div>                        
                        <div class="row">
                        	<div class="col-lg-12 row">
                            	<div class="loginform">
                                	<form name="register_form" id="register_form" method="post" action="" enctype="multipart/form-data">
                                    <fieldset>
                                    
                                        <div class="col-lg-6" for="inputEmail">
                                            <label >Role <span>*</span></label>
                                           <select id="role" name="role" class="form-control">
                  <option value="" >Select</option>
                  <option value="Author" <?php if("Author" === set_value('role',isset($userdata['role'])?$userdata['role']:'')) { echo 'selected="selected"'; } ?>>Author</option>
                  <option value="Author_Reviewer_Editor" <?php if("Author_Reviewer_Editor" === set_value('role',isset($userdata['role'])?$userdata['role']:'')) { echo 'selected="selected"'; } ?>>Author/Reviewer/Editor</option>
                                                        </select>
                                        </div>                                      
                                    
                                        <div class="col-lg-6">
                                            <label for="name">Name <span>*</span></label>
                                            <input type="text" id="name" name="name" value="<?php echo set_value('name',isset($userdata['name'])?$userdata['name']:''); ?>" class="form-control">
                                        </div>
                                        <div class="col-lg-6">
                                           <label for="username">Email ID <span>*</span></label>
                                       		<input type="text" disabled="disabled" name="username" id="username" value="<?php echo set_value('username',isset($userdata['username'])?$userdata['username']:''); ?>" class="form-control">
                                        </div>   
                                        
                                        <div class="col-lg-6">
                                            <label>Contact No. <span>*</span></label>
                                          <input type="text" name="contact_no" id="contact_no" value="<?php echo set_value('contact_no',isset($userdata['contact_no'])?$userdata['contact_no']:''); ?>" class="form-control">
                                        </div>                                        
                                        
                                        <div class="col-lg-6">
                                            <label for="password">Password</label>
                                          <input type="text" name="password" id="password" value="<?php echo set_value('password'); ?>" class="form-control">
                                        </div>          
                                        
                                        <div class="col-lg-6">
                                            <label for="cpassword">Confirm Password</label>
                                          <input type="text" name="cpassword" id="cpassword" value="<?php echo set_value('cpassword'); ?>" class="form-control">
                                        </div>                                                                                                                     

                                        
                                        <div class="col-lg-6">
                                            <label for="specilization_area1">Specialization Area <span>*</span></label>
                                          <input type="text" name="specilization_area1" id="specilization_area1" value="<?php echo set_value('specilization_area1',isset($userdata['specilization_area1'])?$userdata['specilization_area1']:''); ?>" class="form-control">
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
                                                          <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == set_value('country',isset($userdata['country'])?$userdata['country']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
            <?php
                }
            }
            ?>                                               
                                                        </select>
                                        </div>                                        

                                        <div class="cl"></div>                                        
						
                                        <div class="col-lg-12" >
                                           <label for="newsletter">Newsletter</label>
                                            <p><input type="checkbox" value="1" id="newsletter" name="newsletter" <?php if("1" === set_value('role',isset($userdata['newsletter'])?$userdata['newsletter']:'')) { echo ' checked="checked"'; } ?>> Get free offers, coupons, and special updates time to time.</p>
                                        </div>                           
                                                                        
                                        <div class="cl"></div>
                            			<div class="col-lg-1">
                  						<input class="btn btn-primary" type="submit" id="submit" name="submit" value="Update" />
                        				</div>
                            			<div class="col-lg-1">
                                        <a href="<?php echo site_url('user/myaccount')?>" class="btn btn-primary">Cancel</a>
                        				</div>                                        
                                      </fieldset>
              						</form>
                   				</div>
                			 </div>

                        </div>
                        
                    </div>
                    <?php $this->load->view('frontend/includes/user-right');?> 
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