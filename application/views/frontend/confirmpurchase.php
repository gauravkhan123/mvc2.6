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

.errors p
{
	color:#F00;	
}

span.error-advise
{
	display:block;
	color:#f00;
	clear:both;
}
  </style>
  <div class="mid">
	<div class="web-wrap">
		<?php echo $this->load->view("frontend/includes/slider");?>
	
				<div class="content">
                
			<div class="left-side">
            
<?php

$subscriptionData = $this->session->userdata('subscription');
//pr($subscriptionData['subscription']['journal'],false);


foreach($subscriptionData['journal'] as $key=>$value)
{
	if(is_array($value))
	{
			foreach($value as $key2=>$value2)
			{
				if(is_array($value2))
				{
					foreach($value2 as $key3=>$value3)
					{
						if(!is_array($value3))
						{
							$vals3 = explode("-",$value3);
							
							
							$index = "Volume $key3 - " . get_corresponing_value('journals','name',$key,'Id');
							$product_type = "Volume";		
							$purchase_type = $vals3[1];				
							$price = $vals3[0];
							
							$purchasedItems[] = array("Index"=>$index,"Product Type"=>$product_type,"Purchase Type"=>$purchase_type,"Price"=>$price);							
						}
						
					}
				}
				else
				{
					$vals2 = explode("-",$value2);
					
					
					$index = "Year $key2 - " . get_corresponing_value('journals','name',$key,'Id');
					$product_type = "Year";		
					$purchase_type = $vals2[1];				
					$price = $vals2[0];
					
				$purchasedItems[] = array("Index"=>$index,"Product Type"=>$product_type,"Purchase Type"=>$purchase_type,"Price"=>$price);					
				}
				
				
			}
	}
	else
	{
		$vals = explode("-",$value);
		
		
		$index = "Full Journal - " . get_corresponing_value('journals','name',$key,'Id');
		$product_type = "Journal";		
		$purchase_type = $vals[1];				
		$price = $vals[0];
		
		$purchasedItems[] = array("Index"=>$index,"Product Type"=>$product_type,"Purchase Type"=>$purchase_type,"Price"=>$price);		
	}
	
	
}

//pr($purchasedItems,false);

//pr($userData['frontuser']);
?>

					<h2>Confirm Purchase</h2>
						
                    <table class="clean-table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Index</th>
                            <th>Product Type</th>
                            <th>Purchase Type</th>
                            <th>Price (USD)</th>                    
                        </tr>
                    </thead>
                    <tbody>
<?php
if(!empty($purchasedItems))
{
	foreach($purchasedItems as $newkey=>$newvalue)
	{
		
		if($newvalue["Purchase Type"] == "OS")
		{
			$purchase_type = "Online Subscription";
		}
		else if($newvalue["Purchase Type"] == "PS")
		{
			$purchase_type = "Print Subscription";
		}
		else if($newvalue["Purchase Type"] == "OPS")
		{
			$purchase_type = "Online &nbsp; Print Subscription";			
		}

?>                    
                        <tr>                    
                            <td><?php echo $newkey+1;?></td>
                            <td><?php echo $newvalue["Index"];?></td>
                            <td><?php echo $newvalue["Product Type"];?></td>
                            <td><?php echo $purchase_type;?></td>
                            <td><?php echo $newvalue["Price"];?></td>
                        </tr>                                               
<?php

		
		$total += $newvalue["Price"];
	}
}
?>
<tr>                    
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><strong>Total</strong></td>
                            <td><?php echo $total;?></td>
                      </tr>
                    </tbody>                    
                    </table>
                    <h2>Billing Details</h2>

