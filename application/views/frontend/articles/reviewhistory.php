<table width="100%" border="0" cellspacing="0" cellpadding="0" id="wrapper">

  <tr>

    <?php echo $this->load->view("frontend/includes/left");?>

    <td id="ContentPANE-centerPane">
    
    <?php echo $this->load->view("frontend/includes/journal_header");
	
	?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

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

                                        <div id="BOX2_HEADINGBG"></div>

<div style="min-height:260px;">

<?php /*?>                                        <p><?php echo $rs_mcx_cnt['name'];?>, <?php if($rs_mc_cnt['issn']) {?>

                                        <strong>ISSN No. : <?php echo $rs_mc_cnt['issn'];?></strong><br />

                                        <?php } ?>

                                        <?php echo $rs_mcx_cnt['issn'];?></p><?php */?>
                                        
<p><?php echo $data['journal']['name'];?>, <?php echo get_corresponing_value('journals','issn',$data['main_cat'],'Id');?>,Vol.: <?php echo $data['volume'];?>, Issue.: <?php echo $data['issue']['name'];?></p>                                        

                                        <p>&nbsp;</p>

                                        <p><em style="color:#990000; font-weight:bold; font-size:16px;"><?php echo ucwords(str_replace("_"," ",$data['article_type']));?></em></p>

                                       <p>&nbsp;</p>

                                        <p><?php echo $data['name'];?></p>

                                       <p>&nbsp;</p>                                        

                                        <p><strong><?php echo $data['authors'];?></strong></p>

                                         <p>&nbsp;</p>



<?php if(get_settings(3)) { echo "<p><strong>General Comment</strong></p><p>".get_settings(3)."</p>";}?>                                     

<p>&nbsp;</p>    

                                        

<?php if($data['specific_comment']) { echo "<p><strong>Specific Comment</strong></p><p>".$data['specific_comment']."</p>";}?>                                         

                                        </div>                                        

                                        <p id="clear"><p style="float:right"><input type="button" name="review_history>" value="Back" onclick="parent.location='<?php echo $this->agent->referrer();?>'"  /><p id="clear"></p>

                                        

<?php if($data['show_table']) {
	?>   

                                     

                                        <p><strong>Peer review history</strong></p>

                                        <p>&nbsp;</p>

                                        <table width="97%" style="border:1px #999 solid;" align="center">

  <tr>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid; padding:8px;"><strong>Stage</strong></td>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid;; padding:8px;"><strong>Description</strong></td>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid;; padding:8px;"><strong>File 1</strong></td>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid;; padding:8px;"><strong>File 2</strong></td>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid;; padding:8px;"><strong>Date</strong></td>

  </tr>                                        

          <?php

/*			$sl = 0; 

			$stages = "select * from stages where article_id = '".(int)$_GET['aid']."' order by Id";

			$rs = mysql_query($stages);

			$total = mysql_num_rows($rs);			

			while($result = mysql_fetch_assoc($rs)) {

			$sl++;*/

			?>

<?php
$stages = get_few_record("SELECT * FROM stages WHERE article_id = '".(int)$this->uri->segment(2)."' ORDER BY Id");

if(!empty($stages))
{
	foreach($stages as $key=>$value)
	{
?>
  <tr>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid; padding:8px;"><?php if($value['title']) { echo $value['title']; } else { echo "NA"; } ?></td>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid;; padding:8px;"><?php if($value['description']) { echo $value['description']; } else { echo "NA"; } ?></td>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid;; padding:8px;"><?php if($value['file_1']) {?>
    
<a target="_blank" href="<?php echo (($value['article_id'] <= '7077') ? 'http://www.sdiarticle1.org/prh/'.oldJournalFolder($this->uri->segment(2)).getFolderNameYear($this->uri->segment(2)).$value['file_1'] : $value['file_1']);?>" title="<?php echo $value['file_1'];?>" rel="nofollow">    
    
    
    File 1 
    </a><?php }  else { echo "NA"; }?></td>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid;; padding:8px;"><?php if($value['file_2']) {?>
    
    <a target="_blank" href="<?php echo (($value['article_id'] <= '7077') ? 'http://www.sdiarticle1.org/prh/'.oldJournalFolder($this->uri->segment(2)).getFolderNameYear($this->uri->segment(2)).$value['file_2'] : $value['file_2']);?>" rel="nofollow">File 2 </a><?php } else { echo "NA"; }?>
    
    </td>

    <td style="border-right:1px #999 solid;border-bottom:1px #999 solid;; padding:8px;"><?php if($value['date']) { echo $value['date']; } else { echo "NA"; } ?></td>

  </tr>

          <?php

}
}

if(!count($stages)) 
{

			?>

  <tr>

    <td colspan="5" style="padding:8px;" class="red">No records available</td>

  </tr>   

          <?php

}

			?>           

</table>

<?php } ?>                                        								</div>

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

    </table>

    </td>

    <?php echo $this->load->view("frontend/includes/right");?>

  </tr>

</table>