<?php
	$userdata = $this->session->userdata('frontuser');
?>
<div class="col-lg-3">
                    	<div class="right_list">
						 <ul class="oaservicelist">
                        	<a href=""><h3>Subscriber Menu</h3></a>
                           
			<?php if(isset($userdata['id'])) { ?>          

            <li><a href="<?php echo site_url('user/myaccount');?>">Welcome ! <strong><?php echo $userdata['name'];?></strong></a></li>

            <li><a href="<?php echo site_url('user/myaccount');?>">My Account</a></li>

            <li><a href="<?php echo site_url('user/subscriberlogout');?>">Logout</a></li>            

            <?php } else { ?>

            <li><a href="<?php echo site_url('user/subscriberlogin');?>">Subscriber Login</a></li>

            <?php } ?> 
                            </ul>
                        </div>
                    	<div class="right_list">
                        	<ul class="oaservicelist">
                        	<a href=""><h3>Information menu</h3></a>
<?php

$data = get_few_record("select * from quicklinks where publish=1 order by serial");



if(!empty($data))
{

	foreach($data as $value)

	{

?>    

    <li><a href="<?php echo site_url($value['link']);?>"><?php echo $value['title']?></a></li>

<?php

	}

}

?> 

        </ul>
                        </div>
                        <div class="right_list">
                        	<ul class="oaservicelist">
                        	<a href=""><h3>Upcoming Menu</h3></a>

     

<?php

$data = get_few_record("select * from journals where upcoming=1 order by Id desc limit 0,15");



if(!empty($data))

{

	foreach($data as $value)

	{

?>    

            <li><a href="<?php echo site_link;?>journal-home.php?id=<?php echo $value['Id']?>"><?php echo $value['name']?></a></li>

<?php

	}

	?>

	        </ul>

        <p><a href="upcoming_journals.php">View all...</a></p>

	<?php

}

else

{

?>

			<li class="red">No Upcoming Journals</li>

                    </ul>

<?php

} 

?>
                        </div>
                    </div>