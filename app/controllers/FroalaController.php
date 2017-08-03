<?php

namespace App\Controllers;

use App\Controllers\ControllerBase;
use App\Libs\checkfile;
use App\Models\Gallery;

class FroalaController extends ControllerBase {
	public function initialize() {
		$this->view->disable();
	}
	public function indexAction() {
		$allowedExts = array("gif", "jpeg", "jpg", "png", "blob");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);

		// An image check is being done in the editor but it is best to
		// check that again on the server side.
		// Do not use $_FILES["file"]["type"] as it can be easily forged.
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

		if ((($mime == "image/gif") || ($mime == "image/jpeg") || ($mime == "image/pjpeg") || ($mime == "image/x-png") || ($mime == "image/png")) && in_array(strtolower($extension), $allowedExts)) {
		    $name = sha1(microtime()) . "." . $extension;
		    move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/uploaded/" . $name);

		    $gallery = new Gallery();
		    $gallery->uri = $name;
		    $gallery->tag = 'thumbnail';
		    $gallery->save();
		    $response = new \StdClass;
		    $response->link = "/uploaded/" . $name;
		    echo stripslashes(json_encode($response));
		}
	}
	public function loadimgAction () {
	    $response = array();
	    $image_types = array(
	                      "image/gif",
	                      "image/jpeg",
	                      "image/pjpeg",
	                      "image/jpeg",
	                      "image/pjpeg",
	                      "image/png",
	                      "image/x-png"
	                  );
	    $fnames = scandir("uploaded");

	    if ($fnames) {
	        foreach ($fnames as $name) {
	            if (!is_dir($name)) {
	                if (in_array(mime_content_type(getcwd() . "/uploaded/" . $name), $image_types)) {
	                    array_push($response, array("url"=>"/uploaded/" . $name));
	                }
	            }
	        }
	    }
	    else {
	        $response = new \StdClass;
	        $response->error = "Images folder does not exist!";
	    }

	    $response = json_encode($response);
	    echo stripslashes($response);
	}
	public function deleteimgAction() {
		$src = $_POST["src"];
	    if (file_exists(getcwd() . $src)) {
	      unlink(getcwd() . $src);
	    }
	}
}