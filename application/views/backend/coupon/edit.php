        <link href="<?php echo base_url(); ?>assets/themes/backend/vendors/chosen.min.css" rel="stylesheet" media="screen">
        <script src="<?php echo base_url(); ?>assets/themes/backend/vendors/chosen.jquery.min.js"></script>
   
        
        
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
                                          <label class="control-label" for="journal_id"><span class="error">*</span> Journal</label>
                                          <div class="controls">
											<select id="journal_id" name="journal_id" class="span6 chzn-select">
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
                                          <label class="control-label" for="manuscript_id"><span class="error">*</span> Manuscripts </label>
                                          <div class="controls">
                                           <input class="input-xlarge span6" id="manuscript_id" name="manuscript_id" type="text" placeholder="Select Manuscripts" value="<?php echo set_value('manuscript_id',isset($data['manuscript_id'])?$data['manuscript_id']:''); ?>">
                                          <span>Autosuggest Field, start with name initial.</span>
                                            <?php echo form_error('manuscript_id','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="coupon"><span class="error">*</span> Coupon </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="coupon" name="coupon" type="text" placeholder="Coupon" value="<?php echo set_value('coupon',isset($data['coupon'])?$data['coupon']:''); ?>">
                                            <?php echo form_error('coupon','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="reviewer_id"><span class="error">*</span> Select Reviewer</label>
                                          <div class="controls">
											<input class="input-xlarge span6" id="reviewer_id" name="reviewer_id" type="text" placeholder="Select Reviewer" value="<?php echo set_value('reviewer_id',isset($data['reviewer_id'])?$data['reviewer_id']:''); ?>">
                                          <span>Autosuggest Field, start with name initial.</span>
                                            <?php echo form_error('reviewer_id','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="value"><span class="error">*</span> Value [in % ] </label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="value" name="value" type="text" placeholder="Value" value="<?php echo set_value('value',isset($data['value'])?$data['value']:''); ?>">
                                            <?php echo form_error('value','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="newsletter">Valid</label>
                                          <div class="controls">
											<select id="valid" name="valid" class="span6">
                                              <option value="1" <?php if("1" === set_value('valid',isset($data['valid'])?$data['valid']:'')) { echo 'selected="selected"'; } ?>>Active</option>
                                              <option value="0" <?php if("0" === set_value('valid',isset($data['valid'])?$data['valid']:'')) { echo 'selected="selected"'; } ?>>Inactive</option>
                                            </select>
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

        <script>
        $(function() {
            $(".chzn-select").chosen();
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
 
    $( "#reviewer_id" ).autocomplete({
      source: "<?php echo site_url($this->config->item('backend').'/coupon/getreviewer');?>",
      minLength: 1,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });
	
    $( "#manuscript_id" ).autocomplete({
      source: "<?php echo site_url($this->config->item('backend').'/coupon/getmanuscripts');?>",
      minLength: 1,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );
      }
    });	

	
  });
  </script>        