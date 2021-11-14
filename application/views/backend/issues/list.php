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
	                                    <li class="active"><?php echo $this->title;?></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
					<div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left"><?php echo $this->title_plural;?></div>
                            </div>
                            <div class="block-content collapse in">
                            
                            
                            
                            <div class="span12">
                            <h4>Filter</h4>
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
										<thead>
											<tr>
                                             	<th>DB Id</th>
                                                <th>Journal Name</th>
                                                <th>Year</th>
                                                <th>Volume</th>
                                                <th>Issue No.</th>                                                
                                           		<th>Active</th>                                                
                                                <th>Actions</th>                                            
											</tr>
										</thead>
										<tbody>
                                    
											<tr class="odd gradeX">
                                          		<td><input type="text" name="Id" id="Id" value="<?php echo @$getvars['Id'];?>" class="span6" /></td>
                                                <td><select id="main_cat" name="main_cat" class="span6">
                                              <option value="" >Select</option>
<?php if(!empty($journals))
{
	foreach($journals as $value)
	{
?>                                              
                                              <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == @$getvars['main_cat']) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
	}
}
?>                                               
                                            </select></td>
                                                <td><select id="year" name="year" style="width:80px;">
                                              <option value="">Select</option>
                                              
<?php
	$cond = "";
	if($getvars['main_cat'])
	{
		$cond .= "AND main_cat='".$getvars['main_cat']."'";
	}

	$years = get_few_record("select year from issues where 1 AND publish = '1' $cond group by year order by year DESC");

	 if(!empty($years))
	{
		foreach($years as $value)
		{
	?>                                              
												  <option value="<?php echo $value['year'];?>" <?php if($value['year'] == @$getvars['year']) { echo 'selected="selected"'; } ?>><?php echo $value['year'];?></option>
	<?php
		}
	}
?>                                               
 
                                            </select></td>                                                
                                                <td><select id="volume" name="volume" style="width:80px;">
                                              <option value="" >Select</option>
<?php
	$cond = "";

	if($getvars['main_cat'])
	{
		$cond .= "AND main_cat='".$getvars['main_cat']."'";
	}

	if($getvars['year'])
	{
		$cond .= "AND year='".$getvars['year']."'";
	}

$volumes = get_few_record("select volume from issues where 1 AND publish = '1' $cond group by volume order by volume");

	 if(!empty($volumes))
	{
		foreach($volumes as $value)
		{
?>                                              
                                              <option value="<?php echo $value['volume'];?>" <?php if($value['volume'] == @$getvars['volume']) { echo 'selected="selected"'; } ?>><?php echo $value['volume'];?></option>
<?php
		}
	}
?>                                               
                                            </select></td>
                                                <td><select id="name" name="name" style="width:160px;">
                                              <option value="" >Select</option>
<?php
	$cond = "";
	
	if($getvars['main_cat'])
	{
		$cond .= "AND main_cat='".$getvars['main_cat']."'";
	}

	if($getvars['year'])
	{
		$cond .= "AND year='".$getvars['year']."'";
	}	

	if($getvars['volume'])
	{
		$cond .= "AND volume='".$getvars['volume']."'";
	}


$issues = get_few_record("select Id,name from issues WHERE 1 AND publish = '1' $cond group by name order by name");

	 if(!empty($issues))
	{
		foreach($issues as $value)
		{
?>                                              
                                              <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == @$getvars['name']) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
<?php
		}
	}
?>                                               
                                            </select></td>                                             
                                            	<td>
                                                	<select name="publish" id="publish" style="width:80px;">
                                                    	<option value="">Select</option>
                                                        <option value="yes" <?php if("yes"== @$getvars['publish']) { echo 'selected="selected"'; }?>>
                                                        	Yes
                                                        </option>
                                                        <option value="no" <?php if("no"== @$getvars['publish']) { echo 'selected="selected"'; }?>>
                                                        	No
                                                        </option>                                                        	
													</select>
                                                </td>                                                
												<td>
                                                <input class="buttons" type="button" id="filterButton" value="Search"/>
                                                &nbsp;&nbsp;
                                                <input class="buttons" type="button" value="Reset" onclick="parent.location='<?php echo site_url($this->controller);?>'" />
                                                </td>                                                       
										  </tr>	
										</tbody>
									</table>
                            </div>
                            
