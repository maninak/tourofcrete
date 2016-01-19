
<?php
/*
Plugin Name: Tour of Crete Paypal Button Generator
Plugin URI: http://tourofcrete.com
Description: Paypal Hosted Button Update for TOC Registration Form
Author: Octobers
Version: 1.0
Author URI: http://octobers.eu
*/

//SHORTCODE THAT DISPLAYS PAYPAL BUTTON

add_shortcode("toc-paypal-button", "upvalue");




function updateItemPP($buttoncode, $amount, $descr)

{

	$API_USERNAME ="info_api1.tourofcrete.com";
	$API_PASSWORD = "ZUCDP7N5X8HZ3U6P";
	$API_SIGNATURE = "AGDPdupqFskSzeWtFXZLukf2UnzsAWgT9oz5rACh5ccVjOTUWMzpf.LN";
	$API_ENDPOINT = 'https://api-3t.paypal.com/nvp?';
	//$API_ENDPOINT = 'https://api-3t.sandbox.paypal.com/nvp?';

	$VERSION = '82.0';

	$ch=curl_init();

/*	curl_setopt($ch, CURLOPT_URL,$API_ENDPOINT);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POST, 1);
	*/

	$nvpreq=$API_ENDPOINT."&user=".urlencode($API_USERNAME)."&pwd=".urlencode($API_PASSWORD)."&signature=".urlencode($API_SIGNATURE)."&version=".urlencode($VERSION)."&METHOD=BMUpdateButton&HOSTEDBUTTONID=".urlencode($buttoncode)."&BUTTONTYPE=BUYNOW&BUTTONSUBTYPE=SERVICES&BUYNOWTEXT=PAYNOW&L_BUTTONVAR1=item_name=".urlencode($descr)."&L_BUTTONVAR2=amount=".urlencode($amount)."&L_BUTTONVAR3=no_shipping=1&L_BUTTONVAR4=currency_code=EUR";

	//print the requested string
	//echo "here is the request string:\n".$nvpreq;

	curl_setopt($ch,CURLOPT_URL,$nvpreq);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($ch);
	//Print response
	//echo ("Response:".urldecode($response));


	if ($ack=="FAILOR")

	return "failor";


}


function upvalue(){


session_start();  
if(isset($_SESSION['formCost'])&&isset($_SESSION['transNum'])){
    //echo $_SESSION['formCost']; // display the form cost
	$transNum=$_SESSION['transNum'];
	$totalcost=$_SESSION['formCost'];
	echo "<h5>The booking is completed! Your Registration Code is: <strong>".$transNum."</strong><br>";
	echo "<em>Please make sure you add this code along with your full name in the paypal field 'Note for the seller'.</em><h5><br>";
	
    unset($_SESSION['formCost']); // clear the value so that it doesn't display again
} 

$buttonid="HY7D8WP27PJQE";

updateItemPP($buttonid,$totalcost,"Total Cost");
   
?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="HY7D8WP27PJQE">
	<input class="button" type="image" src="http://tourofcrete.com/wp-content/themes/tourofcrete/images/paypal_paynow.jpg" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
</form>


    <?php
}


?>


