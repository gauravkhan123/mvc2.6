<?php $this->load->view('backend/includes/messageblank');?>
<h3>Give box a color</h3>
<hr />
<form action="<?php echo site_url($this->controller.'/commentcolor');?>" method="post" name="add_color" onsubmit="return validate();">
<input type="hidden" name="manuscript_id" value="<?php echo $data['mid'];?>" />
<input type="hidden" name="dept_id" value="<?php echo $data['dept_id'];?>" />
<label>Select Color</label><br />

<select name="field_color" id="field_color" style="width:200px;">
	<option value="">Select</option>	
	<option value="FF0000" <?php if(@$existing['field_color'] == 'FF0000') { echo ' selected="selected"';}?>>Red</option>
	<option value="00FF00" <?php if(@$existing['field_color'] == '00FF00') { echo ' selected="selected"';}?>>Green</option>
	<option value="FFFF00" <?php if(@$existing['field_color'] == 'FFFF00') { echo ' selected="selected"';}?>>Yellow</option>        
</select>
<br />
<input type="submit" name="submit" value="Submit" />
</form>
<style>
	h3
	{
		font-size:16px;
		font-family:Tahoma, Geneva, sans-serif;
	}

	label
	{
		font-size:14px;
		font-family:Tahoma, Geneva, sans-serif;	
		padding:5px 0;
	}
	
	textarea
	{
		font-size:14px;
		font-family:Tahoma, Geneva, sans-serif;	
		width:500px;
		height:150px;
		padding:5px 0;		
	}

</style>
<script language="javascript">
 function validate(){
	var d=document.add_comment;
	
	  if(d.comment.value == "") {
		  alert("Please enter your comment");
		  d.comment.focus();
		  return false;
	  }	
}
</script>