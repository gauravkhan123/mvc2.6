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
                                        <div id="BOX2_HEADINGBG"><div id="BOX2_HEADING">SDI Awards</div>
                                        <p id="clear"></p></div>
    <?php
    	if(!empty($data))
		{
			foreach($data as $key=>$value)
			{
	?>    
                                    
                                        <div style="margin-top:10px; padding-bottom:0px;" id="BOX2_content">
                                            
                                          <p id="BOX_contentHEADING"><?php echo $value['name'];?></p>
                                            <p id="BOX_content"></p><p>&nbsp;</p>
											<?php echo $value['description'];?>
                                            <p>&nbsp;</p>                                            
                                          <p id="line"><img width="1" height="1" src="<?php echo base_url(); ?>assets/themes/frontend/images/trans.gif"></p>
                                            <p id="BOX2_btn"><a href="<?php echo site_url('sdi-award/'.$value['alias']);?>"><img width="58" height="19" src="<?php echo base_url(); ?>assets/themes/frontend/images/btn2_more.gif"></a></p>
                                        </div>

    <?php
			}
		}
	?>    
                                    <div style="text-align:left; padding-left:10px;" class="pagination">
                                    <?php echo $pagination;?>
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
        <p id="clear"></p>
        </td>
      </tr>
    </tbody></table>

    </td>

    <?php echo $this->load->view("frontend/includes/right");?>

  </tr>

</table>