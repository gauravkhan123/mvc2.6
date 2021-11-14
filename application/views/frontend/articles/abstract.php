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
                    	<div class="about_left">

<p><?php echo $journal['name'];?>, <?php if($journal['issn']) {?>

                                        <strong>ISSN No. : <?php echo $journal['issn'];?>,</strong>

                                        <?php } ?>

                                        Vol.: <?php echo $article['volume'];?>, Issue.: <?php echo $issuename['name']; ?></p>

                                        

                                        <p><em style="color:#990000; font-weight:bold; font-size:16px;"><?php echo ucwords(str_replace("_"," ",$article['article_type']));?></em></p>

                                       

                                        <p><?php echo $article['name'];?></p>

                                                                               

                                        <p><strong><?php echo $article['authors'];?></strong></p>

                                         

    <div style="font-weight:bold; background-color:#08B469; margin-bottom:10px; margin-top:10px; color:#FFF; font-size:16px; line-height:50px; clear:both; padding-left:10px;">

    	Abstracts

    </div>

                                         

                                        <p><?php echo $article['abstract'];?></p>

                   

                                        <p><strong>Keywords :</strong> <?php echo $article['keywords'];?></p>                         

<p class="normal_link">

<?php if($article['show_pdf_file']) { 

?>



<?php if(check_multiple_auth($userdata['id'],$article['Id'])) { ?>

    <a href="<?php echo site_url('download/'.base64url_encode($idGET3.'@@'.'pf'));?>" rel="nofollow">

    	<img src="<?php echo base_url();?>assets/themes/frontend/images/pdf.png" /> Download</a> 
    
                                        <?php } 
										else
										{
											?>
                                            
    <a href="<?php echo site_url('download/'.base64url_encode($idGET3.'@@'.'pf'));?>" rel="nofollow">

    	<img src="<?php echo base_url();?>assets/themes/frontend/images/pdf.png" /> Purchase PDF - <?php echo "$".$journal['full_article_price'];?>

    </a>                                             
                                            
                                            
                                        <?php
										}
										?>                                                
    
    
    
    &nbsp;&nbsp;

<?php } ?>

		

<?php if($article['show_provisional_pdf_file']) { ?>

	<a href="download.php?f=<?php echo $article['provisional_pdf_file'];?>&aid=<?php echo $idGET3;?>">

    	<img src="<?php echo base_url();?>assets/themes/frontend/images/pdf.png" /> Provisional PDF

    </a> &nbsp;&nbsp;

<?php } ?>



<?php if($article['html_file']) {?>

	<a href="download.php?f=<?php echo $article['html_file'];?>&aid=<?php echo $idGET3;?>">

    	<img src="<?php echo base_url();?>assets/themes/frontend/images/icon-html.gif"" /> Supplementary Files</a> &nbsp;&nbsp;

<?php } ?>



<?php echo 'Page '.$article['page_no'];?></p>  



<!-- AddThis Button BEGIN -->

<div class="addthis_toolbox addthis_default_style " style="padding:10px; float:right;">

<a class="javascript:void(0);"  style="line-height:16px; padding-right:10px; float:left;">Share</a>

<a class="addthis_button_reddit"></a>

<a class="addthis_button_mendeley"></a>

<a class="addthis_button_twitter"></a> 

<a class="addthis_button_facebook"></a> 

<a class="addthis_button_citeulike"></a> 

<a class="addthis_button_google_plusone_share"></a> 

<a class="addthis_button_stumbleupon"></a> 

<a class="addthis_button_connotea"></a> 

<a class="addthis_button_email"></a> 

</div>

<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50e30d826f4205d7"></script>

<!-- AddThis Button END -->

                        </div>
                    </div>
                    	<?php $this->load->view('frontend/includes/right');?> 
                </div>
            </div>
        </div>