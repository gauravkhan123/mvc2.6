        <?php $this->load->view('frontend/includes/slider');?>
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	
                       	<ul class="nav tab nav-tabs mytabs">
						<h2 class="mainh2">My Profile<span></span></h2>
  <li class="active"><a href="javasccript:void();">My Profile</a></li>
  <li><a href="<?php echo site_url('user/submitmanuscript');?>">New Submission</a></li>
  <li><a href="<?php echo site_url('user/inprocessmanuscript');?>">In Process</a></li>
  <li><a href="<?php echo site_url('user/othersmanuscript');?>">Reviewer Center</a></li>
  <li><a href="<?php echo site_url('user/publishedmanuscript');?>">Published</a></li>
  
</ul>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active in" id="profile">
    				
                        <div style="height:30px;"></div>
                        <div class="row">
                        	<div class="col-lg-12">
                            	<div class="loginform">
                                     
                                        <div class="col-lg-6">
                                          <label>Role</label>
                                          <div class="value"><?php echo str_replace("_"," ",$userdata['role']);?></div>
                                        </div>
                                      
                                        <div class="col-lg-6">
                                          <label>Name</label>
                                          <div class="value"><?php echo $userdata['name'];?></div>
                                        </div>
                                      
                                        <div class="col-lg-6">
                                          <label>Email</label>
                                          <div class="value"><?php echo $userdata['username'];?></div>
                                        </div>
                                     
                                         <div class="col-lg-6">
                                          <label>Contact No.</label>
                                          <div class="value"><?php echo $userdata['contact_no'];?></div>
                                        </div>
                                      
                                        <div class="col-lg-6">
                                          <label>Specialization Area</label>
                                          <div class="value"><?php echo $userdata['specilization_area1'];?></div>
                                        </div>  

                                        <div class="col-lg-6">
                                          <label>Country</label>
                                          <div class="value"><?php echo get_corresponing_value('countries','name',$userdata['country'],'Id');?></div>
                                        </div>  

                                        <div class="col-lg-6">
                                          <label>Newsletter</label>
                                          <div class="value"><?php echo (($userdata['newsletter'] == 1) ? 'Yes' : 'No');?></div>
                                        </div>                                                                                  
                                        
                            			<div class="col-lg-12">
                  							<a href="<?php echo site_url('user/editprofile');?>" class="btn btn-primary">UPDATE PROFILE</a>
                        				</div>
                                                                                                    

                   				</div>
                                
                			 </div>
                            
                        </div>
  </div>
  
</div>
                        
                        
                    </div>
                    <?php $this->load->view('frontend/includes/user-right');?> 
                </div>
            </div>
        </div>
        
<style>
div.value
{
	font-size:22px;
	margin-bottom:15px;	
	color:#08B469;
}
ul.mytabs li, ul.mytabs li a
{
	border-top:none !important;
	background-color:#08B469;
	font-weight:bold;
}

ul.mytabs li.active a
{background-color:#DEFBEE;
	border-left:#CCC 1px solid !important;
	border-top:#CCC 1px solid !important;
}
</style>