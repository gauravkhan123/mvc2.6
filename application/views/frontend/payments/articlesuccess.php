<div class="mid">
	<div class="web-wrap">
		 <?php $this->load->view('frontend/includes/slider');?>
	
		<div class="content">
			<div class="left-side">
               	<h3>Order Successfull</h3>
				<p>Thanks for the payment.</p>
				<p><input type="button" id="download_now" name="download_now" value="Download Now" onclick="location.href='<?php echo site_url('download/'.base64url_encode($aid.'@@'.'pf'));?>'" /></p>
            </div>
            </div>                     
				<?php $this->load->view('frontend/includes/right');?>              
		</div>
	</div>
</div>