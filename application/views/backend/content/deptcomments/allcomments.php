<h3>All Comments</h3>
<hr />
<?php
if(!empty($allcomments))
{
	foreach($allcomments as $value)
	{
?>
<p class="comment"><?php echo $value['comment'];?></p>
<p class="author-date">By <em><a href="mailto:<?php echo get_staff_info($value['staff_id']);?>"><?php echo get_staff_info($value['staff_id'],'name');?></a></em>, at <em><?php echo date("l, d F Y, g:i a",strtotime($value['date']));?></em></p>
<hr />
<?php
	}
}
else
{
?>
<p class="comment">No Comments</p>
<?php
}
?>
<style>
h3
{
	font-size:16px;
	font-family:Tahoma, Geneva, sans-serif;
}
p.comment
{
	font-size:14px;
	font-family:Tahoma, Geneva, sans-serif;
}
p.author-date
{
	font-size:12px;
	font-family:Tahoma, Geneva, sans-serif;
}
</style>