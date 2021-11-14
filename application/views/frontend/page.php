        <?php $this->load->view('frontend/includes/slider');?>
        
                <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	
                    <div class="col-lg-9 border-right">
                    	<div class="about_left">
						
                        	<h2 class="mainh2"><?php echo $data['name'];?><span></span></h2>
                            <?php echo $data['description'];?>
                        </div>
                    </div>
                    	<?php $this->load->view('frontend/includes/right');?> 
                </div>
            </div>
        </div>