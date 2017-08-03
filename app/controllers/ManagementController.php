<?php

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Articles;

class ManagementController extends Controller {
	public function initialize() {
		
	}
	public function indexAction() {
		$re = Articles::find();
		foreach($re as $r) {
			var_dump($r->title);
		}
		$this->view->disable();
	}
	public function timelineAction() {
		
	}
}