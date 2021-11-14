

    <!--header-->
<?php
$userdata = $this->session->userdata('frontuser');

?>
   <!--nav-->
<div class="container">
<div class="row">
    <div class="col-md-2 col-sm-2  col-xs-12 ">
    <div class="qlogo">
    <a href="<?php echo site_url('home');?>"><img src="<?php echo base_url();?>assets/themes/frontend/images/logo.png" /></a>
    </div>
    </div>
    <div class="col-md-7 col-sm-7 col-xs-12">
    <div id='cssmenu'>
<ul>
<?php
$data = get_few_record("select link_url,link_name from top_menu where  publish=1 order by link_position asc");

if(!empty($data))
{
	foreach($data as $key=>$value)
	{
?>  


				<li class="<?php if($key==sizeof($data)){?>last<?php }?> <?php if($key==0){?>first<?php }?>">
                <a <?php if($_SERVER['REQUEST_URI']=='/'.$value['link_url']){?>class="active"<?php }?> 
                href="<?php echo site_url($value['link_url'])?>"><?php echo $value['link_name']?></a></li>
<?php
	}
}
?>
</ul>
</div>

    </div>
    
    <div class="col-md-3 col-sm-3 col-xs-12 text-right">

    <?php  include('google_search.php');?>

    </div>
    <div class="navigation col-sm-12 col-md-12">
                	<div class="logintop">
                    	<div class="row">
                    	<div class="col-lg-12 pullright">
                    	<div class="login_register">
 <?php if(!empty($userdata['Id'])) { ?>                         
                        <a href="<?php echo site_url('user/myaccount');?>">Welcome <?php echo $userdata['name'];?>!!</a>
                        <a href="<?php echo site_url('user/logout');?>">Logout</a>

                            <?php } else { ?> 
                    	<a href="<?php echo site_url('user/register');?>">Register Now!</a>
                        <a href="<?php echo site_url('user/login');?>">Login</a>
                        <?php } ?>                         
                        </div>
                       
                        </div>
                        </div>
                    </div>
    
    
      </div>
</div>
</div>
     <!--end nav-->   
       
  

    <!--end header-->
    
      <?php $this->load->view('frontend/includes/message');?> 