    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/themes/frontend/css/tooltipster.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/themes/frontend/js/jquery.tooltipster.min.js"></script>
    
<script>
    $(document).ready(function() {

		$('.tooltip').tooltipster({
		   maxWidth: 300
		});

    });
</script>

        <?php $this->load->view('frontend/includes/slider');?>
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	
                       	<ul class="nav tab nav-tabs mytabs">
							<h2 class="mainh2">In Process Menuscript<span></span></h2>
  <li><a href="<?php echo site_url('user/myaccount');?>">My Profile</a></li>
  <li><a href="<?php echo site_url('user/submitmanuscript');?>">New Submission</a></li>
  <li class="active"><a href="javasccript:void();">In Process</a></li>
  <li><a href="<?php echo site_url('user/othersmanuscript');?>">Reviewer Center</a></li>
  <li><a href="<?php echo site_url('user/publishedmanuscript');?>">Published</a></li>
  
</ul>

  <div style="text-align:right; color:red; margin:20px 0;">Click on the manuscript number to see the reviewers comment.</div>

                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped mytable">
                                        <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>Manuscript No.</th>
                                            <th>Manuscript Title</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php
			$get_price = get_settings('1');


			$manuscripts = get_few_record("select * from manuscript where author_id='".$userdata['Id']."' and publish<>1 order by Id desc");
			
			if(!empty($manuscripts))
			{
				foreach($manuscripts as $key=>$value)
				{

					if($value['revised'] != 0) {
					$revised = '/R'.$value['revised'];
					} else {
					$revised = "";
					}
					
					
						$discount = 0;
						if($value['requested_discount'] == 2)
						{
							$discount = $value['discount'];
						}

					$discount = $value['discount']+$value['discount_coupon'];

					$discount_price = $get_price * $discount / 100;
					$discounted_price = $get_price - $discount_price;


?>                                          
                                          <tr>
                                            <td><?php echo $key+1?></td>
                                            <td style="text-align:left;">
                                            <a href="javascript:void(0);" class="tooltip" title="<?php if($value['status'] == 0) { echo 'Rejected'; } elseif($value['status'] == 1) { echo 'Congratulations! Your manuscript has been finally accepted. Kindly contact to know the instructions for payments of the page charges here: contact@journalmanuscript.com.'; } elseif($value['status'] == 2) { echo 'Peer review completed. We have sent you the review comments by email. If not received, please write us here : contact@ikpress.org.'; } elseif($value['status'] == 3) { echo 'Your Manuscript is with peer reviewers. Once minimum number of quality review comments are received, we\'ll contact you. Thanks for your cooperation.'; } elseif($value['status'] == 4) { echo 'Paid'; } elseif($value['status'] == 5) { echo 'Peer review completed. We have sent you the review comments by email. If not received, please write us here : contact@ikpress.org.'; } elseif($value['status'] == 6) { echo 'Under Peer Review'; } elseif($value['status'] == 7) { echo 'Under Final Evaluation'; } elseif($value['status'] == 8) { echo 'Withdrawn'; }?>">
											<?php  echo substr($value['date'],0,4)."/"?><?php echo get_short_name($value['journal_id'])?><?php echo "/". $value['Id'] . $revised;?>

                                             </a>
                                             </td>
                                            <td style="text-align:left;"><?php echo $value['title']?></td>
                                            <td style="text-align:left"><?php if($value['requested_discount'] == 0) { echo '<span class="normal_link"><a href="'.site_url('user/discountrequest/'.$value['Id']).'">Send Request</a></span>'; } elseif($value['requested_discount'] == 1) { echo 'Pending'; } elseif($value['requested_discount'] == 2) { echo $value['discount']; }  elseif($value['requested_discount'] == 3) { echo 'Rejected'; }?></td>
                                          </tr>
<?php
				} 
			}
			else
			{
				?>
                                          <tr>
                                            <td colspan="8"><span class="red">No Manuscript Found</span></td>
                                          </tr>
<?php
}
?>                                          
<tbody>
                                        </table>
  

                        
                        
                    </div>
                    <?php $this->load->view('frontend/includes/user-right');?> 
                </div>
            </div>
        </div>
<style>
ul.mytabs li, ul.mytabs li a
{
	border-top:none !important;
	background-color:#08B469;
	font-weight:bold;
}

ul.mytabs li.active a
{
background-color:#DEFBEE;
	border-left:#CCC 1px solid !important;
	border-top:#CCC 1px solid !important;
}
</style>