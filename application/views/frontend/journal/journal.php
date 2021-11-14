<!--mid-->
<div class="oamid">
<div class="container">
<div class="row">

<div class="col-md-9">
<h2 class="mainh2">Journal of Global Ecology and Environment <span></span></h2>

<?php
if(!empty($data['subjects']))
{
	foreach($data['subjects'] as $value)
	{
 ?>       
<ul class="pageul">
<h3><?php echo $value['name'];?></h3>
<?php
$journals = get_few_record("select Id,name from journals where publish=1 and main_cat='".$value['Id']."' order by name");

if(!empty($journals))
{
	foreach($journals as $jour)
	{
?>   
<li><a href="<?php echo site_url('journal/'.$jour['Id']);?>">
                                                	<?php echo $jour['name'];?>
                                                </a></li>
    <?php
    }
}
else
{
echo "No list available.";
}

    ?>  
</ul>
<?php
	}
}

else
{
echo "No Subject available.";
}
 ?>       


</div>
<?php echo $this->load->view("frontend/includes/right");?>
</div>
</div>
</div>