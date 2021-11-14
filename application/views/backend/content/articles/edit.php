<div class="container-fluid">
            <div class="row-fluid">
            <?php $this->load->view('backend/includes/leftnav');?>
                
                <!--/span-->
                <div class="span9" id="content">
                <div class="row-fluid">
                         <?php $this->load->view('backend/includes/message');?>
                         
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="<?php echo site_url($this->config->item('backend').'/home')?>">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>
	                                        <a href="<?php echo site_url($this->controller)?>"><?php echo $this->title_plural?></a> <span class="divider">/</span>	
	                                    </li>                                                                                
	                                    <li class="active"><?php echo $title; ?></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $title;?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
<?php
if($id)
{
?>                                
                                     <form class="form-horizontal" name="" method="post" action="<?php echo site_url($this->controller.'/edit/'.$id);?>" enctype="multipart/form-data">
<?php
}
else
{
?>
                                    <form class="form-horizontal" name="" method="post" action="<?php echo site_url($this->controller.'/add');?>" enctype="multipart/form-data">
<?php
}
?>
                                      <fieldset>
                                        <!--<legend>Edit</legend>-->
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name">Manuscript No.</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="manuscript_no" name="manuscript_no" type="text" placeholder="Manuscript No." value="<?php echo set_value('manuscript_no',isset($data['manuscript_no'])?$data['manuscript_no']:''); ?>">
                                            <?php echo form_error('manuscript_no','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="name"> <span class="error">*</span> Journals</label>
                                          <div class="controls">
											<select id="main_cat" name="main_cat" class="span6">
                                              <option value="" >Select</option>
<?php if(!empty($journals))
{
	foreach($journals as $value)
	{
?>                                              
                                              <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == set_value('main_cat',isset($data['main_cat'])?$data['main_cat']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
	}
}
?>                                               
                                            </select>
                                          <?php echo form_error('main_cat','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="year"> <span class="error">*</span> Year</label>
                                          <div class="controls">
											<select id="year" name="year" class="span6">
                                              <option value="" >Select</option>
                                              
<?php
if($id)
{
	$cond = "";
	if($data['main_cat'])
	{
		$cond .= "AND main_cat='".$data['main_cat']."'";
	}

	$years = get_few_record("select year from issues where 1 AND publish = '1' $cond group by year order by year DESC");

	 if(!empty($years))
	{
		foreach($years as $value)
		{
	?>                                              
												  <option value="<?php echo $value['year'];?>" <?php if($value['year'] == set_value('year',isset($data['year'])?$data['year']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['year'];?></option>
	<?php
		}
	}
}
?>                                               
 
                                            </select>
                                          <?php echo form_error('year','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="volume"> <span class="error">*</span> Volume</label>
                                          <div class="controls">
											<select id="volume" name="volume" class="span6">
                                              <option value="" >Select</option>
<?php
if($id)
{
	$cond = "";

	if($data['main_cat'])
	{
		$cond .= "AND main_cat='".$data['main_cat']."'";
	}

	if($data['year'])
	{
		$cond .= "AND year='".$data['year']."'";
	}

$volumes = get_few_record("select volume from issues where 1 AND publish = '1' $cond group by volume order by volume");

	 if(!empty($volumes))
	{
		foreach($volumes as $value)
		{
?>                                              
                                              <option value="<?php echo $value['volume'];?>" <?php if($value['volume'] == set_value('volume',isset($data['volume'])?$data['volume']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['volume'];?></option>
<?php
		}
	}
}
?>                                               
                                            </select>
                                          <?php echo form_error('volume','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="volume"> <span class="error">*</span> Issues</label>
                                          <div class="controls">
											<select id="sub_cat" name="sub_cat" class="span6">
                                              <option value="" >Select</option>
<?php
if($id)
{
	$cond = "";
	
	if($data['main_cat'])
	{
		$cond .= "AND main_cat='".$data['main_cat']."'";
	}

	if($data['year'])
	{
		$cond .= "AND year='".$data['year']."'";
	}	

	if($data['volume'])
	{
		$cond .= "AND volume='".$data['volume']."'";
	}


$issues = get_few_record("select Id,name from issues WHERE 1 $cond group by name order by name");

	 if(!empty($issues))
	{
		foreach($issues as $value)
		{
?>                                              
                                              <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == set_value('sub_cat',isset($data['sub_cat'])?$data['sub_cat']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
		}
	}
}
?>                                               
                                            </select>
                                          <?php echo form_error('sub_cat','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="category"> <span class="error">*</span> Aricle Type</label>
                                          <div class="controls">
											<select id="article_type" name="article_type" class="span6">
                                              <option value="" >Select</option>
<?php

$article_types = get_few_record("select alias,name from article_type where 1 and publish = 1 order by serial asc");

 if(!empty($article_types))
{
	foreach($article_types as $value)
	{
?>                                              
                                              <option value="<?php echo $value['alias'];?>" <?php if($value['alias'] == set_value('article_type',isset($data['article_type'])?$data['article_type']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
	}
}
?>                                               
                                            </select>
                                          <?php echo form_error('article_type','<span class="error-advise">','</span>'); ?>                                            
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Name</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="name" name="name"><?php echo set_value('name',isset($data['name'])?$data['name']:''); ?></textarea>
                                            <?php echo form_error('name','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="authors"><span class="error">*</span> Authors</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="authors" name="authors"><?php echo set_value('authors',isset($data['authors'])?$data['authors']:''); ?></textarea>
                                            <?php echo form_error('authors','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="abstract"><span class="error">*</span> Abstract</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="abstract" name="abstract"><?php echo set_value('abstract',isset($data['abstract'])?$data['abstract']:''); ?></textarea>
                                            <?php echo form_error('abstract','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="full_text">Full Text</label>
                                          <div class="controls">
                                            <textarea name="full_text" id="full_text" class="span6" placeholder="Full Text"><?php echo set_value('full_text',isset($data['full_text'])?$data['title_tag']:''); ?></textarea>
                                            <?php echo form_error('full_text','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Provisional PDF </label>
                                          <div class="controls">
                                            <input class="input-xlarge span3" id="provisional_pdf_file" name="provisional_pdf_file" type="file" placeholder="Provisional PDF" value="<?php echo set_value('provisional_pdf_file',isset($data['provisional_pdf_file'])?$data['provisional_pdf_file']:''); ?>">
<?php
if($id)
{
?>                                                 
                                            <a href="<?php echo base_url().getJournalFilesFolder($data['Id'],'articleid').$data['provisional_pdf_file']; ?>" title="<?php echo $data['provisional_pdf_file'];?>">
												<?php echo $data['provisional_pdf_file']?>
                                            </a>
<?php
}
?>
&nbsp;&nbsp;
<input type="checkbox" name="show_provisional_pdf_file" id="show_provisional_pdf_file" value="1" <?php if("1" === set_value('show_provisional_pdf_file',isset($data['show_provisional_pdf_file'])?$data['show_provisional_pdf_file']:'')) { echo 'checked="checked"'; } ?> />&nbsp;
Show
&nbsp;&nbsp;
<input type="checkbox" name="delete_provisional_pdf_file" id="delete_provisional_pdf_file" value="1" />
&nbsp;Delete
                                            <?php echo form_error('provisional_pdf_file','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> PDF File </label>
                                          <div class="controls">
                                            <input class="input-xlarge span3" id="pdf_file" name="pdf_file" type="file" placeholder="PDF File" value="<?php echo set_value('pdf_file',isset($data['pdf_file'])?$data['pdf_file']:''); ?>">
<?php
if($id)
{
?>                                                 
                                            <a href="<?php echo base_url().getJournalFilesFolder($data['Id'],'articleid').$data['pdf_file']; ?>" title="<?php echo $data['pdf_file'];?>">
												<?php echo $data['pdf_file']?>
                                            </a>
<?php
}
?>
&nbsp;&nbsp;
<input type="checkbox" name="show_pdf_file" id="show_pdf_file" value="1" <?php if("1" === set_value('show_pdf_file',isset($data['show_pdf_file'])?$data['show_pdf_file']:'')) { echo 'checked="checked"'; } ?> />&nbsp;
Show
&nbsp;&nbsp;
<input type="checkbox" name="delete_pdf_file" id="delete_pdf_file" value="1" />
&nbsp;Delete
                                            <?php echo form_error('pdf_file','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="name"><span class="error">*</span> Supplementary File </label>
                                          <div class="controls">
                                            <input class="input-xlarge span3" id="html_file" name="html_file" type="file" placeholder="Supplementary File" value="<?php echo set_value('html_file',isset($data['html_file'])?$data['html_file']:''); ?>">
<?php
if($id)
{
?>                                                 
                                            <a href="<?php echo base_url().getJournalFilesFolder($data['Id'],'articleid').$data['html_file']; ?>" title="<?php echo $data['html_file'];?>">
												<?php echo $data['html_file']?>
                                            </a>
<?php
}
?>
&nbsp;&nbsp;
<input type="checkbox" name="show_html_file" id="show_html_file" value="1" <?php if("1" === set_value('show_html_file',isset($data['show_html_file'])?$data['show_html_file']:'')) { echo 'checked="checked"'; } ?> />&nbsp;
Show
&nbsp;&nbsp;
<input type="checkbox" name="delete_html_file" id="delete_html_file" value="1" />
&nbsp;Delete
                                            <?php echo form_error('html_file','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="page_no">Page Numbers</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="page_no" name="page_no" type="text" placeholder="Page Numbers" value="<?php echo set_value('page_no',isset($data['page_no'])?$data['page_no']:''); ?>">
                                            <?php echo form_error('page_no','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="doi">DOI</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="doi" name="doi" type="text" placeholder="DOI" value="<?php echo set_value('doi',isset($data['doi'])?$data['doi']:''); ?>">
                                            <?php echo form_error('doi','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="keywords"><span class="error">*</span> Keywords</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="keywords" name="keywords"><?php echo set_value('keywords',isset($data['keywords'])?$data['keywords']:''); ?></textarea>
                                            <?php echo form_error('keywords','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="specific_comment"><span class="error">*</span> Specific Comment</label>
                                          <div class="controls">
                                            <textarea class="ckeditor_full" id="specific_comment" name="specific_comment"><?php echo set_value('specific_comment',isset($data['specific_comment'])?$data['specific_comment']:''); ?></textarea>
                                            <?php echo form_error('specific_comment','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="show_table"> Show Peer Table</label>
                                          <div class="controls">
                                            <input type="checkbox" name="show_table" id="show_table" value="1" <?php if("1" === set_value('show_table',isset($data['show_table'])?$data['show_table']:'')) { echo 'checked="checked"'; } ?> />
                                            <?php echo form_error('show_table','<span class="help-inline">','</span>'); ?>
                                          </div>
                                        </div>
							<?php
                            if($id)
                            {
                            ?>                                        
                                        <div class="control-group">
                                          <label class="control-label" for="existing_comment"> Existing States</label>
                                          <div class="controls">
												<?php
                                                $stages = get_few_record("select * from stages where article_id = '".$id."' order by Id");
                                                
                                                     if(!empty($stages))
                                                    {
                                                        foreach($stages as $key=>$value)
                                                        {
                                                ?>                                        
                                                            <div style="margin-top:10px; margin-bottom:10px; border-bottom:#666 1px dashed;">
                                                                <div style="float:left">Title<br /><input type="text" name="exTitle[<?php echo $value['Id'];?>]" value="<?php echo $value['title'];?>" class="exTitle" /><br /><br />Delete <input type="checkbox" name="delete_existing[]" value="<?php echo $value['Id'];?>" /><input type="hidden" name="allFields[<?php echo $value['Id'];?>]" value="<?php echo $value['Id'];?>" /></div>
                                                                <div style="float:left;margin-left:20px;">Description<br /><textarea name="existingFullText[<?php echo $value['Id'];?>]" id="existingFullText" rows="5" style="width:320px;"><?php echo $value['description'];?></textarea></div>
                                                                <div style="margin-left:596px;">
                                                    
                                                                    <div>File 1<br /><input class="span11" type="text" name="exFileOne[<?php echo $value['Id'];?>]" value="<?php echo $value['file_1'];?>" id="exFileOne" />
                                                    
                                                                    </div>
                                                    
                                                                    <div>File 2<br /><input class="span11" type="text" name="exFileTwo[<?php echo $value['Id'];?>]" value="<?php echo $value['file_2'];?>" id="exFileTwo" />
                                                    
                                                                    </div>
                                                    
                                                                    <div>Date (yyyy-mm-dd)<br /><input type="text" name="exAddDate[<?php echo $value['Id'];?>]" value="<?php echo $value['date'];?>" class="datepicker" id="exAddDate_<?php echo $key+1;?>" />
                                                    
                                                                    </div>        
                                                    
                                                                </div>
                                                                <br />
                                                            </div>
                                                <?php
                                                        }
                                                }
                                                ?>
                                          </div>
                                        </div>
							<?php
                            }
                            ?>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="specific_comment"> Add States</label>
                                          <div class="controls">
											<table class="dynatable">

			<tbody>

            	<tr>

					<td><a class="add" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/backend/addNew.png" /></a></td>

                  				</tr>

				<tr class="prototype">

					<td><div style="margin-top:10px; margin-bottom:10px; border-bottom:#666 1px dashed;">

        <div style="float:left">Title<br /><input type="text" name="title[]" id="title" /><br /><br /><a class="remove" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/backend/remove.png" /></a></div>

      

            <div style="float:left;margin-left:20px;">Description<br /><textarea name="fullText[]" id="fullText" rows="5" style="width:320px;"></textarea></div>

            <div style="margin-left:596px;">

                <div>File 1<br /><input type="text" name="fileOne[]" id="fileOne" class="span11" />

                </div>

                <div>File 2<br /><input type="text" name="fileTwo[]" id="fileTwo" class="span11" />

                </div>

                <div>Date (yyyy-mm-dd)<br /><input type="text" name="addDate[]" class="datepicker" value="<?php echo date("Y-m-d");?>" />

                </div>        

            </div>

            <br />

            </div>

            

            

</td>

				</tr>

                </tbody>

		</table>
                                          </div>
                                        </div>
                                        
                                        
							<?php
                            if($id)
                            {
                                                $citation_authors = get_few_record("select * from  citation_authors where article_id = '".$id."' order by Id");
                                                
                                                     if(!empty($citation_authors))
                                                    {								
                            ?>                                        
                                        <div class="control-group">
                                          <label class="control-label" for="existing_comment"> Existing Citation Author</label>
                                          <div class="controls">
												<?php

                                                        foreach($citation_authors as $value)
                                                        {
                                                ?>                                        
                                                            <div style="margin-top:10px; margin-bottom:10px;">

        <input type="text" name="excitation_author[<?php echo $value['Id'];?>]" value="<?php echo $value['title'];?>" class="exTitle" />&nbsp;

        &nbsp;Delete <input type="checkbox" name="delete_existing_citation[]" value="<?php echo $value['Id'];?>" /></div>
                                                <?php
                                                        }
                                                ?>
                                          </div>
                                        </div>
							<?php
								}
                            }
                            ?>                                        
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="specific_comment"> Citation Author</label>
                                          <div class="controls">
											<table class="dynatable">

			<tbody>

            	<tr>

					<td><a class="add" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/backend/addNew.png" /></a></td>

                  				</tr>

				<tr class="prototype">

					<td>

                    <div style="margin-top:10px; margin-bottom:10px;">

						<input type="text" name="citation_author[]" id="citation_author" value="" style="width:300px;" />&nbsp;&nbsp;<a class="remove" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/themes/frontend/images/backend/remove.png" /></a>

            		</div>

            

</td>

				</tr>

                </tbody>

		</table>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="citation_title">Citation Title</label>
                                          <div class="controls">
                                            <textarea name="citation_title" id="citation_title" class="span6" placeholder="Citation Title"><?php echo set_value('citation_title',isset($data['citation_title'])?$data['citation_title']:''); ?></textarea>
                                            <?php echo form_error('citation_title','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="citation_publication_date">Citation Publication Date</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="citation_publication_date" name="citation_publication_date" type="text" placeholder="Citation Publication Date" value="<?php echo set_value('citation_publication_date',isset($data['citation_publication_date'])?$data['citation_publication_date']:''); ?>">
                                            <?php echo form_error('citation_publication_date','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="citation_journal_title">Citation Journal Title</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="citation_journal_title" name="citation_journal_title" type="text" placeholder="Citation Journal Title" value="<?php echo set_value('citation_journal_title',isset($data['citation_journal_title'])?$data['citation_journal_title']:''); ?>">
                                            <?php echo form_error('citation_journal_title','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="citation_volume">Citation Volume</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="citation_volume" name="citation_volume" type="text" placeholder="Citation Volume" value="<?php echo set_value('citation_volume',isset($data['citation_volume'])?$data['citation_volume']:''); ?>">
                                            <?php echo form_error('citation_volume','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="citation_issue">Citation Issue</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="citation_issue" name="citation_issue" type="text" placeholder="Citation Issue" value="<?php echo set_value('citation_issue',isset($data['citation_issue'])?$data['citation_issue']:''); ?>">
                                            <?php echo form_error('citation_issue','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="citation_issue">Citation First Page</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="citation_firstpage" name="citation_firstpage" type="text" placeholder="Citation First Page" value="<?php echo set_value('citation_firstpage',isset($data['citation_firstpage'])?$data['citation_firstpage']:''); ?>">
                                            <?php echo form_error('citation_firstpage','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="citation_lastpage">Citation Last Page</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="citation_lastpage" name="citation_lastpage" type="text" placeholder="Citation Last Page" value="<?php echo set_value('citation_lastpage',isset($data['citation_lastpage'])?$data['citation_lastpage']:''); ?>">
                                            <?php echo form_error('citation_lastpage','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="citation_pdf_url">Citation PDF Url</label>
                                          <div class="controls">
                                            <input class="input-xlarge span6" id="citation_pdf_url" name="citation_pdf_url" type="text" placeholder="Citation PDF Url" value="<?php echo set_value('citation_pdf_url',isset($data['citation_pdf_url'])?$data['citation_pdf_url']:''); ?>">
                                            <?php echo form_error('citation_pdf_url','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="title_tag">Title Tag</label>
                                          <div class="controls">
                                            <textarea name="title_tag" id="title_tag" class="span6" placeholder="Title Tag"><?php echo set_value('title_tag',isset($data['title_tag'])?$data['title_tag']:''); ?></textarea>
                                            <?php echo form_error('title_tag','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="meta_keyword_tag">Meta Keyword Tag</label>
                                          <div class="controls">
                                            <textarea name="meta_keyword_tag" id="meta_keyword_tag" class="span6" placeholder="Meta Keyword Tag"><?php echo set_value('meta_keyword_tag',isset($data['meta_keyword_tag'])?$data['meta_keyword_tag']:''); ?></textarea>
                                            <?php echo form_error('meta_keyword_tag','<span class="error-advise">','</span>'); ?>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="meta_desc_tag">Meta Description Tag</label>
                                          <div class="controls">
                                            <textarea name="meta_desc_tag" id="meta_desc_tag" class="span6" placeholder="Meta Description Tag"><?php echo set_value('meta_desc_tag',isset($data['meta_desc_tag'])?$data['meta_desc_tag']:''); ?></textarea>
                                            <?php echo form_error('meta_desc_tag','<span class="error-advise">','</span>'); ?>                                          </div>
                                        </div>

                                        
                                        <div class="control-group">
                                          <label class="control-label" for="featured">Featured</label>
                                          <div class="controls">
											<select id="featured" name="featured" class="span6">
                                              <option value="1" <?php if("1" === set_value('featured',isset($data['featured'])?$data['featured']:'')) { echo 'selected="selected"'; } ?>>Active</option>
                                              <option value="0" <?php if("0" === set_value('featured',isset($data['featured'])?$data['featured']:'')) { echo 'selected="selected"'; } ?>>Inactive</option>
                                            </select>
                                          </div>
                                        </div>
                              
                                        
<?php 
	if($this->action_status)
	{
?>                                        
                                        <div class="control-group">
                                          <label class="control-label" for="publish">Publish</label>
                                          <div class="controls">
											<select id="publish" name="publish" class="span6">
                                              <option value="1" <?php if("1" === set_value('publish',isset($data['publish'])?$data['publish']:'')) { echo 'selected="selected"'; } ?>>Active</option>
                                              <option value="0" <?php if("0" === set_value('publish',isset($data['publish'])?$data['publish']:'')) { echo 'selected="selected"'; } ?>>Inactive</option>
                                            </select>
                                          </div>
                                        </div>                                                                              
<?php 
	}
?>                                        
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">Save changes</button>
                                          <button type="reset" class="btn" onclick="parent.location.href='<?php echo site_url($this->controller); ?>'">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <hr>
            <?php $this->load->view('backend/includes/footer');?>
        </div>
        <!--/.fluid-container-->
		<?php /*?><script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
		<link href="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>

  
        
		<link href="<?php echo base_url(); ?>assets/plugin/colorbox/css/colorbox.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/colorbox/js/jquery.colorbox-min.js"></script>             <?php */?>
        
        <script src="<?php echo base_url(); ?>assets/plugin/addremovebutton/js/jquery.min.js"></script>
        
		<script src="<?php echo base_url(); ?>assets/themes/backend/vendors/ckeditor/ckeditor.js"></script>
		<script src="<?php echo base_url(); ?>assets/themes/backend/vendors/ckeditor/adapters/jquery.js"></script>     
        
		<link href="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>                 
        
<script>
        $(function() {
				$( 'textarea.ckeditor_full' ).ckeditor({width:'98%', height: '150px'});
				
/*				$( ".datepicker" ).datepicker( { dateFormat: 'yy-mm-dd' } );
				$( ".datepicker" ).attr('autocomplete','off');
				$( ".datepicker" ).attr('readonly','readonly');*/
//				$(".group1").colorbox({rel:'group1'});
        });
</script>


<script>
		$(document).ready(function() {

			var id = 0;
			// Add button functionality
			$("table.dynatable a.add").click(function() {
				id++;
				var master = $(this).parents("table.dynatable");

				// Get a new row based on the prototype row
				var prot = master.find(".prototype").clone();
				prot.attr("class", "prototype"+id)
				prot.find(".id").attr("value", id);
				prot.find(".name").attr("value", id);				
				prot.find(".remove").attr("id", "prototype"+id);								
//				prot.find(".stageNo").html(id);		
			//	prot.find(".addDate").attr("id", "addDate"+id);												
				master.find("tbody").append(prot);
								
			});

			// Remove button functionality
			$("table.dynatable a.remove").live("click", function() {
//				alert(this.id);
				$("tr."+this.id).remove();
			});
		});
</script>
<style>
.datepicker
{	
}

.dynatable .prototype 
{
	display:none;
}
</style>


<script>
///////////getting values on change

		$( "#main_cat" ).change(function() 		
		{
			$.post( "<?php echo site_url('siteowner/articles/getyear');?>", { journal_id: this.value })
			.done(function( data ) 
			{
				$( "#year" ).html(data);
			});	
		
		});	
		
		$( "#year" ).change(function() 		
		{
			journal_id = $( "#main_cat" ).val();			
			
			$.post( "<?php echo site_url('siteowner/articles/getvolume');?>", { journal_id: journal_id, year: this.value })
			.done(function( data ) 
			{
				$( "#volume" ).html(data);
			});	
		
		});		
		
		$( "#volume" ).change(function() 		
		{
			journal_id = $( "#main_cat" ).val();
			year = $( "#year" ).val();			
			
			$.post( "<?php echo site_url('siteowner/articles/getissues');?>", { journal_id: journal_id, year: year, volume: this.value })
			.done(function( data ) 
			{
				$( "#sub_cat" ).html(data);
			});	
		
		});						
			
</script>