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
											<?php echo get_corresponing_value('categories_spl','name',$data['main_cat'],'Id');?>
                                          </div>
                                        </div>                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Name </label>
                                          <div class="controls">
                                            <?php echo $data['name'];?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Short Name</label>
                                          <div class="controls">
                                            <?php echo $data['short_name'];?>
                                          </div>
                                        </div>
   
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="announcement"><span class="error">*</span> Article in Press</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="about_journal" name="article_press"><?php echo set_value('article_press',isset($data['article_press'])?$data['article_press']:''); ?></textarea>
                                            <?php echo form_error('article_press','<span class="help-inline">','</span>'); ?>
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