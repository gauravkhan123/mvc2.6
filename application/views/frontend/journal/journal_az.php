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
                                        <div id="BOX2_HEADINGBG">
                                          <div id="BOX2_HEADING">List of Journals</div>
                                          <p id="clear"></p></div>
                                          
                                          <p class="alphabets">

										  	<?php 

											foreach(range('a','z') as $letter){





$journals = get_few_record("select Id,name from journals where publish=1 and LEFT(name,1) = '".$letter."' order by name");

if($journals > 0) {												

		echo "<a href='#".ucfirst($letter)."'>".ucfirst($letter)."</a>&nbsp;&nbsp;";

} else {

		echo ucfirst($letter)."&nbsp;&nbsp;";

}

											}

											?>

                                          </p>
    
<?php
	foreach(range('a','z') as $letter)
	{
 ?>                                   
                                        <div style="margin-top:10px; padding-bottom:0px;" id="BOX2_content">
                                            
                                          <p id="BOX_contentHEADING_subject"><?php echo ucfirst($letter);?></p>
                                            <p></p>
                                          <p id="line"><img width="1" height="1" src="images/trans.gif"></p>

<?php
$journals = get_few_record("select Id,name from journals where publish=1 and LEFT(name,1) = '".$letter."' order by name");

if(!empty($journals))
{
	foreach($journals as $jour)
	{
?>                                            
                                            <p id="journal_link">
                                                <a href="<?php echo site_url('journal/'.$jour['Id']);?>">
                                                	<?php echo $jour['name'];?>
                                                    <a name="<?php echo ucfirst($letter);?>"></a>
                                                </a>
                                            </p>
	<?php
        }
    }
    else
    {
    ?>  
    <p id="journal_link">
                                                
                                                	No journal starts with this letter.
                                                
                                            </p>
    <?php
    }
    ?>
                                        </div>
<?php
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