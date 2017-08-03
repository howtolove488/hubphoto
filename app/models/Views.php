<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class Views extends Model {
	public $id;

	public $article_id;

	public $total;

	public function initialize() {
		$this->setSource('views');
		$this->hasOne(
			'article_id',
			'App\\Models\\Articles',
			'id'
		);
	}
	public function validation() {
		
	}
}