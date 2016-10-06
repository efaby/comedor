<?php
require_once (PATH_HELPERS. "/code/Barcode.php");

class Code{
	
	private $font;
	private $type = 'code11';
	private $heightSize = 200;
	private $widthSize = 300;
	private $fontSize = 10;   // GD1 in px ; GD2 in point
	private $marge    = 10;   // between barcode and hri in pixel
	private $x        = 150;  // barcode center
	private $y        = 100;  // barcode center
	private $height   = 100;   // barcode height in 1D ; module size in 2D
	private $width    = 2;    // barcode height in 1D ; not use in 2D
	private $angle    = 0;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
	private $code;

	
	public function generarCodigo($code){
		$this->font = PATH_HELPERS."/code/NOTTB___.TTF";
		$im     = imagecreatetruecolor($this->widthSize,$this->heightSize);
		$black  = ImageColorAllocate($im,0x00,0x00,0x00);
		$white  = ImageColorAllocate($im,0xff,0xff,0xff);
		$red    = ImageColorAllocate($im,0xff,0x00,0x00);
		$blue   = ImageColorAllocate($im,0x00,0x00,0xff);
		imagefilledrectangle($im, 0, 0,  $this->widthSize, $this->heightSize, $white);
		$data = Barcode::gd($im, $black, $this->x, $this->y, $this->angle, $this->type, array('code'=>$code), $this->width, $this->height);		
		$box = imagettfbbox($this->fontSize, 0, $this->font, $data['hri']);
		$len = $box[2] - $box[0];
		Barcode::rotate(-$len / 2, ($data['height'] / 2) + $this->fontSize + $this->marge, $this->angle, $xt, $yt);
		imagettftext($im, $this->fontSize, $this->angle, $this->x + $xt, $this->y + $yt, $black, $this->font, $data['hri']);
		header('Content-type: image/gif');
		imagegif($im);
		imagedestroy($im);
	}
	
}

?>