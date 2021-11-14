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



<?php if(get_settings(4)) { echo "<p><strong>General Guideline for Comments</strong></p><p>".get_settings(4)."</p>";}?>                                     

<p>&nbsp;</p>    

                                        
   <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'sciencedomaininternational'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>                                       

                                        </div>                                        

                                        <p id="clear"><p style="float:right"><input type="button" name="review_history>" value="Back" onclick="parent.location='<?php echo $this->agent->referrer();?>'"  /><p id="clear"></p>

                                        
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

    </table>

    </td>

    <?php echo $this->load->view("frontend/includes/right");?>

  </tr>

</table>