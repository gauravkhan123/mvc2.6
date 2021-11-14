        <?php $this->load->view('frontend/includes/slider');?>
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	
                       	<ul class="nav tab nav-tabs mytabs">
							<h2 class="mainh2">Published Menuscript<span></span></h2>
  <li><a href="<?php echo site_url('user/myaccount');?>">My Profile</a></li>
  <li><a href="<?php echo site_url('user/submitmanuscript');?>">New Submission</a></li>
  <li><a href="<?php echo site_url('user/inprocessmanuscript');?>">In Process</a></li>
  <li><a href="<?php echo site_url('user/othersmanuscript');?>">Reviewer Center</a></li>
  <li class="active"><a href="javasccript:void();">Published</a></li>
  
</ul>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped mytable">
                                          <tr>
                                            <th>Sr.No.</th>
                                            <th>Menuscript No.</th>
                                            <th>Menuscript Title</th>
                                            <th>Status</th>
                                            <?php /*?><th>Payment</th><?php */?>
                                            <th>Print</th>
                                            <th>Invoice</th>                                            
                                          </tr>
<?php

			$manuscripts = get_few_record("select * from manuscript where author_id='".$userdata['Id']."' and publish=1 order by Id desc");
			
			if(!empty($manuscripts))
			{
				foreach($manuscripts as $key=>$value)
				{
					
					$discount = $value['discount']+$value['discount_coupon'];
					
					$discount_price = get_settings(1)*$discount/100;
					$discounted_price = get_settings(1)-$discount_price;					

?>                                          
                                          <tr>
                                            <td id="adminBOX4_contentROWH2"><?php echo  $key+1?></td>
                                            <td id="adminBOX4_contentROWH2" style="text-align:left;"><?php  echo substr($value['date'],0,4)."/" . get_short_name($value['journal_id']) . "/". $value['Id']?></td>
                                            <td style="text-align:left;" id="adminBOX4_contentROWH2"><?php echo $value['title']?></td>
                                            <td id="adminBOX4_contentROWH2"><?php if($value['status'] == 0) { echo 'Rejected'; } elseif($value['status'] == 1) { echo 'Accepted'; } elseif($value['status'] == 2) { echo 'Revision Required'; } elseif($value['status'] == 3) { echo 'On Process'; } elseif($value['status'] == 4) { echo 'Paid'; }?></td>
                                            <?php /*?><td id="adminBOX4_contentROWH2"><?php if($value['status'] == 1) { ?>
                                            <form name="paynow" method="post" action="<?php echo site_url('user/paypal')?>">
                                            <input type="hidden" name="mid" value="<?php echo $value['Id']?>" />
                                            <input type="hidden" name="amount" value="<?php echo $discounted_price?>" />
                                            <input type="submit" name="submit" value="Pay Now" /></form><?php } elseif($value['status'] == 4) { echo $value['payment'];} else { echo 'N/A'; } ?></td><?php */?>
                                            <td id="adminBOX4_contentROWH2"><?php if($value['status'] == 4) { echo '<span class="normal_link"><a href="'.site_url('user/invoice/'.$value['Id']).'" target="_blank">Print</a></span>'; } else { echo 'N/A'; }?></td>
<td id="adminBOX4_contentROWH2"><?php if($value['status'] == 4) { ?>
                    <form name="pdfdownload" target="_blank" action="http://pdfmyurl.com">
                    
<input type="hidden" name="url" value="<?php echo site_url('user/invoicehidden/'.$value['Id']);?>" />
<input type="hidden" name="--page-size" value="A4" />
<input type="hidden" name="--filename" value="<?php  echo "SD_invoice_".str_replace("/","-",manuscriptNo($value['Id']));?>.pdf" />
                    <input type="submit" value="Download" />
                    </form>
					<?php } else { echo 'N/A'; }?></td>                                            
                                          </tr>
<?php
				} 
			}
			else
			{
?>
                                          <tr>
                                            <td id="adminBOX4_contentROWH2" colspan="7"><span class="red">No Manuscript Found</span></td>
                                          </tr>
<?php
}
?>                                         
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