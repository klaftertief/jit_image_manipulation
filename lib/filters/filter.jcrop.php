<?php
	
	require_once(realpath(dirname(__FILE__).'/../') . '/class.imagefilter.php');
	
	Class FilterJcrop extends ImageFilter{
	
		public static function run($res, $width, $height, $dst_x, $dst_y, $background_fill='fff'){
			$dst_w = Image::width($res);
			$dst_h = Image::height($res);

			if(!empty($width) && !empty($height)) {
				$dst_w = $width;
				$dst_h = $height;
			} 

			elseif(empty($height)) {
				$ratio = ($dst_h / $dst_w);
				$dst_w = $width;
				$dst_h = round($dst_w * $ratio);

			} 

			elseif(empty($width)) {
				$ratio = ($dst_w / $dst_h);
				$dst_h = $height;
				$dst_w = round($dst_h * $ratio);
			}

			$tmp = imagecreatetruecolor($dst_w, $dst_h);

			imagecopyresampled($tmp, $res, $src_x, $src_y, $dst_x, $dst_y, Image::width($res), Image::height($res), Image::width($res), Image::height($res));
			
			@imagedestroy($res);
			
			return $tmp;
		}
	}