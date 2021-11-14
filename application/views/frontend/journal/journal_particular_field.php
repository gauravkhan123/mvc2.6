<table width="100%" border="0" cellspacing="0" cellpadding="0" id="wrapper">

  <tr>

<?php echo $this->load->view("frontend/includes/journal_left");?>

    <td id="ContentPANE-centerPane">

<?php echo $this->load->view("frontend/includes/journal_header");?>         

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

<?php 
									if($field == 'about-journal')
									{
										$page_title = "About this Journal";
										$field_code = "about_journal";
									}
									if($field == 'authors-instruction')
									{
										$page_title = "Author's Instruction";
										$field_code = "authors_instruction";
									}
									if($field == 'manuscript-submission')
									{
										$page_title = "Manuscript Submission";
										$field_code = "manuscript_submission";
									}	
									if($field == 'articles-press')
									{
										$page_title = "Articles in Press";
										$field_code = "article_press";
									}
									if($field == 'abstracting-indexing')
									{
										$page_title = "Abstracting & Indexing";
										$field_code = "abstracting_indexing";
									}
									if($field == 'editorial-policy')
									{
										$page_title = "Editorial Policy";
										$field_code = "editorial_policy";
									}
									if($field == 'editorial-policy')
									{
										$page_title = "Editorial Policy";
										$field_code = "editorial_policy";
									}	
									if($field == 'editorial-board-members')
									{
										$page_title = "Editorial Board Members";
										$field_code = "editorial_board_members";
									}																																																						
									?>                                        

                                        <div id="BOX2_HEADINGBG"><div id="BOX2_HEADING"><?php echo $page_title;?> </div><p id="clear"></p></div>

                                        <div style="min-height:460px;">
                                        
                                       <?php echo $data['journal'][$field_code];?> 

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

    </table>

    </td>

    <?php echo $this->load->view("frontend/includes/right");?>

  </tr>

</table>