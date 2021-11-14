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


                                                <th>Manuscript No</th>

<th>Used For</th> 
                                              <th>Journal Name</th>                                                

<th>Reviewer Name</th>  
                                              <th>Validity</th>

                                                <th>Date</th

                                              ><th>Actions</th>                                            

											</tr>

										</thead>

										<tbody>

                                    

											<tr class="odd gradeX">

                                                <td><input type="text" name="manuscript_no" id="manuscript_no" value="<?php echo str_replace("~","/",@$getvars['manuscript_no']);?>" class="span10" /></td>

                                                <td><input type="text" name="used_for" id="used_for" value="<?php echo @$getvars['used_for'];?>" class="span10" /></td>

                                                <td class="span3"><select id="journal_id" name="journal_id" class="span12">

                                              <option value="" >Select</option>

<?php if(!empty($journals))

{

	foreach($journals as $value)

	{

?>                                              

                                              <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == @$getvars['journal_id']) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>

<?php

	}

}

?>                                               

                                            </select></td>

                                                <td><input type="text" name="reviewer_id" id="reviewer_id" value="<?php echo @$getvars['reviewer_id'];?>" class="span10" /></td>

                                                <td><select name="valid" id="valid">

          <option value="">Select</option>

          <option value="Yes" <?php if(@$getvars['valid'] == "Yes") { echo " selected"; }?>>Yes</option>
          <option value="No" <?php if(@$getvars['valid'] == "No") { echo " selected"; }?>>No</option>

        </select></td>           
        <td><input type="text" name="date" id="date" value="<?php echo @$getvars['date'];?>" class="datepicker span10" placeholder="Date" /></td>                                                                               

                                                

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

  									<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

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

                                                <th>Manuscript No.</th>

                                                  <th>Used For</th>

                                                 <th>Journal Name</th>

                                                <th>Reviewer Name</th>                                                

                                                

                                                  <th>Is Valid?</th> 
                                                  <th>Creation Date</th> 

                                                                                           

                                                

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

                                                <td><?php echo $key+1+$this->uri->segment(5);?></td>      

                                                <td><?php echo manuscriptNo($value['manuscript_id']);?></td>

                                                <td><?php echo manuscriptNo($value['used_for']);?></td>

                                                <td><?php echo get_corresponing_value('journals','name',$value['journal_id'],'Id');?></td>

                                                <td><?php if(!empty($value['reviewer_id'])) { echo get_corresponing_value('users','name',$value['reviewer_id'],'Id')."(".get_corresponing_value('users','username',$value['reviewer_id'],'Id').")"; }?></td>      

                                          		<td><?php echo ($value['valid']==1)?'<span class="label label-success">Yes</span>':'<span class="label label-important">No</span>';?></td>
                                                <td><?php echo $value['date'];?></td>   

                                               

                                                                                             

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

<a href="<?php echo site_url($this->controller.'/view/'.$value[$this->db_id]); ?>"><i class="icon-eye-open" title="View"></i></a>

&nbsp;                                                

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

<a href="<?php echo site_url($this->controller.'/edit/'.$value[$this->db_id]); ?>"><i class="icon-edit" title="Edit"></i></a>&nbsp;

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

                                                </td>                                                       

											</tr>	

<?php 

}

?>                                          

											<tr class="odd gradeX">

                                                <td colspan="12" style="text-align:center;"><?php echo $pagination;?></td>                                

											</tr>                                          							

											<tr class="odd gradeY">

                                                <td colspan="12" style="text-align:center;">You are seeing <?php echo $startvalue;?> to <?php echo $endvalue;?> of total <?php echo $totalvalue;?> records</td>                                

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

<?php /*?>        <script src="<?php echo base_url(); ?>assets/themes/backend/vendors/datatables/js/jquery.dataTables.min.js"></script><?php */?>



		<script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>

		<link href="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" media="screen">

		<script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>



        <script src="<?php echo base_url(); ?>assets/themes/backend/assets/scripts.js"></script>

        <script src="<?php echo base_url(); ?>assets/themes/backend/assets/DT_bootstrap.js"></script>

<script>

        $(function() {				
				$( ".datepicker" ).datepicker( { dateFormat: 'yy~mm~dd' } );

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

function makeforurl(str)
{
	str = str.trim();	
	str = str.replace("/", "~"); 
	str = str.replace("&", "andabbreviation"); 	
	
	return str;
}

		

		$( "#filterButton" ).click(function() 		
		{
			manuscript_no 	= makeforurl($( "#manuscript_no" ).val());
			
				manuscript_no = manuscript_no.replace("/", "~"); 
				manuscript_no = manuscript_no.replace("/", "~"); 			
			
			used_for 		= makeforurl($( "#used_for" ).val());
			journal_id 		= makeforurl($( "#journal_id" ).val());
			reviewer_id 	= makeforurl($( "#reviewer_id" ).val());
			valid 			= makeforurl($( "#valid" ).val());		
			
			date = $( "#date" ).val();												
			

			window.location.href = '<?php echo site_url('siteowner/coupon/listing');?>/'+'filter-manuscript_no:'+manuscript_no+'-used_for:'+used_for+'-journal_id:'+journal_id+'-reviewer_id:'+reviewer_id+'-valid:'+valid+'-date:'+date;			
			
			
		});	
			
$("input").keypress(function(event) {
    if (event.which == 13) {

			manuscript_no 	= makeforurl($( "#manuscript_no" ).val());

				manuscript_no = manuscript_no.replace("/", "~"); 
				manuscript_no = manuscript_no.replace("/", "~"); 			
			
			used_for 		= makeforurl($( "#used_for" ).val());
			
				used_for = used_for.replace("/", "~"); 
				used_for = used_for.replace("/", "~"); 				
			
			journal_id 		= makeforurl($( "#journal_id" ).val());
			reviewer_id 	= makeforurl($( "#reviewer_id" ).val());
			valid 			= makeforurl($( "#valid" ).val());			
			
			date = $( "#date" ).val();									
			

			window.location.href = '<?php echo site_url('siteowner/coupon/listing');?>/'+'filter-manuscript_no:'+manuscript_no+'-used_for:'+used_for+'-journal_id:'+journal_id+'-reviewer_id:'+reviewer_id+'-valid:'+valid+'-date:'+date;

			
	}
		});	

			

</script>   