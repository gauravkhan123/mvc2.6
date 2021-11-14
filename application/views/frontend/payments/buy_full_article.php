<html>
<head>
<script>
function form_submit() {
	document._xclick.submit();
}
</script>
</head>
<body onLoad="form_submit();" style="height:200px;">
<h2 style="text-align:center;">Please wait....</h2>
<p style="text-align:center;"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/loading.gif" alt="loading"></p>
<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="ikpress.finance@gmail.com">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="item_name" value="<?php echo $item_name;?>">
    <input type="hidden" name="amount" value="<?php echo $amount;?>">
    <input type="hidden" name="return" value="<?php echo $return_url;?>">
    <input type="hidden" name="cancel_return" value="<?php echo $cancel_return;?>">
    <input type="hidden" name="custom" value="<?php echo $custom;?>">    
    <input type="hidden" name="notify_url" value="<?php echo $ipn_url;?>">
</form>
</body>
</html>