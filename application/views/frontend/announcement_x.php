<div class="mid">
	<div class="web-wrap">
	 <?php $this->load->view('frontend/includes/slider');?>	
		<div class="content">
			<div class="left-side">
				<div class="announcement-news">
					<h3>Announcement <span>& News</span></h3>
    <?php
    	if(!empty($data))
		{
			?>
            					<ul>
            <?php
			foreach($data as $key=>$value)
			{
	?>                 
						<li>
							<h5><a href="<?php echo site_url("announcement/".$value['alias']);?>"><?php echo strip_tags($value['name']);?></a></h5>
							<p><?php  echo substr($value['description'],0,250).get_dots('announcement_news','description',$value['Id'],250) ?></p>
                        					<p><a href="<?php echo site_url("announcement/".$value['alias']);?>">Read More...</a></p>
						</li>                                            
<?php
	}
	?>
					</ul>
                    
<?php 
if($pagination)
{    
?>
                                    <div style="text-align:left; padding-left:10px;" class="pagination">
                                    <?php echo $pagination;?>
                                    </div>            
<?php
}
?>                        
                    
    <?php
}
else
{
	?>
					<p>No Announcement Available</p>   
    <?php
}
?>   
				</div>
			
			</div>
		
		<?php $this->load->view('frontend/includes/right');?> 
		</div>
	</div>
</div>
