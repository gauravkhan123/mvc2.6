<table width="100%" border="0" cellspacing="0" cellpadding="0" id="wrapper">

  <tr>

    <?php echo $this->load->view("frontend/includes/journal_left");?>

    <td id="ContentPANE-centerPane">
    
    <?php echo $this->load->view("frontend/includes/journal_header");
	
	?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td id="contentPANE_CELLleft_full">
        <div id="BOX2_top-tail">
            <div id="BOX2_right-tail">
                <div id="BOX2_bot-tail">
                    <div id="BOX2_left-tail">
                        <div id="BOX2_top-left">
                            <div id="BOX2_top-right">
                                <div id="BOX2_bot-right">
                                    <div id="BOX2_bot-left">
                                        <div id="BOX2_indent">
                                        <div id="BOX2_HEADINGBG"><!--<div id="BOX2_HEADING">&nbsp;</div>--><p id="clear"></p></div>
                                        <div style="min-height:460px;">

                                        <p><?php echo $data['journal']['name'];?>, <?php echo get_corresponing_value('journals','issn',$data['main_cat'],'Id');?>,Vol.: <?php echo $data['volume'];?>, Issue.: <?php echo $data['issue']['name'];?></p>

                                        <p>&nbsp;</p>

                                        <p><em style="color:#990000; font-weight:bold; font-size:16px;"><?php echo ucwords(str_replace("_"," ",$data['article_type']));?></em></p>

                                       <p>&nbsp;</p>

                                        <p><?php echo $data['name'];?></p>

                                       <p>&nbsp;</p>                                        

                                        <p><strong><?php echo $data['authors'];?></strong></p>

                                         <p>&nbsp;</p>

                                        <p>

                                        <div style="background-color:#0066CC; vertical-align:middle; color:#FFFFFF; padding:10px; font-weight:bold; font-size:18px;">Abstracts</div></p>

                                         <p>&nbsp;</p>

                                        <p><?php echo $data['abstract'];?></p>

 <p>&nbsp;</p>                  

                                        <p><strong>Keywords :</strong> <?php echo $data['keywords'];?></p> <p>&nbsp;</p>                        

<p class="normal_link">



<?php if($data['show_pdf_file'] && $data['pdf_file']) { ?>


<a href="<?php echo site_url('download/'.base64url_encode($data['Id'].'@@'.'pf'));?>" rel="nofollow">



<img src="<?php echo base_url(); ?>assets/themes/frontend/images/icon-pdf.gif" /> Full Article - PDF</a> &nbsp;&nbsp;

<?php } 
//'download.php?f=' . $data['provisional_pdf_file'] . '&aid=' . $data['Id'] . '&type=a'
?>



<?php if($data['show_provisional_pdf_file'] && $data['provisional_pdf_file']) { ?>


<a href="<?php echo site_url('download/'.base64url_encode($data['Id'].'@@'.'ppf'));?>" rel="nofollow">

<img src="<?php echo base_url(); ?>assets/themes/frontend/images/icon-pdf.gif" /> Provisional PDF</a> &nbsp;&nbsp;

<?php } 


if($data['show_html_file'] && $data['html_file']) {
	
	?>

<a href="<?php echo site_url('download/'.base64url_encode($data['Id'].'@@'.'hf'));?>" rel="nofollow">

<img src="<?php echo base_url(); ?>assets/themes/frontend/images/icon-file.png" /> 
Supplementary Files
</a> &nbsp;&nbsp;    
    <?php
}
 

if($data['page_no']) 
{
echo 'Page '.$data['page_no'];
}

?>

</p>  



                                        <?php if($data['doi']) { ?>

                                        <p>&nbsp;</p>                                         

										<p><?php echo 'DOI : '.$data['doi'];?></p>

                                        <?php } ?>



<?php /*<p style="margin-top:10px;">Total Downloads/Views : <?php echo $data['download_count'];?></p>*/ ?>

<p style="margin-top:10px;">

<a href="<?php echo site_url('review-history/'.$data['Id'])?>">Review History</a>

&nbsp;&nbsp;

<a href="<?php echo site_url('post-comments/'.$data['Id'])?>#disqus_thread">Comments</a>



  <script type="text/javascript">

    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */

    var disqus_shortname = 'sciencedomaininternational'; // required: replace example with your forum shortname



    /* * * DON'T EDIT BELOW THIS LINE * * */

    (function () {

        var s = document.createElement('script'); s.async = true;

        s.type = 'text/javascript';


        s.src = '//' + disqus_shortname + '.disqus.com/count.js';

        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);

    }());

    </script>  

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

<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50e30d826f4205d7"></script>

<!-- AddThis Button END -->

<br style="clear:both;" />

                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </td>
      </tr>
    </tbody></table>

    </td>

    <?php echo $this->load->view("frontend/includes/right");?>

  </tr>

</table>