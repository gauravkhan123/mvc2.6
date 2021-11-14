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
	                                    <li class="active">View <?php echo $this->title; ?></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>                
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $title;?></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                        <div class="pull-right">
                                          <button type="button" class="btn" onclick="parent.location.href='<?php echo site_url($this->controller.'/edit/'.$id); ?>'">Edit</button>
                                        </div>                               
                                     <table class="table">
						              <thead>
						                <tr>
						                  <th class="span3">Field Name</th>
						                  <th>Value</th>
						                </tr>
						              </thead>
						              <tbody>
<?php 
if(!empty($data))
{
	foreach($data as $key=>$value)
	{
?>
						                <tr>
						                  <td><?php echo ucwords(str_replace("_"," ",$key));?></td>
						                  <td><?php echo $value;?></td>
						                </tr>
<?php
	}
}
?>                            
                                        
						              </tbody>
						            </table>
                                        <div class="pull-right">
                                          <button type="button" class="btn" onclick="parent.location.href='<?php echo site_url($this->controller.'/edit/'.$id); ?>'">Edit</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
             </div>                                           
            <hr>
            <?php $this->load->view('backend/includes/footer');?>
        </div>