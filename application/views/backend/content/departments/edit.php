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
                                     <form class="form-horizontal" name="" method="post" action="<?php echo site_url($this->controller.'/edit/'.$id);?>">
<?php
}
else
{
?>
                                    <form class="form-horizontal" name="" method="post" action="<?php echo site_url($this->controller.'/add');?>">
<?php
}
?>
                                      <fieldset>
                                        <!--<legend>Edit</legend>-->
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Title </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="name" name="name" type="text" placeholder="Title" value="<?php echo set_value('name',isset($data['name'])?$data['name']:''); ?>">
                                            <?php echo form_error('name','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="serial"><span class="error">*</span> Ordering </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="serial" name="serial" type="text" placeholder="Ordering" value="<?php echo set_value('serial',isset($data['serial'])?$data['serial']:''); ?>">
                                            <?php echo form_error('serial','<span class="error-advise">','</span>'); ?>
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