   		
        <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
				
                    <div class="col-lg-9 border-right">
                    	<div class="row">
                            		
								 	<div class="col-lg-3 col-sm-6">
									
                                	<div class="global">
                           	   			 <img src="<?php echo site_url();?>media/jours/200/<?php echo $journal['image'];?>" width="197">
                                         <?php if($issue['Id']) {?>
                                        <p><a href="<?php echo site_url('issue/'.$issue['Id']);?>">Current Issue <?php echo $issue['year']; ?> <br />Volume - <?php echo $issue['volume']; ?> <br /><?php echo 'Issue - '.$issue['name']; ?></a> </p>
                                         <?php } ?>
                                        <?php if($journal['upcoming']) {?>
                                        <p>Coming on : <strong><?php echo $journal['upcoming_date'];?></strong></p>
                                         <?php } ?>  
                                	</div>
                              
							  </div>
                                 	<div class="col-lg-9 col-sm-6">
									<div class="well"style="background-color:#FFFFFF;">
                                	<div class="globalecology">
                                    	<h2 class="mainh2"><?php echo $journal['name'];?></h2>
                                        <span>About this Journal</span>
                                        <?php  echo $journal['journal_home']; ?>
                                    </div>
									</div>
                                </div>
                                	
                                
                            </div>
                        <div class="row">
                        	<div class="col-lg-12">
							<div class="well"style="background-color:#FFFFFF;">
                            <div class="borderbottom"> &nbsp;</div>
                            	<div class="articalmain row">
											<div class="col-lg-6 col-sm-6">
                                        	<h2 class="mainh2">Recent Articles</h2>                               
<?php
foreach($article as $key=>$val)
{ 
?>                                
                                    	<div class="articalbox">
                                            <span><a  href="<?php echo site_url('abstract/'.$val['Id']);?>"><?php echo substr(strip_tags($val['name']),0,45).get_dots('articles','name',$val['Id'],45)?></a></span>
                                            <p><?php  echo substr(strip_tags($val['abstract']),0,85).get_dots('articles','abstract',$val['Id'],85) ?></p>
                                        </div>
										
<?php
}
?>                                            
									<a href="<?php echo site_url();?>journal-articles/<?php echo $idGET;?>" class="readmore">View all...</a>
                                    </div>                                
                                	<div class="col-lg-6 col-sm-6">
									<h2 class="mainh2">Announcement & New</h2> 
		                                    
                                    			
                                                <?php echo $journal['announcement']; ?>
                                                
                                        </div>
                                    </div>
                            </div>
                        </div>
						</div>
                    </div>
 					<?php echo $this->load->view("frontend/includes/right");?>
                </div>
            </div>
        </div>