<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, maximum-scale=1">

<title>IMS Login Page</title>
<link rel="icon" href="Knight/favicon.png" type="image/png">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,800italic,700italic,600italic,400italic,300italic,800,700,600' rel='stylesheet' type='text/css'>

<link href="Knight/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="Knight/css/style.css" rel="stylesheet" type="text/css">
<link href="Knight/css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="Knight/css/responsive.css" rel="stylesheet" type="text/css">
<link href="Knight/css/animate.css" rel="stylesheet" type="text/css">
    <style type="text/css">.pie {
        behavior: url(Knight/PIE.htc);
    }</style>
<script type="text/javascript" src="Knight/js/jquery.1.8.3.min.js"></script>
<script type="text/javascript" src="Knight/js/bootstrap.js"></script>
<script type="text/javascript" src="Knight/js/jquery-scrolltofixed.js"></script>
<script type="text/javascript" src="Knight/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="Knight/js/jquery.isotope.js"></script>
<script type="text/javascript" src="Knight/js/wow.js"></script>
<script type="text/javascript" src="Knight/js/classie.js"></script>
    <script src="Knight/js/respond-1.1.0.min.js"></script>
    <script src="Knight/js/html5shiv.js"></script>
    <script src="Knight/js/html5element.js"></script>
</head>
<body>
<div style="overflow:hidden;">
<header class="header" id="header">
	<div class="container">
    	<figure class="logo animated fadeInDown delay-07s">
        <!--	<a href="#"><img src="images/SSS.gif" alt=""></a> -->
        	<a href="#"><img src="images/s.gif" alt=""></a>
        </figure>
        <h1 class="animated fadeInDown delay-07s">Welcome To SCDB Inventory Management System</h1>
        <ul class="we-create animated fadeInUp delay-1s">
        	<li>Tracking Inventory levels, Orders, Sales and Deliveries.</li>
        </ul>
            <a class="link animated fadeInUp delay-1s" href="indexx.php">Get Started</a>
    </div>
</div>
</header>
<footer class="footer">
    <div class="container">
        <div class="footer-logo"><a href="#"><img src="" alt=""></a></div>
        <span class="copyright">Copyright © SCDB | <a href="#">Inventory Management System</a> </span>
    </div>
</footer>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('#test').scrollToFixed();
        $('.res-nav_click').click(function(){
            $('.main-nav').slideToggle();
            return false    
            
        });
        
    });
</script>

  <script>
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100
      }
    );
    wow.init();
 
  </script>


<script type="text/javascript">
	$(window).load(function(){
		
		$('.main-nav li a').bind('click',function(event){
			var $anchor = $(this);
			
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top - 102
			}, 1500,'easeInOutExpo');
			event.preventDefault();
		});
	})
</script>

<script type="text/javascript">

$(window).load(function(){
  
  
  var $container = $('.portfolioContainer'),
      $body = $('body'),
      colW = 375,
      columns = null;

  
  $container.isotope({
    resizable: true,
    masonry: {
      columnWidth: colW
    }
  });
  
  $(window).smartresize(function(){
    // check if columns has changed
    var currentColumns = Math.floor( ( $body.width() -30 ) / colW );
    if ( currentColumns !== columns ) {
      // set new column count
      columns = currentColumns;
      // apply width to container manually, then trigger relayout
      $container.width( columns * colW )
        .isotope('reLayout');
    }
    
  }).smartresize(); // trigger resize to set container width
  $('.portfolioFilter a').click(function(){
        $('.portfolioFilter .current').removeClass('current');
        $(this).addClass('current');
 
        var selector = $(this).attr('data-filter');
        $container.isotope({
			
            filter: selector,
         });
         return false;
    });
  
});

</script>
</body>
</html>