<?php

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class Gallery extends Model {

	public $id;

	public $uri;

	public $tag;

	public function initialize() {
		$this->setSource('gallery');
	}

	public function validation() {
		$validator = new Validation();

		$validator->add(
			'uri',
			new PresenceOf(array(
				'message' => 'Slug is required !'
			))
		);

		$validator->add(
			'tag',
			new PresenceOf(array(
				'message' => 'Tag is required !'
			))
		);

		return $this->validate($validator);
	}
}