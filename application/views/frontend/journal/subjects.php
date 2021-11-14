<table width="100%" border="0" cellspacing="0" cellpadding="0" id="wrapper">

  <tr>

    <?php echo $this->load->view("frontend/includes/left");?>

    <td id="ContentPANE-centerPane">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tbody><tr>
        <td id="contentPANE_CELLright_full">
        <div id="BOX2_top-tail">
            <div id="BOX2_right-tail">
                <div id="BOX2_bot-tail">
                    <div id="BOX2_left-tail">
                        <div id="BOX2_top-left">
                            <div id="BOX2_top-right">
                                <div id="BOX2_bot-right">
                                    <div id="BOX2_bot-left">
                                        <div id="BOX2_indent">
<div class="breadcrumb"><a href="index.php">Home</a> &gt; Subjects</div>                                        
                                        <div id="BOX2_HEADINGBG"><div id="BOX2_HEADING">Subjects</div>
                                        <p id="clear"></p></div>
    
 <?php
if(!empty($data['subjects']))
{
	foreach($data['subjects'] as $value)
	{
 ?>                                    <div style="margin-top:10px; padding-bottom:0px;" id="BOX2_content">             
                                        <div style="margin-top:10px; padding-bottom:0px;" id="BOX2_content">
                                            
                                          <p id="BOX_contentHEADING"><?php echo $value['name'];?></p>
                                            <p></p>
                                          <p id="line"><img width="1" height="1" src="images/trans.gif"></p>
                                            <p id="BOX2_btn"><a href="<?php echo site_url('journals/'.$value['Id']);?>">See all Journals of this Subject</a></p>
                                        </div>                                                                     
                                        </div>
<?php
	}
}
?>                                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <p id="clear"></p>
        </td>
      </tr>
    </tbody></table>

    </td>

    <?php echo $this->load->view("frontend/includes/right");?>

  </tr>

</table>