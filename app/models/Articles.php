<?php

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\InclusionIn;

class Articles extends Model {

	public $id;

	public $title;

	public $slug;

	public $intro;

	public $description;

	public $tag;

	public $category;

	public $content;

	public $updated_at;

	public function initialize() {
		$this->setSource('articles');
		$this->belongsTo(
			'id',
			'App\\Models\\Views',
			'article_id'
		);
	}

	public function validation() {
		$validator = new Validation();

		$validator->add(
			"title",
			new Uniqueness(array(
				"message" => "The title must be unique !"
			))
		);

		$validator->add(
			"title",
			new StringLength(array(
				"min" => "8",
				"max" => "150",
				"messageMinimum" => "Title min 8 char",
				"messageMaximum" => "Title max 150 char"
			))
		);

		$validator->add(
			"title",
			new PresenceOf(array(
				"message" => "Title 's required"
			))
		);

		$validator->add(
			"slug",
			new StringLength(array(
				"min" => "8",
				"max" => "200",
				"messageMinimum" => "Slug min 8 char",
				"messageMaximum" => "Slug max 200 char"
			))
		);

		$validator->add(
			"slug",
			new PresenceOf(array(
				"message" => "Slug 's required"
			))
		);

		$validator->add(
			"description",
			new StringLength(array(
				"min" => "8",
				"max" => "255",
				"messageMinimum" => "Description min 8 char",
				"messageMaximum" => "Description max 255 char"
			))
		);

		$validator->add(
			"tag",
			new PresenceOf(array(
				"message" => "Tag 's required !"
			))
		);

		$validator->add(
			"tag",
			new StringLength(array(
				"min" => "4",
				"max" => "40",
				"messageMinimum" => "tag min 4 char",
				"messageMaximum" => "Tag max 40 char"
			))
		);

		$validator->add(
			"content", 
			new PresenceOf(array(
				"message" => "Content 's required !"
			))
		);

		$validator->add(
			"category",
			new InclusionIn(array(
				"message" => "Category name invalid !",
				"domain" => array(
					"do-uong",
					"mon-an-vat",
					"mon-an-gia-dinh",
					"mon-an-theo-mua",
					"dac-san-vung-mien",
					"streetfood"
				)
			)
		));

		return $this->validate($validator);
	}

}