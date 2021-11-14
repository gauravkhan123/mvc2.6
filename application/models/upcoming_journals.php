<div class="mid">
	<div class="web-wrap">
	 <?php $this->load->view('frontend/includes/slider');?>	
		<div class="content">
			<div class="left-side">
				<div class="announcement-news">
					<h3>Upcoming <span>Journals</span></h3>
    
<?php

if(!empty($results))
{
	foreach($results as $key => $value)
	{
 ?>                                   
                                        <div style="margin-top:10px; padding-bottom:0px;" id="BOX2_content">
                                            
                                          <p id="BOX_contentHEADING_subject"><?php echo $value->name;?></p>
                                            <p></p>
                                          <p id="line"><img width="1" height="1" src="images/trans.gif"></p>

<?php
$journals = get_few_record("select Id,name from journals where publish=1 and main_cat='".$value->Id."' and upcoming=1 order by name");

if(!empty($journals))
{
	foreach($journals as $jour)
	{
?>                                            
                                            <p id="journal_link" style="color:#FF0000 !important;">
                                                <a href="<?php echo site_url('journal/'.$jour['Id']);?>">
                                                	<?php echo $jour['name'];?>
                                                </a>
                                            </p>
	<?php
        }
    }
    else
    {
    ?>  
    <p id="journal_link"  style="color:#FF0000 !important;">
                                                
                                                	No Journal Listted in this subject.
                                                
                                            </p>
    <?php
    }
    ?>
                                        </div>
                                        
<?php
	}

	echo $links;
}
else
{
?>  
<div style="margin-top:10px; padding-bottom:0px;" id="BOX2_content">
                                            
                                          <p id="BOX_contentHEADING_subject">No Subject for Journal</p>
                                           
                                        </div>
<?php
}
?>
            
				</div>
			
			</div>
		
		<?php $this->load->view('frontend/includes/right');?> 
		</div>
	</div>
</div>
