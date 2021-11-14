<?php
 if($this->session->flashdata('success'))
 {
?>
<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Success</h4>
                        	<?php echo $this->session->flashdata('success');?></div>
<?php
 }
?>
<?php
 if($this->session->flashdata('error'))
 {
?>                            
<div class="alert alert-error">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Error</h4>
                        	<?php echo $this->session->flashdata('error');?></div><?php
 }
?>