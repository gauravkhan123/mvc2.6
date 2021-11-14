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
                    	<div class="about_left artical">
                        	<h2>Articles</h2>
<?php 
if(!empty($results)){
	foreach($results as $key => $val)
	{
	?>                      <div class="article-field-group">      
                            <p><?php echo ucfirst(strtolower(strip_tags($val->name))); ?></p>
                            <a class="readmore" href="<?php echo base_url("abstract/".$val->Id); ?>">Read More</a>
                            </div>
<?php	
	}
}
?> 
                        </div>
<?php	echo $links;  ?>                        
                        
                    </div>
 					<?php echo $this->load->view("frontend/includes/right");?>
                </div>
            </div>
        </div>