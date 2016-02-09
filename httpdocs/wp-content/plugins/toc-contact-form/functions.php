<?php
/*
Plugin Name: Tour of Crete Contact Form -Functions 
Plugin URI: http://tourofcrete.com
Description: Contact Form for Tour of Crete
Author: Octobers
Version: 1.0
Author URI: http://octobers.eu
*/


function display_toc_contact_form(){
require_once(get_template_directory()."/mycaptcha.php");
?>  
	<div class="contactBox">
		<div class="leftCol">
			<h2><font>Please don't hesitate to contact us if you have any questions,</br>comments or messages. We will try to respond to everything.</font></h2>
				<form class="contactform" method="post" action="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
		<?php 

	//date_default_timezone_set('Europe/Athens');
	//$date = date('d/m/Y h:i:s a', time());

	if(isset($_POST['submit'])){

		$contact_name = $_POST['contact_name'];
		$contact_email = $_POST['contact_email'];
		$contact_subject = $_POST['contact_subject'];
		$contact_message = $_POST['contact_message'];
		$is_captcha_correct = MyCaptcha::verify();
		
	
		if ( empty( $contact_name ) ) {
			$formErrors .= "<li>Required form field -Name- is missing</li>";
		}
		
		if ((!empty( $contact_email )) && (!filter_var($contact_email, FILTER_VALIDATE_EMAIL))) {
			$formErrors .= "<li>The email you entered is not correct</li>";
		}
		if ( empty( $contact_email ) ) {
			$formErrors .= "<li>Required form field -Email- is missing</li>";
		}		
		
		if ( empty( $contact_subject ) ) {
			$formErrors .= "<li>Required form field -Subject- is missing</li>";
		}	
	
		if ( empty( $contact_message ) ) {
			$formErrors .= "<li>Required form field -Message- is missing</li>";
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
		
				$email_message = "<p>Dear <strong><font color='#ff6600'>".$contact_name."</font></strong>,</p>";	
				$email_message .= "<p><strong>Thank you for contacting the Tour of Crete support team.</strong></p>";	
				$email_message .= "<p>One of our members has been notified of your inquiry and will be in touch with you as soon as possible.<br/>Until then, have a good day and why not have a quick ride!</p>";
				$email_message .= "<br/>Best regards,</p>";	
				$email_message .= "<br><p><table border='0'><tr><td> <img src='http://tourofcrete.com/wp-content/uploads/2015/10/cropped-ToC_logo-150x150.png' alt='The Tour of Crete logo' style='width:5rem;height:5rem; padding-right:1rem;'></td><td> <strong><font face='crillee It BT, impact, Segoe UI, courier new' color='#ff6600'>The Tour of Crete Team</font></strong><br/> <font face='open sans light, open sans,helvetica,News Gothic MT,sans-serif,arial'> Visit our <a href='http://tourofcrete.com/' target='_blank'>Official Website</a><br/> Like our <a href='https://www.facebook.com/thetourofcrete' target='_blank'>Facebook page</a> </font></td></tr></table></p><br>";
				$email_message .= "<p><br/><br/>------------ Below follows a copy of the message we received from you ------------</p>";
				$email_message .= "<table>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Name: ".$contact_name."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Email: ".$contact_email."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Subject: ".$contact_subject."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "<tr><td>";	
				$email_message .= "Message: ".$contact_message."\n";
				$email_message .= "</td></tr>";	
				$email_message .= "</table><br/>";		
				
				sendmail_contact_form($email_message, $contact_email, $contact_subject);
				
			}
		
		}
	
		
		?>

              <div class="row">
                  <div class="OneCol">
                    <label for="contact_name">Name <span class="required">*</span></label>
                    <input type="text" id="contact_name" name="contact_name" value="<?php if (isset($contact_name)) { echo $contact_name; } ?>" placeholder="Name"  />
                  </div>
                  <div class="OneCol">
                    <label for="contact_email">Email <span class="required">*</span></label>
                    <input type="text" id="contact_email" name="contact_email" value="<?php if (isset($contact_email)) { echo $contact_email; } ?>" placeholder="Email"  />
                  </div>
                  <div class="OneCol">
                    <label for="contact_subject">Subject <span class="required">*</span></label>
                    <input type="text" id="contact_subject" name="contact_subject" value="<?php if (isset($contact_subject)) { echo $contact_subject; } ?>" placeholder="Subject"  />
                  </div>
                  <div class="OneCol">
                    <label for="contact_message">Message <span class="required">*</span></label>
                    <textarea rows="4" cols="50" id="contact_message" name="contact_message" value="<?php if (isset($contact_message))?>" placeholder="Message"><?php { echo $contact_message; } ?></textarea>				
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
                      <input type="submit" id="submit" name="submit" value="Submit" style="margin-right:175px;">
					  <input type="hidden" name="action" value="new_post" />
                  </div>
              </div>				  
              </div>
		</form>	
	</div>
	<div class="rightCol">
        <div class="info">
            <h2>Contact Information</h2>
            <table border="0" width="100%" cellpadding="0" cellspacing="0">		
			<tr>
				<td colspan="2">
						<a href="http://www.cretansportscycling.gr/" target="_blank" alt="Adventure Guided Tours">
						   <img src="<?=get_bloginfo('stylesheet_directory'); ?>/images/a-g-t.jpg" title="Adventure Guided Tours" border="0" />
						</a>
				</td>
			</tr>
                <tr>
                    <td colspan="2">MORNOU 22, Zip Code: 71409, HERAKLION, CRETE</td>
                </tr>		
                <tr>
                    <td><strong>Telephone: </strong></td>
                    <td>+30 2810360768</td>
                </tr>
                <tr>
                    <td><strong>Fax: </strong></td>
                    <td>+30 2810361123</td>
                </tr>				
                <tr>
                    <td><strong>Email: </strong></td>
                    <td><a href="mailto:info@tourofcrete.com" title="Contact Us">info@tourofcrete.com</a></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Contact Persons</strong></td>
                </tr>	
               <tr>
                    <td colspan="2">Vagionaki Eva</td>
                </tr>	
                <tr>
                    <td><strong>Telephone: </strong></td>
                    <td>+30 6945219843</td>
                </tr>				
            </table>
        </div>
    </div>
</div>
<?php
	}//END CONTACT FORM
	

function redirect_contact_form($url){
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';
    echo $string;
}

function sendmail_contact_form($email_message, $toEmail, $subject){

	$subject = 'Tour of Crete: Contact form - Subject: '.$subject;
	$body = $email_message;
	$from ="info@tourofcrete.com"; //From email.
	$to = $toEmail; //To email
	$cc = "info@tourofcrete.com"; //client email to add to cc headers

	$headers  = "From: Tour of Crete <".$from. ">\r\n" . "CC: info@tourofcrete.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html\r\n";

$emailsent = mail($to, $subject, $body, $headers);

	if ($emailsent == true){
	
		redirect_contact_form('http://tourofcrete.com/contact-form-confirmation/');
	}
	else 
	{	
		redirect_contact_form('http://tourofcrete.com/contact-form/');
		}

}

?>
