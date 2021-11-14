<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo site_url($this->config->item('backend').'/home');?>">Admin Panel</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<?php 
								
								echo $this->session->userdata['user']['name'];
								?>
                                 <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/profile/view/'.$this->session->userdata['user']['Id']);?>">Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/logout');?>">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li<?php if($this->router->fetch_class() == 'backend_home') { echo ' class="active"'; }?>>
                                <a href="<?php echo site_url($this->config->item('backend').'/home');?>">Dashboard</a>
                            </li>
                            
<li class="dropdown <?php if($this->router->fetch_class() == 'backend_pages' || $this->router->fetch_class() == 'backend_category' ||$this->router->fetch_class() == 'backend_books' ||$this->router->fetch_class() == 'backend_books_category' || $this->router->fetch_class() == 'backend_product' || $this->router->fetch_class() == 'backend_articles' || $this->router->fetch_class() == 'backend_article_type' || $this->router->fetch_class() == 'backend_manuscript' || $this->router->fetch_class() == 'backend_issues' || $this->router->fetch_class() == 'backend_subjects' || $this->router->fetch_class() == 'backend_journals' || $this->router->fetch_class() == 'backend_awards' || $this->router->fetch_class() == 'backend_announcements') { echo ' active'; }?>">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Content <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    
                                    
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 
									'staff' && check_staff_permission($this->session->userdata['user']['Id'],'pages')))
									{
									?>
                                        <li<?php if($this->router->fetch_class() == 'backend_pages') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/pages');?>">Pages</a>
                                        </li>
                                    <?php
									}
									?>
									<?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'products')))
									{
									?>
                                        <li<?php if($this->router->fetch_class() == 'backend_product') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/product');?>">Products</a>
                                        </li>
                                    <?php
									}
									?>
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'category')))
									{
									?>
                                        <li<?php if($this->router->fetch_class() == 'backend_category') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/category');?>">Categories</a>
                                        </li>
                                    <?php
									}
									?>
									<?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 
									'books_category' && check_staff_permission($this->session->userdata['user']['Id'],'books_category')))
									{
									?>
                                        <li<?php if($this->router->fetch_class() == 'backend_books_category') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/books_category');?>">Books Category</a>
                                        </li>
                                    <?php
									}
									?>
									<?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 
									'books' && check_staff_permission($this->session->userdata['user']['Id'],'books')))
									{
									?>
                                        <li<?php if($this->router->fetch_class() == 'backend_books') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/books');?>">Books </a>
                                        </li>
                                    <?php
									}
									?>
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'articles')))
									{
									?>                                    
                                        <li<?php if($this->router->fetch_class() == 'backend_articles') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/articles');?>">Articles</a>
                                        </li>
                                    <?php
									}
									?>                                    
                                    
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'article_type')))
									{
									?>                                     
                                        <li<?php if($this->router->fetch_class() == 'backend_article_type') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/article_type');?>">Article Type</a>
                                        </li>
                                    <?php
									}
									?> 
                                    
<?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'departments')))
									{
									?>                                                                        
                                        <li<?php if($this->router->fetch_class() == 'backend_departments') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/departments');?>">Departments</a>
                                        </li>
                                    <?php
									}
									?>  

                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'deptcomments')))
									{
									?>                                                                        
                                        <li<?php if($this->router->fetch_class() == 'backend_deptcomments') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/deptcomments');?>">Department Comments</a>
                                        </li>
                                    <?php
									}
									?>                                                                           
                                    
                                    <?php /*?><li<?php if($this->router->fetch_class() == 'backend_manuscripts') { echo ' class="active"'; }?>>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/manuscripts');?>">Manuscript</a>
                                    </li><?php */?>
                                    
                                    
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'issues')))
									{
									?>
                                        <li<?php if($this->router->fetch_class() == 'backend_issues') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/issues');?>">Issues</a>
                                        </li>
                                    <?php
									}
									?>  
                                    
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'subjects')))
									{
									?>                                                                        
                                        <li<?php if($this->router->fetch_class() == 'backend_subjects') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/subjects');?>">Subjects</a>
                                        </li>
                                    <?php
									}
									?>     
                                    
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'journals')))
									{
									?>                                                                        
                                        <li<?php if($this->router->fetch_class() == 'backend_journals') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/journals');?>">Journals</a>
                                        </li>
                                    <?php
									}
									?>   
                                    
                                   <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'journals_aip')))
									{
									?>                                                                        
                                        <li<?php if($this->router->fetch_class() == 'backend_journals_aip') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/journals_aip');?>">Article in Press</a>
                                        </li>
                                    <?php
									}
									?>   
                                    
                                   <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'journals_ebm')))
									{
									?>                                                                        
                                        <li<?php if($this->router->fetch_class() == 'backend_journals_ebm') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/journals_ebm');?>">Editorial Board Members</a>
                                        </li>
                                    <?php
									}
									?>                                                                                             
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'announcements')))
									{
									?>                                    
                                        <li<?php if($this->router->fetch_class() == 'backend_announcements') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/announcements');?>">Announcement & News</a>
                                        </li>    
                                    <?php
									}
									?>      
<?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'manuscripts')))
									{
									?>                                                                        
                                        <li<?php if($this->router->fetch_class() == 'backend_manuscripts') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/manuscripts');?>">Manuscripts</a>
                                        </li>
                                    <?php
									}
									?>                                       
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'coupon')))
									{
									?>                                    
                                        <li<?php if($this->router->fetch_class() == 'backend_coupon') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/coupon');?>">Coupons</a>
                                        </li>    
                                    <?php
									}
									?>                                                                                                     
                                </ul>
                            </li>          