<form action="<?php echo site_url($this->controller.'/bulkaction');?>" method="post" id="frm_bulkaction">                            
                                <div class="span12">
<?php 
	if($this->action_status || $this->action_delete)
	{
?>                                 
                                <div>
                                    <label>
                                        <select name="bulkaction" size="1" style="width:100px;" onchange="return SubmitForm(this.value);">
                                            <option value="" selected="selected">Select</option>
<?php 
	if($this->action_status)
	{
?>                                                   
                                            <option value="active">Active</option>
                                            <option value="inactive">In-Active</option>
<?php 
	}
?>                                                                     
<?php 
	if($this->action_delete)
	{
?>                                            
                                            <option value="delete">Delete</option>
<?php 
	}
?>                                              
                                        </select> 
                                        Bulk Update
                                    </label>
                                 </div>
<?php 
	}
?>                                      
  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
										<thead>
											<tr>
<?php 
	if($this->action_status || $this->action_delete)
	{
?>                                               
                                                <th><input type="checkbox" name="selecctall" id="selecctall" /></th>
<?php 
	}
?>                                                 
                                                <th>S.No.</th>
                                                <th>DB Id</th>
                                                <th>Journal Name</th>
                                                <th>Year</th>
                                                <th>Volume</th>
                                                <th>Issue No.</th>                                                
                                                
<?php 
	if($this->action_status)
	{
?>                                                 <th>Active</th>                                                
<?php 
	}
?> 
                                                <th>Actions</th>                                            
											</tr>
										</thead>
										<tbody>
