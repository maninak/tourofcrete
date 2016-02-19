<?php
/*
Plugin Name: Tour of Crete Registration
Plugin URI: http://tourofcrete.com
Description: Registration Form for Tour of Crete
Author: Octobers
Version: 1.0
Author URI: http://octobers.eu
*/

function toc_registration_form_handler($incomingcategory) {
	//process incoming attributes assigning defaults if required
	$incomingcategory=shortcode_atts(array(
		"category" => ''         
	), $incomingcategory);
  
  display_toc_registration_form($incomingcategory);
}

function display_toc_registration_form($incomingcategory){
require_once(get_template_directory()."/mycaptcha.php");
	//echo $incomingcategory['category'];
	//echo realpath(dirname(__FILE__));

if ($incomingcategory['category'] == "individual"){ //START INDIVIDUAL FORM
?>
	<script language="javascript">
        jQuery(document).ready(function(){
            jQuery("#birthday" ).datepicker({
                dateFormat : 'dd-mm-yy'
               // changeMonth : true,
                //changeYear : true,
               // yearRange: '-100y:c+nn',
               // maxDate: '-1d'
            });		
            	
			//show hide packages info based on user selection	
			jQuery('#soloPackage').click(function () {
				jQuery('#TwinPackageDiv').hide('fast');
				jQuery('#EntryOnlyDiv').hide('fast');
				jQuery('#soloPackageDiv').show('fast');
			});
			
			jQuery('#TwinPackage').click(function () {
				jQuery('#soloPackageDiv').hide('fast');
				jQuery('#EntryOnlyDiv').hide('fast');
				jQuery('#TwinPackageDiv').show('fast');
			});
			
			jQuery('#EntryOnly').click(function () {
				jQuery('#TwinPackageDiv').hide('fast');
				jQuery('#soloPackageDiv').hide('fast');
				jQuery('#EntryOnlyDiv').show('fast');
			});

			jQuery("#dialogErrors").dialog({
				autoOpen: false,
				width: "600",
				resizable: false,
				height:"600",
				modal: true,
				buttons: {
						"Close": function() {
						jQuery(this).dialog( "close" );
					}
				}
			});
			
			//keep selected values for selects after submit
			<?php if (isset($_POST['country'])) { ?>
				jQuery('select#country').val('<?php echo $_POST['country'];?>'); 
			<?php } ?>
			
			<?php if (isset($_POST['gender'])) { ?>
				jQuery('select#gender').val('<?php echo $_POST['gender'];?>'); 
			<?php } ?>
			
			<?php if (isset($_POST['raceCategory'])) { ?>
				jQuery('select#raceCategory').val('<?php echo $_POST['raceCategory'];?>'); 
			<?php } ?>
			
			<?php if (isset($_POST['bikeRental'])) { ?>
				jQuery('select#bikeRental').val('<?php echo $_POST['bikeRental'];?>'); 
			<?php } ?>
			
			<?php if (isset($_POST['jerseySize'])) { ?>
				jQuery('select#jerseySize').val('<?php echo $_POST['jerseySize'];?>'); 
			<?php } ?>
                    
					
			//show hidden divs for radio buttons after submit
			if(jQuery('#soloPackage').is(':checked')) { 
				jQuery('#soloPackageDiv').show('fast');
			}
			if(jQuery('#TwinPackage').is(':checked')) { 
				jQuery('#TwinPackageDiv').show('fast');
			}
			if(jQuery('#EntryOnly').is(':checked')) { 
				jQuery('#EntryOnlyDiv').show('fast');
			}
			
        });
    </script>

    <form class="form" method="post" action="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
	<?php 
	date_default_timezone_set('Europe/Athens');
	$date = date('d/m/Y H:i:s a', time());
	$random_number = rand(0, 1000);
	$regCode = "TOCI-" . date('ymd-His') ."-".$random_number;
		
	if(isset($_POST['submit'])){
		
		$formCost = "";
		$formErrors = "";
		
		$surname = $_POST['surname'];
		$name = $_POST['name2'];
		$email = $_POST['email'];
		$emailverify = $_POST['emailverify'];
		$phone = $_POST['phone'];
		$country = $_POST['country'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$postcode = $_POST['postcode'];
		$birthday = $_POST['birthday'];
		$gender = $_POST['gender'];
		$raceCategory = $_POST['raceCategory'];
		$bikeRental = $_POST['bikeRental'];
		$bikeSize = $_POST['bikeSize'];
		$EmergencyName = $_POST['EmergencyName'];
		$EmergencyPhone = $_POST['EmergencyPhone'];
		$jerseySize = $_POST['jerseySize'];
		$DietaryReqTxt = $_POST['DietaryReqTxt'];
		$MedicalConditionsTxt = $_POST['MedicalConditionsTxt'];	
		$FlightDetailsTxt = $_POST['FlightDetailsTxt'];		
		$RidingWith = $_POST['RidingWith'];			
		$sharedAcco = $_POST['sharedAcco'];				
		$selectPackage = $_POST['Package'];		
		$soloPackage = $_POST['soloPackage'];					
		$soloPackageValue = 1070;						
		$TwinPackage = $_POST['TwinPackage'];						
		$TwinPackageValue = 890;							
		$EntryOnly = $_POST['EntryOnly'];			
		$EntryOnlyValue = 150;
		$PackageOption = $_POST['PackageOption'];	
		$PaymentMethod = $_POST['paymentmethod'];
		$Terms = $_POST['terms'];
		$IBAN = "GR80 0110 2050 0000 2053 8216 845";
		$signature = "<br><p><table border='0'><tr><td> <img src='http://tourofcrete.com/wp-content/uploads/2015/10/cropped-ToC_logo-150x150.png' alt='The Tour of Crete logo' style='width:5rem;height:5rem; padding-right:1rem;'></td><td> <strong><font face='crillee It BT, impact, Segoe UI, courier new' color='#ff6600'>The Tour of Crete Team</font></strong><br/> <font face='open sans light, open sans,helvetica,News Gothic MT,sans-serif,arial'> Visit our <a href='http://tourofcrete.com/' target='_blank'>Official Website</a><br/> Like our <a href='https://www.facebook.com/thetourofcrete' target='_blank'>Facebook page</a> </font></td></tr></table></p><br>";
		
		$DietaryReq = $_POST['DietaryReq'];		
		
		$is_captcha_correct = MyCaptcha::verify();
			
		if ( empty( $surname ) ) {
			$formErrors .= "<li>Required form field -Surname- is missing</li>";
		}
		
		if ( empty( $name ) ) {
			$formErrors .= "<li>Required form field -Name- is missing</li>";
		}
		
		if ( empty( $email ) ) {
			$formErrors .= "<li>Required form field -Email- is missing</li>";
		}
		
		if ((!empty( $email )) && (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
			$formErrors .= "<li>The email you entered is not correct</li>";
		}
		
		if ( empty( $emailverify ) ) {
			$formErrors .= "<li>Required form field -Repeat Email- is missing</li>";
		}	
		
		if ((!empty( $email )) && (!empty( $emailverify )) && ($email != $emailverify)) {
			$formErrors .= "<li>Email and Verification Email are not the same</li>";
		}
		
		if ( empty( $phone ) ) {
			$formErrors .= "<li>Required form field -Contact Number- is missing</li>";
		}
		
		if ( $country == "-" ) {
			$formErrors .= "<li>Required form field -Country- is missing</li>";
		}
		
		if ( empty( $city ) ) {
			$formErrors .= "<li>Required form field -City- is missing</li>";
		}
		
		if ( empty( $address ) ) {
			$formErrors .= "<li>Required form field -Address- is missing</li>";
		}
		
		if ( empty( $postcode ) ) {
			$formErrors .= "<li>Required form field -Postcode- is missing</li>";
		}
		
		if ( empty( $birthday ) ) {
			$formErrors .= "<li>Required form field -Date of Birth- is missing</li>";
		}
		
		if ( $gender == "-" ) {
			$formErrors .= "<li>Required form field -Gender- is missing</li>";
		}
		
		if ( empty( $raceCategory ) ) {
			$formErrors .= "<li>Required form field -Category- is missing</li>";
		}
		
		if ( empty( $EmergencyName ) ) {
			$formErrors .= "<li>Required form field -Emergency contact name- is missing</li>";
		}
		
		if ( empty( $jerseySize ) ) {
			$formErrors .= "<li>Required form field -Jersey size- is missing</li>";
		}
		
		if ( empty( $DietaryReqTxt ) ) {
			$formErrors .= "<li>Required form field -Dietary Requirements- is missing</li>";
		}
		
		if ( empty( $MedicalConditionsTxt ) ) {
			$formErrors .= "<li>Required form field -Medical Conditions- is missing</li>";
		}
		
		if ( empty( $selectPackage ) ) {
			$formErrors .= "<li>Required form field -Select Package- is missing</li>";
		}
		
		if (( $selectPackage == "TwinPackage" ) && ( empty( $PackageOption ) )) {
			$formErrors .= "<li>Required form field -Select option for Twin Package- is missing</li>";
		}
		
		if ( empty( $PaymentMethod ) ) {
			$formErrors .= "<li>Required form field -Payment Option- is missing</li>";
		}
		
		if ( empty( $Terms ) ) {
			$formErrors .= "<li>Please accept Terms and Conditions</li>";
		}
		
		if (!($is_captcha_correct)) {
			$formErrors .= "<li>Form Captcha incorrect</li>";		
		}
		
	if ( !empty($formErrors) ) {
			echo "<div id='dialogErrors' title='Please check the following errors'>";
				echo "<ul>".$formErrors."</ul>";
			echo "</div>";
			?>
			<script>
				jQuery(document).ready(function(){
					jQuery("#dialogErrors").dialog( "open" );
				});
			</script>
			<?php
		}else{
				$email_message = "<p>Dear <font color=\"#f60\"><strong>".$surname." ".$name."</strong></font>,</p>";	
				$email_message .= "<p>Your booking for the Tour of Crete has been submitted succesfully! Your Registration Code is: <strong>".$regCode."</strong>. <br/>Please safekeep this number for future reference of this transaction when in contact with us. <br/>We have received your application and will be in contact with you to arrange any outlying details, if any arise.</p>";	
				$email_message .= "<p>Please review all following information and inform us in case of an error or correction:</p>";
				$email_message .= "<table>";	
				$email_message .= "<tr><td>";	
				$email_message .= "<strong>Personal Information</strong>\n\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Surname: ".$surname."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Name: ".$name."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Email: ".$email."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Contact Number: ".$phone."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Country: ".$country."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "City: ".$city."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Address: ".$address."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Postcode: ".$postcode."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Date of Birth: ".$birthday."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Gender: ".$gender."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Category: ".$raceCategory."\n";
				$email_message .= "</td></tr>";	
				
				if ( $bikeRental <> "-" ) {
					$email_message .= "<tr><td>";	
					if ($bikeRental == "Teammachine-155"){ 
						$email_message .= "Bike Rental: Teammachine SLR02 Shimano 105 Compact (Price for the event: 155,00 Euro) \n";	
						$formCost += 155;
					} else {
						$email_message .= "Granfondo GF02 Shimano Tiagra Compact (Price for the event: 135,00 Euro) \n";	
						$formCost += 135;
					}
					$email_message .= "</td></tr>";	
				}
				
				$email_message .= "<tr><td>";	
				$email_message .= "Requested bike size: ".$bikeSize."\n";				
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Emergency Contact Name: ".$EmergencyName."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Emergency contact phone: ".$EmergencyPhone."\n";		
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Jersey Size: ".$jerseySize."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Dietary Requirements: ".$DietaryReqTxt."\n";		
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Medical Conditions: ".$MedicalConditionsTxt."\n";				
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Flight details: ".$FlightDetailsTxt."\n";						
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Who are you riding with, or plan to ride with?: ".$RidingWith."\n";								
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "If opting for shared accommodation, who do you want to room with?: ".$sharedAcco."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td><br/>";	
				$email_message .= "<strong>Package Option</strong>\n\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";		
				if ($selectPackage == "soloPackage"){ 
					$email_message .= "Solo Room package - Hotel room based on single occupancy. Price: ".number_format($soloPackageValue)." &euro; \n"; 
					$formCost += $soloPackageValue;
				}
				if ($selectPackage == "TwinPackage"){ 
					if ($PackageOption == "TwinPackageA1"){
						$email_message .= "Shared Room registration package - Option A1: Double room or twin room (one double bed or two single beds) shared with another rider. Price: ".number_format($TwinPackageValue)." &euro; \n"; 
					}
					else{
						$email_message .= "Shared Room registration package - Option A2: Double room, shared with another non-cyclist participant. Price: ".number_format($TwinPackageValue)." &euro; \n"; 
					}
					$formCost += $TwinPackageValue;
				}				
				if ($selectPackage == "EntryOnly"){ 
					$email_message .= "Registration-only package (i.e. no accommodation or (air)port/hotel luggage transfers). Price: ".$EntryOnlyValue." &euro; \n"; 
					$formCost += $EntryOnlyValue;
				}		
				$email_message .= "<tr><td><br/>";	
				$email_message .= "<strong>Payment Method</strong>\n\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				if ($PaymentMethod == "paypal"){
					$email_message .= "Paypal <br/>";
				}else{
					$email_message .= "Bank Deposit <br/>National Bank of Greece <br/>IBAN: <strong>".$IBAN."</strong><br/>";
				}
				$email_message .= "Transaction Date: ".$date."<br/>";
				$email_message .= "Registration Code: <strong>".$regCode."</strong><br/>";
				$email_message .= "Total Cost: ".number_format($formCost)." &euro;<br/>";
				$email_message .= "<br/><em>Make sure you attach your Full Name and Registration Code when submitting your payment.</em><br/>";
				$email_message .= "</td></tr>";	
				$email_message .= "</table><br/>";		
				$email_message .= "<p>In order to complete this transaction the user has read and accepted the <a href='http://tourofcrete.com/terms-conditions/' target='_blank'>Terms and Conditions</a>.</p>";	
				$email_message .= "<p>If, for any reason, you deem the above information as inaccurate, please contact us as soon as possible by replying to this e-mail. You will promptly receive a reply form us on any corrections or questions you may have.</p>";	
				$email_message .= "<p>We are gladly at your disposal. <br/>Best regards,</p>";
				$email_message .= $signature;	
				
				foreach ($_POST as $key => $value){
					echo "<input type=\"hidden\" name=\"".htmlspecialchars($key).
					 "\" value=\"".htmlspecialchars($value)."\"/>\n";
				}
				
				sendmail($email_message, $incomingcategory['category'], $email, $PaymentMethod, $formCost, $regCode);
			
			}
		
		}
		
		?>
        
      	<div class="step1">
        	  <h1>Registration Details</h1>
        	  
        	   <h2>Provisions</h2>
              <p>The Tour of Crete travel service provides the following for each cyclist-participant from May 7th 2016 until May 14th 2016:</p>
              <ul><strong>1. What is included per person:</strong>
                <li>7 x nights' accommodation  in various 4 stars hotels including breakfast</li>
                <li>7 x evening dinner (3-course Menu) at the hotel restaurant</li>
                <li>Airport shuttle - airport/hotel/airport, for rider and bike</li>
                <li>Registration fee for all 6 stages</li>
                <li>Event kit bag of the Tour of Crete</li>
                <li>Luggage transportation from hotel to hotel</li>
                <li>Nutrition supply during the event (feed zones)</li>
                <li>Timing system for all 6 stages</li>
                <li>Mechanical and technical support</li>
                <li>Motorbike outriders and lead cars</li>
                <li>Per request massage session at discounted price</li>
                <li>Digital photo and film (DVD will be sent) </li>
                <li>Event's memorabilia T-shirt</li>              
              </ul>
             <ul><strong>2. What's NOT included:</strong>
             	<li>Alcohol and personal expenses</li>
                <li>Travel insurance</li>
                <li>Flights</li>
                <li>Strong legs</li>
             </ul>
			
              <h2>Registration Options <font>(Select a package from below for more info)</font></h2>
			   <p>If your desired package is not available to select below then this has Sold Out. Please contact <a href="mailto:info@tourofcrete.com">info@tourofcrete.com</a>  to be added to the waiting list for this package.</p>
               <div>
                <p>Please Select Package:</p>
                
                <div class="row">
              		<div class="OneCol">
                        <input 	type="radio" name="Package" id="soloPackage" value="soloPackage" <?php if (isset($selectPackage) && $selectPackage=="soloPackage") echo "checked";?> />
                        <label for="soloPackage">Solo Room package</label>
                        <div id="soloPackageDiv" class="infoDiv" style="display:none;">
                    		<p><strong>Solo Room registration package: 1070 &euro; </strong>(until 31/1/2016 - 1260 &euro; until 30/4 - 1430 &euro; until 6/5)<br/>Hotel room based on single occupancy.</p>
                        </div>
                	</div>
                </div>
                <div class="row">
                	<div class="OneCol">
                         <input type="radio" name="Package" id="TwinPackage" value="TwinPackage" <?php if (isset($selectPackage) && $selectPackage=="TwinPackage") echo "checked";?> />
                         <label for="TwinPackage">Shared Room package</label>
                        <div id="TwinPackageDiv" class="infoDiv" style="display:none;"> 
                        	<p><strong>Shared Room registration package (price per person): 890 &euro; </strong>(until 31/1/2016 - 1050 &euro; until 30/4 - 1190 &euro; until 6/5)<br/>
                                <input type="radio" name="PackageOption" id="TwinPackageA1" value="TwinPackageA1" <?php if (isset($PackageOption) && $PackageOption=="TwinPackageA1") echo "checked";?> />
                                <label for="TwinPackageA1">Option A1: Double room or twin room (one double bed or two single beds) shared with another rider.</label>
                                <input type="radio" name="PackageOption" id="TwinPackageA2" value="TwinPackageA2" <?php if (isset($PackageOption) && $PackageOption=="TwinPackageA2") echo "checked";?> />
                                <label for="TwinPackageA2">Option A2: Double room shared with another non-cyclist participant.</label>
                            </p>
                        </div>
                    </div>
                </div> 
				<div class="row">
                	<div class="OneCol">
                        <input type="radio" name="Package" id="EntryOnly" value="EntryOnly" <?php if (isset($selectPackage) && $selectPackage=="EntryOnly") echo "checked";?>/>
                        <label for="EntryOnly">Registration-only Package</label>
                         <div id="EntryOnlyDiv" class="infoDiv" style="display:none;">    
                             <p><strong>Registration-only package (i.e. no accommodation or (air)port/hotel luggage transfers): 150 &euro; </strong>(until 30/4 - 180 &euro; until 6/5)<br/>
                                    If you wish to organize your own accommodation and meals, this package will suit you best. You will be responsible for arranging your (air)port transportation, accommodation, breakfast and evening meals. The package does include the finale celebration dinner on Friday evening and everything else as described in the package.</p>
                          </div>
                  </div>            
              </div>
              
              <h2>Personal Information</h2>
              <div class="row">
                  <div class="FiveCols">
                    <label for="surname">Surname <span class="required">*</span></label>
                    <input type="text" id="surname" name="surname" value="<?php if (isset($surname)) { echo $surname; } ?>" placeholder="Surname"  />
                  </div>
                  <div class="FiveCols">
                    <label for="name2">Name <span class="required">*</span></label>
                    <input type="text" id="name2" name="name2" value="<?php if (isset($name)) { echo $name; } ?>" placeholder="Name"  />
                  </div>
                  <div class="FiveCols">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="text" id="email" name="email" value="<?php if (isset($email)) { echo $email; } ?>" placeholder="Email"  />
                  </div>
                  <div class="FiveCols">
                    <label for="emailverify">Repeat Email <span class="required">*</span></label>
                    <input type="text" id="emailverify" name="emailverify" value="<?php if (isset($emailverify)) { echo $emailverify; } ?>" placeholder="Repeat Email"  />
                  </div>
                  <div class="FiveCols">
                    <label for="phone">Contact Number <span class="required">*</span></label>
                    <input type="text" id="phone" name="phone" value="<?php if (isset($phone)) { echo $phone; } ?>" placeholder="Phone"  />				
                  </div>
              </div>
              <div class="row">
                  <div class="FiveCols">
                    <label for="country">Country <span class="required">*</span></label>
                    <select name="country" id="country">
                      	<option value="-">Select...</option>
                        <option value="AT">Austria</option>
                        <option value="BE">Belgium</option>
                        <option value="CY">Cyprus</option>
                        <option value="DK">Denmark</option>
                        <option value="FI">Finland</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                        <option value="GR">Greece</option>
                        <option value="IE">Ireland</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italy</option>
                        <option value="NL">Netherlands</option>
                        <option value="NO">Norway</option>
                        <option value="SE">Sweden</option>
                        <option value="CH">Switzerland</option>
                        <option value="TR">Turkey</option>
                        <option value="UK">United Kingdom</option>
                        <option value="US">U.S.A.</option>
                        <option value="AF">Afganistan</option>
                        <option value="AL">Albania</option>
                        <option value="DZ">Algeria</option>
                        <option value="AS">American Samoa</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguilla</option>
                        <option value="AQ">Antarctica</option>
                        <option value="AG">Antigua and Barbuda</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AZ">Azerbaijan</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahrain</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BB">Barbados</option>
                        <option value="BY">Belarus</option>
                        <option value="BZ">Belize</option>
                        <option value="BJ">Benin</option>
                        <option value="BM">Bermuda</option>
                        <option value="BT">Bhutan</option>
                        <option value="BO">Bolivia</option>
                        <option value="BA">Bosnia and Herzegovina</option>
                        <option value="BW">Botswana</option>
                        <option value="BV">Bouvet Island</option>
                        <option value="BR">Brazil</option>
                        <option value="IO">British Indian Ocean Territory</option>
                        <option value="BN">Brunei Darussalam</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina FASO</option>
                        <option value="BI">Burundi</option>
                        <option value="KH">Cambodia</option>
                        <option value="CM">Cameroon</option>
                        <option value="CA">Canada</option>
                        <option value="CV">Cape Verde</option>
                        <option value="KY">Cayman Islands</option>
                        <option value="CF">Central African Republic</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="CX">Christmas Island</option>
                        <option value="CC">Cocos (Keeling) Islands</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comoros</option>
                        <option value="CG">Congo</option>
                        <option value="CK">Cook Islands</option>
                        <option value="CR">Costa Rica</option>
                        <option value="CI">Cote d'Ivoire</option>
                        <option value="HR">Croatia</option>
                        <option value="CU">Cuba</option>
                        <option value="CZ">Czech Republic</option>
                        <option value="DJ">Djibouti</option>
                        <option value="DM">Dominican Republic</option>
                        <option value="TP">East Timor</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egypt</option>
                        <option value="SV">El Salvador</option>
                        <option value="GQ">Equatorial Guinea</option>
                        <option value="ER">Eritrea</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Ethiopia</option>
                        <option value="FK">Falkland Islands</option>
                        <option value="FO">Faroe Islands</option>
                        <option value="FJ">Fiji</option>
                        <option value="GF">French Guiana</option>
                        <option value="PF">French Polynesia</option>
                        <option value="TF">French Southern Territories</option>
                        <option value="MK">F.Y.R.O.M.</option>
                        <option value="GA">Gabon</option>
                        <option value="GM">Gambia</option>
                        <option value="GE">Georgia</option>
                        <option value="GH">Ghana</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GL">Greenland</option>
                        <option value="GD">Grenada</option>
                        <option value="GP">Guadeloupe</option>
                        <option value="GU">Guam</option>
                        <option value="GT">Guatemala</option>
                        <option value="GN">Guinea</option>
                        <option value="GW">Guinea-Bissau</option>
                        <option value="GY">Guyana</option>
                        <option value="HT">Haiti</option>
                        <option value="HM">Heard and Mc Donald Islands</option>
                        <option value="HN">Honduras</option>
                        <option value="HK">Hong Kong</option>
                        <option value="HU">Hungary</option>
                        <option value="IS">Iceland</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IR">Iran</option>
                        <option value="IQ">Iraq</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japan</option>
                        <option value="JO">Jordan</option>
                        <option value="KZ">Kazakhstan</option>
                        <option value="KE">Kenya</option>
                        <option value="KI">Kiribati</option>
                        <option value="KP">Korea, Republic of</option>
                        <option value="KR">Korea (South)</option>
                        <option value="KW">Kuwait</option>
                        <option value="KG">Kyrgyzstan</option>
                        <option value="LA">Lao</option>
                        <option value="LV">Latvia</option>
                        <option value="LB">Lebanon</option>
                        <option value="LS">Lesotho</option>
                        <option value="LR">Liberia</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lithuania</option>
                        <option value="LU">Luxembourg</option>
                        <option value="MO">Macau</option>
                        <option value="MG">Madagascar</option>
                        <option value="MW">Malawi</option>
                        <option value="MY">Malaysia</option>
                        <option value="MV">Maldives</option>
                        <option value="ML">Mali</option>
                        <option value="MT">Malta</option>
                        <option value="MH">Marshall Islands</option>
                        <option value="MQ">Martinique</option>
                        <option value="MR">Mauritania</option>
                        <option value="MU">Mauritius</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">Mexico</option>
                        <option value="FM">Micronesia</option>
                        <option value="MD">Moldova</option>
                        <option value="MC">Monaco</option>
                        <option value="MN">Mongolia</option>
                        <option value="MS">Montserrat</option>
                        <option value="MA">Morocco</option>
                        <option value="MZ">Mozambique</option>
                        <option value="MM">Myanmar</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="AN">Netherlands Antilles</option>
                        <option value="NC">New Caledonia</option>
                        <option value="NZ">New Zealand</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Niger</option>
                        <option value="NG">Nigeria</option>
                        <option value="NU">Niue</option>
                        <option value="NF">Norfolk Island</option>
                        <option value="MP">Northern Mariana Islands</option>
                        <option value="OM">Oman</option>
                        <option value="PK">Pakistan</option>
                        <option value="PW">Palau</option>
                        <option value="PA">Panama</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Peru</option>
                        <option value="PH">Philippines</option>
                        <option value="PN">Pitcairn</option>
                        <option value="PL">Poland</option>
                        <option value="PT">Portugal</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="QA">Qatar</option>
                        <option value="RE">Reunion</option>
                        <option value="RO">Romania</option>
                        <option value="RU">Russia</option>
                        <option value="RW">Rwanda</option>
                        <option value="KN">Saint Kitts and Nevis</option>
                        <option value="LC">Saint Lucia</option>
                        <option value="WS">Samoa</option>
                        <option value="SM">San Marino</option>
                        <option value="ST">Sao Tome and Principe</option>
                        <option value="SA">Saudi Arabia</option>
                        <option value="SN">Senegal</option>
                        <option value="SC">Seychelles</option>
                        <option value="RS">Serbia</option>
                        <option value="SL">Sierra Leone</option>
                        <option value="SG">Singapore</option>
                        <option value="SK">Slovakia</option>
                        <option value="SI">Slovenia</option>
                        <option value="SB">Solomon Islands</option>
                        <option value="SO">Somalia</option>
                        <option value="ZA">South Africa</option>
                        <option value="ES">Spain</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="SH">St. Helena</option>
                        <option value="PM">St. Pierre And Miquelon</option>
                        <option value="SD">Sudan</option>
                        <option value="SR">Suriname</option>
                        <option value="SJ">Svalbard + J Mayen</option>
                        <option value="S">Swaziland</option>
                        <option value="SY">Syria</option>
                        <option value="TW">Taiwan</option>
                        <option value="TJ">Tajikistan</option>
                        <option value="TZ">Tanzania</option>
                        <option value="TH">Thailand</option>
                        <option value="TG">Togo</option>
                        <option value="TK">Tokelau</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad and Tobago</option>
                        <option value="TN">Tunisia</option>
                        <option value="TM">Turkmenistan</option>
                        <option value="TC">Turks and Caicos Islands</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UG">Uganda</option>
                        <option value="UA">Ukraine</option>
                        <option value="AE">United Arab Emirates</option>
                        <option value="UY">Uruguay</option>
                        <option value="UZ">Uzbekistan</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VA">Vatican City State (Holy See)</option>
                        <option value="VE">Venezuela</option>
                        <option value="VN">Vietnam</option>
                        <option value="VG">Virgin Islands (British)</option>
                        <option value="VI">Virgin Islands (U.S.)</option>
                        <option value="WF">Wallis and Futuna Islands</option>
                        <option value="EH">Western Sahara</option>
                        <option value="YE">Yemen</option>
                        <option value="ZY">Zaire</option>
                        <option value="ZM">Zambia</option>
                        <option value="ZW">Zimbabwe</option>
                    </select>
                  </div>
                  <div class="FiveCols">
                    <label for="city">City <span class="required">*</span></label>
                    <input type="text" id="city" name="city" value="<?php if (isset($city)) { echo $city; } ?>" placeholder="City"  />						
                  </div>
                  <div class="FiveCols">
                    <label for="address">Address <span class="required">*</span></label>
                    <input type="text" id="address" name="address" value="<?php if (isset($address)) { echo $address; } ?>" placeholder="Address"  />							
                  </div>
                  <div class="FiveCols">
                    <label for="postcode">Postcode <span class="required">*</span></label>
                    <input type="text" id="postcode" name="postcode" value="<?php if (isset($postcode)) { echo $postcode; } ?>" placeholder="Postcode"  />						
                  </div>
                  
                  <div class="FiveCols">
                    <label for="birthday">Date of Birth (d/m/y) <span class="required">*</span></label>
                    <input type="text" id="birthday" name="birthday" class="hasDatepicker" value="<?php if (isset($birthday)) { echo $birthday; } ?>" placeholder="Birthday"  />					
                  </div>
              </div>
              
              
              <h2>Other Info</h2>
              <div class="row">
                  <div class="FiveCols">
                    <label for="gender">Gender <span class="required">*</span></label>
                    <select id="gender" name="gender">
                      <option value="-">Select...</option>
                      <option value="Female">Female</option>
                      <option value="Male">Male</option>
                    </select>
                  </div>
                  <div class="FiveCols">
                    <label for="raceCategory">Category <span class="required">*</span></label>
                    <select id="raceCategory" name="raceCategory">
                      <option value="-">Select...</option>
                      <option value="From 18 until 35 years old">From 18 until 35 years old</option>
                      <option value="From 36 until 55 years old">From 36 until 55 years old</option>
                      <option value="From 56 years old and above">From 56 years old and above</option>
                    </select>
                  </div>
                  <div class="FiveCols">
                  	<label for="bikeRental">Bike Rental</label>
                    <select id="bikeRental" name="bikeRental">
                      <option value="-">Select...</option>
                      <option value="Teammachine-155">Teammachine SLR02 Shimano 105 Compact (Price for the event: 155,00 Euro)</option>
                      <option value="Granfondo-135">Granfondo GF02 Shimano Tiagra Compact (Price for the event: 135,00 Euro)</option>
                    </select>
                  </div>
                   <div class="FiveCols" id="bikeSizeDiv">
                    <label for="bikeSize">Requested bike size</label>
                    <input type="text" id="bikeSize" name="bikeSize" placeholder="Bike Size" value="<?php if (isset($bikeSize)) { echo $bikeSize; } ?>" />
                  </div>
              </div>
              
            
             
              <h2>Additional Required Details</h2>
              <div class="row">
                  <div class="OneCol">
                    <label for="EmergencyName">Emergency contact name <span class="required">*</span></label>
                    <input type="text" id="EmergencyName" name="EmergencyName" value="<?php if (isset($EmergencyName)) { echo $EmergencyName; } ?>" placeholder="Emergency Name"  />					
                  </div>
               </div>
               <div class="row"> 
                  <div class="OneCol">
                    <label for="EmergencyPhone">Emergency contact phone</label>
                    <input type="text" id="EmergencyPhone" name="EmergencyPhone" value="<?php if (isset($EmergencyPhone)) { echo $EmergencyPhone; } ?>" placeholder="Emergency EmergencyPhone" />
                  </div>
                </div>  
                <div class="row">  
                  <div class="OneCol">
                    <label for="jerseySize">Please state your jersey size <span class="required">*</span></label>
                    <select id="jerseySize" name="jerseySize">
                      <option value="-">Select...</option>
                      <option value="Small">Small</option>
                      <option value="Medium">Medium</option>
                      <option value="Large">Large</option>
                      <option value="Extra Large">Extra Large</option>
                    </select>
                  </div>
              </div>
              
              <div class="row">
              	<div class="OneCol">
                    <label>Do you have any Dietary Requirements? <span class="required">*</span></label>
                    <input 	type="text" id="DietaryReqTxt" name="DietaryReqTxt" value="<?php if (isset($DietaryReqTxt)) { echo $DietaryReqTxt; } ?>" placeholder="Dietary Requirements" />
              	</div>
              </div>
              
              <div class="row">
              	<div class="OneCol">
                    <label>Do you have any Medical Conditions? <span class="required">*</span></label>
                    <input 	type="text" id="MedicalConditionsTxt" name="MedicalConditionsTxt" value="<?php if (isset($MedicalConditionsTxt)) { echo $MedicalConditionsTxt; } ?>" placeholder="Medical Conditions" />
                </div>
              </div>
              
              <div class="row">
              	<div class="OneCol">
                     <label>Do you know your flight details?</label>
                     <input type="text" id="FlightDetailsTxt" name="FlightDetailsTxt" value="<?php if (isset($FlightDetailsTxt)) { echo $FlightDetailsTxt; } ?>" placeholder="Flight Details" />
              	</div>
              </div>               
              
              <div class="row">
              	<div class="OneCol">
                    <label for="RidingWith">Who are you riding with, or plan to ride with?</label>
                    <input type="text" id="RidingWith" name="RidingWith" value="<?php if (isset($RidingWith)) { echo $RidingWith; } ?>" placeholder="Riding With" />
              	</div>
              </div>
              
              <div class="row">
              	<div class="OneCol">
                    <label for="sharedAcco">If opting for shared accommodation, who do you want to room with?</label>
                    <input 	type="text" id="sharedAcco" name="sharedAcco" value="<?php if (isset($sharedAcco)) { echo $sharedAcco; } ?>" placeholder="Shared  Accommodation" />
             	</div>
              </div>
    			
              <h2>Payment Options</h2>
              <div class="row">
			 	 <div class="OneCol">
                    <input type="radio" name="paymentmethod" id="paypal" value="paypal" <?php if (isset($PaymentMethod) && $PaymentMethod=="paypal") echo "checked";?> />
                    <label for="paypal">I am going to pay using Paypal</label>
					<input type="radio" name="paymentmethod" id="deposit" value="deposit" <?php if (isset($PaymentMethod) && $PaymentMethod=="deposit") echo "checked";?> />
                	<label for="deposit">I am going to pay using Bank Deposit</label>
				</div>
             </div>
             <div class="row"> 	
             	<div class="OneCol">					 
                     <p><br/><strong>Safe Online Payments</strong><br/>
                         Your safety is our priority. We chose to use the best online payment solutions. You can now safely pay online for your bookings because:
                         <ul>
                            <li>Using PayPal is Safe and Easy.</li>
                            <li>Your payment is Secure and Confidential.</li>
                            <li>You can pay with your PayPal account, Visa, MasterCard, Maestro, American Express and others.</li>
                            <li>You can pay from anywhere at anytime.</li>
                        </ul>
                     </p>
                 </div>
             </div>
             
             <div class="row"> 
             	<div class="OneCol">
                    <input type="checkbox" name="terms" id="terms" <?php if(isset($_POST['terms'])) echo "checked='checked'"; ?> />
                    <label for="terms">I have read and accept the <a href="/terms-conditions/" target="_blank">Terms and Conditions</a></label>
                </div> 
			 </div>

				   <div class="row">
					 <div class="my_captcha">
					   <?php
					   $args = array(
						 'chars_num'=> '8', // number of characters
						 'tcolor' => 'FF6600', // text color
						 'ncolor' => '999999', // noise color
						 'dots' => 50, // number of dots
						 'lines'=> 40, // number of lines,
						 'width'=>'220', // number of width,
						 'height'=>'70' // number of height
					   );
					   new MyCaptcha( $args );
					   ?>
					 </div>
					</div>			 
             
              <div class="row"> 
                  <div class="OneCol" align="right">
                      <input type="submit" id="submit" name="submit" value="Checkout">
                      <input type="hidden" name="action" value="new_post" />
                  </div>
              </div>
             
          </div>
          		
    </form>	
<?php
	}//END INDIVIDUAL FORM
	
	elseif ($incomingcategory['category'] == 'teams'){ //START TEAMS FORM
?>
	<script language="javascript">
        jQuery(document).ready(function(){
			
            jQuery("#birthday" ).datepicker({
                dateFormat : 'dd-mm-yy'
               // changeMonth : true,
                //changeYear : true,
               // yearRange: '-100y:c+nn',
               // maxDate: '-1d'
            });		

			jQuery("#dialogErrors").dialog({
				autoOpen: false,
				width: "600",
				resizable: false,
				height:"600",
				modal: true,
				buttons: {
						"Close": function() {
						jQuery(this).dialog( "close" );
					}
				}
			});
			
			//keep selected values for selects after submit
			<?php if (isset($_POST['teammembers'])) { ?>
				jQuery('select#teammembers').val('<?php echo $_POST['teammembers'];?>'); 
			<?php } ?>
			
			<?php for ($i = 1; $i <= 8; $i++) { ?>
				<?php if (isset($_POST['country_'.$i])) { ?>
						jQuery('#country_<?php echo $i;?>').val('<?php echo $_POST['country_'.$i];?>'); 
				<?php } ?>
			<?php } ?>

			<?php for ($i = 1; $i <= 8; $i++) { ?>
				<?php if (isset($_POST['gender_'.$i])) { ?>
						jQuery('#gender_<?php echo $i;?>').val('<?php echo $_POST['gender_'.$i];?>'); 
				<?php } ?>
			<?php } ?>

			<?php for ($i = 1; $i <= 8; $i++) { ?>
				<?php if (isset($_POST['raceCategory_'.$i])) { ?>
						jQuery('#raceCategory_<?php echo $i;?>').val('<?php echo $_POST['raceCategory_'.$i];?>'); 
				<?php } ?>
			<?php } ?>
			
			<?php for ($i = 1; $i <= 8; $i++) { ?>
				<?php if (isset($_POST['bikeRental_'.$i])) { ?>
						jQuery('#bikeRental_<?php echo $i;?>').val('<?php echo $_POST['bikeRental_'.$i];?>'); 
				<?php } ?>
			<?php } ?>
			
			<?php for ($i = 1; $i <= 8; $i++) { ?>
				<?php if (isset($_POST['jerseySize_'.$i])) { ?>
						jQuery('#jerseySize_<?php echo $i;?>').val('<?php echo $_POST['jerseySize_'.$i];?>'); 
				<?php } ?>
			<?php } ?>
			
			//if twin package selected show package option 
			<?php for ($i = 1; $i <= 8; $i++) { ?>
				if(jQuery('#TwinPackage_<?php echo $i;?>').is(':checked')) { 
					jQuery('#TwinPackageDiv_<?php echo $i;?>').show();
					<?php if (isset($_POST['PackageOption_'.$i])) { ?>
						jQuery('#PackageOption_<?php echo $i;?>').val('<?php echo $_POST['PackageOption_'.$i];?>'); 
					<?php } ?>
				}
			<?php } ?>
        });
		
		//show hide packages info based on user selection
		function togglePackageOption(id){
			if(jQuery("#TwinPackage_"+id).is(':checked'))  {
				jQuery("#TwinPackageDiv_"+id).show('fast');
			} else{
				jQuery("#TwinPackageDiv_"+id).hide('fast');
			}
		}
		
    </script>

    <form class="form" method="post" action="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
	<?php 
	date_default_timezone_set('Europe/Athens');
	$date = date('d/m/Y H:i:s a', time());
	$random_number = rand(0, 1000);
	$regCode = "TOCG-" . date('ymd-His') ."-".$random_number;
	
	if(isset($_POST['submit'])){
		
		$formCost = "";
		$formErrors = "";
		
		$teamname = $_POST['teamname'];
		$teamleader = $_POST['teamleader'];
		$leaderemail = $_POST['leaderemail'];
		$teammembers = $_POST['teammembers'];
		for ($i = 1; $i <= $_POST['teammembers']; $i++) {
			$surnameArr[] = $_POST['surname_'.$i];
			$nameArr[] = $_POST['name_'.$i];
			$emailArr[] = $_POST['email_'.$i];
			$emailverifyArr[] = $_POST['emailverify_'.$i];
			$phoneArr[] = $_POST['phone_'.$i];
			$countryArr[] = $_POST['country_'.$i];
			$cityArr[] = $_POST['city_'.$i];
			$addressArr[] = $_POST['address_'.$i];
			$postcodeArr[] = $_POST['postcode_'.$i];
			$birthdayArr[] = $_POST['birthday_'.$i];
			
			$genderArr[] = $_POST['gender_'.$i];
			$raceCategoryArr[] = $_POST['raceCategory_'.$i];
			$bikeRentalArr[] = $_POST['bikeRental_'.$i];
			$bikeSizeArr[] = $_POST['bikeSize_'.$i];
			
			$EmergencyNameArr[] = $_POST['EmergencyName_'.$i];
			$EmergencyPhoneArr[] = $_POST['EmergencyPhone_'.$i];
			$jerseySizeArr[] = $_POST['jerseySize_'.$i];
			$DietaryReqTxtArr[] = $_POST['DietaryReqTxt_'.$i];
			$MedicalConditionsTxtArr[] = $_POST['MedicalConditionsTxt_'.$i];	
			$FlightDetailsTxtArr[] = $_POST['FlightDetailsTxt_'.$i];		
			$RidingWithArr[] = $_POST['RidingWith_'.$i];			
			$sharedAccoArr[] = $_POST['sharedAcco_'.$i];				
			
			$selectPackageArr[] = $_POST['Package_'.$i];
			$PackageOptionArr[] = $_POST['PackageOption_'.$i];	
		} 
		$soloPackage = $_POST['soloPackage'];					
		$soloPackageValue = 1070;						
		$TwinPackage = $_POST['TwinPackage'];						
		$TwinPackageValue = 890;							
		$EntryOnly = $_POST['EntryOnly'];			
		$EntryOnlyValue = 150;			
		$PaymentMethod = $_POST['paymentmethod'];
		$Terms = $_POST['terms'];
		$IBAN = "GR80 0110 2050 0000 2053 8216 845";
		$signature = "<br><p><table border='0'><tr><td> <img src='http://tourofcrete.com/wp-content/uploads/2015/10/cropped-ToC_logo-150x150.png' alt='The Tour of Crete logo' style='width:5rem;height:5rem; padding-right:1rem;'></td><td> <strong><font face='crillee It BT, impact, Segoe UI, courier new' color='#ff6600'>The Tour of Crete Team</font></strong><br/> <font face='open sans light, open sans,helvetica,News Gothic MT,sans-serif,arial'> Visit our <a href='http://tourofcrete.com/' target='_blank'>Official Website</a><br/> Like our <a href='https://www.facebook.com/thetourofcrete' target='_blank'>Facebook page</a> </font></td></tr></table></p><br>";
		
		$DietaryReq = $_POST['DietaryReq'];		
		
		$is_captcha_correct = MyCaptcha::verify();
			
		if (empty($leaderemail)) {
			$formErrors .= "<li>Required form field -Leader Email- is missing</li>";
		}
		
		if ((!empty( $leaderemail )) && (!filter_var($leaderemail, FILTER_VALIDATE_EMAIL))) {
			$formErrors .=  "<li>The Leader Email is not correct</li>"; 
		} 
		
		if ( $teammembers == "-") {
			$formErrors .= "<li>Required form field -Group Members- is missing</li>";
		}
		
		if ( $teammembers <> "-") {
			if (sizeof($surnameArr) > 0) {
				foreach (array_values($surnameArr) as $k => $surname) {
					if (empty($surname)) {
						$formErrors .=  "<li>Required form field -Surname- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}
			
			if (sizeof($nameArr) > 0) {
				foreach (array_values($nameArr) as $k => $name) {
					if (empty($name)) {
						$formErrors .=  "<li>Required form field -Name- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}
			
			if (sizeof($emailArr) > 0) {
				foreach (array_values($emailArr) as $k => $email) {
					if (empty($email)) {
						$formErrors .=  "<li>Required form field -Email- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
					
					if ((!empty( $email )) && (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
						$formErrors .=  "<li>The email for MEMBER " . ($k+1) ." is not correct</li>"; 
					} 
				}
			}
			
			if (sizeof($emailverifyArr) > 0) {
				foreach (array_values($emailverifyArr) as $k => $emailverify) {
					if (empty($emailverify)) {
						$formErrors .=  "<li>Required form field -Repeat Email- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}
	
			if ((sizeof($emailArr) > 0) && (sizeof($emailverifyArr) > 0)) {
				foreach (array_values($emailArr) as $k => $email) {
					if ($email <> $emailverifyArr[$k]) {
						$formErrors .=  "<li>Email and Verification Email are not the same for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
				
			}
	

			if (sizeof($phoneArr) > 0) {
				foreach (array_values($phoneArr) as $k => $phone) {
					if (empty($phone)) {
						$formErrors .=  "<li>Required form field -Contact Number- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}
			
			if (sizeof($countryArr) > 1) {
				foreach (array_values($countryArr) as $k => $country) {
					if ($country == "-") {
						$formErrors .=  "<li>Required form field -Country- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}
			
			if (sizeof($cityArr) > 0) {
				foreach (array_values($cityArr) as $k => $city) {
					if (empty($city)) {
						$formErrors .=  "<li>Required form field -City- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}

			if (sizeof($addressArr) > 0) {
				foreach (array_values($addressArr) as $k => $address) {
					if (empty($address)) {
						$formErrors .=  "<li>Required form field -Address- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}

			if (sizeof($postcodeArr) > 0) {
				foreach (array_values($postcodeArr) as $k => $postcode) {
					if (empty($postcode)) {
						$formErrors .=  "<li>Required form field -Postcode- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}

			if (sizeof($birthdayArr) > 0) {
				foreach (array_values($birthdayArr) as $k => $birthday) {
					if (empty($birthday)) {
						$formErrors .=  "<li>Required form field -Date of Birth- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}

			if (sizeof($genderArr) > 0) {
				foreach (array_values($genderArr) as $k => $gender) {
					if ($gender == "-") {
						$formErrors .=  "<li>Required form field -Gender- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}
			
			if (sizeof($raceCategoryArr) > 0) {
				foreach (array_values($raceCategoryArr) as $k => $raceCategory) {
					if ($raceCategory == "-") {
						$formErrors .=  "<li>Required form field -Category- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}

			if (sizeof($EmergencyNameArr) > 0) {
				foreach (array_values($EmergencyNameArr) as $k => $EmergencyName) {
					if (empty($EmergencyName)) {
						$formErrors .=  "<li>Required form field -Emergency contact name- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}

			if (sizeof($jerseySizeArr) > 0) {
				foreach (array_values($jerseySizeArr) as $k => $jerseySize) {
					if ($jerseySize == "-") {
						$formErrors .=  "<li>Required form field -Jersey size- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}

			if (sizeof($DietaryReqTxtArr) > 0) {
				foreach (array_values($DietaryReqTxtArr) as $k => $DietaryReqTxt) {
					if (empty($DietaryReqTxt)) {
						$formErrors .=  "<li>Required form field -Dietary Requirements- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}

			if (sizeof($MedicalConditionsTxtArr) > 0) {
				foreach (array_values($MedicalConditionsTxtArr) as $k => $MedicalConditionsTxt) {
					if (empty($MedicalConditionsTxt)) {
						$formErrors .=  "<li>Required form field -Medical Conditions- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}

			if (sizeof($selectPackageArr) > 0) {
				foreach (array_values($selectPackageArr) as $k => $selectPackage) {
					if (empty($selectPackage)) {
						$formErrors .=  "<li>Required form field -Select Package- is missing for MEMBER " . ($k+1) ."</li>"; 
					} 
				}
			}
			
			if (sizeof($selectPackageArr) > 0) {
				foreach (array_values($selectPackageArr) as $k => $selectPackage) {
					if ($selectPackage == "TwinPackage" ) {
						foreach (array_values($PackageOptionArr) as $m => $PackageOption) {
							if ($PackageOption == "-") {
								$formErrors .=  "<li>Required form field -Package Option for Twin Package- is missing for MEMBER " . ($k+1) ."</li>"; 
							}
						}
					} 
				}
			}
		}
		
		if ( empty( $PaymentMethod ) ) {
			$formErrors .= "<li>Please select Payment Option</li>";
		}
		if ( empty( $Terms ) ) {
			$formErrors .= "<li>Please accept Terms and Conditions</li>";
		}
		
		if (!($is_captcha_correct)) {
			$formErrors .= "<li>Form Captcha incorrect</li>";		
		}
		
	if ( !empty($formErrors) ) {
			echo "<div id='dialogErrors' title='Please check the following errors'>";
				echo "<ul>".$formErrors."</ul>";
			echo "</div>";
			?>
			<script>
				jQuery(document).ready(function(){
					jQuery("#dialogErrors").dialog( "open" );
				});
			</script>
			<?php
		}else{
				$email_message = "<p>Dear <font color=\"#f60\"><strong>".$teamleader."</strong></font>,</p>";	
				$email_message .= "<p>Your booking for the Tour of Crete has been submitted succesfully! Your Registration Code is: <strong>".$regCode."</strong>. <br/>Please safekeep this number for future reference of this transaction when in contact with us. <br/>We have received your application and will be in contact with you to arrange any outlying details, if any arise.</p>";	
				$email_message .= "<p>Please review all following information and inform us in case of an error or correction:</p>";	
				$email_message .= "<table cellpadding='1' cellspacing='1'>";	
				$email_message .= "<tr><td colspan='".$teammembers."'>";	
				$email_message .= "<strong>Group Information</strong>\n\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td colspan='".$teammembers."'>";	
				$email_message .= "Group Name: ".$teamname."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td colspan='".$teammembers."'>";	
				$email_message .= "Group Leader: ".$teamleader."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td colspan='".$teammembers."'>";	
				$email_message .= "Leader Email: ".$leaderemail."\n";
				$email_message .= "</td></tr>";
				$email_message .= "<tr><td colspan='".$teammembers."'>";	
				$email_message .= "Group Members: ".$teammembers."\n";
				$email_message .= "</td></tr>";	
					
				$email_message .= "<tr>";
				$email_message .= "<td>&nbsp;</td>";
				for ($i = 1; $i <= $teammembers; $i++) {
					$email_message .= "<td><strong>MEMBER ".$i."</strong></td>";
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Surname</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $surnameArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Name</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $nameArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Email</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $emailArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Contact Number</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $phoneArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Country</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $countryArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>City</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $cityArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Address</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $addressArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Postcode</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $postcodeArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Date of Birth</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $birthdayArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Gender</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $genderArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Gender</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $genderArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Category</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $raceCategoryArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";

				$email_message .= "<tr>";
				$email_message .= "<td><strong>Bike Rental</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					if ($bikeRentalArr[$i-1] == "Teammachine-155"){ 
						$email_message .= "Teammachine 155 &euro;";
						$formCost += 155;
					}else if($bikeRentalArr[$i-1] == "Granfondo-135"){
						$email_message .= "Granfondo 135 &euro;";
						$formCost += 135;
					}else{
						$email_message .= "-";
					}
					
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";

				$email_message .= "<tr>";
				$email_message .= "<td><strong>Bike size</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $bikeSizeArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";

				$email_message .= "<tr>";
				$email_message .= "<td><strong>Emerg. Cont. Name</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $EmergencyNameArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Emerg. Cont. Phone</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $EmergencyPhoneArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Jersey Size</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $jerseySizeArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Dietary Req.</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $DietaryReqTxtArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Medical Cond.</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $MedicalConditionsTxtArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Flight det.</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $FlightDetailsTxtArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Riding with</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $RidingWithArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Shared Acc.</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					$email_message .= $sharedAccoArr[$i-1];
					$email_message .= "</td>";	
				}
				$email_message .= "</tr>";
				
				
				$email_message .= "<tr>";
				$email_message .= "<td><strong>Package Option</strong></td>";
				for ($i = 1; $i <= $_POST['teammembers']; $i++) {
					$email_message .= "<td>";	
					
					if ($selectPackageArr[$i-1] == "soloPackage"){ 
						$email_message .= "Solo Room package: ".number_format($soloPackageValue)." &euro;";
						$formCost += $soloPackageValue;
					} 
					
					else if ($selectPackageArr[$i-1] == "TwinPackage"){
						
						if ($PackageOptionArr[$i-1] == "TwinPackageA1"){
							$email_message .= "Shared Room registration package - A1: Double room or twin room (one double bed or two single beds) shared with another rider. Price: ".number_format($TwinPackageValue)." &euro;";
							$formCost += $TwinPackageValue;
						}
						else if ($PackageOptionArr[$i-1] == "TwinPackageA2"){
							$email_message .= "Shared Room registration package - Option A2: Double room, shared with another non-cyclist participant. Price: ".number_format($TwinPackageValue)." &euro;";
							$formCost += $TwinPackageValue;
						}
						
					} 
					
					else{
						$email_message .= "Registration-only package (i.e. no accommodation or (air)port/hotel luggage transfers): ".number_format($EntryOnlyValue)." &euro;";
						$formCost += $EntryOnlyValue;
					}
					
					$email_message .= "</td>";	
				}
				
				$email_message .= "</tr>";
				
				
				$email_message .= "</table><br/><br/>";
				
				
				$email_message .= "<table>";
				$email_message .= "<tr><td>";	
				$email_message .= "<strong>Payment Method</strong>\n\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				if ($PaymentMethod == "paypal"){
					$email_message .= "Paypal <br/>";
				}else{
					$email_message .= "Bank Deposit <br/>National Bank of Greece <br/>IBAN: <strong>".$IBAN."</strong><br/>";
				}
				$email_message .= "Transaction Date: ".$date."<br/>";
				$email_message .= "Registration Code: <strong>".$regCode."</strong><br/>";
				$email_message .= "Total Cost: ".number_format($formCost)." &euro;<br/>";
				$email_message .= "<br/><em>Make sure you attach your Full Name and Registration Code when submitting your payment.</em><br/>";
				$email_message .= "</td></tr>";	
				$email_message .= "</table><br/>";		
				$email_message .= "<p>In order to complete this transaction the user has read and accepted the <a href='http://tourofcrete.com/terms-conditions/' target='_blank'>Terms and Conditions</a>.</p>";	
				$email_message .= "<p>If, for any reason, you deem the above information as inaccurate, please contact us as soon as possible by replying to this e-mail. You will promptly receive a reply form us on any corrections or questions you may have.</p>";	
				$email_message .= "<p>We are gladly at your disposal. <br/>Best regards,</p>";	
				$email_message .= $signature;
				
				
				foreach ($_POST as $key => $value){
					echo "<input type=\"hidden\" name=\"".htmlspecialchars($key).
					 "\" value=\"".htmlspecialchars($value)."\"/>\n";
				}
				
				
				sendmail($email_message, $incomingcategory['category'], $leaderemail, $PaymentMethod, $formCost, $regCode);
			
			}
		
		}
		
		?>
        
      	<div class="step1">
        	  <h1>Registration Details</h1>
        	  
        	  <h2>Provisions</h2>
              <p>The Tour of Crete travel service provides the following for each cyclist-participant from May 7th 2016 until May 14th 2016:</p>
              <ul><strong>1. What is included per person:</strong>
                <li>7 x nights' accommodation  in various 4 stars hotels including breakfast</li>
                <li>7 x evening dinner (3-course Menu) at the hotel restaurant</li>
                <li>Airport shuttle - airport/hotel/airport, for rider and bike</li>
                <li>Registration fee for all 6 stages</li>
                <li>Event kit bag of the Tour of Crete</li>
                <li>Luggage transportation from hotel to hotel</li>
                <li>Nutrition supply during the event (feed zones)</li>
                <li>Timing system for all 6 stages</li>
                <li>Mechanical and technical support</li>
                <li>Motorbike outriders and lead cars</li>
                <li>Per request massage session at discounted price</li>
                <li>Digital photo and film (DVD will be sent) </li>
                <li>Event's memorabilia T-shirt</li>              
              </ul>
             <ul><strong>2. What's NOT included:</strong>
             	<li>Alcohol and personal expenses</li>
                <li>Travel insurance</li>
                <li>Flights</li>
                <li>Strong legs</li>
             </ul>
			
            
            <h2>Registration Options <font>(Select a package from below for more info)</font></h2>
            <p>Please Select Package. If your desired package is not available to select below then this has Sold Out. Please contact <a href="mailto:info@tourofcrete.com">info@tourofcrete.com</a>  to be added to the waiting list for this package.</p>
            <div class="row" style="margin:24px 0 0;">
                <p><strong>Solo Room registration package: 1070 &euro; </strong>(until 31/1/2016 - 1260 &euro; until 30/4 - 1430 &euro; until 6/5)<br/>Hotel room based on single occupancy.</p>
                <p><strong>Shared Room registration package (price per person): 890 &euro; </strong>(until 31/1/2016 - 1050 &euro; until 30/4 - 1190 &euro; until 6/5)<br/>
                    Option A1: Double room or twin room (one double bed or two single beds) shared with another rider.<br/>
                    Option A2: Double room shared with another non-cyclist participant.
                </p>   
                <p><strong>Registration-only package (i.e. no accommodation or (air)port/hotel luggage transfers): 150 &euro; </strong>(until 30/4 - 180 &euro; until 6/5)<br/>
                                    If you wish to organize your own accommodation and meals, this package will suit you best. You will be responsible for arranging your (air)port transportation, accommodation, breakfast and evening meals. The package does include the finale celebration dinner on Friday evening and everything else as described in the package.</p><br/>
              </div>
              
              <div class="row">
                  <div class="FiveCols">
                    <label for="teamname">Group Name</label>
                    <input type="text" id="teamname" name="teamname" value="<?php if (isset($teamname)) { echo $teamname; } ?>" placeholder="Team Name"  />
                  </div>
                  <div class="FiveCols">
                    <label for="teamleader">Group Leader</label>
                    <input type="text" id="teamleader" name="teamleader" value="<?php if (isset($teamleader)) { echo $teamleader; } ?>" placeholder="Team Leader"  />
                  </div>
                  <div class="FiveCols">
                    <label for="leaderemail">Leader Email <span class="required">*</span></label>
                    <input type="text" id="leaderemail" name="leaderemail" value="<?php if (isset($leaderemail)) { echo $leaderemail; } ?>" placeholder="Leader Email"  />
                  </div>
                  <div class="FiveCols">
                    <label for="teammembers">Group Members <span class="required">*</span></label>
                    <select name="teammembers" id="teammembers">
                    	<option value="-">Select...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                  </div>
              </div>
              
              <div class="row">
              	<div class="NineCols"><div class="title">&nbsp;</div></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) {
					echo "<div class='NineCols'><div class='title'>MEMBER ".$i."</div></div>";
				} 
				?>
              </div>
              
              <div class="row">
              	<div class="NineCols first"><label for="soloPackage_1">Solo Room package</label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                    	<input 	type="radio" name="Package_<?php echo $i; ?>" id="soloPackage_<?php echo $i; ?>" value="soloPackage" <?php if (isset($selectPackageArr[$i-1]) && $selectPackageArr[$i-1]=="soloPackage") echo "checked";?> onchange="togglePackageOption(<?php echo $i; ?>);"/>
                    </div>
                <?php	
				} 
				?>
              </div>
              
              <div class="row">
              	<div class="NineCols first"><label for="TwinPackage_1">Shared Room package</label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                        <input type="radio" name="Package_<?php echo $i; ?>" id="TwinPackage_<?php echo $i; ?>" value="TwinPackage" <?php if (isset($selectPackageArr[$i-1]) && $selectPackageArr[$i-1]=="TwinPackage") echo "checked";?> onchange="togglePackageOption(<?php echo $i; ?>);" />
                        <div id="TwinPackageDiv_<?php echo $i; ?>" class="infoDiv" style="display:none;"> 
                        	<select name="PackageOption_<?php echo $i; ?>" id="PackageOption_<?php echo $i; ?>">
                            	<option value="-">Select...</option>
                        		<option value="TwinPackageA1">Option A1</option>
                                <option value="TwinPackageA2">Option A2</option>
                            </select>
                        </div>
                    </div>
                <?php	
				} 
				?>
              </div>
              
              <div class="row">
              	<div class="NineCols first"><label for="EntryOnly_1">Registration-only</label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                        <input type="radio" name="Package_<?php echo $i; ?>" id="EntryOnly_<?php echo $i; ?>" value="EntryOnly" <?php if (isset($selectPackageArr[$i-1]) && $selectPackageArr[$i-1]=="EntryOnly") echo "checked";?> onchange="togglePackageOption(<?php echo $i; ?>);" />
                    </div>
                <?php	
				} 
				?>
              </div>
        	  
             
              <h2>Personal Information</h2>
              <div class="row">
                <div class="NineCols"><div class="title">&nbsp;</div></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) {
                    echo "<div class='NineCols'><div class='title'>MEMBER ".$i."</div></div>";
                } 
                ?>
              </div>
              
              <div class="row">
                <div class="NineCols first"><label for="surname_1">Surname <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols"><input type="text" id="surname_<?php echo $i; ?>" name="surname_<?php echo $i; ?>" value="<?php if (isset($surnameArr[$i-1])) { echo $surnameArr[$i-1]; } ?>" placeholder="Surname <?php echo $i; ?>"  /></div>
                
                <?php	
                } 
                ?>
              </div>
              
              <div class="row">
                <div class="NineCols first"><label for="name_1">Name <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols"><input type="text" id="name_<?php echo $i; ?>" name="name_<?php echo $i; ?>" value="<?php if (isset($nameArr[$i-1])) { echo $nameArr[$i-1]; } ?>" placeholder="Name <?php echo $i; ?>"  /></div>
                <?php	
                } 
                ?>
              </div>
             
              <div class="row">
                <div class="NineCols first"><label for="email_1">Email <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols"><input type="text" id="email_<?php echo $i; ?>" name="email_<?php echo $i; ?>" value="<?php if (isset($emailArr[$i-1])) { echo $emailArr[$i-1]; } ?>" placeholder="Email <?php echo $i; ?>"  /></div>
                <?php	
                } 
                ?>
              </div>

              <div class="row">
                <div class="NineCols first"><label for="emailverify_1">Repeat Email <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols"><input type="text" id="emailverify_<?php echo $i; ?>" name="emailverify_<?php echo $i; ?>" value="<?php if (isset($emailverifyArr[$i-1])) { echo $emailverifyArr[$i-1]; } ?>" placeholder="Repeat Email <?php echo $i; ?>"  /></div>
                <?php	
                } 
                ?>
              </div>

              <div class="row">
                <div class="NineCols first"><label for="phone_1">Contact Number <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols"><input type="text" id="phone_<?php echo $i; ?>" name="phone_<?php echo $i; ?>" value="<?php if (isset($phoneArr[$i-1])) { echo $phoneArr[$i-1]; } ?>" placeholder="Phone <?php echo $i; ?>"  /></div>
                <?php	
                } 
                ?>
              </div>
              
              <div class="row">
                <div class="NineCols first"><label for="country_1">Country <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols">
                        <select name="country_<?php echo $i; ?>" id="country_<?php echo $i; ?>" placeholder="Country"  >
                        <option value="-">Select...</option>
                        <option value="AT">Austria</option>
                        <option value="BE">Belgium</option>
                        <option value="CY">Cyprus</option>
                        <option value="DK">Denmark</option>
                        <option value="FI">Finland</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                        <option value="GR">Greece</option>
                        <option value="IE">Ireland</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italy</option>
                        <option value="NL">Netherlands</option>
                        <option value="NO">Norway</option>
                        <option value="SE">Sweden</option>
                        <option value="CH">Switzerland</option>
                        <option value="TR">Turkey</option>
                        <option value="UK">United Kingdom</option>
                        <option value="US">U.S.A.</option>
                        <option value="AF">Afganistan</option>
                        <option value="AL">Albania</option>
                        <option value="DZ">Algeria</option>
                        <option value="AS">American Samoa</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguilla</option>
                        <option value="AQ">Antarctica</option>
                        <option value="AG">Antigua and Barbuda</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AZ">Azerbaijan</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahrain</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BB">Barbados</option>
                        <option value="BY">Belarus</option>
                        <option value="BZ">Belize</option>
                        <option value="BJ">Benin</option>
                        <option value="BM">Bermuda</option>
                        <option value="BT">Bhutan</option>
                        <option value="BO">Bolivia</option>
                        <option value="BA">Bosnia and Herzegovina</option>
                        <option value="BW">Botswana</option>
                        <option value="BV">Bouvet Island</option>
                        <option value="BR">Brazil</option>
                        <option value="IO">British Indian Ocean Territory</option>
                        <option value="BN">Brunei Darussalam</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina FASO</option>
                        <option value="BI">Burundi</option>
                        <option value="KH">Cambodia</option>
                        <option value="CM">Cameroon</option>
                        <option value="CA">Canada</option>
                        <option value="CV">Cape Verde</option>
                        <option value="KY">Cayman Islands</option>
                        <option value="CF">Central African Republic</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="CX">Christmas Island</option>
                        <option value="CC">Cocos (Keeling) Islands</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comoros</option>
                        <option value="CG">Congo</option>
                        <option value="CK">Cook Islands</option>
                        <option value="CR">Costa Rica</option>
                        <option value="CI">Cote d'Ivoire</option>
                        <option value="HR">Croatia</option>
                        <option value="CU">Cuba</option>
                        <option value="CZ">Czech Republic</option>
                        <option value="DJ">Djibouti</option>
                        <option value="DM">Dominican Republic</option>
                        <option value="TP">East Timor</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egypt</option>
                        <option value="SV">El Salvador</option>
                        <option value="GQ">Equatorial Guinea</option>
                        <option value="ER">Eritrea</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Ethiopia</option>
                        <option value="FK">Falkland Islands</option>
                        <option value="FO">Faroe Islands</option>
                        <option value="FJ">Fiji</option>
                        <option value="GF">French Guiana</option>
                        <option value="PF">French Polynesia</option>
                        <option value="TF">French Southern Territories</option>
                        <option value="MK">F.Y.R.O.M.</option>
                        <option value="GA">Gabon</option>
                        <option value="GM">Gambia</option>
                        <option value="GE">Georgia</option>
                        <option value="GH">Ghana</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GL">Greenland</option>
                        <option value="GD">Grenada</option>
                        <option value="GP">Guadeloupe</option>
                        <option value="GU">Guam</option>
                        <option value="GT">Guatemala</option>
                        <option value="GN">Guinea</option>
                        <option value="GW">Guinea-Bissau</option>
                        <option value="GY">Guyana</option>
                        <option value="HT">Haiti</option>
                        <option value="HM">Heard and Mc Donald Islands</option>
                        <option value="HN">Honduras</option>
                        <option value="HK">Hong Kong</option>
                        <option value="HU">Hungary</option>
                        <option value="IS">Iceland</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IR">Iran</option>
                        <option value="IQ">Iraq</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japan</option>
                        <option value="JO">Jordan</option>
                        <option value="KZ">Kazakhstan</option>
                        <option value="KE">Kenya</option>
                        <option value="KI">Kiribati</option>
                        <option value="KP">Korea, Republic of</option>
                        <option value="KR">Korea (South)</option>
                        <option value="KW">Kuwait</option>
                        <option value="KG">Kyrgyzstan</option>
                        <option value="LA">Lao</option>
                        <option value="LV">Latvia</option>
                        <option value="LB">Lebanon</option>
                        <option value="LS">Lesotho</option>
                        <option value="LR">Liberia</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lithuania</option>
                        <option value="LU">Luxembourg</option>
                        <option value="MO">Macau</option>
                        <option value="MG">Madagascar</option>
                        <option value="MW">Malawi</option>
                        <option value="MY">Malaysia</option>
                        <option value="MV">Maldives</option>
                        <option value="ML">Mali</option>
                        <option value="MT">Malta</option>
                        <option value="MH">Marshall Islands</option>
                        <option value="MQ">Martinique</option>
                        <option value="MR">Mauritania</option>
                        <option value="MU">Mauritius</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">Mexico</option>
                        <option value="FM">Micronesia</option>
                        <option value="MD">Moldova</option>
                        <option value="MC">Monaco</option>
                        <option value="MN">Mongolia</option>
                        <option value="MS">Montserrat</option>
                        <option value="MA">Morocco</option>
                        <option value="MZ">Mozambique</option>
                        <option value="MM">Myanmar</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="AN">Netherlands Antilles</option>
                        <option value="NC">New Caledonia</option>
                        <option value="NZ">New Zealand</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Niger</option>
                        <option value="NG">Nigeria</option>
                        <option value="NU">Niue</option>
                        <option value="NF">Norfolk Island</option>
                        <option value="MP">Northern Mariana Islands</option>
                        <option value="OM">Oman</option>
                        <option value="PK">Pakistan</option>
                        <option value="PW">Palau</option>
                        <option value="PA">Panama</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Peru</option>
                        <option value="PH">Philippines</option>
                        <option value="PN">Pitcairn</option>
                        <option value="PL">Poland</option>
                        <option value="PT">Portugal</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="QA">Qatar</option>
                        <option value="RE">Reunion</option>
                        <option value="RO">Romania</option>
                        <option value="RU">Russia</option>
                        <option value="RW">Rwanda</option>
                        <option value="KN">Saint Kitts and Nevis</option>
                        <option value="LC">Saint Lucia</option>
                        <option value="WS">Samoa</option>
                        <option value="SM">San Marino</option>
                        <option value="ST">Sao Tome and Principe</option>
                        <option value="SA">Saudi Arabia</option>
                        <option value="SN">Senegal</option>
                        <option value="SC">Seychelles</option>
                        <option value="RS">Serbia</option>
                        <option value="SL">Sierra Leone</option>
                        <option value="SG">Singapore</option>
                        <option value="SK">Slovakia</option>
                        <option value="SI">Slovenia</option>
                        <option value="SB">Solomon Islands</option>
                        <option value="SO">Somalia</option>
                        <option value="ZA">South Africa</option>
                        <option value="ES">Spain</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="SH">St. Helena</option>
                        <option value="PM">St. Pierre And Miquelon</option>
                        <option value="SD">Sudan</option>
                        <option value="SR">Suriname</option>
                        <option value="SJ">Svalbard + J Mayen</option>
                        <option value="S">Swaziland</option>
                        <option value="SY">Syria</option>
                        <option value="TW">Taiwan</option>
                        <option value="TJ">Tajikistan</option>
                        <option value="TZ">Tanzania</option>
                        <option value="TH">Thailand</option>
                        <option value="TG">Togo</option>
                        <option value="TK">Tokelau</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad and Tobago</option>
                        <option value="TN">Tunisia</option>
                        <option value="TM">Turkmenistan</option>
                        <option value="TC">Turks and Caicos Islands</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UG">Uganda</option>
                        <option value="UA">Ukraine</option>
                        <option value="AE">United Arab Emirates</option>
                        <option value="UY">Uruguay</option>
                        <option value="UZ">Uzbekistan</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VA">Vatican City State (Holy See)</option>
                        <option value="VE">Venezuela</option>
                        <option value="VN">Vietnam</option>
                        <option value="VG">Virgin Islands (British)</option>
                        <option value="VI">Virgin Islands (U.S.)</option>
                        <option value="WF">Wallis and Futuna Islands</option>
                        <option value="EH">Western Sahara</option>
                        <option value="YE">Yemen</option>
                        <option value="ZY">Zaire</option>
                        <option value="ZM">Zambia</option>
                        <option value="ZW">Zimbabwe</option>
                    </select>
                   </div>
                <?php	
                } 
                ?>
              </div>

              <div class="row">
                <div class="NineCols first"><label for="city_1">City <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols"><input type="text" id="city_<?php echo $i; ?>" name="city_<?php echo $i; ?>" value="<?php if (isset($cityArr[$i-1])) { echo $cityArr[$i-1]; } ?>" placeholder="City <?php echo $i; ?>"  /></div>
                <?php	
                } 
                ?>
              </div>

              <div class="row">
                <div class="NineCols first"><label for="address_1">Address <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols"><input type="text" id="address_<?php echo $i; ?>" name="address_<?php echo $i; ?>" value="<?php if (isset($addressArr[$i-1])) { echo $addressArr[$i-1]; } ?>" placeholder="Address <?php echo $i; ?>"  /></div>
                <?php	
                } 
                ?>
              </div>
              
              <div class="row">
                <div class="NineCols first"><label for="postcode_1">Postcode <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols"><input type="text" id="postcode_<?php echo $i; ?>" name="postcode_<?php echo $i; ?>" value="<?php if (isset($postcodeArr[$i-1])) { echo $postcodeArr[$i-1]; } ?>" placeholder="Postcode <?php echo $i; ?>"  /></div>
                <?php	
                } 
                ?>
              </div>

              <div class="row">
                <div class="NineCols first"><label for="birthday_1">Date of Birth (d/m/y) <span class="required">*</span></label></div>
                <?php 
                for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="NineCols"><input type="text" id="birthday_<?php echo $i; ?>" name="birthday_<?php echo $i; ?>" value="<?php if (isset($birthdayArr[$i-1])) { echo $birthdayArr[$i-1]; } ?>" placeholder="Birthday <?php echo $i; ?>"  /></div>
                <?php	
                } 
                ?>
              </div>

              
              <h2>Other Info</h2>
              <div class="row">
              	<div class="NineCols first"><label for="gender_1">Gender <span class="required">*</span></label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                    	<select id="gender_<?php echo $i; ?>" name="gender_<?php echo $i; ?>" placeholder="Gender <?php echo $i; ?>" >
                          <option value="-">Select...</option>
                          <option value="female">Female</option>
                          <option value="male">Male</option>
                        </select>
                    </div>
                <?php	
				} 
				?>
              </div>
              
              <div class="row">
              	<div class="NineCols first"><label for="raceCategory_1">Category <span class="required">*</span></label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                    	<select id="raceCategory_<?php echo $i; ?>" name="raceCategory_<?php echo $i; ?>" placeholder="Category <?php echo $i; ?>" >
                          <option value="-">Select...</option>
                          <option value="From 18 until 35 years old">From 18 until 35 years old</option>
                          <option value="From 36 until 55 years old">From 36 until 55 years old</option>
                          <option value="From 56 years old and above">From 56 years old and above</option>
                        </select>
                    </div>
                <?php	
				} 
				?>
              </div>
              
              <div class="row">
              	<div class="NineCols first"><label for="bikeRental_1">Bike Rental</label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                        <select id="bikeRental_<?php echo $i; ?>" name="bikeRental_<?php echo $i; ?>" placeholder="Bike Rental <?php echo $i; ?>">
                          <option value="-">Select...</option>
                          <option value="Teammachine-155">Teammachine SLR02 Shimano 105 Compact (Price for the event: 155,00 Euro)</option>
                          <option value="Granfondo-135">Granfondo GF02 Shimano Tiagra Compact (Price for the event: 135,00 Euro)</option>
                        </select>
                    </div>
                <?php	
				} 
				?>
              </div>
              
              <div class="row">
              	<div class="NineCols first"><label for="bikeSize_1">Requested bike size</label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                    	<input type="text" id="bikeSize_<?php echo $i; ?>" name="bikeSize_<?php echo $i; ?>" placeholder="Bike Size <?php echo $i; ?>" value="<?php if (isset($bikeSizeArr[$i-1])) { echo $bikeSizeArr[$i-1]; } ?>" />
                    </div>
                <?php	
				} 
				?>
              </div>
              
              <h2>Additional Required Details</h2>
              <div class="row">
              	<div class="NineCols first"><label for="EmergencyName_1">Emergency contact name <span class="required">*</span></label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                    	<input type="text" id="EmergencyName_<?php echo $i; ?>" name="EmergencyName_<?php echo $i; ?>" value="<?php if (isset($EmergencyNameArr[$i-1])) { echo $EmergencyNameArr[$i-1]; } ?>" placeholder="Emerg. Name <?php echo $i; ?>"  />	
                    </div>
                <?php	
				} 
				?>
              </div>
             
              <div class="row">
              	<div class="NineCols first"><label for="EmergencyPhone_1">Emergency contact phone</label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                        <input type="text" id="EmergencyPhone_<?php echo $i; ?>" name="EmergencyPhone_<?php echo $i; ?>" value="<?php if (isset($EmergencyPhoneArr[$i-1])) { echo $EmergencyPhoneArr[$i-1]; } ?>" placeholder="Emerg. Phone <?php echo $i; ?>" />
                    </div>
                <?php	
				} 
				?>
              </div>
              
              <div class="row">
              	<div class="NineCols first"><label for="jerseySize_1">Please state your jersey size <span class="required">*</span></label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                        <select id="jerseySize_<?php echo $i; ?>" name="jerseySize_<?php echo $i; ?>" placeholder="Jersey Size <?php echo $i; ?>" >
                          <option value="-">Select...</option>
                          <option value="small">Small</option>
                          <option value="medium">Medium</option>
                          <option value="large">Large</option>
                          <option value="xlarge">Extra Large</option>
                        </select>
                    </div>
                <?php	
				} 
				?>
              </div>
              
              <div class="row">
              	<div class="NineCols first"><label>Do you have any Dietary Requirements? <span class="required">*</span></label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                        <input 	type="text" id="DietaryReqTxt_<?php echo $i; ?>" name="DietaryReqTxt_<?php echo $i; ?>" value="<?php if (isset($DietaryReqTxtArr[$i-1])) { echo $DietaryReqTxtArr[$i-1]; } ?>" placeholder="Dietary Req. <?php echo $i; ?>" />
                    </div>
                <?php	
				} 
				?>
              </div>
              
              <div class="row">
              	<div class="NineCols first"><label>Do you have any Medical Conditions? <span class="required">*</span></label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                    	<input 	type="text" id="MedicalConditionsTxt_<?php echo $i; ?>" name="MedicalConditionsTxt_<?php echo $i; ?>" value="<?php if (isset($MedicalConditionsTxtArr[$i-1])) { echo $MedicalConditionsTxtArr[$i-1]; } ?>" placeholder="Med. Cond. <?php echo $i; ?>" />
                    </div>
                <?php	
				} 
				?>
              </div>

              <div class="row">
              	<div class="NineCols first"><label>Do you know your flight details?</label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                        <input type="text" id="FlightDetailsTxt_<?php echo $i; ?>" name="FlightDetailsTxt_<?php echo $i; ?>" value="<?php if (isset($FlightDetailsTxtArr[$i-1])) { echo $FlightDetailsTxtArr[$i-1]; } ?>" placeholder="Flight Details <?php echo $i; ?>" />
                    </div>
                <?php	
				} 
				?>
              </div>

              <div class="row">
              	<div class="NineCols first"><label for="RidingWith">Who are you riding with, or plan to ride with?</label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                        <input type="text" id="RidingWith_<?php echo $i; ?>" name="RidingWith_<?php echo $i; ?>" value="<?php if (isset($RidingWithArr[$i-1])) { echo $RidingWithArr[$i-1]; } ?>" placeholder="Riding With <?php echo $i; ?>" />
                    </div>
                <?php	
				} 
				?>
              </div>

              <div class="row">
              	<div class="NineCols first"><label for="sharedAcco">If opting for shared accommodation, who do you want to room with?</label></div>
                <?php 
				for ($i = 1; $i <= 8; $i++) { ?>
					<div class="NineCols">
                        <input 	type="text" id="sharedAcco_<?php echo $i; ?>" name="sharedAcco_<?php echo $i; ?>" value="<?php if (isset($sharedAccoArr[$i-1])) { echo $sharedAccoArr[$i-1]; } ?>" placeholder="Shared Acc. <?php echo $i; ?>" />
                    </div>
                <?php	
				} 
				?>
              </div>
             
              
              				
              <h2>Payment Options</h2>
              <div class="row">
			 	 <div class="OneCol">
                    <input type="radio" name="paymentmethod" id="paypal" value="paypal" <?php if (isset($PaymentMethod) && $PaymentMethod=="paypal") echo "checked";?> />
                    <label for="paypal">I am going to pay using Paypal</label>
					<input type="radio" name="paymentmethod" id="deposit" value="deposit" <?php if (isset($PaymentMethod) && $PaymentMethod=="deposit") echo "checked";?> />
                	<label for="deposit">I am going to pay using Bank Deposit</label>
				</div>
             </div>
             <div class="row"> 	
             	<div class="OneCol">					 
                     <p><br/><strong>Safe Online Payments</strong><br/>
                         Your safety is our priority. We chose to use the best online payment solutions. You can now safely pay online for your bookings because:
                         <ul>
                            <li>Using PayPal is Safe and Easy.</li>
                            <li>Your payment is Secure and Confidential.</li>
                            <li>You can pay with your PayPal account, Visa, MasterCard, Maestro, American Express and others.</li>
                            <li>You can pay from anywhere at anytime.</li>
                        </ul>
                     </p>
                 </div>
             </div>
             
             <div class="row"> 
             	<div class="OneCol">
                    <input type="checkbox" name="terms" id="terms" <?php if(isset($_POST['terms'])) echo "checked='checked'"; ?> />
                    <label for="terms">I have read and accept the <a href="/terms-conditions/" target="_blank">Terms and Conditions</a></label>
                </div> 
			 </div>

				   <div class="row">
					 <div class="my_captcha">
					   <?php
					   $args = array(
						 'chars_num'=> '8', // number of characters
						 'tcolor' => 'FF6600', // text color
						 'ncolor' => '999999', // noise color
						 'dots' => 50, // number of dots
						 'lines'=> 40, // number of lines,
						 'width'=>'220', // number of width,
						 'height'=>'70' // number of height
					   );
					   new MyCaptcha( $args );
					   ?>
					 </div>
					</div>
					
              <div class="row"> 
                  <div class="OneCol" align="right">
                      <input type="submit" id="submit" name="submit" value="Checkout">
                      <input type="hidden" name="action" value="new_post" />
                  </div>
              </div>
             
             <?php
			 echo $formCost;
			 
			 ?>
          </div>
          		
    </form>	
    
    <?php
	}//END TEAMS FORM
	else{ //START NON CYCLIST FORM
	?>
	<script language="javascript">
        jQuery(document).ready(function(){
            jQuery("#birthday" ).datepicker({
                dateFormat : 'dd-mm-yy'
               // changeMonth : true,
                //changeYear : true,
               // yearRange: '-100y:c+nn',
               // maxDate: '-1d'
            });		
            	
			//show hide packages info based on user selection	
			jQuery('#soloPackage').click(function () {
				jQuery('#TwinPackageDiv').hide('fast');
				jQuery('#EntryOnlyDiv').hide('fast');
				jQuery('#soloPackageDiv').show('fast');
			});
			
			jQuery('#TwinPackage').click(function () {
				jQuery('#soloPackageDiv').hide('fast');
				jQuery('#EntryOnlyDiv').hide('fast');
				jQuery('#TwinPackageDiv').show('fast');
			});
			
			jQuery('#EntryOnly').click(function () {
				jQuery('#TwinPackageDiv').hide('fast');
				jQuery('#soloPackageDiv').hide('fast');
				jQuery('#EntryOnlyDiv').show('fast');
			});

			jQuery("#dialogErrors").dialog({
				autoOpen: false,
				width: "600",
				resizable: false,
				height:"600",
				modal: true,
				buttons: {
						"Close": function() {
						jQuery(this).dialog( "close" );
					}
				}
			});
			
			//keep selected values for selects after submit
			<?php if (isset($_POST['country'])) { ?>
				jQuery('select#country').val('<?php echo $_POST['country'];?>'); 
			<?php } ?>
			
			<?php if (isset($_POST['gender'])) { ?>
				jQuery('select#gender').val('<?php echo $_POST['gender'];?>'); 
			<?php } ?>
			
			<?php if (isset($_POST['tshirtSize'])) { ?>
				jQuery('select#tshirtSize').val('<?php echo $_POST['tshirtSize'];?>'); 
			<?php } ?>
                    
					
			//show hidden divs for radio buttons after submit
			if(jQuery('#soloPackage').is(':checked')) { 
				jQuery('#soloPackageDiv').show('fast');
			}
			if(jQuery('#TwinPackage').is(':checked')) { 
				jQuery('#TwinPackageDiv').show('fast');
			}
			if(jQuery('#EntryOnly').is(':checked')) { 
				jQuery('#EntryOnlyDiv').show('fast');
			}
			
        });
    </script>

    <form class="form" method="post" action="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
	<?php 
	date_default_timezone_set('Europe/Athens');
	$date = date('d/m/Y H:i:s a', time());
	$random_number = rand(0, 1000);
	$regCode = "TOCN-" . date('ymd-His') ."-".$random_number;
	
	if(isset($_POST['submit'])){
		
		$formCost = "";
		$formErrors = "";
		
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$emailverify = $_POST['emailverify'];
		$phone = $_POST['phone'];
		$country = $_POST['country'];
		$city = $_POST['city'];
		$address = $_POST['address'];
		$postcode = $_POST['postcode'];
		$birthday = $_POST['birthday'];
		$gender = $_POST['gender'];
		$EmergencyName = $_POST['EmergencyName'];
		$EmergencyPhone = $_POST['EmergencyPhone'];
		$tshirtSize = $_POST['tshirtSize'];
		$DietaryReqTxt = $_POST['DietaryReqTxt'];
		$MedicalConditionsTxt = $_POST['MedicalConditionsTxt'];	
		$FlightDetailsTxt = $_POST['FlightDetailsTxt'];					
		$sharedAcco = $_POST['sharedAcco'];				
		$selectPackage = $_POST['Package'];
		$soloPackage = $_POST['soloPackage'];					
		$soloPackageValue = 890;						
		$TwinPackage = $_POST['TwinPackage'];						
		$TwinPackageValue = 740;		
		$PackageOption = $_POST['PackageOption'];	
		$PaymentMethod = $_POST['paymentmethod'];
		$Terms = $_POST['terms'];
		$IBAN = "GR80 0110 2050 0000 2053 8216 845";
		$signature = "<br><p><table border='0'><tr><td> <img src='http://tourofcrete.com/wp-content/uploads/2015/10/cropped-ToC_logo-150x150.png' alt='The Tour of Crete logo' style='width:5rem;height:5rem; padding-right:1rem;'></td><td> <strong><font face='crillee It BT, impact, Segoe UI, courier new' color='#ff6600'>The Tour of Crete Team</font></strong><br/> <font face='open sans light, open sans,helvetica,News Gothic MT,sans-serif,arial'> Visit our <a href='http://tourofcrete.com/' target='_blank'>Official Website</a><br/> Like our <a href='https://www.facebook.com/thetourofcrete' target='_blank'>Facebook page</a> </font></td></tr></table></p><br>";
		
		$DietaryReq = $_POST['DietaryReq'];		
		
		$is_captcha_correct = MyCaptcha::verify();		
			
		if ( empty( $fullname ) ) {
			$formErrors .= "<li>Required form field -Full Name- is missing</li>";
		}
		if ( empty( $email ) ) {
			$formErrors .= "<li>Required form field -Email- is missing</li>";
		}
		if ((!empty( $email )) && (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
			$formErrors .= "<li>The email you entered is not correct</li>";
		}
		if ( empty( $emailverify ) ) {
			$formErrors .= "<li>Required form field -Repeat Email- is missing</li>";
		}	
		if ((!empty( $email )) && (!empty( $emailverify )) && ($email != $emailverify)) {
			$formErrors .= "<li>Email and Verification Email are not the same</li>";
		}
		if ( empty( $phone ) ) {
			$formErrors .= "<li>Required form field -Contact Number- is missing</li>";
		}
		if ( $gender == "-" ) {
			$formErrors .= "<li>Required form field -Gender- is missing</li>";
		}
		if ( $country == "-" ) {
			$formErrors .= "<li>Required form field -Country- is missing</li>";
		}
		if ( empty( $city ) ) {
			$formErrors .= "<li>Required form field -City- is missing</li>";
		}
		if ( empty( $address ) ) {
			$formErrors .= "<li>Required form field -Address- is missing</li>";
		}
		if ( empty( $postcode ) ) {
			$formErrors .= "<li>Required form field -Postcode- is missing</li>";
		}
		if ( empty( $birthday ) ) {
			$formErrors .= "<li>Required form field -Date of Birth- is missing</li>";
		}
		if ( empty( $EmergencyName ) ) {
			$formErrors .= "<li>Required form field -Emergency contact name- is missing</li>";
		}
		if ( $tshirtSize == "-" ) {
			$formErrors .= "<li>Required form field -T-Shirt size- is missing</li>";
		}
		if ( empty( $DietaryReqTxt ) ) {
			$formErrors .= "<li>Required form field -Dietary Requirements- is missing</li>";
		}
		if ( empty( $MedicalConditionsTxt ) ) {
			$formErrors .= "<li>Required form field -Medical Conditions- is missing</li>";
		}
		if ( empty( $selectPackage ) ) {
			$formErrors .= "<li>Required form field -Select Package- is missing</li>";
		}
		if (( $selectPackage == "TwinPackage" ) && ( empty( $PackageOption ) )) {
			$formErrors .= "<li>Required form field -Select option for Twin Package- is missing</li>";
		}
		if ( empty( $PaymentMethod ) ) {
			$formErrors .= "<li>Required form field -Payment Option- is missing</li>";
		}
		if ( empty( $Terms ) ) {
			$formErrors .= "<li>Please accept Terms and Conditions</li>";
		}

		if (!($is_captcha_correct)) {
			$formErrors .= "<li>Form Captcha incorrect</li>";		
		}		

	if ( !empty($formErrors) ) {
			echo "<div id='dialogErrors' title='Please check the following errors'>";
				echo "<ul>".$formErrors."</ul>";
			echo "</div>";
			?>
			<script>
				jQuery(document).ready(function(){
					jQuery("#dialogErrors").dialog( "open" );
				});
			</script>
			<?php
		}else{
			
			$email_message = "<p>Dear <font color=\"#f60\"><strong>".$fullname."</strong></font>,</p>";	
				$email_message .= "<p>Your booking for the Tour of Crete has been submitted succesfully! Your Registration Code is: <strong>".$regCode."</strong>. <br/>Please safekeep this number for future reference of this transaction when in contact with us. <br/>We have received your application and will be in contact with you to arrange any outlying details, if any arise.</p>";	
				$email_message .= "<p>Please review all following information and inform us in case of an error or correction:</p>";
				$email_message .= "<table>";	
				$email_message .= "<tr><td>";	
				$email_message .= "<strong>Personal Information</strong>\n\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Full Name: ".$fullname."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Email: ".$email."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Contact Number: ".$phone."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Country: ".$country."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "City: ".$city."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Address: ".$address."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Postcode: ".$postcode."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Date of Birth: ".$birthday."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Gender: ".$gender."\n";
				$email_message .= "</td></tr>";		
				$email_message .= "<tr><td>";	
				$email_message .= "Emergency Contact Name: ".$EmergencyName."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Emergency contact phone: ".$EmergencyPhone."\n";		
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "T-Shirt Size: ".$tshirtSize."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Dietary Requirements: ".$DietaryReqTxt."\n";		
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Medical Conditions: ".$MedicalConditionsTxt."\n";				
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Flight details: ".$FlightDetailsTxt."\n";						
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "If opting for shared accommodation, who do you want to room with?: ".$sharedAcco."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td><br/>";	
				$email_message .= "<strong>Package Option</strong>\n\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";		
				if ($selectPackage == "soloPackage"){ 
					$email_message .= "Solo Room package - Hotel room based on single occupancy. Price: ".number_format($soloPackageValue)." &euro; \n"; 
					$formCost += $soloPackageValue;
				}
				if ($selectPackage == "TwinPackage"){ 
					if ($PackageOption == "TwinPackageB1"){
						$email_message .= "Shared Room registration package - Option A1: Double room or twin room (one double bed or two single beds) shared with another rider. Price: ".number_format($TwinPackageValue)." &euro; \n"; 
					}
					else{
						$email_message .= "Shared Room registration package - Option A2: Double room shared with another non-cyclist participant. Price: ".number_format($TwinPackageValue)." &euro; \n"; 
					}
					$formCost += $TwinPackageValue;
				}				
		
				$email_message .= "<tr><td><br/>";	
				$email_message .= "<strong>Payment Method</strong>\n\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				if ($PaymentMethod == "paypal"){
					$email_message .= "Paypal <br/>";
				}else{
					$email_message .= "Bank Deposit <br/>National Bank of Greece <br/>IBAN: <strong>".$IBAN."</strong><br/>";
				}
				$email_message .= "Transaction Date: ".$date."<br/>";
				$email_message .= "Registration Code: <strong>".$regCode."</strong><br/>";
				$email_message .= "Total Cost: ".number_format($formCost)." &euro;<br/>";
				$email_message .= "<br/><em>Make sure you attach your Full Name and Registration Code when submitting your payment.</em><br/>";
				$email_message .= "</td></tr>";	
				$email_message .= "</table><br/>";		
				$email_message .= "<p>In order to complete this transaction the user has read and accepted the <a href='http://tourofcrete.com/terms-conditions/' target='_blank'>Terms and Conditions</a>.</p>";	
				$email_message .= "<p>If, for any reason, you deem the above information as inaccurate, please contact us as soon as possible by replying to this e-mail. You will promptly receive a reply form us on any corrections or questions you may have.</p>";	
				$email_message .= "<p>We are gladly at your disposal. <br/>Best regards,</p>";	
				$email_message .= $signature;
				
								
				foreach ($_POST as $key => $value){
					echo "<input type=\"hidden\" name=\"".htmlspecialchars($key).
					 "\" value=\"".htmlspecialchars($value)."\"/>\n";
				}
				
				sendmail($email_message, $incomingcategory['category'], $email, $PaymentMethod, $formCost, $regCode);
			
			}
		
		}
		
		?>
        
      	<div class="step1">
        	  <h1>Registration Details</h1>
        	  
        	  <h2>Provisions</h2>
              <p>Tour of Crete travel service provides for each non-cyclist participant from May 7th 2016 until May 14th 2016:</p>
              <ul><strong>1. What is included per person:</strong>
                <li>7 x nights' accommodation  in various 4 stars hotels including breakfast</li>
                <li>7 x evening dinner (3-course Menu) in the hotel</li>
                <li>Luggage transportation from hotel to hotel</li>
                <li>6 trips, following the cyclists' route</li>
                <li>Digital photo and film (DVD will be sent) </li>         
              </ul>
             <ul><strong>2. What's NOT included:</strong>
             	<li>Alcohol and personal expenses</li>
                <li>Travel insurance</li>
                <li>Flights</li>
             </ul>
			
              <h2>Registration Options <font>(Select a package from below for more info)</font></h2>
			   <p>If your desired package is not available to select below then this has Sold Out. Please contact <a href="mailto:info@tourofcrete.com">info@tourofcrete.com</a>  to be added to the waiting list for this package.</p>
               <div>
                <p>Please Select Package:</p>
                
                <div class="row">
              		<div class="OneCol">
                        <input 	type="radio" name="Package" id="soloPackage" value="soloPackage" <?php if (isset($selectPackage) && $selectPackage=="soloPackage") echo "checked";?> />
                        <label for="soloPackage">Solo Room package</label>
                        <div id="soloPackageDiv" class="infoDiv" style="display:none;">
                    		<p><strong>Solo Room package: 890 &euro; </strong>(until 31/1/2016 - 1070 &euro; until 30/4 - 1190 &euro; until 6/5)
                    			<br/>Hotel room based on single occupancy.
                    		</p>
                        </div>
                	</div>
                </div>
                <div class="row">
                	<div class="OneCol">
                         <input type="radio" name="Package" id="TwinPackage" value="TwinPackage" <?php if (isset($selectPackage) && $selectPackage=="TwinPackage") echo "checked";?> />
                         <label for="TwinPackage">Shared Room package</label>
                        <div id="TwinPackageDiv" class="infoDiv" style="display:none;"> 
                        	<p><strong>Shared Room package (price per person): 740 &euro; </strong>(until 31/1/2016 - 890 &euro; until 30/4 - 990 &euro; until 6/5)<br/>
                                <input type="radio" name="PackageOption" id="TwinPackageB1" value="TwinPackageB1" <?php if (isset($PackageOption) && $PackageOption=="TwinPackageB1") echo "checked";?> />
                                <label for="TwinPackageB1">Option A1: Double room or twin room (one double bed or two single beds) shared with another rider.</label>
                                <input type="radio" name="PackageOption" id="TwinPackageA2" value="TwinPackageA2" <?php if (isset($PackageOption) && $PackageOption=="TwinPackageA2") echo "checked";?> />
                                <label for="TwinPackageA2">Option A2: Double room shared with another non-cyclist participant.</label>
                            </p>
                        </div>
                    </div>
                </div> 
        	  
              <h2>Personal Information</h2>
              <div class="row">
                  <div class="FiveCols">
                    <label for="fullname">Full Name <span class="required">*</span></label>
                    <input type="text" id="fullname" name="fullname" value="<?php if (isset($fullname)) { echo $fullname; } ?>" placeholder="Full Name"  />
                  </div>
                  <div class="FiveCols">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="text" id="email" name="email" value="<?php if (isset($email)) { echo $email; } ?>" placeholder="Email"  />
                  </div>
                  <div class="FiveCols">
                    <label for="emailverify">Repeat Email <span class="required">*</span></label>
                    <input type="text" id="emailverify" name="emailverify" value="<?php if (isset($emailverify)) { echo $emailverify; } ?>" placeholder="Repeat Email"  />
                  </div>
                  <div class="FiveCols">
                    <label for="phone">Contact Number <span class="required">*</span></label>
                    <input type="text" id="phone" name="phone" value="<?php if (isset($phone)) { echo $phone; } ?>" placeholder="Phone"  />				
                  </div>
                  <div class="FiveCols">
                    <label for="gender">Gender <span class="required">*</span></label>
                    <select id="gender" name="gender">
                      <option value="-">Select...</option>
                      <option value="female">Female</option>
                      <option value="male">Male</option>
                    </select>
                  </div>
              </div>
              <div class="row">
                  <div class="FiveCols">
                    <label for="country">Country <span class="required">*</span></label>
                    <select name="country" id="country">
                      	<option value="-">Select...</option>
                        <option value="AT">Austria</option>
                        <option value="BE">Belgium</option>
                        <option value="CY">Cyprus</option>
                        <option value="DK">Denmark</option>
                        <option value="FI">Finland</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                        <option value="GR">Greece</option>
                        <option value="IE">Ireland</option>
                        <option value="IL">Israel</option>
                        <option value="IT">Italy</option>
                        <option value="NL">Netherlands</option>
                        <option value="NO">Norway</option>
                        <option value="SE">Sweden</option>
                        <option value="CH">Switzerland</option>
                        <option value="TR">Turkey</option>
                        <option value="UK">United Kingdom</option>
                        <option value="US">U.S.A.</option>
                        <option value="AF">Afganistan</option>
                        <option value="AL">Albania</option>
                        <option value="DZ">Algeria</option>
                        <option value="AS">American Samoa</option>
                        <option value="AD">Andorra</option>
                        <option value="AO">Angola</option>
                        <option value="AI">Anguilla</option>
                        <option value="AQ">Antarctica</option>
                        <option value="AG">Antigua and Barbuda</option>
                        <option value="AR">Argentina</option>
                        <option value="AM">Armenia</option>
                        <option value="AW">Aruba</option>
                        <option value="AU">Australia</option>
                        <option value="AZ">Azerbaijan</option>
                        <option value="BS">Bahamas</option>
                        <option value="BH">Bahrain</option>
                        <option value="BD">Bangladesh</option>
                        <option value="BB">Barbados</option>
                        <option value="BY">Belarus</option>
                        <option value="BZ">Belize</option>
                        <option value="BJ">Benin</option>
                        <option value="BM">Bermuda</option>
                        <option value="BT">Bhutan</option>
                        <option value="BO">Bolivia</option>
                        <option value="BA">Bosnia and Herzegovina</option>
                        <option value="BW">Botswana</option>
                        <option value="BV">Bouvet Island</option>
                        <option value="BR">Brazil</option>
                        <option value="IO">British Indian Ocean Territory</option>
                        <option value="BN">Brunei Darussalam</option>
                        <option value="BG">Bulgaria</option>
                        <option value="BF">Burkina FASO</option>
                        <option value="BI">Burundi</option>
                        <option value="KH">Cambodia</option>
                        <option value="CM">Cameroon</option>
                        <option value="CA">Canada</option>
                        <option value="CV">Cape Verde</option>
                        <option value="KY">Cayman Islands</option>
                        <option value="CF">Central African Republic</option>
                        <option value="TD">Chad</option>
                        <option value="CL">Chile</option>
                        <option value="CN">China</option>
                        <option value="CX">Christmas Island</option>
                        <option value="CC">Cocos (Keeling) Islands</option>
                        <option value="CO">Colombia</option>
                        <option value="KM">Comoros</option>
                        <option value="CG">Congo</option>
                        <option value="CK">Cook Islands</option>
                        <option value="CR">Costa Rica</option>
                        <option value="CI">Cote d'Ivoire</option>
                        <option value="HR">Croatia</option>
                        <option value="CU">Cuba</option>
                        <option value="CZ">Czech Republic</option>
                        <option value="DJ">Djibouti</option>
                        <option value="DM">Dominican Republic</option>
                        <option value="TP">East Timor</option>
                        <option value="EC">Ecuador</option>
                        <option value="EG">Egypt</option>
                        <option value="SV">El Salvador</option>
                        <option value="GQ">Equatorial Guinea</option>
                        <option value="ER">Eritrea</option>
                        <option value="EE">Estonia</option>
                        <option value="ET">Ethiopia</option>
                        <option value="FK">Falkland Islands</option>
                        <option value="FO">Faroe Islands</option>
                        <option value="FJ">Fiji</option>
                        <option value="GF">French Guiana</option>
                        <option value="PF">French Polynesia</option>
                        <option value="TF">French Southern Territories</option>
                        <option value="MK">F.Y.R.O.M.</option>
                        <option value="GA">Gabon</option>
                        <option value="GM">Gambia</option>
                        <option value="GE">Georgia</option>
                        <option value="GH">Ghana</option>
                        <option value="GI">Gibraltar</option>
                        <option value="GL">Greenland</option>
                        <option value="GD">Grenada</option>
                        <option value="GP">Guadeloupe</option>
                        <option value="GU">Guam</option>
                        <option value="GT">Guatemala</option>
                        <option value="GN">Guinea</option>
                        <option value="GW">Guinea-Bissau</option>
                        <option value="GY">Guyana</option>
                        <option value="HT">Haiti</option>
                        <option value="HM">Heard and Mc Donald Islands</option>
                        <option value="HN">Honduras</option>
                        <option value="HK">Hong Kong</option>
                        <option value="HU">Hungary</option>
                        <option value="IS">Iceland</option>
                        <option value="IN">India</option>
                        <option value="ID">Indonesia</option>
                        <option value="IR">Iran</option>
                        <option value="IQ">Iraq</option>
                        <option value="JM">Jamaica</option>
                        <option value="JP">Japan</option>
                        <option value="JO">Jordan</option>
                        <option value="KZ">Kazakhstan</option>
                        <option value="KE">Kenya</option>
                        <option value="KI">Kiribati</option>
                        <option value="KP">Korea, Republic of</option>
                        <option value="KR">Korea (South)</option>
                        <option value="KW">Kuwait</option>
                        <option value="KG">Kyrgyzstan</option>
                        <option value="LA">Lao</option>
                        <option value="LV">Latvia</option>
                        <option value="LB">Lebanon</option>
                        <option value="LS">Lesotho</option>
                        <option value="LR">Liberia</option>
                        <option value="LI">Liechtenstein</option>
                        <option value="LT">Lithuania</option>
                        <option value="LU">Luxembourg</option>
                        <option value="MO">Macau</option>
                        <option value="MG">Madagascar</option>
                        <option value="MW">Malawi</option>
                        <option value="MY">Malaysia</option>
                        <option value="MV">Maldives</option>
                        <option value="ML">Mali</option>
                        <option value="MT">Malta</option>
                        <option value="MH">Marshall Islands</option>
                        <option value="MQ">Martinique</option>
                        <option value="MR">Mauritania</option>
                        <option value="MU">Mauritius</option>
                        <option value="YT">Mayotte</option>
                        <option value="MX">Mexico</option>
                        <option value="FM">Micronesia</option>
                        <option value="MD">Moldova</option>
                        <option value="MC">Monaco</option>
                        <option value="MN">Mongolia</option>
                        <option value="MS">Montserrat</option>
                        <option value="MA">Morocco</option>
                        <option value="MZ">Mozambique</option>
                        <option value="MM">Myanmar</option>
                        <option value="NA">Namibia</option>
                        <option value="NR">Nauru</option>
                        <option value="NP">Nepal</option>
                        <option value="AN">Netherlands Antilles</option>
                        <option value="NC">New Caledonia</option>
                        <option value="NZ">New Zealand</option>
                        <option value="NI">Nicaragua</option>
                        <option value="NE">Niger</option>
                        <option value="NG">Nigeria</option>
                        <option value="NU">Niue</option>
                        <option value="NF">Norfolk Island</option>
                        <option value="MP">Northern Mariana Islands</option>
                        <option value="OM">Oman</option>
                        <option value="PK">Pakistan</option>
                        <option value="PW">Palau</option>
                        <option value="PA">Panama</option>
                        <option value="PY">Paraguay</option>
                        <option value="PE">Peru</option>
                        <option value="PH">Philippines</option>
                        <option value="PN">Pitcairn</option>
                        <option value="PL">Poland</option>
                        <option value="PT">Portugal</option>
                        <option value="PR">Puerto Rico</option>
                        <option value="QA">Qatar</option>
                        <option value="RE">Reunion</option>
                        <option value="RO">Romania</option>
                        <option value="RU">Russia</option>
                        <option value="RW">Rwanda</option>
                        <option value="KN">Saint Kitts and Nevis</option>
                        <option value="LC">Saint Lucia</option>
                        <option value="WS">Samoa</option>
                        <option value="SM">San Marino</option>
                        <option value="ST">Sao Tome and Principe</option>
                        <option value="SA">Saudi Arabia</option>
                        <option value="SN">Senegal</option>
                        <option value="SC">Seychelles</option>
                        <option value="RS">Serbia</option>
                        <option value="SL">Sierra Leone</option>
                        <option value="SG">Singapore</option>
                        <option value="SK">Slovakia</option>
                        <option value="SI">Slovenia</option>
                        <option value="SB">Solomon Islands</option>
                        <option value="SO">Somalia</option>
                        <option value="ZA">South Africa</option>
                        <option value="ES">Spain</option>
                        <option value="LK">Sri Lanka</option>
                        <option value="SH">St. Helena</option>
                        <option value="PM">St. Pierre And Miquelon</option>
                        <option value="SD">Sudan</option>
                        <option value="SR">Suriname</option>
                        <option value="SJ">Svalbard + J Mayen</option>
                        <option value="S">Swaziland</option>
                        <option value="SY">Syria</option>
                        <option value="TW">Taiwan</option>
                        <option value="TJ">Tajikistan</option>
                        <option value="TZ">Tanzania</option>
                        <option value="TH">Thailand</option>
                        <option value="TG">Togo</option>
                        <option value="TK">Tokelau</option>
                        <option value="TO">Tonga</option>
                        <option value="TT">Trinidad and Tobago</option>
                        <option value="TN">Tunisia</option>
                        <option value="TM">Turkmenistan</option>
                        <option value="TC">Turks and Caicos Islands</option>
                        <option value="TV">Tuvalu</option>
                        <option value="UG">Uganda</option>
                        <option value="UA">Ukraine</option>
                        <option value="AE">United Arab Emirates</option>
                        <option value="UY">Uruguay</option>
                        <option value="UZ">Uzbekistan</option>
                        <option value="VU">Vanuatu</option>
                        <option value="VA">Vatican City State (Holy See)</option>
                        <option value="VE">Venezuela</option>
                        <option value="VN">Vietnam</option>
                        <option value="VG">Virgin Islands (British)</option>
                        <option value="VI">Virgin Islands (U.S.)</option>
                        <option value="WF">Wallis and Futuna Islands</option>
                        <option value="EH">Western Sahara</option>
                        <option value="YE">Yemen</option>
                        <option value="ZY">Zaire</option>
                        <option value="ZM">Zambia</option>
                        <option value="ZW">Zimbabwe</option>
                    </select>
                  </div>
                  <div class="FiveCols">
                    <label for="city">City <span class="required">*</span></label>
                    <input type="text" id="city" name="city" value="<?php if (isset($city)) { echo $city; } ?>" placeholder="City"  />						
                  </div>
                  <div class="FiveCols">
                    <label for="address">Address <span class="required">*</span></label>
                    <input type="text" id="address" name="address" value="<?php if (isset($address)) { echo $address; } ?>" placeholder="Address"  />							
                  </div>
                  <div class="FiveCols">
                    <label for="postcode">Postcode <span class="required">*</span></label>
                    <input type="text" id="postcode" name="postcode" value="<?php if (isset($postcode)) { echo $postcode; } ?>" placeholder="Postcode"  />						
                  </div>
                  
                  <div class="FiveCols">
                    <label for="birthday">Date of Birth (d/m/y) <span class="required">*</span></label>
                    <input type="text" id="birthday" name="birthday" class="hasDatepicker" value="<?php if (isset($birthday)) { echo $birthday; } ?>" placeholder="Birthday"  />					
                  </div>
              </div>
             
              <h2>Additional Required Details</h2>
              <div class="row">
                  <div class="OneCol">
                    <label for="EmergencyName">Emergency contact name <span class="required">*</span></label>
                    <input type="text" id="EmergencyName" name="EmergencyName" value="<?php if (isset($EmergencyName)) { echo $EmergencyName; } ?>" placeholder="Emergency Name"  />					
                  </div>
               </div>
               <div class="row"> 
                  <div class="OneCol">
                    <label for="EmergencyPhone">Emergency contact phone</label>
                    <input type="text" id="EmergencyPhone" name="EmergencyPhone" value="<?php if (isset($EmergencyPhone)) { echo $EmergencyPhone; } ?>" placeholder="Emergency EmergencyPhone" />
                  </div>
                </div>  
                <div class="row">  
                  <div class="OneCol">
                    <label for="tshirtSize">Please state your T-Shirt size <span class="required">*</span></label>
                    <select id="tshirtSize" name="tshirtSize">
                      <option value="-">Select...</option>
                      <option value="small">Small</option>
                      <option value="medium">Medium</option>
                      <option value="large">Large</option>
                      <option value="xlarge">Extra Large</option>
                    </select>
                  </div>
              </div>
              
              <div class="row">
              	<div class="OneCol">
                    <label>Do you have any Dietary Requirements? <span class="required">*</span></label>
                    <input 	type="text" id="DietaryReqTxt" name="DietaryReqTxt" value="<?php if (isset($DietaryReqTxt)) { echo $DietaryReqTxt; } ?>" placeholder="Dietary Requirements" />
              	</div>
              </div>
              
              <div class="row">
              	<div class="OneCol">
                    <label>Do you have any Medical Conditions? <span class="required">*</span></label>
                    <input 	type="text" id="MedicalConditionsTxt" name="MedicalConditionsTxt" value="<?php if (isset($MedicalConditionsTxt)) { echo $MedicalConditionsTxt; } ?>" placeholder="Medical Conditions" />
                </div>
              </div>
              
              <div class="row">
              	<div class="OneCol">
                     <label>Do you know your flight details?</label>
                     <input type="text" id="FlightDetailsTxt" name="FlightDetailsTxt" value="<?php if (isset($FlightDetailsTxt)) { echo $FlightDetailsTxt; } ?>" placeholder="Flight Details" />
              	</div>
              </div>               
              
              <div class="row">
              	<div class="OneCol">
                    <label for="sharedAcco">If opting for shared accommodation, who do you want to room with?</label>
                    <input 	type="text" id="sharedAcco" name="sharedAcco" value="<?php if (isset($sharedAcco)) { echo $sharedAcco; } ?>" placeholder="Shared  Accommodation" />
             	</div>
              </div>
              
              
				
              <h2>Payment Options</h2>
              <div class="row">
			 	 <div class="OneCol">
                    <input type="radio" name="paymentmethod" id="paypal" value="paypal" <?php if (isset($PaymentMethod) && $PaymentMethod=="paypal") echo "checked";?> />
                    <label for="paypal">I am going to pay using Paypal</label>
					<input type="radio" name="paymentmethod" id="deposit" value="deposit" <?php if (isset($PaymentMethod) && $PaymentMethod=="deposit") echo "checked";?> />
                	<label for="deposit">I am going to pay using Bank Deposit</label>
				</div>
             </div>
             <div class="row"> 	
             	<div class="OneCol">					 
                     <p><br/><strong>Safe Online Payments</strong><br/>
                         Your safety is our priority. We chose to use the best online payment solutions. You can now safely pay online for your bookings because:
                         <ul>
                            <li>Using PayPal is Safe and Easy.</li>
                            <li>Your payment is Secure and Confidential.</li>
                            <li>You can pay with your PayPal account, Visa, MasterCard, Maestro, American Express and others.</li>
                            <li>You can pay from anywhere at anytime.</li>
                        </ul>
                     </p>
                 </div>
             </div>
             
             <div class="row"> 
             	<div class="OneCol">
                    <input type="checkbox" name="terms" id="terms" <?php if(isset($_POST['terms'])) echo "checked='checked'"; ?> />
                    <label for="terms">I have read and accept the <a href="/terms-conditions/" target="_blank">Terms and Conditions</a></label>
                </div> 
			 </div>
				   <div class="row">
					 <div class="my_captcha">
					   <?php
					   $args = array(
						 'chars_num'=> '8', // number of characters
						 'tcolor' => 'FF6600', // text color
						 'ncolor' => '999999', // noise color
						 'dots' => 50, // number of dots
						 'lines'=> 40, // number of lines,
						 'width'=>'220', // number of width,
						 'height'=>'70' // number of height
					   );
					   new MyCaptcha( $args );
					   ?>
					 </div>
					</div>			 
             
              <div class="row"> 
                  <div class="OneCol" align="right">
                      <input type="submit" id="submit" name="submit" value="Checkout">
                      <input type="hidden" name="action" value="new_post" />
                  </div>
              </div>
             
             <?php
			 echo $formCost;
			 
			 ?>
          </div>
          		
    </form>	
<?php
	}//END NON CYCLIST FORM

}


function redirect($url){
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';
    echo $string;
}

function sendmail($email_message, $formType, $toEmail, $PaymentMethod, $formCost, $regCode){

	$subject = 'Tour of Crete: Registration for '.$formType;
	$body = $email_message;
	$from ="info@tourofcrete.com"; //From email.
	$to = $toEmail; //To email
	$cc = "info@tourofcrete.com"; //client email to add to cc headers
	
	$headers  = "From: Tour of Crete <".$from. ">\r\n" . "CC: info@tourofcrete.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html\r\n";
	

	mail($to, $subject, $body, $headers);
	
	session_start();
	$_SESSION['formCost'] = $formCost;
	$_SESSION['transNum'] = $regCode;

	if ($PaymentMethod == "paypal"){
		redirect('http://tourofcrete.com/registration/payment-method-paypal-gateway/');
	}else {
		redirect('http://tourofcrete.com/registration/payment-method-bank-deposit/');
	}

}

?>
