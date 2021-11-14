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
                    	<div class="journals">
                        <h1 class="journal_heading">List of Journals</h1>
                        
<?php
if(!empty($data['subjects']))
{
	foreach($data['subjects'] as $value)
	{
 ?>                           
                        	<div class="journals_box">
                            	<strong><?php echo $value['name'];?></strong>
<?php
$journals = get_few_record("select Id,name from journals where publish=1 and main_cat='".$value['Id']."' order by name");

if(!empty($journals))
{
	foreach($journals as $jour)
	{
?>                                     
                                
                                <p><a href="<?php echo site_url('journal/'.$jour['Id']);?>">
                                                	<?php echo $jour['name'];?>
                                                </a>
                                                </p>
	<?php
        }
    }
    else
    {
    ?> 
    <div>
                                                
                                                	No Journal Listed in this subject.
                                                
                                            </div>    
    <?php
    }
    ?>                                            
                                                    
                            </div>
<?php
	}
}
else
{
?>  
    <div>
                                                
                                                	No Subject available.
                                                
                                            </div>
<?php
}
?>                            
                         </div>
                        
                    </div>
 					<?php echo $this->load->view("frontend/includes/right");?>
                </div>
            </div>
        </div>