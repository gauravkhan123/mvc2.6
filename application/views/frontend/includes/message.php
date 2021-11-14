<?php
 if($this->session->flashdata('success'))
 {
?>
<div class="web-wrap" style="clear:both; margin-top:10px;">
<div class="container alert success">
                            <h4>Success</h4>
                        	<?php echo $this->session->flashdata('success');?></div></div>
<?php
 }
?>
<?php
 if($this->session->flashdata('error'))
 {
?>  
	<div class="web-wrap" style="clear:both; margin-top:10px;">                        
<div class="container alert error">
                            <h4>Error</h4>
                        	<?php echo $this->session->flashdata('error');?></div></div><?php
 }
?>

<style>

.alert {
    margin-bottom: 10px;
    padding: 0 10px 10px 10px;
	border-radius:5px;
}

.success {
    border: 1px solid #57b053;
    background: #b8e7b6;
}

.error {
    border: 1px solid #ff0000;
    background: #ffd5d5;
}

</style>