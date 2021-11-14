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
<!--                                        <label class="control-label" for="permission">Pricing</label>-->
                                        <div class="controls">
                                        <?php
										$permissions = unserialize($data['permissions']);
									
										if(!is_array($permissions))
										{
											$permissions = array();	
										}
										
								?>
					<table width="100%" border="1">   
									<tr>
									<th colspan="3">Product Name</th>
                                    <th>Online

subscription, USD</td>
                                    <th>Print

Subscription, USD</th>
                                    <th>Online & Print 

subscription, USD</th>                                                                        
                                    </tr>                                                 
                                <?php
								if(!empty($this->journals))
								{
									foreach($this->journals as $valueJ)
									{	
									?>	
									<tr>
									<td colspan="3"><?php echo strip_tags($valueJ['name'])." (".$valueJ['short_name'].")";?></td>
                                    <td><input name="journal[<?php echo $valueJ['Id'];?>][OS]" value="<?php echo $pricing[$valueJ['Id']]['OS']?>"></td>
                                    <td><input name="journal[<?php echo $valueJ['Id'];?>][PS]" value="<?php echo $pricing[$valueJ['Id']]['PS']?>"></td>
                                    <td><input name="journal[<?php echo $valueJ['Id'];?>][OPS]" value="<?php echo $pricing[$valueJ['Id']]['OPS']?>"></td>                                                                        
                                    </tr>
                                    <?php
									$years = get_few_record("select year from issues where publish = 1 and main_cat='".$valueJ['Id']."' group by year order by year desc");	
										
                                        if(!empty($years))
										{
											foreach($years as $value)
											{
										?>
                                    <tr>
									<td>&nbsp;</td>
									<td colspan="2"><?php echo $value['year'];?></td>
                                    <td><input name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>][OS]" value="<?php echo $pricing[$valueJ['Id']][$value['year']]['OS']?>"></td>
                                    <td><input name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>][PS]" value="<?php echo $pricing[$valueJ['Id']][$value['year']]['PS']?>"></td>
                                    <td><input name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>][OPS]" value="<?php echo $pricing[$valueJ['Id']][$value['year']]['OPS']?>"></td>                                                                        
                                    </tr>
                                                    
												<?php 
		$sql="select * from issues where publish=1 and year='".$value['year']."' and main_cat='".$valueJ['Id']."' group by volume order by volume desc";
		$query2 = $this->db->query($sql);
		$records2 = $query2->result_array();
		
        foreach($records2 as $val)
        {		                                                
                                                ?>

                                    <tr>
									<td>&nbsp;</td>
                                    <td>&nbsp;</td>
									<td><?php echo "Volume - ".$val['volume'];?></td>
                                    <td><input name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>][<?php echo $val['volume'];?>][OS]" value="<?php echo $pricing[$valueJ['Id']][$value['year']][$val['volume']]['OS']?>"></td>
                                    <td><input name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>][<?php echo $val['volume'];?>][PS]" value="<?php echo $pricing[$valueJ['Id']][$value['year']][$val['volume']]['PS']?>"></td>
                                    <td><input name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>][<?php echo $val['volume'];?>][OPS]" value="<?php echo $pricing[$valueJ['Id']][$value['year']][$val['volume']]['OPS']?>"></td>                                                                     
                                    </tr>                                            
                                            
                                            
                                            <?php 
											
		}
		?>

                                        <?php
											} 
										}
										?>
                                        <?php
											
									} 
								}											
											
										?>
                                        </table>
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
  <style>
  .years h4
  {
	font-size:16px;  
  }
  .years div
  {
	font-size:12px;  
  }
  .years div input
  {
	margin-left:20px;
	margin-top:-4px;
  }
  .volumes
  {
	  line-height:20px;
  }
  td
  {
	padding:5px;  
  }
  td input
  {
	width:50px;  
  }
  </style>