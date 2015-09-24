
<!DOCTYPE html>
<html lang="el">
<head>
<meta charset="utf-8" >
<title>Paypal Payment Gateway</title>

<!-- Mobile Devices -->
<meta name = "viewport" content = "width=device-width, minimum-scale=1, maximum-scale=1">
<meta name = "apple-mobile-web-app-capable" content = "yes">

<!-- MY CSS -->
<link rel="stylesheet" href="../styles.css" type="text/css" >
<!-- Sidebar -->
<link rel="stylesheet" type="text/css" href="../css/green-glass/sidebar.css">
<!-- Tooltip -->
<link rel="stylesheet" type="text/css" href="../css/tooltip/jquery.powertip.css">

<!-- jQuery -->
<script src="../scripts/jquery-1.7.min.js"></script>

<!-- Sidebar -->
<script type="text/javascript" src="../scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="../scripts/sidebar/jquery.sidebar.js"></script>
<!-- Tooltip -->
<script type="text/javascript" src="../scripts/tooltip/jquery.powertip.js"></script>
<!-- Promo -->
<script type="text/javascript" src="../scripts/useractions.js"></script>
<!-- Scripts -->
<script type="text/javascript">
$(document).ready(function(){
	//MAIN MENU
	$("#main-nav > li a.main-link").hover(function(){ 
      if (!$(this).hasClass('active')) { 
         $("#main-nav li a.close").fadeIn(); 
         $("#main-nav li a.main-link").removeClass("active");                                     
         $(this).addClass("active");                               
         $("#sub-link-bar").fadeIn(); 
         $(".sub-links").hide(); 
         $(this).siblings(".sub-links").fadeIn(); 
      } 
   });

	$("#main-nav li a.close").click(function(){
		$("#main-nav li a.main-link").removeClass("active");												 									 
		$(".sub-links").fadeOut();
		$("#sub-link-bar").fadeOut();
		$("#main-nav li a.close").fadeOut();
	});

	//SIDEBAR
	$("#weather").sidebar({
		position:"right",
		callback:{
			item : {
				enter : function(){
					$(this).find("a").animate({color:"red"}, 250);
				},
				leave : function(){
					$(this).find("a").animate({color:"white"}, 250);
				}
			}
		}
	});

});

//TOOLTIP PLACEMENTS
$(function() {
	//Based on direction
	$('.east').powerTip({placement: 'e'});
	$('.west').powerTip({placement: 'w'});
	$('.south').powerTip({placement: 's'});
});

//REPEAT CLICKS
var PayButtonclicked = false;
function PayClicked(language)
{
	// Check to see if Pay Button has been clicked before
	if (PayButtonclicked){
		if (language=='engilsh'){
			// Message displayed
			alert ("Transaction already sent.");
		}else if (language=='greek'){
			// Message displayed
			alert ("Η συναλλαγή είναι υπό εξέλιξη. Παρακαλώ περιμένετε.");
		}else if (language=='french'){
			// Message displayed
			alert ("Transaction already sent.");
		}else if (language=='german'){
			// Message displayed
			alert ("Transaction already sent.");
		}
		return false;
	}else{
		PayButtonclicked = true;
		return true;
	}
}
</script>
<script src='/google_analytics_auto.js'></script></head>

