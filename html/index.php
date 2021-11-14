<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
        <title></title>         
        <meta name="description" content="" />
        <meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/qa.css" rel="stylesheet" />
        <link href="css/qa-responsive.css" rel="stylesheet" />
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Bootstrap -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		 <!--animation-->
    <script src="js/wow.min.js"></script>
    <script>
       new WOW().init();
     </script>
    <!--end animation-->

   <!--nav-->
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="js/script.js"></script>
   <!--end nav-->
   
   <!--slider-->
        <link rel="stylesheet" type="text/css" href="slider2/css/style.css" />
        <link rel="stylesheet" type="text/css" href="slider2/css/custom.css" />
		<script type="text/javascript" src="slider2/js/modernizr.custom.79639.js"></script>

<!--end slider-->
   
    </head>
    <body>
    <div class="qmain">
    <!--header-->
    <?php include('header.php'); ?>
    <!--end header-->
    
    <!--oa1-->
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
							<img src="images/banner.jpg" />
							<h2>OA ACADEMIC PRESS</h2>
							<blockquote><cite>Interdum et malesuada</cite><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, </p></blockquote>
						</div>
					</div>
					
					<div class="sl-slide" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
						<div class="sl-slide-inner">
							<img src="images/banner.jpg" />
							<h2>OA ACADEMIC PRESS</h2>
							<blockquote><cite>Interdum et malesuada</cite><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, </p></blockquote>
						</div>
					</div>
					
					<div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
						<div class="sl-slide-inner">
							<img src="images/banner.jpg" />
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
		
		<script type="text/javascript" src="slider2/js/jquery.ba-cond.min.js"></script>
		<script type="text/javascript" src="slider2/js/jquery.slitslider.js"></script>
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
 <h2>about this journal <span>Interdum et malesuada</span></h2>
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper facilisis. Fusce vestibulum est rhoncus bibendum fermentum. Vivamus sit amet ullamcorper justo, in feugiat erat. In eu lacus Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper </p>
 <a href="">Read More</a>
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
 <img src="images/blk1.jpg" alt="" title="" />
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper facilisis...</p>
 <a href="" class="grnbtn">Read More</a>
 </div>
 </div>   
 
 <div class="col-md-4">
 <div class="oablock">
 <a href=""><h3>A versatile, content switchblade plugin with a rich UI A versatile</h3></a>
 <img src="images/blk1.jpg" alt="" title="" />
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper facilisis...</p>
 <a href="" class="grnbtn">Read More</a>
 </div>
 </div>  
 
 
 <div class="col-md-4">
 <div class="oablock">
 <a href=""><h3>A versatile, content switchblade plugin with a rich UI A versatile</h3></a>
 <img src="images/blk1.jpg" alt="" title="" />
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
 <img src="images/blk1.jpg" alt="" title="" />
 <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec porttitor, enim nec interdum porta, velit ipsum luctus eros, sed tincidunt justo arcu non sapien. Proin laoreet quam eget odio ullamcorper facilisis...</p>
 <a href="" class="grnbtn">Read More</a>
 </div>
 </div>   
 
 <div class="col-md-5">
 <div class="oablock bggray oablock2">
 <a href=""><h3>A versatile, content switchblade plugin with a rich UI A versatile</h3></a>
 <img src="images/blk1.jpg" alt="" title="" />
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
    
    <!--footer-->
    <?php include('footer.php'); ?>
    <!--end footer-->

      </div> 
       <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>