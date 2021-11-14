   		<!---banner--->
        <div class="banner">
           		 <div class="container">
                 	<div class="row">
                        &nbsp;
                    </div>
                </div>
        </div>
<?php 
$sql="select * from issues where publish=1 and main_cat='".$idGET."' group by year order by year desc";
$res = $this->db->query($sql);
$records = $res->result_array();

if(!empty($records))
{
	foreach($records as $key=>$value)
	{
		$sql="select * from issues where publish=1 and main_cat='".$idGET."' and year='".$value['year']."' group by volume order by volume desc";
		$query2 = $this->db->query($sql);
		$records2[] = $query2->result_array();
	
	
	}
}

?>          
        <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right">
                    	<div class="issumain">
                        	<h1 class="global-economics">Journal of Global Economics, Management and Business Research  </h1>
                            
                            
		<?php 
        foreach($records2 as $key=>$value)
        {
            foreach($value as $keys=>$val)
            {
            ?>                              
                             	<div class="rowissu">
                                	<h2><?php echo $val['year']." - Volume ".$val['volume'];?></h2>
				<?php
                $sql_jr="select * from issues where publish=1 and volume='".$val['volume']."' and year='".$val['year']."' and main_cat='".$idGET."' order by Id";
                $query3 = $this->db->query($sql_jr);
                $result_jr = $query3->result_array();
                $total_jr=count($result_jr);
					foreach($result_jr as $jrkey=>$jrval)
					{
						?>                                    
                                    <div class="issuecell"><a href="<?php echo site_url('issue/'.$jrval['Id']);?>"><?php echo 'Issue '.$jrval['name']?></a></div>
               <?php
					}
               ?>
                                </div>
            <?php
            }
            ?>                                             
        <?php
        }
        ?>         
                                    
                        </div>
                        
                    </div>
 					<?php echo $this->load->view("frontend/includes/right");?>
                </div>
            </div>
        </div>