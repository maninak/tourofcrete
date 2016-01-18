<?php

class MyCaptcha {
  
  protected $code = '';
  protected $letters = '23456789bcdfghjkmnpqrstvwxyz';
  protected $chars_num;
  protected $tcolor;
  protected $ncolor;
  protected $width;
  protected $height;

  /**
   * Allow to configure some options, generate a random code and print the fields
   */
  function __construct( $args = array() ) {
	$defaults = array(
	  'chars_num' => 6,
	  'dots' => 0,
	  'lines' => 20,
	  'width' => 110,
	  'height' => 35,
	  'tcolor' => 'B9B098',
	  'ncolor' => 'CEC7BA'
	);
	$args = wp_parse_args( $args, $defaults );
	foreach ( $args as $k => $v ) {
		$this->$k = $v;
	}
	$this->setCode();
	$this->fields();
  }

  /**
   * Print the fields
   */
  protected function fields() {
	echo $this->getHidden();
	echo $this->getImg();
	echo $this->getText();
  }

  /**
   * Generate a random code
   */    
  protected function setCode() {
	$i = 0;
	$len = strlen( $this->letters ) - 1;
	while ( $i < $this->chars_num ) { 
	  $this->code .= substr( $this->letters, mt_rand( 0, $len ), 1 );
	  $i++;
	}
  }

  /**
   * Print hidden field
   */ 
  protected function getHidden() {
	return wp_nonce_field( $this->code , md5(__CLASS__) . '_n', FALSE, FALSE );
  }

  /**
   * Print text field
   */     
  protected function getText() {
	$f = '<label>%s<input type="text" name="%s" value="" autocomplete="off" /></label>';
	return sprintf( $f, __('<br/>Please type in the field below the characters you see in the image above:<br/>', 'your-textdomain'),  md5(__CLASS__) );
  }

  /**
   * Print captcha image
   */      
  protected function getImg() {
	$f = '<img src="%s" width="%d" height="%d" alt="" />';
	$data = array(
	  'c' => self::encode( $this->code ),
	  'size' => "{$this->width}x{$this->height}",
	  'dots' => "{$this->dots}",
	  'lines' => "{$this->lines}",
	  'tcolor' => "{$this->tcolor}",
	  'ncolor' => "{$this->ncolor}"
	);
	$url = add_query_arg( $data, get_template_directory_uri() . '/captcha_img.php' );
	return sprintf( $f, $url, $this->width, $this->height );
  }

  /**
   * Verify the nonce
   */      
  static function verify() {
	$method = filter_input( INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING );
	$type = strtoupper( $method ) === 'GET' ? INPUT_GET : INPUT_POST;
	$nonce = filter_input( $type, md5(__CLASS__) . '_n', FILTER_SANITIZE_STRING );
	$code = filter_input( $type, md5(__CLASS__), FILTER_SANITIZE_STRING );
	return ! empty($code) &&  ! empty($nonce) && wp_create_nonce( $code ) === $nonce;
  }

  /**
   * Convert an hexadecimal color to an rgb array color
   */      
  static function hexrgb( $hex ) {
	$int = hexdec( $hex );
	return array(
	  "red" => 0xFF & ($int >> 0x10),
	  "green" => 0xFF & ($int >> 0x8),
	  "blue" => 0xFF & $int
	);
  }
  
  /**
   * encode the code to avoid put plan code in image url
   */
  private static function encode( $code ) {
    $iv_size = mcrypt_get_iv_size( MCRYPT_BLOWFISH , MCRYPT_MODE_ECB );
    $iv = mcrypt_create_iv( $iv_size, MCRYPT_RAND );
    $key = md5( __CLASS__ );
    $enc = mcrypt_encrypt( MCRYPT_BLOWFISH , $key, $code, MCRYPT_MODE_ECB, $iv);
    return urlencode( base64_encode( $enc ) );
  }

  /**
   * Decode the code
   */
  static function decode( $encoded ) {
    $code = urldecode( base64_decode( $encoded ) );
    $iv_size = mcrypt_get_iv_size( MCRYPT_BLOWFISH , MCRYPT_MODE_ECB );
    $iv = mcrypt_create_iv( $iv_size, MCRYPT_RAND );
    $key = md5( __CLASS__ );
    return mcrypt_decrypt( MCRYPT_BLOWFISH , $key, $code, MCRYPT_MODE_ECB, $iv );
  }

}
?>