<?php

		if(!$this->session->userdata('frontuser'))

		{
?>                    
                    
<div class="register-form">
<h3>Already have subscription, please login?</h3>
<p>Login for quick checkout and merge your old subscriptions. You will avoid buying previous products.</p>

                                        <form name="main_login" id="main_login" action="<?php echo site_url('user/subscriberloginpurchase'); ?>" method="post">
                                        
                                        
							<p>
                            <label for="username">Username / Email-ID <span>*</span></label>
                            <input type="text" value="<?php echo set_value('email'); ?>" id="email" name="email">
                            <?php echo form_error('email','<span class="error-advise">','</span>'); ?> 
                        </p>
						
						<p>
                            <label for="password">Password <span>*</span></label>
                            <input type="password" value="<?php echo set_value('username'); ?>" id="password" name="password">
                            <?php echo form_error('password','<span class="error-advise">','</span>'); ?> 
                        </p>       
                        <p><input type="submit" name="submit" id="submit"  class="submitBTN" value="Login & Pay" /></p>                                 
                                        
                                        </form>
					</div>
                    
<div class="register-form">
<h3>New Subscription ?</h3>
<p>Your current order will process immediately, we will create your new account and after payment approval, we will send you the username and password via Email.</p>


              <form name="register_form" id="register_form" method="post" action="<?php echo site_url('home/confirmpurchase'); ?>" enctype="multipart/form-data">
					
						<p><input type="hidden" name="mc_gross" value="<?php echo $total;?>" />
                            <label for="name">Name <span>*</span></label>
                            <input type="text" value="<?php echo set_value('name',isset($userdata['name'])?$userdata['name']:''); ?>" id="name" name="name">
                            <?php echo form_error('name','<span class="error-advise">','</span>'); ?> 
                        </p>
						
						<p>
                            <label for="username">Email <span>*</span></label>
                            <input type="text" value="<?php echo set_value('username',isset($userdata['username'])?$userdata['username']:''); ?>" id="username" name="username">
                            <?php echo form_error('username','<span class="error-advise">','</span>'); ?> 
                        </p>
						
						
                        <p>
                            <label for="institute_name">Institute Name <span>*</span></label>
                            <input type="text" value="<?php echo set_value('institute_name',isset($userdata['institute_name'])?$userdata['institute_name']:''); ?>" id="institute_name" name="institute_name">
                            <?php echo form_error('institute_name','<span class="error-advise">','</span>'); ?> 
                        </p>
						
						<p>
                            <label for="contact_no">Contact No. <span>*</span></label>
                            <input type="text" value="<?php echo set_value('contact_no',isset($userdata['contact_no'])?$userdata['contact_no']:''); ?>" id="contact_no" name="contact_no">
                            <?php echo form_error('contact_no','<span class="error-advise">','</span>'); ?>                          
                        </p>
						
					
						<p>
                            <label for="address1">Address 1</label>
                            <input type="text" value="<?php echo set_value('address1',isset($userdata['address1'])?$userdata['address1']:''); ?>" id="address1" name="address1">
                            <?php echo form_error('address1','<span class="error-advise">','</span>'); ?>                         
                        </p>
                        
						<p>
                            <label for="address2">Address 2</label>
                            <input type="text" value="<?php echo set_value('address2',isset($userdata['address2'])?$userdata['address2']:''); ?>" id="address2" name="address2">
                            <?php echo form_error('address2','<span class="error-advise">','</span>'); ?>                         
                        </p> 
                        
						<p>
                            <label for="country">Country <span>*</span></label>
                            <select id="country" name="country">
                                                          <option value="" >Select</option>
            <?php if(!empty($countries))
            {
                foreach($countries as $value)
                {
            ?>                                              
                                                          <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == set_value('country',isset($userdata['country'])?$userdata['country']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
            <?php
                }
            }
            ?>                                               
                                                        </select>
                            <?php echo form_error('country','<span class="error-advise">','</span>'); ?>                           
                        </p>   
                        
						<p>
                            <label for="state">State</label>
                            <input type="text" value="<?php echo set_value('state',isset($userdata['state'])?$userdata['state']:''); ?>" id="state" name="state">
                            <?php echo form_error('state','<span class="error-advise">','</span>'); ?>                         
                        </p> 
                        
						<p>
                            <label for="city">City</label>
                            <input type="text" value="<?php echo set_value('city',isset($userdata['city'])?$userdata['city']:''); ?>" id="city" name="city">
                            <?php echo form_error('city','<span class="error-advise">','</span>'); ?>                         
                        </p> 
                        
						<p>
                            <label for="zip">Zip</label>
                            <input type="text" value="<?php echo set_value('zip',isset($userdata['zip'])?$userdata['zip']:''); ?>" id="zip" name="zip">
                            <?php echo form_error('zip','<span class="error-advise">','</span>'); ?>                         
                        </p>                                                                                                                    

						<p><input type="submit" name="submitRegister" id="submitRegister" class="submitBTN" value="Create Account & Pay" /></p>
						</form>   
                                        
 					</div>                    

                
<?php
		}
		else
		{
?>       
<div class="login-txt-filled">
					<div class="register-form">
                                      <form name="register_form" id="register_form" method="post" action="" enctype="multipart/form-data">
					
						<p><input type="hidden" name="mc_gross" value="<?php echo $total;?>" />
                            <label for="name">Name <span>*</span></label>
                            <input type="text" value="<?php echo set_value('name',isset($userdata['name'])?$userdata['name']:''); ?>" id="name" name="name">
                            <?php echo form_error('name','<span class="error-advise">','</span>'); ?> 
                        </p>
						
						<p>
                            <label for="username">Email <span>*</span></label>
                            <input type="text" value="<?php echo set_value('username',isset($userdata['username'])?$userdata['username']:''); ?>" id="username" name="username">
                            <?php echo form_error('username','<span class="error-advise">','</span>'); ?> 
                        </p>
						
						
                        <p>
                            <label for="institute_name">Institute Name <span>*</span></label>
                            <input type="text" value="<?php echo set_value('institute_name',isset($userdata['institute_name'])?$userdata['institute_name']:''); ?>" id="institute_name" name="institute_name">
                            <?php echo form_error('institute_name','<span class="error-advise">','</span>'); ?> 
                        </p>
						
						<p>
                            <label for="contact_no">Contact No. <span>*</span></label>
                            <input type="text" value="<?php echo set_value('contact_no',isset($userdata['contact_no'])?$userdata['contact_no']:''); ?>" id="contact_no" name="contact_no">
                            <?php echo form_error('contact_no','<span class="error-advise">','</span>'); ?>                          
                        </p>
						
					
						<p>
                            <label for="address1">Address 1</label>
                            <input type="text" value="<?php echo set_value('address1',isset($userdata['address1'])?$userdata['address1']:''); ?>" id="address1" name="address1">
                            <?php echo form_error('address1','<span class="error-advise">','</span>'); ?>                         
                        </p>
                        
						<p>
                            <label for="address2">Address 2</label>
                            <input type="text" value="<?php echo set_value('address2',isset($userdata['address2'])?$userdata['address2']:''); ?>" id="address2" name="address2">
                            <?php echo form_error('address2','<span class="error-advise">','</span>'); ?>                         
                        </p> 
                        
						<p>
                            <label for="country">Country <span>*</span></label>
                            <select id="country" name="country">
                                                          <option value="" >Select</option>
            <?php if(!empty($countries))
            {
                foreach($countries as $value)
                {
            ?>                                              
                                                          <option value="<?php echo $value['Id'];?>" <?php if($value['Id'] == set_value('country',isset($userdata['country'])?$userdata['country']:'')) { echo 'selected="selected"'; } ?>><?php echo $value['name'];?></option>
            <?php
                }
            }
            ?>                                               
                                                        </select>
                            <?php echo form_error('country','<span class="error-advise">','</span>'); ?>                           
                        </p>   
                        
						<p>
                            <label for="state">State</label>
                            <input type="text" value="<?php echo set_value('state',isset($userdata['state'])?$userdata['state']:''); ?>" id="state" name="state">
                            <?php echo form_error('state','<span class="error-advise">','</span>'); ?>                         
                        </p> 
                        
						<p>
                            <label for="city">City</label>
                            <input type="text" value="<?php echo set_value('city',isset($userdata['city'])?$userdata['city']:''); ?>" id="city" name="city">
                            <?php echo form_error('city','<span class="error-advise">','</span>'); ?>                         
                        </p> 
                        
						<p>
                            <label for="zip">Zip</label>
                            <input type="text" value="<?php echo set_value('zip',isset($userdata['zip'])?$userdata['zip']:''); ?>" id="zip" name="zip">
                            <?php echo form_error('zip','<span class="error-advise">','</span>'); ?>                         
                        </p>                                                                                                                    

						<p style="padding-left:185px;"><input type="submit" name="submit" id="submit" class="submitBTN" value="Confirm & Pay" /></p>
						</form>   
                                        
 					</div>
									
				</div>
<?php
		}
		?>                             
			</div>
			
<?php 

	if($this->session->userdata('frontuser'))
		{
			$this->load->view('frontend/includes/right');
			
			        }
			?>      

        
		</div>
	</div>
</div>

<style>
.register-form p
{
	margin-bottom:10px;	
	padding:0;		
}


.register-form
{
	width:450px;
	float:left;
	margin-right:30px;
}


</style>