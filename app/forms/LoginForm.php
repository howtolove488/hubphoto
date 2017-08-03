<?php

namespace App\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class LoginForm extends Form {
	public function getCsrf() {
		return $this->security->getToken();
	}
	public function initialize() {
		$secret = new Password('key', array('class' => 'form-control', 'placeholder' => 'Secret key...', 'autofocus' => ''));
		$secret->setLabel('');
		$secret->addValidators(array(
			new PresenceOf(array(
				'message' => 'Secret key is required !'
			)),
			new StringLength(array(
				'min' => 6,
				'max' => 24,
				'messageMinimum' => 'Secret min 6 char !',
				'messageMaximum' => 'Secret max 24 char !'
			))
		));
		$secret->setFilters(array(
			'string',
			'striptags'
		));

		$this->add($secret);

		$this->add(new Hidden('csrf'));
	}
}