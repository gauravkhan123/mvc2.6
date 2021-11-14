<script type="text/javascript" src="http://journalmanuscript.com/assets/themes/frontend/js/jquery-latest.js"></script>

        <?php $this->load->view('frontend/includes/slider');?>
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	
                       	<ul class="nav tab nav-tabs mytabs">
							<h2 class="mainh2">New Submission<span></span></h2>
  <li><a href="<?php echo site_url('user/myaccount');?>">My Profile</a></li>
  <li class="active"><a href="javasccript:void();">New Submission</a></li>
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
                                	<form name="manuscript" id="manuscript" method="post" action="<?php echo site_url('user/submitmanuscript');?>" enctype="multipart/form-data">
                                    <fieldset>
                                      
                                     
                                        <div class="col-lg-6">
                                            <label class="logintext">Select Subject <span>*</span></label>
<select name="subject_id" id="subject_id" class="form-control">
                        <option value="">--Select--</option>
<?php
$subjects = get_few_record("select * from categories_spl WHERE 1 AND publish = 1 order by name");

if(!empty($subjects))
{
    foreach($subjects as $value)
    {
    ?>                                          
        <option value="<?php echo $value['Id']?>" <?php if($value['Id'] == set_value('subject_id')) { echo 'selected="selected"'; } ?>>
            <?php echo $value['name']?>
        </option>
    <?php
    }
}
    ?>                                            
                        </select>
                                        </div>
                                      
                                        <div class="col-lg-6">
                                            <label class="logintext">Select Journal <span>*</span></label>
                                        	<select name="journal_id" id="journal_id" class="form-control">
                        <option value="">--Select--</option>
<?php

$journals = get_few_record("select * from journals WHERE 1 AND publish = 1 AND main_cat = '".set_value('subject_id')."' order by name");

if(!empty($journals))
{
    foreach($journals as $value)
    {
    ?>                                             
                                                                 
                        <option value="<?php echo $value['Id']?>" <?php if($value['Id'] == set_value('journal_id')) { echo 'selected="selected"'; } ?>>
                            <?php echo $value['name']?>
                        </option>
    <?php
    }
}
    ?>                                            
                        </select>
                                        </div>
                                      
                                      
                                        <div class="col-lg-6">
                                            <label class="logintext" for="title">Title <span>*</span></label>
                                        	<input type="text" name="title" id="title" value="<?php echo set_value('title'); ?>" class="form-control" />
                                        </div>
                                      
                                      
                                        <div class="col-lg-6">
                                            <label class="logintext">Article Type <span>*</span></label>
                                        <select name="article_type" id="article_type" class="form-control">
                          <option value="">--Select Article Type--</option>

<?php
$article_types = get_few_record("select * from article_type WHERE 1 AND publish = 1 order by serial");

