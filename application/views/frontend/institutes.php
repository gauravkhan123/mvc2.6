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
	margin-left:22px;
	margin-top:-4px;
  }
  .volumes
  {
	  line-height:20px;
  }
  #accordion
  {
	margin:20px 0;  
  }
  
  
table.clean-table {
    background-color: #f9f9f9;
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    margin: 20px 0;
    width: 100%;
}

table.clean-table td, th {
    border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;
    padding: 4px 10px;
}


table.clean-table input[type="button"] {
    background: #d02b2b none repeat scroll 0 0;
    border: 1px solid #d02b2b;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
}

table.clean-table input[type="button"]:hover {
    background: #d93d3d;
}


input.buynow {
    background: #d02b2b none repeat scroll 0 0;
    border: 1px solid #d02b2b;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
	padding:10px;
}

input.buynow:hover {
    background: #d93d3d;
}
  </style>
				<div class="content">
 <script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'clean'
 };
 </script>         

            
            
        <?php $this->load->view('frontend/includes/slider');?>
        
                <!----second2-row-body-contant-->
        <div class="second2-row">
        	<div class="container">
            	<div class="row">
                	<!----about us--- pages-->
                    <div class="col-lg-9 border-right">
                    	<div class="about_left">
<form name="subscription" id="subscription" method="post" action="<?php echo site_url('institutes')?>">

<h2 class="mainh2">Journal Subscription: Price List <span></span></h2>
					
					
					                
                                        <?php
										if(!empty($permissions))
										{
											$permissions = unserialize($permissions);
										}
										else
										{
											$permissions = array();	
										}
										
								?>
					<div id="accordion">                                
                                <?php
$journals = get_few_record("SELECT Id,name,short_name FROM journals WHERE publish = 1 ORDER BY Id DESC");
								

								if(!empty($journals))
								{
									foreach($journals as $valueJ)
									{	

									?>	
                                    <h3><?php echo strip_tags($valueJ['name'])." (".$valueJ['short_name'].")";?> </h3>								
                                    <div>
                                    <?php
									
										$permissions = unserialize($data['permissions']);
									
										if(!is_array($permissions))
										{
											$permissions = array();	
										}
										
								?>
                                    
                                   <table class="clean-table">   
									<tr>
									<th colspan="3" width="30%">Product Name</th>
                                    <th width="20%">Online

Subscription (USD)<th width="20%">Print

Subscription (USD)</th>
                                    <th width="20%">Online & Print 

Subscription (USD)</th> 
<th width="10%">Action</th>                                                                        
                                    </tr>                                                 
                                <?php

									?>	
									<tr class="journal_<?php echo $valueJ['Id']?>">
									<td colspan="3"><span title="<?php echo strip_tags($valueJ['name'])." (".$valueJ['short_name'].")";?>">Full Journal</span></td>
                                    <td><input type="radio" name="journal[<?php echo $valueJ['Id'];?>]" class="journal_<?php echo $valueJ['Id'];?>" value="<?php echo $pricing[$valueJ['Id']]['OS']."-OS"?>" onclick="hide(<?php echo $valueJ['Id']?>)">&nbsp;<?php echo $pricing[$valueJ['Id']]['OS']?></td>
                                    <td><input type="radio" name="journal[<?php echo $valueJ['Id'];?>]" class="journal_<?php echo $valueJ['Id'];?>" value="<?php echo $pricing[$valueJ['Id']]['PS']."-PS"?>"onclick="hide(<?php echo $valueJ['Id']?>)">&nbsp;<?php echo $pricing[$valueJ['Id']]['PS']?></td>
                                    <td><input type="radio" name="journal[<?php echo $valueJ['Id'];?>]" class="journal_<?php echo $valueJ['Id'];?> radio_year_<?php echo $valueJ['Id'];?>" value="<?php echo $pricing[$valueJ['Id']]['OPS']."-OPS"?>" onclick="hide(<?php echo $valueJ['Id']?>)">&nbsp;<?php echo $pricing[$valueJ['Id']]['OPS']?></td>     
                                    <td><input type="button" value="New Selection" onclick="show(<?php echo $valueJ['Id'];?>)"></td>                                                                        
                                    </tr>
                                    <?php
									$years = get_few_record("select year from issues where publish = 1 and main_cat='".$valueJ['Id']."' group by year order by year desc");	
										
                                        if(!empty($years))
										{
											foreach($years as $value)
											{
										?>
                                    <tr class="year_<?php echo $valueJ['Id']?>">
									<td>&nbsp;&nbsp;</td>
									<td colspan="2"><?php echo $value['year'];?></td>
                                    <td><input type="radio" name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>]" class="journal_<?php echo $valueJ['Id'];?>_<?php echo $value['year'];?> radio_year_<?php echo $valueJ['Id'];?>" value="<?php echo $pricing[$valueJ['Id']][$value['year']]['OS']."-OS"?>" onclick="hidevolume('<?php echo $valueJ['Id']."_".$value['year']?>')">&nbsp;&nbsp;<?php echo $pricing[$valueJ['Id']][$value['year']]['OS']?></td>
                                    <td><input type="radio" name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>]" class="journal_<?php echo $valueJ['Id'];?>_<?php echo $value['year'];?> radio_year_<?php echo $valueJ['Id'];?>" value="<?php echo $pricing[$valueJ['Id']][$value['year']]['PS']."-PS"?>" onclick="hidevolume('<?php echo $valueJ['Id']."_".$value['year']?>')">&nbsp;&nbsp;<?php echo $pricing[$valueJ['Id']][$value['year']]['PS']?></td>
                                    <td><input type="radio" name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>]" class="journal_<?php echo $valueJ['Id'];?>_<?php echo $value['year'];?> radio_year_<?php echo $valueJ['Id'];?>" value="<?php echo $pricing[$valueJ['Id']][$value['year']]['OPS']."-OPS"?>" onclick="hidevolume('<?php echo $valueJ['Id']."_".$value['year']?>')">&nbsp;<?php echo $pricing[$valueJ['Id']][$value['year']]['OPS']?></td>   
                                    
                                     <td><input type="button" value="New Selection" onclick="showvolume('<?php echo $valueJ['Id']."_".$value['year'];?>')"></td>                                                                   
                                    </tr>
                                                    
												<?php 
		$sql="select * from issues where publish=1 and year='".$value['year']."' and main_cat='".$valueJ['Id']."' group by volume order by volume desc";
		$query2 = $this->db->query($sql);
		$records2 = $query2->result_array();
		
        foreach($records2 as $val)
        {		                                                
                                                ?>

                                    <tr class="volume_<?php echo $valueJ['Id']?> volume_<?php echo $valueJ['Id']."_".$value['year']?>">
									<td>&nbsp;&nbsp;</td>
                                    <td>&nbsp;&nbsp;</td>
									<td><?php echo "Volume - ".$val['volume'];?></td>
                                   <td><input type="radio" name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>][<?php echo $val['volume'];?>]" class="journal_<?php echo $valueJ['Id'];?>_<?php echo $value['year'];?>_<?php echo $val['volume'];?>" value="<?php echo $pricing[$valueJ['Id']][$value['year']][$val['volume']]['OS']."-OS"?>">&nbsp;<?php echo $pricing[$valueJ['Id']][$value['year']][$val['volume']]['OS']?></td>
                                    <td><input type="radio" name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>][<?php echo $val['volume'];?>]" class="journal_<?php echo $valueJ['Id'];?>_<?php echo $value['year'];?>_<?php echo $val['volume'];?>" value="<?php echo $pricing[$valueJ['Id']][$value['year']][$val['volume']]['PS']."-PS"?>">&nbsp;<?php echo $pricing[$valueJ['Id']][$value['year']][$val['volume']]['PS']?></td>
                                    <td><input type="radio" name="journal[<?php echo $valueJ['Id'];?>][<?php echo $value['year'];?>][<?php echo $val['volume'];?>]" class="journal_<?php echo $valueJ['Id'];?>_<?php echo $value['year'];?>_<?php echo $val['volume'];?>" value="<?php echo $pricing[$valueJ['Id']][$value['year']][$val['volume']]['OPS']."-OPS"?>">&nbsp;<?php echo $pricing[$valueJ['Id']][$value['year']][$val['volume']]['OPS']?></td><td><input type="button" value="New Selection" onclick="unchecked('journal_<?php echo $valueJ['Id'];?>_<?php echo $value['year'];?>_<?php echo $val['volume'];?>')"></td>                                                                    
                                    </tr>                                            
                                            
                                            
                                            <?php 
											
		}
		?>

                                        <?php
											} 
										}
										?>
                                        <?php
