<?php
if($this->controller and $this->router->class != 'backend_home')
{
?>
<ul class="nav nav-pills">





<?php
if($this->controller == $this->config->item('backend').'/journals')
{
?>
  <li><a href="<?php echo site_url($this->config->item('backend').'/subjects');?>">Subjects</a></li>
<?php
}
?> 

<?php
if($this->controller == $this->config->item('backend').'/subjects')
{
?>
  <li><a href="<?php echo site_url($this->config->item('backend').'/journals');?>">Journals</a></li>
<?php
}
?> 





  <li<?php if($this->router->method == 'index') { echo ' class="active"'; }?>><a href="<?php echo site_url($this->controller);?>"><?php echo $this->title_plural;?></a></li>
<?php
if($this->action_add)
{
?>
  <li<?php if($this->router->method == 'add') { echo ' class="active"'; }?>><a href="<?php echo site_url($this->controller.'/add');?>">Add New <?php echo $this->title;?></a></li>
<?php
}
?>  
</ul>
<?php
}
?>