if(!empty($article_types))
{
    foreach($article_types as $value)
    {
    ?>  
        <option value="<?php echo $value['alias'];?>" <?php if($value['alias'] == set_value('article_type')) { echo 'selected="selected"'; } ?>>
            <?php echo $value['name'];?>
        </option>
    <?php
    }
}
    ?> 
                                                    
                          </select>
                                        </div>
                                     
                                      	<div class="col-lg-6">
                                            <label class="logintext">Abstract <span>*</span></label>
                                        <textarea rows="2" name="abstract" id="abstract" class="form-control"><?php echo set_value('abstract'); ?></textarea>
                      					<div class="comment">[Maximum 350 words]</div>
                                        </div>
                                        
                                        
                                        <div class="col-lg-6">
                                            <label class="logintext" for="title">Keywords <span>*</span></label>
                                        	<input type="text" name="keywords" id="keywords" value="<?php echo set_value('keywords'); ?>" class="form-control" />
                                        </div>

                                      	<div class="col-lg-12">
                                            <h2 class="mainh2">Crresponding author details <span></span> </h2>
                                        </div>
                                                                                
                                        <div class="col-lg-6">
                                            <label class="logintext" for="ca_name">Corresponding author details <span>*</span></label>
                                        	<input type="text" name="ca_name" id="ca_name" value="<?php echo set_value('ca_name'); ?>" class="form-control" />
                                        </div>                                           
                                        
                                        <div class="col-lg-6">
                                            <label class="logintext" for="ca_address">Address & Affiliation <span>*</span></label>
                                        	<input type="text" name="ca_address" id="ca_address" value="<?php echo set_value('ca_address'); ?>" class="form-control" />
                                        </div>    
                                        
                                        <div class="col-lg-6">
                                            <label class="logintext" for="ca_name">Email Id <span>*</span></label>
                                        	<input type="text" name="ca_email" id="ca_email" value="<?php echo set_value('ca_email'); ?>" class="form-control" />
                                        </div>                          
                                        <br />
                                      	<div class="col-lg-12">
										<h2 class="mainh2">Excluded Reviewers [if any]<span></span></h2>
                                            
                                        </div>  
                                        
                                        <div class="col-lg-6">
                                            <label class="logintext" >[Excluded Reviewer 1]</label>

                                        </div>                                           
                                        
                                        <div class="col-lg-6">
                                        <label class="logintext" >[Excluded Reviewer 2]</label>

                                        </div>                                                                                                                                            
                                      
                                      
                                      
                                        <div class="col-lg-6">
                                            <label class="logintext" for="rv_name_e">Name</label>
                                        	<input type="text" name="rv_name_e" id="rv_name_e" value="<?php echo set_value('rv_name_e'); ?>" class="form-control" />
                                        </div>                                           
                                        
                                        <div class="col-lg-6">
                                        <label class="logintext" for="rv_name_f">Name</label>
                                        	<input type="text" name="rv_name_f" id="rv_name_f" value="<?php echo set_value('rv_name_f'); ?>" class="form-control" />
                                        </div>    
                                        
                                        <div class="col-lg-6">
                                            <label class="logintext" for="rv_address_e">Address </label>
                                        	<input type="text" name="rv_address_e" id="rv_address_e" value="<?php echo set_value('rv_address_e'); ?>" class="form-control" />                                        </div>  
                                        
                                        
                                        <div class="col-lg-6">

                                        
                                            <label class="logintext" for="rv_address_f">Address </label>
                                        	<input type="text" name="rv_address_f" id="rv_address_f" value="<?php echo set_value('rv_address_f'); ?>" class="form-control" />
                                            
                                        </div>                                           
                                        
                                        <div class="col-lg-6">
                                        
                                            <label class="logintext" for="rv_email_e">Email Id</label>
                                        	<input type="text" name="rv_email_e" id="rv_email_e" value="<?php echo set_value('rv_email_e'); ?>" class="form-control" />
                                        </div>    
                                        
                                        <div class="col-lg-6">
                                            <label class="logintext" for="rv_email_f">Email Id</label>
                                        	<input type="text" name="rv_email_f" id="rv_email_f" value="<?php echo set_value('rv_email_f'); ?>" class="form-control" />
                                        </div>     
                                        
                                      	<div class="col-lg-12">
                                            <h3 class="divider">&nbsp;</h3>
                                        </div>
                                                
                                                                                        
                                        <div class="col-lg-6">
                                            <label class="logintext">Upload CV (Optional)</label>
                                        
                                        <div class="fileupload">
                                          <input type="file" name="ms_word_file" id="ms_word_file">
                                          </div>
                                        </div>     
                                        
                                        <div class="col-lg-12" >
                                           <label for="agreement">Agreement</label>
                                            <p><input type="checkbox" value="1" id="agree" name="agree"> I have read and accepted all General Terms & Conditions and Journal Specific Terms & Conditions.</p> 
                                            <p>
                                            <strong>For discount on publication charge (developing countries only) follow these steps:<br />
1. click on the "ON PROCESS" tab. <br />
2. click on the "SEND REQUEST" under "DISCOUNT" column.</strong>
                                            </p>
                                        </div>                                                                                                                      
                                        
                                        
                                              
                            			<div class="col-lg-4">
                  						<input class="btn btn-primary" type="submit" id="submit" name="submit" value="Submit" />
                        				</div>
                                      
                                    </fieldset>
              						</form>
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
ul.mytabs li, ul.mytabs li a
{
	border-top:none !important;
	background-color:#08B469;
	font-weight:bold;
}

ul.mytabs li.active a
{
background-color:#DEFBEE;
	border-left:#CCC 1px solid !important;
	border-top:#CCC 1px solid !important;
}
.comment
{
	font-size:12px; color:#666;
	text-align:right;
}

form#manuscript h3
{
	border-bottom:#006 2px solid;	
	line-height:50px;
}
form#manuscript h3.divider
{
	margin:10px 0;
	line-height:0;
}

</style>
<script>
///////////getting values on change

		$( "#subject_id" ).change(function() 		
		{
			$.post( "<?php echo site_url('user/getjournal');?>", { journal_id: this.value })
			.done(function( data ) 
			{
				$( "#journal_id" ).html(data);
			});	
		
		});	
		
			
</script>