<?php 
foreach($coloums as $key=>$value)
{
?>                                        
											<tr class="odd gradeX">
<?php 
	if($this->action_status || $this->action_delete)
	{
?>                                             
                                                <td><input type="checkbox" name="ids[]" id="ids" class="checkbox1" value="<?php echo $value[$this->db_id];?>" /></td>
<?php 
	}
?>                                                  
                                                <td><?php echo $key+1;?></td>
                                                <td><?php echo $value['Id'];?></td>
                                                                                                <td><?php echo get_corresponing_value('journals','name',$value['main_cat'],'Id');?></td>
                                                
                                                <td><?php echo $value['year'];?></td>
                                                <td><?php echo $value['volume'];?></td>                                                                                                <td><?php echo $value['name'];?></td>
<?php 
	if($this->action_status)
	{
?>                                                                                                  
                                            <td><?php echo ($value['publish']==1)?'<span class="label label-success">Yes</span>':'<span class="label label-important">No</span>';?></td>                                                <?php 
}
?> 
												<td>
<?php 
	if($this->action_view)
	{
?>
<i class="icon-eye-open" title="View" onclick="parent.location.href='<?php echo site_url($this->controller.'/view/'.$value[$this->db_id]); ?>'" style="cursor:pointer;"></i>&nbsp;                                                
<?php 
	}
?>

<?php 
	if($this->action_status)
	{
?>                                              
<?php if($value['publish']==0):?>                                                
                                                <i class="icon-ok" title="Active" data-toggle="modal" href="#myActiveAlert_<?php echo $value[$this->db_id];?>" style="cursor:pointer;"></i>&nbsp;
<div class="modal hide" id="myActiveAlert_<?php echo $value[$this->db_id];?>" style="display: none;" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Are you sure ?</h3>
    </div>
    <div class="modal-body">
        <p><strong>Active</strong> - <?php echo $value[$this->first_field];?></p>
    </div>
    <div class="modal-footer">
        <a href="<?php echo site_url($this->controller.'/active/'.$value[$this->db_id]); ?>" class="btn btn-primary">Confirm</a>
        <a href="javascript:void(0)" class="btn" data-dismiss="modal">Cancel</a>
    </div>
</div>                                                
<?php else:?>                                                      
                                                <i class="icon-ban-circle" title="Inactive" data-toggle="modal" href="#myInactiveAlert_<?php echo $value[$this->db_id];?>" style="cursor:pointer;"></i>&nbsp;
<div class="modal hide" id="myInactiveAlert_<?php echo $value[$this->db_id];?>" style="display: none;" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Are you sure ?</h3>
    </div>
    <div class="modal-body">
        <p><strong>Inactive</strong> - <?php echo $value[$this->first_field];?></p>
    </div>
    <div class="modal-footer">
        <a href="<?php echo site_url($this->controller.'/inactive/'.$value[$this->db_id]); ?>" class="btn btn-primary">Confirm</a>
        <a href="javascript:void(0)" class="btn" data-dismiss="modal">Cancel</a>
    </div>
</div>                                                
<?php endif;?>
<?php 
	}
?>
<?php 
	if($this->action_edit)
	{
?>
                                                <i class="icon-edit" title="Edit" onclick="parent.location.href='<?php echo site_url($this->controller.'/edit/'.$value[$this->db_id]); ?>'" style="cursor:pointer;"></i>&nbsp;
<?php 
	}
?>                                                
<?php 
	if($this->action_delete)
	{
?>
                                                <i class="icon-remove" title="Delete" data-toggle="modal" href="#myDeleteAlert_<?php echo $value[$this->db_id];?>" style="cursor:pointer;"></i>
<div class="modal hide" id="myDeleteAlert_<?php echo $value[$this->db_id];?>" style="display: none;" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3>Are you sure ?</h3>
    </div>
    <div class="modal-body">
        <p><strong>Delete</strong> - <?php echo $value[$this->first_field];?></p>
    </div>
    <div class="modal-footer">
        <a href="<?php echo site_url($this->controller.'/delete/'.$value[$this->db_id]); ?>" class="btn btn-primary">Confirm</a>
        <a href="javascript:void(0)" class="btn" data-dismiss="modal">Cancel</a>
    </div>
</div>                                           
<?php 
	}
?>     


<?php 
}
?>                                                                                    							
<tr class="odd gradeX">
                                                <td colspan="9" style="text-align:center;"><?php echo $pagination;?></td>                                
											</tr>                                          							
											<tr class="odd gradeY">
                                                <td colspan="9" style="text-align:center;">You are seeing <?php echo $startvalue;?> to <?php echo $endvalue;?> of total <?php echo $totalvalue;?> records</td>                                
											</tr> 
                                                </td>                                                       
											</tr>	
										</tbody>
									</table>
                                </div>
</form>                                
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
        <script src="<?php echo base_url(); ?>assets/themes/backend/vendors/datatables/js/jquery.dataTables.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/themes/backend/assets/scripts.js"></script>
        <script src="<?php echo base_url(); ?>assets/themes/backend/assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
            
        });
        </script>                

<?php 
	if($this->action_status || $this->action_delete)
	{
?>           
<script>
function SubmitForm(action)
{

		var checkboxs=document.getElementsByName("ids[]");
		var okay=false;

		for(var i=0,l=checkboxs.length;i<l;i++)
		{
		
		if(checkboxs[i].checked)
        {
            okay=true;
        }
		}
		if(okay && action!='select')
		{
			var x = confirm("Are you sure ?");
			if (x)
     		{
		document.getElementById("frm_bulkaction").submit();
		return true;
			}
			else
			{
				return false;
			}
		}
    else 
	{
	alert("Please select atleast one row.");
	return false;
	}	

}


$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });
   
});
</script>    
<?php 
	}
?>       
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
				$( "#name" ).html(data);
			});	
		
		});				
		
		
		
		$( "#filterButton" ).click(function() 		
		{
//			alert("hello");
			Id = $( "#Id" ).val();	
			main_cat = $( "#main_cat" ).val();	
			year = $( "#year" ).val();
			volume = $( "#volume" ).val();		
			name = $( "#name" ).val();	
			publish = $( "#publish" ).val();				
			
			window.location.href = '<?php echo site_url('siteowner/issues/listing');?>/'+'filter-Id:'+Id+'-main_cat:'+main_cat+'-year:'+year+'-volume:'+volume+'-name:'+name+'-publish:'+publish;
			
		});	
			
</script>   