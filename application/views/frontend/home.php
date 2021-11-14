<div class="oa1">
    <div class="container">
    <div class="row">
    <div class="col-md-8" style="padding-right:0 !important;">
    <!--slider-->
 
 <div class="demo-2" >
		
		
            <div id="slider" class="sl-slider-wrapper">

			<div class="sl-slider">
				
					<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
						<div class="sl-slide-inner">
							<img src="<?php echo base_url();?>assets/themes/frontend/images/banner.jpg" />
							<h2>OA ACADEMIC PRESS</h2>
							<blockquote><cite>Interdum et malesuada</cite><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, </p></blockquote>
						</div>
					</div>
					
					<div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
						<div class="sl-slide-inner">
							<img src="<?php echo base_url();?>assets/themes/frontend/images/banner.jpg" />
							<h2>OA ACADEMIC PRESS</h2>
							<blockquote><cite>Interdum et malesuada</cite><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, </p></blockquote>
						</div>
					</div>
					
					<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
						<div class="sl-slide-inner">
							<img src="<?php echo base_url();?>assets/themes/frontend/images/banner.jpg" />
							<h2>OA ACADEMIC PRESS</h2>
						
							<blockquote><cite>Interdum et malesuada</cite><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, </p></blockquote>
						</div>
					</div>
					
				
					
				</div><!-- /sl-slider -->

				<nav id="nav-dots" class="nav-dots">
					<span class="nav-dot-current"></span>
					<span></span>
					<span></span>
					
				</nav>

			</div><!-- /slider-wrapper -->


        </div>
		
		<script type="text/javascript" src="<?php echo base_url();?>assets/themes/frontend/slider2/js/jquery.ba-cond.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/themes/frontend/slider2/js/jquery.slitslider.js"></script>
		<script type="text/javascript">	
			$(function() {
			
				var Page = (function() {

					var $nav = $( '#nav-dots > span' ),
						slitslider = $( '#slider' ).slitslider( {
							onBeforeChange : function( slide, pos ) {

								$nav.removeClass( 'nav-dot-current' );
								$nav.eq( pos ).addClass( 'nav-dot-current' );

							}
						} ),

						init = function() {

							initEvents();
							
						},
						initEvents = function() {

							$nav.each( function( i ) {
							
								$( this ).on( 'click', function( event ) {
									
									var $dot = $( this );
									
									if( !slitslider.isActive() ) {

										$nav.removeClass( 'nav-dot-current' );
										$dot.addClass( 'nav-dot-current' );
									
									}
									
									slitslider.jump( i + 1 );
									return false;
								
								} );
								
							} );

						};

						return { init : init };

				})();

				Page.init();

				/**
				 * Notes: 
				 * 
				 * example how to add items:
				 */

				/*
				
				var $items  = $('<div class="sl-slide sl-slide-color-2" data-orientation="horizontal" data-slice1-rotation="-5" data-slice2-rotation="10" data-slice1-scale="2" data-slice2-scale="1"><div class="sl-slide-inner bg-1"><div class="sl-deco" data-icon="t"></div><h2>some text</h2><blockquote><p>bla bla</p><cite>Margi Clarke</cite></blockquote></div></div>');
				
				// call the plugin's add method
				ss.add($items);

				*/
			
			});
		</script>
 <!--end slider-->
 
    </div>
 <div class="col-md-4" style="padding-left:0 !important;">
 <div class="oaabout">
 <h2>About us </h2>

 <p> <?php 
 $data= get_one_record(" select  description from pages where alias = 'about-us'");
 
 echo  $data['description'];?></p>
 <a href="<?php echo site_url('page/about-us');?>">Read More</a>
 </div>
 </div>
    
    </div>
    </div>
    </div>
    
    <!--end oa1-->
    
    <!--oa2-->
    <div class="oa2">
    <div class="container">
    <div class="row">
 <div class="col-md-4">
 <div class="oablock">
 <a href=""><h3>A versatile, content switchblade plugin with a rich UI A versatile</h3></a>
 <img src="<?php echo base_url();?>assets/themes/frontend/images/blk1.jpg" alt="" title="" />
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper facilisis...</p>
 <a href="" class="grnbtn">Read More</a>
 </div>
 </div>   
 
 <div class="col-md-4">
 <div class="oablock">
 <a href=""><h3>A versatile, content switchblade plugin with a rich UI A versatile</h3></a>
 <img src="<?php echo base_url();?>assets/themes/frontend/images/blk1.jpg" alt="" title="" />
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper facilisis...</p>
 <a href="" class="grnbtn">Read More</a>
 </div>
 </div>  
 
 
 <div class="col-md-4">
 <div class="oablock">
 <a href=""><h3>A versatile, content switchblade plugin with a rich UI A versatile</h3></a>
 <img src="<?php echo base_url();?>assets/themes/frontend/images/blk1.jpg" alt="" title="" />
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper facilisis...</p>
 <a href="" class="grnbtn">Read More</a>
 </div>
 </div>  
 
    
    </div>
    </div>
    </div>
    
    <!--end oa2-->
    
    
    <!--oa3-->
    <div class="oa3">
    <div class="container">
    <div class="row">
 <div class="col-md-4">
 <div class="oablock">
 <a href=""><h3>A versatile, content switchblade plugin with a rich UI A versatile</h3></a>
 <img src="<?php echo base_url();?>assets/themes/frontend/images/blk1.jpg" alt="" title="" />
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper facilisis...</p>
 <a href="" class="grnbtn">Read More</a>
 </div>
 </div>   
 
 <div class="col-md-5">
 <div class="oablock bggray oablock2">
 <a href=""><h3>A versatile, content switchblade plugin with a rich UI A versatile</h3></a>
 <img src="<?php echo base_url();?>assets/themes/frontend/images/blk1.jpg" alt="" title="" />
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper facilisis...</p>
 <a href="" class="grnbtn">Read More</a>
 </div>
 </div>  
 
 
 <div class="col-md-3">
 <ul class="oaservicelist">
 <a href=""><h3>OA Academic Our Services</h3></a>
 <li>Lorem ipsum dolor sit ame ectetur adipiscing elit</li>
<li>Lorem ipsum dolor sit ame ectetur adipiscing elit</li>
<li>Lorem ipsum dolor sit ame ectetur adipiscing elit</li>
<li>Lorem ipsum dolor sit ame ectetur adipiscing elit</li>
<li>Lorem ipsum dolor sit ame ectetur adipiscing elit</li>
<li>Lorem ipsum dolor sit ame ectetur adipiscing elit</li>
<a href="">View All</a>
 </ul>
 </div>  
 
    
    </div>
    </div>
    </div>
    
    <!--end oa3-->
    
 