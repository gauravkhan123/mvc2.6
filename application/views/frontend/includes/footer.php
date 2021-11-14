<!--footer-->
    <!--footer top-->
<div class="ofooter">
    <div class="container">
    <div class="row">
    
    <div class="col-md-3">
    <h3>Quick Link</h3>
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
    
    
     <div class="col-md-3">
    <h3>Quick Link</h3>
    <ul>
    <li><a href="<?php echo site_url('page/about-us');?>">About Us</a></li>
    <li><a href="<?php echo site_url('page/privacy-policy');?>">Privacy Policy</a></li>
    <li><a href="<?php echo site_url('page/terms-conditions');?>">Terms & Conditions</a></li>
    <li><a href="<?php echo site_url('page/faqs-help');?>">FAQs & Help</a></li>
    </ul>
    </div>
    
     <div class="col-md-3">
    <h3>Newsletter</h3>
   <form class="footerform" method="post" action="<?php echo site_url('user/emailsubscription');?>">
   <input type="text" name="name" placeholder="Name..." />
   <input type="text" name="email" placeholder="Email..."  />
   <input type="submit" name="submit" value="Submit" />
   </form>
    </div>
    
    
     <div class="col-md-3">
    <h3>Follow Us</h3>
    <ul class="ofootsocial">
    <li><a href=""><i class="fa fa-facebook"></i></a></li>
    <li><a href=""><i class="fa fa-twitter"></i></a></li>
    <li><a href=""><i class="fa fa-rss"></i></a></li>
    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
    </ul>
    
    <h3>Address</h3>
    <address>
    <p>Email : hr@oaacademic.com</p>
    <p>Mobile : +91 9911 745 157</p>
    <p>Telephone : 52876425</p>
    </address>
    </div>
    
    </div>
    </div>
    </div>
    
    <div class="ofooterbtm">
    <div class="container">
    <div class="row">
    <div class="col-md-12 text-center">
    <p>All Rights Reserved 2016 OA Academic Press</p>
    </div>
    </div>
    </div>
    </div>
<!--end footer bottom-->
    <!--end footer-->
