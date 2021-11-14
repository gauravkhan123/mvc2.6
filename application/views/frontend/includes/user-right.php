<?php
	$userdata = $this->session->userdata('frontuser');
?>


<div class="col-lg-3">
                    	<div class="right_list">
						
       
        <ul class="oaservicelist">
		<h3>User Menu</h3>
<li><a href="<?php echo site_url('user/myaccount')?>">My Profile</a></li>
<?php if($userdata['role'] == 'Author_Reviewer_Editor' && 1==2) { ?>
                                        <li><a href="<?php echo site_url('user/reviewercoupons')?>">My Coupons</a></li>
<?php } ?>                                        
                                        <li><a href="<?php echo site_url('user/submitmanuscript')?>">New Submission</a></li>
                                        <li><a href="<?php echo site_url('user/inprocessmanuscript')?>">In Process</a></li>
<?php if($userdata['role'] == 'Author_Reviewer_Editor') { ?>
                                        <li><a href="<?php echo site_url('user/othersmanuscript')?>">Reviewer Center</a></li>
<?php } ?>                         
                                        <li><a href="<?php echo site_url('user/publishedmanuscript')?>">Published</a></li>
        </ul>
    </div>

<?php /*?><div class="upcoming">
        <h3>Upcoming <span>Journals</span></h3>
        <ul>
<?php 
$sql_ucj="select * from journals where upcoming=1 order by Id desc limit 0,15";
$rs_ucj=$newdb->page($sql_ucj);
$total_ucj = mysql_num_rows($rs_ucj);
while($result_ucj=mysql_fetch_assoc($rs_ucj))
{
?>          
            <li><a href="<?php echo site_link;?>journal-home.php?id=<?php echo $result_ucj['Id']?>"><?php echo $result_ucj['name']?></a></li>
<?php
}
if($total_ucj ==0) {
?>
			<li class="red">No Upcoming Journals</li>
<?php
} else {
?>            
<?php } ?>            
        </ul>
        <p><a href="upcoming_journals.php">View all...</a></p>
    </div><?php */?>    
</div>