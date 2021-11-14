<div class="container-fluid">
            <div class="row-fluid">
            <?php $this->load->view('backend/includes/leftnav');?>
                
                <!--/span-->
                <div class="span9" id="content">
                <div class="row-fluid">
                         <?php $this->load->view('backend/includes/message');?>
                         
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="<?php echo site_url($this->config->item('backend').'/home')?>">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>
	                                        <a href="<?php echo site_url($this->controller)?>"><?php echo $this->title_plural?></a> <span class="divider">/</span>	
	                                    </li>                                                                                
	                                    <li class="active"><?php echo $title; ?></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $title;?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
<?php
if($id)
{
?>                                
                                     <form class="form-horizontal" name="" method="post" action="<?php echo site_url($this->controller.'/edit/'.$id);?>" enctype="multipart/form-data">
<?php
}
else
{
?>
                                    <form class="form-horizontal" name="" method="post" action="<?php echo site_url($this->controller.'/add');?>" enctype="multipart/form-data">
<?php
}
?>
                                      <fieldset>
                                        <!--<legend>Edit</legend>-->
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="special_editor_id"> Special Editor</label>
                                          <div class="controls">
                                          <input class="input-xlarge span6" id="special_editor_id" name="special_editor_id" type="text" placeholder="Special Editor" value="<?php echo set_value('special_editor_id',isset($data['special_editor_id'])?$data['special_editor_id']:''); ?>">
                                          <span>Autosuggest Field, start with name initial.</span>
                                          <?php echo form_error('special_editor_id','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                          </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="special_editor_id"> Author</label>
                                          <div class="controls">
                                          <input class="input-xlarge span6" id="author_id" name="author_id" type="text" placeholder="Author" value="<?php echo set_value('author_id',isset($data['author_id'])?$data['author_id']:''); ?>">
                                          <span>Autosuggest Field, start with name initial.</span>
                                          <?php echo form_error('author_id','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                          </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="category"> <span class="error">*</span> Subject</label>
                                          <div class="controls">
											<select id="subject_id" name="subject_id" class="span6">
                                              <option value="" >Select</option>
<?php if(!empty($subjects))
{
	foreach($subjects as $value)
	{
?>                                              
                                              <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == set_value('subject_id',isset($data['subject_id'])?$data['subject_id']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
	}
}
?>                                               
                                            </select>
                                          <?php echo form_error('subject_id','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"> <span class="error">*</span> Journals</label>
                                          <div class="controls">
											<select id="journal_id" name="journal_id" class="span6">
                                              <option value="" >Select</option>
<?php if(!empty($journals))
{
	foreach($journals as $value)
	{
?>                                              
                                              <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == set_value('journal_id',isset($data['journal_id'])?$data['journal_id']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
	}
}
?>                                               
                                            </select>
                                          <?php echo form_error('journal_id','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="title"><span class="error">*</span> Title </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="title" name="title" type="text" placeholder="Title" value="<?php echo set_value('title',isset($data['title'])?$data['title']:''); ?>">
                                            <?php echo form_error('title','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
<div class="control-group">
                                          <label class="control-label" for="category"> <span class="error">*</span> Aricle Type</label>
                                          <div class="controls">
											<select id="article_type" name="article_type" class="span6">
                                              <option value="" >Select</option>
<?php

$article_types = get_few_record("select alias,name from article_type where 1 and publish = 1 order by serial asc");

 if(!empty($article_types))
{
	foreach($article_types as $value)
	{
?>                                              
                                              <option value="<?php echo $value['alias'];?>" <?php if($value['alias'] == set_value('article_type',isset($data['article_type'])?$data['article_type']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
	}
}
?>                                               
                                            </select>
                                          <?php echo form_error('article_type','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>              
                                        
                                        
<div class="control-group">
                                          <label class="control-label" for="abstract"><span class="error">*</span> Abstract</label>
                                          <div class="controls">
                                            <textarea class="span6" id="abstract" name="abstract"><?php echo set_value('abstract',isset($data['abstract'])?specialchars($data['abstract']):''); ?></textarea>
                                            <?php echo form_error('abstract','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                          
                                        
									<div class="control-group">
                                          <label class="control-label" for="keywords"><span class="error">*</span> Enter Keywords </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="keywords" name="keywords" type="text" placeholder="Enter Keywords" value="<?php echo set_value('keywords',isset($data['keywords'])?$data['keywords']:''); ?>">
                                            <?php echo form_error('keywords','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>       
                                        
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="keywords"> </label>
                                          <div class="controls">
                                          <strong>Enter Corresponding Author</strong>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="ca_name"><span class="error">*</span> Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="ca_name" name="ca_name" type="text" placeholder="Name" value="<?php echo set_value('ca_name',isset($data['ca_name'])?$data['ca_name']:''); ?>">
                                            <?php echo form_error('ca_name','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="ca_address"><span class="error">*</span> Address </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="ca_address" name="ca_address" type="text" placeholder="Address" value="<?php echo set_value('ca_address',isset($data['ca_address'])?$data['ca_address']:''); ?>">
                                            <?php echo form_error('ca_address','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="ca_email"><span class="error">*</span> Email </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="ca_email" name="ca_email" type="text" placeholder="Email" value="<?php echo set_value('ca_email',isset($data['ca_email'])?$data['ca_email']:''); ?>">
                                            <?php echo form_error('ca_email','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <?php /*?><div class="control-group">
                                          <label class="control-label" for="keywords"> </label>
                                          <div class="controls">
                                          <strong>Suggest Four Reviewer Details</strong>
                                          </div>
                                        </div>

										<div class="control-group">
                                          <label class="control-label" for="rv_name_a"><span class="error">*</span> Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_name_a" name="rv_name_a" type="text" placeholder="Name" value="<?php echo set_value('rv_name_a',isset($data['rv_name_a'])?$data['rv_name_a']:''); ?>">
                                            <?php echo form_error('rv_name_a','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="rv_address_a"><span class="error">*</span> Address </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_address_a" name="rv_address_a" type="text" placeholder="Address" value="<?php echo set_value('rv_address_a',isset($data['rv_address_a'])?$data['rv_address_a']:''); ?>">
                                            <?php echo form_error('rv_address_a','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="rv_email_a"><span class="error">*</span> Email </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_email_a" name="rv_email_a" type="text" placeholder="Email" value="<?php echo set_value('rv_email_a',isset($data['rv_email_a'])?$data['rv_email_a']:''); ?>">
                                            <?php echo form_error('rv_email_a','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                                                                                                                                       
										<div class="control-group">
                                          <label class="control-label" for="rv_name_b"><span class="error">*</span> Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_name_b" name="rv_name_b" type="text" placeholder="Name" value="<?php echo set_value('rv_name_b',isset($data['rv_name_b'])?$data['rv_name_b']:''); ?>">
                                            <?php echo form_error('rv_name_b','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="rv_address_b"><span class="error">*</span> Address </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_address_b" name="rv_address_b" type="text" placeholder="Address" value="<?php echo set_value('rv_address_b',isset($data['rv_address_b'])?$data['rv_address_b']:''); ?>">
                                            <?php echo form_error('rv_address_b','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="rv_email_b"><span class="error">*</span> Email </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_email_b" name="rv_email_b" type="text" placeholder="Email" value="<?php echo set_value('rv_email_b',isset($data['rv_email_b'])?$data['rv_email_b']:''); ?>">
                                            <?php echo form_error('rv_email_b','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
										<div class="control-group">
                                          <label class="control-label" for="rv_name_c"><span class="error">*</span> Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_name_c" name="rv_name_c" type="text" placeholder="Name" value="<?php echo set_value('rv_name_c',isset($data['rv_name_c'])?$data['rv_name_c']:''); ?>">
                                            <?php echo form_error('rv_name_c','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="rv_address_c"><span class="error">*</span> Address </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_address_c" name="rv_address_c" type="text" placeholder="Address" value="<?php echo set_value('rv_address_c',isset($data['rv_address_c'])?$data['rv_address_c']:''); ?>">
                                            <?php echo form_error('rv_address_c','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="rv_email_c"><span class="error">*</span> Email </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_email_c" name="rv_email_c" type="text" placeholder="Email" value="<?php echo set_value('rv_email_c',isset($data['rv_email_c'])?$data['rv_email_c']:''); ?>">
                                            <?php echo form_error('rv_email_c','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
										<div class="control-group">
                                          <label class="control-label" for="rv_name_d"><span class="error">*</span> Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_name_d" name="rv_name_d" type="text" placeholder="Name" value="<?php echo set_value('rv_name_d',isset($data['rv_name_d'])?$data['rv_name_d']:''); ?>">
                                            <?php echo form_error('rv_name_d','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="rv_address_d"><span class="error">*</span> Address </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_address_d" name="rv_address_d" type="text" placeholder="Address" value="<?php echo set_value('rv_address_d',isset($data['rv_address_d'])?$data['rv_address_d']:''); ?>">
                                            <?php echo form_error('rv_address_d','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="rv_email_d"><span class="error">*</span> Email </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_email_d" name="rv_email_d" type="text" placeholder="Email" value="<?php echo set_value('rv_email_d',isset($data['rv_email_d'])?$data['rv_email_d']:''); ?>">
                                            <?php echo form_error('rv_email_d','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>   <?php */?>                                                                           
                                        
                                        
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="keywords"> </label>
                                          <div class="controls">
                                          <strong>Excluded Reviewers [if any]</strong>
                                          </div>
                                        </div>
                                        
										<div class="control-group">
                                          <label class="control-label" for="rv_name_e">Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_name_e" name="rv_name_e" type="text" placeholder="Name" value="<?php echo set_value('rv_name_e',isset($data['rv_name_e'])?$data['rv_name_e']:''); ?>">
                                            <?php echo form_error('rv_name_e','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="rv_address_e">Address </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_address_e" name="rv_address_e" type="text" placeholder="Address" value="<?php echo set_value('rv_address_e',isset($data['rv_address_e'])?$data['rv_address_e']:''); ?>">
                                            <?php echo form_error('rv_address_e','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="rv_email_e">Email </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_email_e" name="rv_email_e" type="text" placeholder="Email" value="<?php echo set_value('rv_email_e',isset($data['rv_email_e'])?$data['rv_email_e']:''); ?>">
                                            <?php echo form_error('rv_email_e','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                                                                                                                                       
										<div class="control-group">
                                          <label class="control-label" for="rv_name_f">Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_name_f" name="rv_name_f" type="text" placeholder="Name" value="<?php echo set_value('rv_name_f',isset($data['rv_name_f'])?$data['rv_name_f']:''); ?>">
                                            <?php echo form_error('rv_name_f','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="rv_address_f">Address </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_address_f" name="rv_address_f" type="text" placeholder="Address" value="<?php echo set_value('rv_address_f',isset($data['rv_address_f'])?$data['rv_address_f']:''); ?>">
                                            <?php echo form_error('rv_address_f','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="rv_email_f">Email </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="rv_email_f" name="rv_email_f" type="text" placeholder="Email" value="<?php echo set_value('rv_email_f',isset($data['rv_email_f'])?$data['rv_email_f']:''); ?>">
                                            <?php echo form_error('rv_email_f','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                    
                                                                                                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Upload Manuscript </label>
                                          <div class="controls">
                                            <input class="input-xlarge span3" id="ms_word_file" name="ms_word_file" type="file" placeholder="Upload Manuscript" value="<?php echo set_value('ms_word_file',isset($data['ms_word_file'])?$data['ms_word_file']:''); ?>">
<?php
if($id)
{
?> 
                                            <a target="_blank" href="<?php echo base_url().'media/manuscripts'.date("/Y/M/",strtotime($data['date'])).$data['ms_word_file']; ?>" title="<?php echo $data['ms_word_file'];?>">
												<?php echo $data['ms_word_file']?>
                                            </a>
                                            
&nbsp;&nbsp;
<input type="checkbox" name="delete_ms_word_file" id="delete_ms_word_file" value="1" />
&nbsp;Delete    
<?php		
}
?>

                                            <?php echo form_error('ms_word_file','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="keywords"> </label>
                                          <div class="controls">
                                          <strong>Assign Reviewers [if any]</strong>
                                          </div>
                                        </div>         
                                        
										<div class="control-group">
                                          <label class="control-label" for="assign_reviewer1">Assign Reviewer 1 </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="assign_reviewer1" name="assign_reviewer1" type="text" placeholder="Assign Reviewer 1" value="<?php echo set_value('assign_reviewer1',isset($data['assign_reviewer1'])?$data['assign_reviewer1']:''); ?>">
                                            <span>Autosuggest Field, start with name initial.</span>
                                            <?php echo form_error('assign_reviewer1','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="assign_reviewer2">Assign Reviewer 2 </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="assign_reviewer2" name="assign_reviewer2" type="text" placeholder="Assign Reviewer 2" value="<?php echo set_value('assign_reviewer2',isset($data['assign_reviewer2'])?$data['assign_reviewer2']:''); ?>">
                                            <span>Autosuggest Field, start with name initial.</span>
                                            <?php echo form_error('assign_reviewer2','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="assign_reviewer3">Assign Reviewer 3 </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="assign_reviewer3" name="assign_reviewer3" type="text" placeholder="Assign Reviewer 3" value="<?php echo set_value('assign_reviewer3',isset($data['assign_reviewer3'])?$data['assign_reviewer3']:''); ?>">
                                            <span>Autosuggest Field, start with name initial.</span>
                                            <?php echo form_error('assign_reviewer3','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>     
                                        
										<div class="control-group">
                                          <label class="control-label" for="assign_reviewer4">Assign Reviewer 4 </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="assign_reviewer4" name="assign_reviewer4" type="text" placeholder="Assign Reviewer 4" value="<?php echo set_value('assign_reviewer4',isset($data['assign_reviewer4'])?$data['assign_reviewer4']:''); ?>">
                                            <span>Autosuggest Field, start with name initial.</span>
                                            <?php echo form_error('assign_reviewer4','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        
   <?php
if($id)
{
?>                                                
                                        
<div class="control-group">
                                          <label class="control-label" for="status"> <span class="error">*</span> Status</label>
                                          <div class="controls">
											<select name="status" id="status" style="width:200px;">
<option value="0" <?php if($data['status'] == "0") { echo " selected"; }?>>Rejected</option>	
<option value="8" <?php if($data['status'] == "8") { echo " selected"; }?>>Withdrawn</option>	
<option value="7" <?php if($data['status'] == "7") { echo " selected"; }?>>Under Final Evaluation</option>	
<option value="6" <?php if($data['status'] == "6") { echo " selected"; }?>>Under Peer Review</option>	
<option value="5" <?php if($data['status'] == "5") { echo " selected"; }?>>Minor Revision</option>	
<option value="4" <?php if($data['status'] == "4") { echo " selected"; }?>>Paid</option>	
<option value="3" <?php if($data['status'] == "3") { echo " selected"; }?>>On Process</option>	
<option value="2" <?php if($data['status'] == "2") { echo " selected"; }?>>Major Revision</option>	
<option value="1" <?php if($data['status'] == "1") { echo " selected"; }?>>Accepted</option>	
</select>
                                          <?php echo form_error('status','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>      
                                        
<?php
}
?>                                               
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="requested_discount"> <span class="error">*</span> Discount Request Decision</label>
                                          <div class="controls">
											<select name="requested_discount" id="requested_discount" style="width:200px;">
<option value="0" <?php if(set_value('requested_discount',isset($data['requested_discount'])?$data['requested_discount']:'') == "0") { echo " selected"; }?>>Not Applied</option>	
<option value="3" <?php if(set_value('requested_discount',isset($data['requested_discount'])?$data['requested_discount']:'') == "3") { echo " selected"; }?>>Rejected</option>	
<option value="2" <?php if(set_value('requested_discount',isset($data['requested_discount'])?$data['requested_discount']:'') == "2") { echo " selected"; }?>>Accepted</option>	
<option value="1" <?php if(set_value('requested_discount',isset($data['requested_discount'])?$data['requested_discount']:'') == "1") { echo " selected"; }?>>Pending</option>		
</select>
                                          <?php echo form_error('status','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>
                                        
<div class="control-group">
                                          <label class="control-label" for="keywords"><span class="error">*</span> Discount %</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="discount" name="discount" type="text" placeholder="Discount" value="<?php echo set_value('discount',isset($data['discount'])?$data['discount']:''); ?>">
                                            <?php echo form_error('discount','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
<?php
if($id)
{
?>                                          
                                        <div class="control-group">
                                          <label class="control-label" for="keywords"><span class="error">*</span> Discount Request</label>
                                          <div class="controls">
                                            <?php if($data['requested_discount'] ==  1) { echo "Applied"; } elseif($data['requested_discount'] ==  2) { echo "Accepted"; } elseif($data['requested_discount'] ==  3) { echo "Rejected"; } ?>
                                          </div>
                                        </div>                                                                                                                                                                             
<?php
}
?>                     
<?php 
	if($this->action_status)
	{
?>                                        
                                        <div class="control-group">
                                          <label class="control-label" for="publish">Publish</label>
                                          <div class="controls">
											<select id="publish" name="publish" class="span6">
                                              <option value="1" <?php if("1" === set_value('publish',isset($data['publish'])?$data['publish']:'')) { echo 'selected="selected"'; } ?>>Active</option>
                                              <option value="0" <?php if("0" === set_value('publish',isset($data['publish'])?$data['publish']:'')) { echo 'selected="selected"'; } ?>>Inactive</option>
                                            </select>
                                          </div>
                                        </div>                                                                              
<?php 
	}
?>                                        
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">Save changes</button>
                                          <button type="reset" class="btn" onclick="parent.location.href='<?php echo site_url($this->controller); ?>'">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <hr>
            <?php $this->load->view('backend/includes/footer');?>
        </div>
        <!--/.fluid-container-->
		<?php /*?><script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
		<link href="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>

  
        
		<link href="<?php echo base_url(); ?>assets/plugin/colorbox/css/colorbox.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/colorbox/js/jquery.colorbox-min.js"></script>             <?php */?>
        
        <script src="<?php echo base_url(); ?>assets/plugin/addremovebutton/js/jquery.min.js"></script>
        
		<script src="<?php echo base_url(); ?>assets/themes/backend/vendors/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/themes/backend/vendors/ckeditor/adapters/jquery.js"></script>     
        
<?php /*?>		<link href="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>    <?php */?>             
        
<script>
        $(function() {
				$( 'textarea.ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
				
/*				$( ".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' } );
				$( ".datepicker" ).attr('autocomplete','off');
				$( ".datepicker" ).attr('readonly','readonly');*/
//				$(".group1").colorbox({rel:'group1'});
        });
</script>


<script>
		$(document).ready(function() {

			var id = 0;
			// Add button functionality
			$("table.dynatable a.add").click(function() {
				id++;
				var master = $(this).parents("table.dynatable");

				// Get a new row based on the prototype row
				var prot = master.find(".prototype").clone();
				prot.attr("class", "prototype"+id)
				prot.find(".id").attr("value", id);
				prot.find(".name").attr("value", id);				
				prot.find(".remove").attr("id", "prototype"+id);								
//				prot.find(".stageNo").html(id);		
			//	prot.find(".addDate").attr("id", "addDate"+id);												
				master.find("tbody").append(prot);
								
			});

			// Remove button functionality
			$("table.dynatable a.remove").live("click", function() {
//				alert(this.id);
				$("tr."+this.id).remove();
			});
		});
</script>
<style>
.datepicker
{	
}

.dynatable .prototype 
{
	display:none;
}
</style>


<script>
///////////getting values on change

		$( "#subject_id" ).change(function() 		
		{
			$.post( "<?php echo site_url($this->config->item('backend').'/manuscripts/getjournal');?>", { subject_id: this.value })
			.done(function( data ) 
			{
				$( "#journal_id" ).html(data);
			});	
		
		});	

</script>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/autocomplete/jquery-ui.css">
  <script src="<?php echo base_url(); ?>assets/plugin/autocomplete/jquery-1.10.2.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugin/autocomplete/jquery-ui.js"></script>
  <style>
  .ui-autocomplete-loading {
    background: white url("<?php echo base_url(); ?>assets/plugin/autocomplete/ui-anim_basic_16x16.gif") right center no-repeat;
  }
  </style>
  <script>
  $(function() {
    function log( message ) {
    }
 
    $( "#special_editor_id" ).autocomplete({
      source: "<?php echo site_url($this->config->item('backend').'/manuscripts/getspecialeditors');?>",
      minLength: 1,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });
	
    $( "#author_id" ).autocomplete({
      source: "<?php echo site_url($this->config->item('backend').'/manuscripts/getspecialeditors');?>",
      minLength: 1,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });	
	
    $( "#assign_reviewer1" ).autocomplete({
      source: "<?php echo site_url($this->config->item('backend').'/manuscripts/getspecialeditors');?>",
      minLength: 1,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });	
	
    $( "#assign_reviewer2" ).autocomplete({
      source: "<?php echo site_url($this->config->item('backend').'/manuscripts/getspecialeditors');?>",
      minLength: 1,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });	
	
    $( "#assign_reviewer3" ).autocomplete({
      source: "<?php echo site_url($this->config->item('backend').'/manuscripts/getspecialeditors');?>",
      minLength: 1,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });	
	
    $( "#assign_reviewer4" ).autocomplete({
      source: "<?php echo site_url($this->config->item('backend').'/manuscripts/getspecialeditors');?>",
      minLength: 1,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });					
	
	
	
	
  });
  </script>