<body>
<div id="wrapper">
<header>
	<!-- HEADER BG IMAGE -->
	<div id="headerimage">
		<img src="../images/headerimages/headerimage-cycling-about.jpg">
	</div>

	<div id="headercontent">
		<!-- CONTAINER FOR MARGIN (CENTER) -->
		<div id="headercontainer">

			<!-- LEFT -->
			<div id="logo">
				<img src="../images/logo/logo.png">
			</div>

			<!-- RIGHT -->
			<div id="logoright">
				<!-- TOP -->
				<div id="logorighttop">
					<!-- LETTERS -->
					<div id="logoletters">
						<img src="../images/logo/logoletters.png">
					</div>
					<!-- SOCIAL -->
					<div id="logosocial">
						<a href="../book-now.php" title="Book Now your Tour!"><img src="../images/icons/booknow.png" alt="Book Now icon"></a>
						<a href="http://www.facebook.com/pages/Cretan-Sports-Cycling/504379792945907" target="_blank" title="Find us on Facebook"><img src="../images/icons/facebook.png" alt="Facebook icon" class="smallsocial"></a>
						<a href="http://www.youtube.com/channel/UCr7vJogbWXe0VSBzbWEBdBA" target="_blank" title="See all of our videos on YouTube"><img src="../images/icons/youtube.png" alt="Youtube icon" class="smallsocial"></a>
					</div>
				</div>
				<!-- NAVIGATION -->
								<div id="logorightbottom">
					<nav id="main-handle">
						<ul id="main-nav">
							<li><a class="main-link" href="../index.php">HOME</a>
								<ul class="sub-links">
									<li><a href="../index.php" title="HOME">HOME</a> </li>
								</ul>
							</li>
							<li><a class="main-link" href="../about-us.php">ABOUT US</a>
								<ul class="sub-links">
									<li><a href="../about-us.php" title="ABOUT US">ABOUT US</a> </li>
								</ul>
							</li>
							<li><a class="main-link" href="../about-crete-island.php">CRETE</a>
								<ul class="sub-links">
									<li><a href="../about-crete-island.php" title="CRETE">CRETE</a> </li>
								</ul>
							</li>
							<li><a class="main-link" href="../mountain-biking-tours.php">TOURS</a>
								<ul class="sub-links">
									<li><a href="../mountain-biking-tours.php" title="MOUNTAIN BIKING">MOUNTAIN BIKING</a> </li>
									<li><a href="../road-cycling-tours.php" title="ROAD CYCLING">ROAD CYCLING</a> </li>
									<li><a href="../lifestyle-cycling-tours.php" title="LIFESTYLE TOURS">LIFESTYLE TOURS</a> </li>
									<li><a href="../custom-biking-tours.php" title="CUSTOM TOURS">CUSTOM TOURS</a> </li>
									<li><a href="../hiking.php" title="HIKING">HIKING</a> </li>
								</ul>
							</li>
							<li><a class="main-link" href="../the-experience-of-cycling.php">THE EXPERIENCE</a>
								<ul class="sub-links">
									<li><a href="../the-experience-of-cycling.php" title="THE EXPERIENCE">THE EXPERIENCE</a> </li>
								</ul>
							</li>
							<li><a class="main-link" href="../photo-galleries.php">GALLERIES</a>
								<ul class="sub-links">
									<li><a href="../photo-galleries.php" title="PHOTO GALLERIES">PHOTO GALLERIES</a> </li>
									<li><a href="../video-galleries.php" title="VIDEO GALLERIES">VIDEO GALLERIES</a> </li>
								</ul>
							</li>
							<li><a class="main-link" href="c../ontact-us.php">CONTACT US</a>
								<ul class="sub-links">
									<li><a href="../contact-us.php" title="CONTACT US">CONTACT US</a> </li>
								</ul>
							</li>
							<li><a class="close hand" title="Click to Collapse">X</a></li>
						</ul>

						<!-- Sub-link-bar -->
						<div id="sub-link-bar"> </div>
					</nav>
				</div>				<!-- END NAVIGATION -->
				</div>
			<!-- END RIGHT -->

		</div>
		<!-- END HEADERCONTAINER FOR MARGIN-->

	</div>
</header>

<div id="content">

	<article id="mainpagetext">
		<header>
			<h2 class="pageTitle">Payment Method: PayPal Gateway</h2>
		</header>
		<!-- PART -->
		<div class="part">

			<!-- PAGE TEXT -->
			<div class="fulltext">

			

			 
			<p><h2>The check is completed successfully!</h2> <br> In order to continue with the payment please click on the image below "CLICK TO PAY NOW". 
			<br>You will be transfered in a secure area for the payment.</p>

			<form id="ff1" name="ff1" method="post" action="" enctype="multipart/form-data">				
					<input type="hidden" name="description" value="Cycling Tours CSC. Transaction Code: csc2013-45" >
					<input type="hidden" name="amount" value="0.298">
					<input type="hidden" name="itemid"  value="45">
					<input type="hidden" name="currency" value="EUR" >
					<input type="hidden" name="language"  value="english">
					<input type="hidden" name="process" value="yes" >
					<input type="image" src="../images/icons/paypalLogo.jpg" name="Submit" class="e" border="0" value="Pay with Paypal" onclick="if (PayClicked('english')) document.ff1.submit(); return false;" alt="Pay Now Button" title="Pay Now!">
			  </form>
			
			</div>
			<!-- PAGE TEXT END -->

		</div>
		<!-- END PART -->
	</article>
</div>


<article id="kairos">
		<!-- WEATHER -->
		<div id="weather" >
            <div id="c_539dc4b521d5a907998a51eba42f5f6e" class="normal"><h2 style="color: #000000; margin: 0 0 3px; padding: 2px; font: bold 13px/1.2 Verdana; text-align: center; width=100%"><a href="http://www.okairos.gr/%CE%B7%CF%81%CE%AC%CE%BA%CE%BB%CE%B5%CE%B9%CE%BF-her.html" style="color: #000000; text-decoration: none; font: bold 13px/1.2 Verdana;">Ηράκλειο (Heraklion)</a></h2><div id="w_539dc4b521d5a907998a51eba42f5f6e" class="normal" style="height:100%"></div></div><script type="text/javascript" src="http://www.okairos.gr/widget/loader/539dc4b521d5a907998a51eba42f5f6e"></script>
        </div>
	</article>

<div class="space20"></div>

<footer>
	<!-- GRASS -->
	<div id="footergrass"></div>

	<!-- GREEN -->
	<div id="green">
		<div class="horizontal-bar-end bottom-shadow "></div>
	</div>
</footer>
<!-- Toggle -->
<script type="text/javascript" src="scripts/toggle.js"></script>
</div>
</body>
</html>
