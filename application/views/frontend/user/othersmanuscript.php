        <?php $this->load->view('frontend/includes/slider');?>
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right col-sm-6">
                    	
                       	<ul class="nav tab nav-tabs mytabs">
							<h2 class="mainh2">Other MenuScript<span></span></h2>
  <li><a href="<?php echo site_url('user/myaccount');?>">My Profile</a></li>
  <li><a href="<?php echo site_url('user/submitmanuscript');?>">New Submission</a></li>
  <li><a href="<?php echo site_url('user/inprocessmanuscript');?>">In Process</a></li>
  <li class="active"><a href="javasccript:void();">Reviewer Center</a></li>
  <li><a href="<?php echo site_url('user/publishedmanuscript');?>">Published</a></li>
  
</ul>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped mytable">
                                      <tr>
                                        <th>Sr.No.</th>
                                        <th>Menuscript No.</th>
                                        <th>Menuscript Title</th>
                                        <th>Decision</th>
                                        <th>Download File</th>
                                      </tr>
<?php
			$manuscripts = get_few_record("select * from manuscript where (author_id<>'".$userdata['Id']."') and (assign_reviewer1='".$userdata['Id']."' or assign_reviewer2='".$userdata['Id']."' or assign_reviewer3='".$userdata['Id']."' or assign_reviewer4='".$userdata['Id']."') order by Id desc");
			
			if(!empty($manuscripts))
			{
				foreach($manuscripts as $key=>$value)
				{

?>                                          
                                          <tr>
                                            <td id="adminBOX4_contentROWH2"><?php echo $key+1?></td>
                                            <td id="adminBOX4_contentROWH2" style="text-align:left;"><span class="normal_link"><a href="update-others-manuscript.php?mid=<?php echo $value['Id']?>"><?php  echo substr($value['date'],0,4)."/"?><?php echo get_short_name($value['journal_id'])?><?php echo "/". $value['Id']?></a></span></td>
                                            <td style="text-align:left;" id="adminBOX4_contentROWH2"><?php echo $value['title']?></td>
                                            <td id="adminBOX4_contentROWH2"><?php if($value['status'] == 0) { echo 'Rejected'; } elseif($value['status'] == 1) { echo 'Accepted'; } elseif($value['status'] == 2) { echo 'Revision Required'; } elseif($value['status'] == 3) { echo 'On Process'; }?></td>
                                            <td id="adminBOX4_contentROWH2"><span class="normal_link"><a href="<?php echo base_url;?>uploads/<?php echo $value['ms_word_file'] ?>">Download</a></span></td>
                                          </tr>
<?php
				}
			}
			else
			{
?>
                                          <tr>
                                            <td id="adminBOX4_contentROWH2" colspan="6"><span class="red">No Manuscript Found</span></td>
                                          </tr>
<?php
}
?>                                          
                                        </table>
                        
                        
                    </div>
                    <?php $this->load->view('frontend/includes/user-right');?> 
                </div>
            </div>
        </div>
<style>
ul.mytabs li, ul.mytabs li a
{
	border-top:none !important;
	background-color:#08B469;
	font-weight:bold;
}

ul.mytabs li.active a
{background-color:#DEFBEE;
	border-left:#CCC 1px solid !important;
	border-top:#CCC 1px solid !important;
}
</style>