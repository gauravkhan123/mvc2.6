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
                                          <label class="control-label" for="category"> <span class="error">*</span> Subject</label>
                                          <div class="controls">
											<select id="main_cat" name="main_cat" class="span6">
                                              <option value="" >Select</option>
<?php if(!empty($subjects))
{
	foreach($subjects as $value)
	{
?>                                              
                                              <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == set_value('main_cat',isset($data['main_cat'])?$data['main_cat']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
	}
}
?>                                               
                                            </select>
                                          <?php echo form_error('main_cat','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Name </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="name" name="name" type="text" placeholder="Name" value="<?php echo set_value('name',isset($data['name'])?$data['name']:''); ?>">
                                            <?php echo form_error('name','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Short Name</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="short_name" name="short_name" type="text" placeholder="Short Name" value="<?php echo set_value('short_name',isset($data['short_name'])?$data['short_name']:''); ?>">
                                            <?php echo form_error('short_name','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> ISSN </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="issn" name="issn" type="text" placeholder="ISSN" value="<?php echo set_value('issn',isset($data['issn'])?$data['issn']:''); ?>">
                                            <?php echo form_error('issn','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>                                        
                                  <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Image </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="image" name="image" type="file" placeholder="Image" value="<?php echo set_value('image',isset($data['image'])?$data['image']:''); ?>">
<?php
if($id)
{
?>                                                 
                                            <a class="group1" href="<?php echo base_url().'media/jours/orignal/'.$data['image']; ?>" title="<?php echo $data['image'];?>"><img src="<?php echo base_url().'media/jours/105/'.$data['image']; ?>" width="50" /></a>
<?php
}
?>                                            
                                            <?php echo form_error('image','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
<div class="control-group">
                                          <label class="control-label" for="announcement"><span class="error">*</span> Journals Announcement</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="announcement" name="announcement"><?php echo set_value('announcement',isset($data['announcement'])?$data['announcement']:''); ?></textarea>
                                            <?php echo form_error('announcement','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>          
                                        
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="announcement"><span class="error">*</span> About Journals</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="about_journal" name="about_journal"><?php echo set_value('about_journal',isset($data['about_journal'])?$data['about_journal']:''); ?></textarea>
                                            <?php echo form_error('about_journal','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>                          
                                        <div class="control-group">
                                          <label class="control-label" for="authors_instruction"><span class="error">*</span> Authors Instruction</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="authors_instruction" name="authors_instruction"><?php echo set_value('authors_instruction',isset($data['authors_instruction'])?$data['authors_instruction']:''); ?></textarea>
                                            <?php echo form_error('authors_instruction','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>    
                                        
                                        
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="editorial_policy"><span class="error">*</span> Editorial Policy</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="editorial_policy" name="editorial_policy"><?php echo set_value('editorial_policy',isset($data['editorial_policy'])?$data['editorial_policy']:''); ?></textarea>
                                            <?php echo form_error('editorial_policy','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="manuscript_submission"><span class="error">*</span> Manuscript Submission</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="manuscript_submission" name="manuscript_submission"><?php echo set_value('manuscript_submission',isset($data['manuscript_submission'])?$data['manuscript_submission']:''); ?></textarea>
                                            <?php echo form_error('manuscript_submission','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="article_press"><span class="error">*</span> Abstracting & Indexing</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="abstracting_indexing" name="abstracting_indexing"><?php echo set_value('abstracting_indexing',isset($data['abstracting_indexing'])?$data['abstracting_indexing']:''); ?></textarea>
                                            <?php echo form_error('abstracting_indexing','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="title_tag">Title Tag</label>
                                          <div class="controls">
                                            <textarea name="title_tag" id="title_tag" class="span6" placeholder="Title Tag"><?php echo set_value('title_tag',isset($data['title_tag'])?$data['title_tag']:''); ?></textarea>
                                            <?php echo form_error('title_tag','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="meta_keyword_tag">Meta Keyword Tag</label>
                                          <div class="controls">
                                            <textarea name="meta_keyword_tag" id="meta_keyword_tag" class="span6" placeholder="Meta Keyword Tag"><?php echo set_value('meta_keyword_tag',isset($data['meta_keyword_tag'])?$data['meta_keyword_tag']:''); ?></textarea>
                                            <?php echo form_error('meta_keyword_tag','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="meta_desc_tag">Meta Description Tag</label>
                                          <div class="controls">
                                            <textarea name="meta_desc_tag" id="meta_desc_tag" class="span6" placeholder="Meta Description Tag"><?php echo set_value('meta_desc_tag',isset($data['meta_desc_tag'])?$data['meta_desc_tag']:''); ?></textarea>
                                            <?php echo form_error('meta_desc_tag','<span class="error-advise">','</span>'); ?>                                          </div>
                                        </div>

                                        
                                        <div class="control-group">
                                          <label class="control-label" for="featured">Featured</label>
                                          <div class="controls">
											<select id="featured" name="featured" class="span6">
                                              <option value="1" <?php if("1" === set_value('featured',isset($data['featured'])?$data['featured']:'')) { echo 'selected="selected"'; } ?>>Active</option>
                                              <option value="0" <?php if("0" === set_value('featured',isset($data['featured'])?$data['featured']:'')) { echo 'selected="selected"'; } ?>>Inactive</option>
                                            </select>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="upcoming">Upcoming</label>
                                          <div class="controls">
											<select id="upcoming" name="upcoming" class="span6">
                                              <option value="1" <?php if("1" === set_value('upcoming',isset($data['upcoming'])?$data['upcoming']:'')) { echo 'selected="selected"'; } ?>>Active</option>
                                              <option value="0" <?php if("0" === set_value('upcoming',isset($data['upcoming'])?$data['upcoming']:'')) { echo 'selected="selected"'; } ?>>Inactive</option>
                                            </select>
                                          </div>
                                        </div>
                                        
<div class="control-group">
                                          <label class="control-label" for="upcoming_date">Up-cominng Date </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="upcoming_date" name="upcoming_date" type="text" placeholder="Upcoming Date" value="<?php echo set_value('upcoming_date',isset($data['upcoming_date'])?$data['upcoming_date']:''); ?>">
                                            <?php echo form_error('upcoming_date','<span class="error-advise">','</span>'); ?>
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
		<?php /*?><script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script><?php */?>
		<link href="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>

		<script src="<?php echo base_url(); ?>assets/themes/backend/vendors/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/themes/backend/vendors/ckeditor/adapters/jquery.js"></script>        
        
		<link href="<?php echo base_url(); ?>assets/plugin/colorbox/css/colorbox.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/colorbox/js/jquery.colorbox-min.js"></script>             
        
<script>
        $(function() {
				$( 'textarea.ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
				
				$( ".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' } );
				$( ".datepicker" ).attr('autocomplete','off');
				$( ".datepicker" ).attr('readonly','readonly');
				$(".group1").colorbox({rel:'group1'});
        });
</script>
<style>
.datepicker
{	

}
</style>