?>
                                        </table>
                                        </div>
                                        
                                        <?php
											
									} 
								}											
											
								?>                                        
                                        </div>
                                        
 					<h2>Payment Options :</h2>                                       
                            
                                        
                         <ul style="padding-left:25px; list-style:none;">
                         <li><input type="radio" name="payment_option" value="option1" checked="checked" /> Option 1: Paypal (any country except India)</li>
<li><input type="radio" name="payment_option" value="option2" /> Option 2: Credit card (any country) (Please contact editorial office instruction)</li>
<li><input type="radio" name="payment_option" value="option3" /> Option 3: Credit card (India) (Please contact editorial office instruction)</li>
<li><input type="radio" name="payment_option" value="option4" /> Option 4: Bank wire transfer (Please contact editorial office instruction)</li>           
</ul>
                        <p>&nbsp;</p>
						<?php
                            require_once(APPPATH.'libraries/recaptcha-php-1.11/recaptchalib.php');
                            $publickey = "6LegEAYTAAAAAD6MeDa6YU2ZuyyOy1d5kxqn2fd_"; // you got this from the signup page
                            echo recaptcha_get_html($publickey);
                        ?>

<p><input type="submit" name="submit" value="Buy Now" class="submitBTN" style="margin-top:10px; margin-bottom:10px" /></p>
            </form>
                        </div>
                    </div>
                    	<?php $this->load->view('frontend/includes/right');?> 
                </div>
            </div>
        </div>

		<link href="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" media="screen">
		<script src="<?php echo base_url(); ?>assets/plugin/jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js"></script>
        
  <script>
  $(function() {
    $( "#accordion" ).accordion({
      heightStyle: "content",
	  collapsible: true
    });
  });
  </script>

<script>

function unchecked(id)
{
	$( "."+id ).prop( "checked", false );	
}

function show(id)
{
	$( ".year_"+id ).show();	
	$( ".volume_"+id ).show();
	$( ".journal_"+id ).prop( "checked", false );	
	$( ".radio_year_"+id ).prop( "checked", false );		
}
   
function hide(id)
{
	$( ".year_"+id ).hide();	
	$( ".volume_"+id ).hide();	
	
	$( ".year_"+id+" input[type=radio]" ).prop( "checked", false );	
	$( ".volume_"+id+" input[type=radio]" ).prop( "checked", false );	
}

function showvolume(id)
{
	$( ".volume_"+id ).show();
	$( ".journal_"+id ).prop( "checked", false );	
}
   
function hidevolume(id)
{
	$( ".volume_"+id ).hide();		
	
	$( ".volume_"+id+" input[type=radio]" ).prop( "checked", false );
}

</script> 
 