<table width="100%" border="0" cellspacing="0" cellpadding="0" id="wrapper">

  <tr>

    <?php echo $this->load->view("frontend/includes/left");?>

    <td id="ContentPANE-centerPane">

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
                                        <div id="BOX2_HEADINGBG"><div id="BOX2_HEADING"><?php echo $data['name'];?></div><p id="clear"></p></div>
                                        <div style="min-height:460px;">
                                    
                                    <?php echo $data['description'];?>
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