<?php
$userdata = $this->session->userdata('frontuser');
?>
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
<h2><?php echo $issues['year']." - Volume ".$issues['volume'] . "  [Issue ".$issues['name']."]";?></h2>
                    <h3>Contents</h3>                    
<?php
$querys = $this->db->query("select * from articles where sub_cat='".$idGETS."' and  publish=1 order by Id");
$articles = $querys->result_array();

if(!empty($articles))
{
	foreach($articles as $value)
	{
?>     
<div style="border-bottom:#CCC 1px solid; margin:10px 0;">
									<p><em style="color:#990000; font-weight:bold; font-size:16px;"><?php echo ucwords(str_replace("_"," ",$value['article_type']));?></em></p>

                                        <span style="font-weight:bold; padding-left:40px;"><?php echo $value['name'];?></span>

                                        <p><?php echo $value['authors'];?></p>                                        

                                        <p>&nbsp;</p>

                                        <p class="normal_link"><a href="<?php echo site_url('abstract/'.$value['Id']); ?>">[Abstract]</a> &nbsp;&nbsp;

                                        	<?php if($value['page_no']) { ?>
                                        
                                        	<?php echo 'Page '.$value['page_no'];?> &nbsp;&nbsp;
                                        
	                                        <?php } ?>                                         
                                        
                                        <?php if($value['show_pdf_file']) { ?>
                                        
                                       	<?php if(check_multiple_auth($userdata['id'],$value['Id'])) { ?>
                                        
                                        <a href="<?php echo site_url('download/'.base64url_encode($value['Id'].'@@'.'pf'));?>" rel="nofollow"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/pdf.png" /> Download </a>
                                        
                                        <?php } 
										else
										{
											?>
                                        
                                        <a href="<?php echo site_url('download/'.base64url_encode($value['Id'].'@@'.'pf'));?>" rel="nofollow"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/pdf.png" /> Purchase PDF - <?php echo "$".$journal['full_article_price'];?></a>                                         
                                        
                                        <?php
										}
										?>
                                        
                                        &nbsp;&nbsp;
                                        
                                        
                                        <?php } ?> 
                                        <?php if($value['show_provisional_pdf_file']) { ?>
                                        <a href="download.php?f=<?php echo $value['provisional_pdf_file'];?>&aid=<?php echo $value['Id'];?>"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/pdf.png" /> Provisional PDF</a> &nbsp;&nbsp;
                                        <?php } ?>                                           
                                                                                    
                                        </p>
                         </div>

                                        <?php if($value['doi']) { ?>

                                        <p>&nbsp;</p>                                         

										<p><?php echo 'DOI : '.$value['doi'];?></p>

                                        <?php } 
	}
}
?>		                                
                         </div>
                        
                    </div>
 					<?php echo $this->load->view("frontend/includes/right");?>
                </div>
            </div>
        </div>
