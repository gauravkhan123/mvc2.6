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
                        	<h2>Announcement & News</h2>
	<?php
    	if(!empty($data))
		{			
			foreach($data as $key=>$value)
			{
	?>                        <div class="article-field-group">      
                            <h3><?php echo strip_tags($value['name']);?></h3>
                            <p><?php  echo substr($value['description'],0,250).get_dots('announcement_news','description',$value['Id'],250) ?></p>
                            <a class="readmore" href="<?php echo site_url("announcement/".$value['alias']);?>">Read More</a>
                            </div>
	<?php	
        	}
    	}
    ?> 
                        </div>
	<?php 
    if($pagination)
    {    
    ?>
                                        <div class="pagination">
                                        <?php echo $pagination;?>
                                        </div>            
    <?php
    }
    ?>                       
                        
                    </div>
 					<?php echo $this->load->view("frontend/includes/right");?>
                </div>
            </div>
        </div>
        
        