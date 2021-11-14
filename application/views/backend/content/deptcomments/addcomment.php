<?php $this->load->view('backend/includes/messageblank');?>
<h3>Add Comment</h3>
<hr />
<form action="<?php echo site_url($this->controller.'/addcomment');?>" method="post" name="add_comment" onsubmit="return validate();">
<input type="hidden" name="manuscript_id" value="<?php echo $data['mid'];?>" />
<input type="hidden" name="dept_id" value="<?php echo $data['dept_id'];?>" />
<label>Comment</label><br />
<textarea name="comment" id="comment"></textarea>
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