<div class="oamid">
<div class="container">
<div class="row">

<div class="col-md-9">


<div class="well" style="background:#FFFFFF">
<form method="post" name="paynow" id="paynow" action="<?php echo site_url('paynow/'.$aid.'/'.$file)?>">
				<div class="about-txt">
                	<h2 class="mainh2">Payment Mode<span></span></h2>
					<ul style="list-style-type:none">
                    	<li><input type="radio" name="mode" value="paypal" checked="checked" /> Paypal</li>
                    </ul>
					<h2 class="mainh2">Product (Download Access)<span></span></h2>
                    
                    <p>Full Article - <?php echo strip_tags($articledetails['name']);?></p>                    
<?php /*?>					<h3>Access For (in hours)</h3>
					<ul style="list-style-type:none" id="hour_radios">
                    	<li><input type="radio" name="hours" id="hours24" value="24"  class="hours_ul" checked="checked" /> 24</li>
                    	<li><input type="radio" name="hours" id="hours48" value="48"  class="hours_ul"/> 48</li>
                    	<li><input type="radio" name="hours" id="hours72" value="72"  class="hours_ul"/> 72</li>
                    </ul> <?php */?>   

                    <input type="hidden" name="hours" id="hours" value="24" />
					<h2 class="mainh2">Amount<span></span></h2>
                    
                    <p>USD : $<span id="amount"><?php echo $price['full_article_price'];?></span></p>
                    <p>
                    <input type="hidden" id="article_id" name="article_id" value="<?php echo $aid;?>" />
                    <input type="hidden" id="file_name" name="file_name" value="<?php echo $file;?>" />
                    <input type="hidden" id="item_name" name="item_name" value="Download Access - <?php echo strip_tags($articledetails['name']);?>" />                    
                    <?php if(!empty($price['full_article_price']))
					{
					?>
					<br />
                    <input type="submit" id="submit" name="submit" value="Pay Now" />
                    <?php
					}
					else
					{
						echo "Sorry Price is not set for this article.";	
					}
					?>
                    </p>
				</div>
				
                </form>
				
</div>


</div>
<?php echo $this->load->view("frontend/includes/right");?>
</div>
</div>
</div>