   		<!---banner--->
        <div class="banner">
           		 <div class="container">
                 	<div class="row">
                        &nbsp;
                    </div>
                </div>
        </div>

        
        <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right">
                    	<div class="about_left">
                        	<h2><?php echo $data['name'];?></h2>
                            <?php echo $data['description'];?>
                        </div>
                    </div>
                    	<?php $this->load->view('frontend/includes/right');?> 
                </div>
            </div>
        </div>