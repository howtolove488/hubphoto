<?php

namespace App\Libs;

class checkfile {
	public static function image($type, $extends) {
		$allowedTypes = array(
            'image/gif',
            'image/jpg',
            'image/png',
            'image/bmp',
            'image/jpeg',
            'image/svg+xml'
        );

        $allowedExt = array("gif", "jpeg", "jpg", "png", "blob");

        if(in_array($type, $allowedTypes) || in_array($extends, $allowedExt)) {
        	return true;
        }
        return false;
	}
}