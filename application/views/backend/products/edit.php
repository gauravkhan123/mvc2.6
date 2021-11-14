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
                                          <label class="control-label" for="category">Category</label>
                                          <div class="controls">
											<select id="category_id" name="category_id">
                                              <option value="" >Select</option>
											  <?php if(!empty($categories))
{
	foreach($categories as $value)
	{
?>                                              
                                              <option value="<?php echo $value['id'];?>" <?php if($value['id'] == set_value('category_id',isset
											  ($data['category_id'])?$data['category_id']:'')) { echo 'selected="selected"'; } ?>>
											  <?php echo $value['name'];?></option>
<?php
	}
}
?>   
                                            </select>
                                          </div>
                                        </div>
										
										
										<div class="control-group">
                                          <label class="control-label" for="category">Checkbox Category</label>
                                          <div class="controls">
                                        <?php
										//pr($categories);
										
										if(!empty($data['checkbox_categories']))
										{
											$data['checkbox_categories'] = unserialize($data['checkbox_categories']);
										}
										else
										{
											$data['checkbox_categories'] = array();	
										}
										
										
                                        if(!empty($categories))
										{
											foreach($categories as $value)
											{
										?>
                                        <div style="height:25px;">
                                        	<input type="checkbox" id="checkbox_categories" name="checkbox_categories[]" value="<?php echo $value['id'];?>" 
											<?php if(in_array($value['id'],$data['checkbox_categories'])) { echo 'checked="checked"'; } ?>  /> <?php echo $value['name'];?>
                                        </div>
                                        <?php
											}
										}
										?>
                                        </div>
                                        </div>
										
										<div class="control-group">
                                          <label class="control-label" for="category">Checkbox Category 2</label>
                                          <div class="controls">
                                        <?php
										//pr($categories);
										
										if(!empty($data['checkbox_categories2']))
										{
											$data['checkbox_categories2'] = unserialize($data['checkbox_categories2']);
										}
										else
										{
											$data['checkbox_categories2'] = array();	
										}
										
										
                                        if(!empty($categories))
										{
											foreach($categories as $value)
											{
										?>
                                        <div style="height:25px;">
                                        	<input type="checkbox" id="checkbox_categories2" name="checkbox_categories2[]"
											 value="<?php echo $value['id'];?>" 
											<?php if(in_array($value['id'],$data['checkbox_categories2'])) { echo 'checked="checked"'; } ?>  /> 
											<?php echo $value['name'];?>
                                        </div>
                                        <?php
											}
										}
										?>
                                        </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="category">Checkbox Category 3</label>
                                          <div class="controls">
                                        <?php
										//pr($categories);
										
										if(!empty($data['checkbox_categories3']))
										{
											$data['checkbox_categories3'] = unserialize($data['checkbox_categories3']);
										}
										else
										{
											$data['checkbox_categories3'] = array();	
										}
										
										
                                        if(!empty($categories))
										{
											foreach($categories as $value)
											{
										?>
                                        <div style="height:25px;">
                                        	<input type="checkbox" id="checkbox_categories3" name="checkbox_categories3[]" value="<?php echo $value['id'];?>" 
											<?php if(in_array($value['id'],$data['checkbox_categories3'])) { echo 'checked="checked"'; } ?>  /> <?php echo $value['name'];?>
                                        </div>
                                        <?php
											}
										}
										?>
                                        </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Title </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="name" name="name" type="text" placeholder=" Title" value="<?php echo set_value('name',isset($data['name'])?$data['name']:''); ?>">
                                            <?php echo form_error('name','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Sku </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="name" name="sku" type="text" placeholder=" Sku" value="<?php echo set_value('sku',isset($data['sku'])?$data['sku']:''); ?>">
                                            <?php echo form_error('sku','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="description"><span class="error">*</span> Content</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="description" name="description"><?php echo set_value
											('description',isset($data['description'])?$data['description']:''); ?></textarea>
                                            <?php echo form_error('description','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="title_tag">Title Tag</label>
                                          <div class="controls">
                                            <textarea name="title_tag" id="title_tag" class="span6" placeholder="Title Tag"><?php echo set_value('title_tag',isset($data['title_tag'])?$data['title_tag']:''); ?></textarea>
                                            <?php echo form_error('title_tag','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="meta_keyword_tag">Meta Keyword Tag</label>
                                          <div class="controls">
                                            <textarea name="meta_keyword_tag" id="meta_keyword_tag" class="span6" placeholder="Meta Keyword Tag"><?php echo set_value('meta_keyword_tag',isset($data['meta_keyword_tag'])?$data['meta_keyword_tag']:''); ?></textarea>
                                            <?php echo form_error('meta_keyword_tag','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="meta_desc_tag">Meta Description Tag</label>
                                          <div class="controls">
                                            <textarea name="meta_desc_tag" id="meta_desc_tag" class="span6" placeholder="Meta Description Tag"><?php echo set_value('meta_desc_tag',isset($data['meta_desc_tag'])?$data['meta_desc_tag']:''); ?></textarea>
                                            <?php echo form_error('meta_desc_tag','<span class="help-inline">','</span>'); ?>                                          </div>
                                        </div> 
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="publish">Publish</label>
                                          <div class="controls">
											<select id="publish" name="publish">
                                              <option value="1" <?php if("1" == set_value('publish',isset($data['publish'])?$data['publish']:'')) { echo 'selected="selected"'; } ?>>Active</option>
                                              <option value="0" <?php if("0" == set_value('publish',isset($data['publish'])?$data['publish']:'')) { echo 'selected="selected"'; } ?>>Inactive</option>
                                            </select>
                                          </div>
                                        </div>                                                                                
                                        
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