<td id="ContentPANE-leftPane">
    <div id="quickBOX_HEADING"><div id="quickBOX_HEADING_leftIMG"><div id="quickBOX_HEADING_rightIMG">Quick Menu</div></div></div>
    <div id="quickBOX_top-tail">
    	<div id="quickBOX_right-tail">
        	<div id="quickBOX_bot-tail">
            	<div id="quickBOX_left-tail">
                	<div id="quickBOX_top-left">
                    	<div id="quickBOX_top-right">
                        	<div id="quickBOX_bot-right">
                            	<div id="quickBOX_bot-left">
                                	<div id="quickBOX_indent">
                                    <ul>
<li><a href="<?php echo site_url('journals/a-z');?>">Journals (A-Z)</a></li>                                    
<?php
$quicklinks = get_few_record("SELECT * FROM `quicklinks` WHERE 1 AND `publish` = '1' ORDER BY `serial`");

if(!empty($quicklinks))
{
	foreach($quicklinks as $value)
	{
?>
		<li>
        	<a href="<?php echo site_url($value['link']);?>">
				<?php echo $value['title']?>
            </a>
        </li>
<?php
	}
}
?>                                        
                                    </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><p id="clear"></p>
    <div id="quickBOX_Shadow"></div>


    <div id="BOX_HEADING"><div id="BOX_HEADING_leftIMG"><div id="BOX_HEADING_rightIMG">Upcoming  Journals</div>
    </div></div>
    <div id="BOX_right-tail">
    	<div id="BOX_left-tail">
        	<div id="BOX_top-tail">
            	<div id="BOX_bot-tail">
                	<div id="BOX_top-left">
                    	<div id="BOX_top-right">
                        	<div id="BOX_bot-right">
                            	<div id="BOX_bot-left">
                                	<div id="BOX_indent">
                                    <ul>
<?php
$uc_journals = get_few_record("SELECT `Id`,`name` FROM `journals` WHERE 1 AND `publish` = '1' AND `upcoming` = '1' ORDER BY `Id` DESC LIMIT 0,15");

if(!empty($uc_journals))
{
	foreach($uc_journals as $value)
	{
?>                                
        <li>
            <a href="<?php echo site_url('journal/'.$value['Id']);?>">
                <?php echo $value['name']?>
            </a>
        </li>
<?php
	}
}
?>
<?php
if(empty($uc_journals))
{
?>
        <li class="red">
            No Upcoming Journals
        </li>
    </ul>
</div>
<?php
} 
else
{
?>
   </ul>
	<p id="BOX2_btn">
    	<a href="<?php echo site_url('journals/upcoming');?>">
        	<img src="<?php echo base_url(); ?>assets/themes/frontend/images/btn2_more.gif" width="58" height="19" />
         </a>
    </p>
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

    </div><p id="clear"></p>
    <div id="BOX_Shadow"></div>
    </td>