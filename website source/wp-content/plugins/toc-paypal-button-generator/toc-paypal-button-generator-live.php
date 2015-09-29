
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

add_shortcode("toc-paypal-button", "test");



function updateItemPP($buttoncode, $amount, $descr)

{

	$API_USERNAME ="mika.stav_api1.hotmail.com";
	$API_PASSWORD = "KDJMZBC8B92LLFF7";
	$API_SIGNATURE = "Aq5O9PVkxyoKftgLzaHfB71mRQA.AxBSO7jlAtMoIPQ5bjmfvl3TUIC2";
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


function test(){

updateItemPP("HQ29GQRQENNVY","50","Solo Package");

echo "test";

if(isset($_SESSION['formCost'])){
    echo $_SESSION['formCost']; // display the form cost
    unset($_SESSION['formCost']); // clear the value so that it doesn't display again
}  
?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="HQ29GQRQENNVY">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


    <?php
}


?>


