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
                                          <label class="control-label" for="name"><span class="error">*</span> Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="name" name="name" type="text" placeholder="Name" value="<?php echo set_value('name',isset($data['name'])?$data['name']:''); ?>">
                                            <?php echo form_error('name','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="username"><span class="error">*</span> Username </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="username" name="username" type="text" placeholder="Username" value="<?php echo set_value('username',isset($data['username'])?$data['username']:''); ?>">
                                            <?php echo form_error('username','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                        <label class="control-label" for="password">Password</label>
                                        <div class="controls">
                                        <input class="input-xlarge span6" id="password" name="password" type="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
                                        <?php echo form_error('password','<span class="error-advise">','</span>'); ?>
                                        </div>
                                        </div>     
                                        <div class="control-group">
                                        <label class="control-label" for="cpassword">Confirm Password</label>
                                        <div class="controls">
                                        <input class="input-xlarge span6" id="cpassword" name="cpassword" type="password" placeholder="Confirm Password" value="<?php echo set_value('cpassword'); ?>">
                                        <?php echo form_error('cpassword','<span class="error-advise">','</span>'); ?>
                                        </div>
                                        </div>     
                                        <div class="control-group">
                                          <label class="control-label" for="institute_name"> Institute Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="institute_name" name="institute_name" type="text" placeholder="Institute Name" value="<?php echo set_value('institute_name',isset($data['institute_name'])?$data['institute_name']:''); ?>">
                                            <?php echo form_error('institute_name','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                    
                                        <div class="control-group">
                                          <label class="control-label" for="contact_no">Contact No </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="contact_no" name="contact_no" type="text" placeholder="Contact No" value="<?php echo set_value('contact_no',isset($data['contact_no'])?$data['contact_no']:''); ?>">
                                            <?php echo form_error('username','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
										<div class="control-group">
                                          <label class="control-label" for="address1">Address 1 </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="address1" name="address1" type="text" placeholder="Address 1" value="<?php echo set_value('address1',isset($data['address1'])?$data['address1']:''); ?>">
                                            <?php echo form_error('address1','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                        
										<div class="control-group">
                                          <label class="control-label" for="address2">Address 2 </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="address2" name="address2" type="text" placeholder="Address 2" value="<?php echo set_value('address2',isset($data['address2'])?$data['address2']:''); ?>">
                                            <?php echo form_error('address2','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                        
										<div class="control-group">
                                          <label class="control-label" for="country"><span class="error">*</span> Country </label>    
                                          <div class="controls">
											<select id="country" name="country" class="span6">
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
                                            <?php echo form_error('country','<span class="error-advise">','</span>'); ?> 
                                          </div>
                                        </div>                                        
										<div class="control-group">
                                          <label class="control-label" for="state">State </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="state" name="state" type="text" placeholder="State" value="<?php echo set_value('state',isset($data['state'])?$data['state']:''); ?>">
                                            <?php echo form_error('state','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                        
                                        <div class="control-group">
                                          <label class="control-label" for="city">City </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="city" name="city" type="text" placeholder="City" value="<?php echo set_value('city',isset($data['city'])?$data['city']:''); ?>">
                                            <?php echo form_error('city','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                        
										<div class="control-group">
                                          <label class="control-label" for="zip">Zip </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="zip" name="zip" type="text" placeholder="Zip" value="<?php echo set_value('zip',isset($data['zip'])?$data['zip']:''); ?>">
                                            <?php echo form_error('zip','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                        
                                       
                                        <div class="control-group">
                                        <label class="control-label" for="permission">Permissions</label>
                                        <div class="controls">
                                        <?php
										if(!empty($data['permissions']))
										{
											$permissions = unserialize($data['permissions']);
										}
										else
										{
											$permissions = array();	
										}
										
//										pr($permissions);
										
								?>
					<div id="accordion">                                
                                <?php
								if(!empty($this->journals))
								{
									foreach($this->journals as $valueJ)
									{	
									?>	
									<h3><?php echo strip_tags($valueJ['name'])." (".$valueJ['short_name'].")";?></h3>	
                                    <div>
                                    <?php
									
									$years = get_few_record("select year from issues where publish = 1 and main_cat='".$valueJ['Id']."' group by year order by year desc");	
										
                                        if(!empty($years))
										{
											foreach($years as $value)
											{
										?>
                                        <div class="years">
                                        	<label><h4><?php echo $value['year'];?></h4></label>
                                                    <div class="volumes">
												<?php 
		$sql="select * from issues where publish=1 and year='".$value['year']."' and main_cat='".$valueJ['Id']."' group by volume order by volume desc";
		$query2 = $this->db->query($sql);
		$records2 = $query2->result_array();
		
        foreach($records2 as $val)
        {		                                                
                                                ?>
                                        	<input type="checkbox" id="permissions" name="permissions[]" value="<?php echo $val['Id'];?>" 
											<?php if(in_array($val['Id'],$permissions)) { echo 'checked="checked"'; } ?>  /> <?php echo "Volume - ".$val['volume'];?>

                                            
                                            <?php 
											
		}
		?>
        
		                                            </div>                                        

                                        </div>
                                        <?php
											} 
										}
										?>
                                        </div>
                                        <?php
											
									} 
								}											
											
										?>
                                        </div>
                                        </div>
                                        </div>
                                    
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
<?php
if($id)
{
?>  
                                        <div class="control-group">
                                          <label class="control-label" for="login-activity">Login Activity</label>
                                          <div class="controls">
											<table width="60%" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <td>IP Address</td>
    <td>Location</td>
    <td>Date / Time of Login</td>    
    <td>Session Duration</td>        
    
    
  </tr>
                                    <?php
									$login_activity = get_few_record("select *,date_format(date,'%b %d %Y %h:%i %p') as date,(UNIX_TIMESTAMP(update_date) - UNIX_TIMESTAMP(date)) AS difference from subscribers_login_activity where user_id = ".$id." and status = 'offline' order by id desc limit 0,50");	
										
                                        if(!empty($login_activity))
										{
											foreach($login_activity as $key=>$value)
											{
										?>    
  <tr>
    <td><?php echo $value['ip_address'];?></td>
    <td><?php echo $value['location'];?></td>
    <td><?php echo $value['date'];?></td>    
    <td><?php echo number_format(($value['difference']/60),2) . " Minute/s";?></td>   
  </tr>
                                    <?php
											}
										}
										else
										{
										?>  
  <tr>
    <td colspan="4" style="text-align:center;">No activity is recorded yet.</td>
  </tr>                                        
                                    <?php
										}
										?>                                              
</table>

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
		<link href="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
        
  <script>
  $(function() {
    $( "#accordion" ).accordion({
      heightStyle: "content",
	  collapsible: true
    });
  });
  </script>
  <style>
  .years h4
  {
	font-size:16px;  
  }
  .years div
  {
	font-size:12px;  
  }
  .years div input
  {
	margin-left:20px;
	margin-top:-4px;
  }
  .volumes
  {
	  line-height:20px;
  }
  </style>