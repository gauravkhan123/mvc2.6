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

                                    <form class="form-horizontal" name="" method="post" action="<?php echo site_url($this->controller.'/index');?>">
                          <fieldset>
                                        <!--<legend>Edit</legend>-->
<?php
if(!empty($data))
{
	foreach($data as $fields)
	{
?>                                        
                           <?php 
						   if($fields['field_type'] == 'text')
						   { 
						   ?>             
                                        <div class="control-group">
                                          <label class="control-label" for="<?php echo $fields['id']?>">
                                          <?php 
										  if($fields['required'])
										  {
											  ?>
                                          <span class="error">*</span> 
                                          <?php 
										  }
											  ?>                                          
										  
										  <?php echo $fields['title'];?> </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="<?php echo $fields['id']?>" name="<?php echo $fields['id']?>" type="text" placeholder="<?php echo $fields['title'];?>" value="<?php echo set_value($fields['id'],isset($fields['value'])?$fields['value']:''); ?>">
                                            <?php if($fields['description']) {?><p class="note"><?php echo $fields['description'];?></p><?php } ?>
                                            <?php echo form_error($fields['id'],'<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                           <?php 
						   }
						   if($fields['field_type'] == 'wysiwyg')
						   { 
						   ?>                                                     
                                        <div class="control-group">
                                          <label class="control-label" for="<?php echo $fields['id']?>">
                                          <?php 
										  if($fields['required'])
										  {
											  ?>
                                          <span class="error">*</span> 
                                          <?php 
										  }
											  ?>                                          
										  
										  <?php echo $fields['title'];?> </label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="<?php echo $fields['id']?>" name="<?php echo $fields['id']?>"><?php echo set_value($fields['id'],isset($fields['value'])?$fields['value']:''); ?></textarea>
                                            <?php if($fields['description']) {?><p class="note"><?php echo $fields['description'];?></p><?php } ?>
                                            <?php echo form_error($fields['id'],'<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>       
                           <?php 
						   }
						   if($fields['field_type'] == 'textarea')
						   { 
						   ?>                                                                           
                                        <div class="control-group">
                                          <label class="control-label" for="<?php echo $fields['id']?>">
                                          <?php 
										  if($fields['required'])
										  {
											  ?>
                                          <span class="error">*</span> 
                                          <?php 
										  }
											  ?>                                          
										  
										  <?php echo $fields['title'];?> </label>
                                          <div class="controls">
                                            <textarea class="span6" id="<?php echo $fields['id']?>" name="<?php echo $fields['id']?>"><?php echo set_value($fields['id'],isset($fields['value'])?$fields['value']:''); ?></textarea>
                                            <?php if($fields['description']) {?><p class="note"><?php echo $fields['description'];?></p><?php } ?>
                                            <?php echo form_error($fields['id'],'<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>  
                           <?php 
						   }
						   if($fields['field_type'] == 'checkbox')
						   { 
						   ?>                                                                           
                                        <div class="control-group">
                                          <label class="control-label" for="<?php echo $fields['id']?>">
                                          <?php 
										  if($fields['required'])
										  {
											  ?>
                                          <span class="error">*</span> 
                                          <?php 
										  }
											  ?>                                          
										  
										  <?php echo $fields['title'];?> </label>
                                          <div class="controls">
                                            <input type="checkbox" id="<?php echo $fields['id']?>" name="<?php echo $fields['id']?>" <?php if(set_value($fields['id'],isset($fields['value'])?$fields['value']:'')) { echo ' checked="checked"'; } ?> />
                                            <?php if($fields['description']) {?><p class="note"><?php echo $fields['description'];?></p><?php } ?>
                                            <?php echo form_error($fields['id'],'<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>  

                           <?php 
						   }
						   ?>  
                                                                   
                                                                           
<?php
	}
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
		<script src="<?php echo base_url(); ?>assets/themes/backend/vendors/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/themes/backend/vendors/ckeditor/adapters/jquery.js"></script>
        
<script>
        $(function() {
				$( 'textarea.ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
        });
</script>                