<li class="dropdown <?php if($this->router->fetch_class() == 'backend_top_menu' || $this->router->fetch_class() == 'backend_quick_link' || $this->router->fetch_class() == 'backend_quick_link_journal') { echo ' active'; }?>">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Menu <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'top_menu')))
									{
									?>                                 
                                        <li<?php if($this->router->fetch_class() == 'backend_pages') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/top_menu');?>">Top Menu</a>
                                        </li>
                                    <?php
									}
									?>    
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'quick_link')))
									{
									?>                                                                           
                                        <li>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/quick_link');?>">Quick Links</a>
                                        </li>
                                    <?php
									}
									?>  
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'quick_link_journal')))
									{
									?>                                                                             
                                        <li>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/quick_link_journal');?>">Quick Links Journal</a>
                                        </li> 
                                    <?php
									}
									?>                                                                             
                                </ul>
                            </li>    
<li class="dropdown <?php if($this->router->fetch_class() == 'backend_common_meta' || $this->router->fetch_class() == 'backend_misc_meta') { echo ' active'; }?>">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">SEO Settings <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'common_meta')))
									{
									?>                                 
                                        <li>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/common_meta');?>">Common Meta Tags</a>
                                        </li>
                                    <?php
									}
									?>  
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'misc_meta')))
									{
									?>                                                                          
                                        <li>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/misc_meta');?>">Meta Tags Misc.</a>
                                        </li>  
                                    <?php
									}
									?>                                                                           
                                </ul>
                            </li>
<li class="dropdown <?php if($this->router->fetch_class() == 'backend_documents' || $this->router->fetch_class() == 'backend_pictures') { echo ' active'; }?>">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Media<i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'documents')))
									{
									?>                                 
                                        <li<?php if($this->router->fetch_class() == 'backend_documents') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/documents');?>">Documents</a>
                                        </li>
                                    <?php
									}
									?>  
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'pictures')))
									{
									?>                                                                            
                                        <li<?php if($this->router->fetch_class() == 'backend_pictures') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/pictures');?>">Pictures</a>
                                        </li>
                                    <?php
									}
									?>      
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'slider')))
									{
									?>                                                                            
                                        <li<?php if($this->router->fetch_class() == 'backend_slider') { echo ' class="active"'; }?>>
                                            <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/slider');?>">Slider</a>
                                        </li>
                                    <?php
									}
									?>                                                                                                              
                                </ul>
                            </li>
<?php
if(1==2)
{
?>                            
<li<?php if($this->router->fetch_class() == 'backend_coupon') { echo ' class="active"'; }?>>
                                <a href="<?php echo site_url($this->config->item('backend').'/coupon');?>">Coupons </a>
                            </li>

                            
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="#">Tools <i class="icon-arrow-right"></i>

                                        </a>
                                        <ul class="dropdown-menu sub-menu">
                                            <li>
                                                <a href="#">Reports</a>
                                            </li>
                                            <li>
                                                <a href="#">Logs</a>
                                            </li>
                                            <li>
                                                <a href="#">Errors</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">SEO Settings</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Content <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Blog</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">News</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Custom Pages</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Calendar</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="#">FAQ</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">User List</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Search</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Permissions</a>
                                    </li>
                                </ul>
                            </li>
<?php
}
?>                            
							
<?php /*?><li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Invoices <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Invoices</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Manual Invoices</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#"> Invoice Address</a>
                                    </li>                                    
                                </ul>
                            </li><?php */?>
                            
                            
							<?php
                            if($this->session->userdata['user']['type'] == 'admin')
                            {
                            ?>
                            <li class="dropdown <?php if($this->router->fetch_class() == 'backend_users' || $this->router->fetch_class() == 'backend_staff') { echo ' active'; }?>">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'users')))
									{
									?>                                  
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/users');?>">User</a>
                                    </li>
									<?php
                                    }
                                    ?>                                   
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/subscribers');?>">Subscribers</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/staff');?>">Staff</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/pricing/edit/1');?>">Pricing</a>
                                    </li>                                    
                                </ul>
                            </li>
                            <li class="dropdown <?php if($this->router->fetch_class() == 'backend_settings' || $this->router->fetch_class() == 'backend_developing_countries') { echo ' active'; }?>">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Settings <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/settings');?>">Default Settings</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/developing_countries');?>">Developing Countries</a>
                                    </li>
                                    
<?php
                            if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'email_templates')))
                            {
                            ?>                                                  
                                    <li<?php if($this->router->fetch_class() == 'backend_email_templates') { echo ' class="active"'; }?>>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/email_templates');?>">Email Templates</a>
                                    </li>  
							<?php
                            }
                            ?>      
                            
							<?php
                            if($this->session->userdata['user']['type'] == 'admin' || ($this->session->userdata['user']['type'] == 'staff' && check_staff_permission($this->session->userdata['user']['Id'],'invoices')))
                            {
                            ?>                                                  
                                    <li<?php if($this->router->fetch_class() == 'backend_invoices') { echo ' class="active"'; }?>>
                                        <a tabindex="-1" href="<?php echo site_url($this->config->item('backend').'/invoices');?>">Invoices</a>
                                    </li>  
							<?php
                            }
                            ?>                                         
                                                                        
                                </ul>
                            </li>
							<?php
							}
							?>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>