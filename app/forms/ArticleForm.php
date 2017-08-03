<?php

namespace App\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\PresenceOf;

class ArticleForm extends Form {

	public function getCsrf() {
		return $this->security->getToken();
	}
	public function initialize() { 

		$this->add(
			new Hidden("csrf")
		);
		
		$title = new Text("title", array("class" => "form-control", "id" => "management-add-title", "placeholder" => "Article's title..", "autofocus" => ""));
		$title->setLabel("Title");
		$title->addValidators(array(
			new PresenceOf(array(
				"message" => "Title is required !"
			)),
			new StringLength(array(
				"min" => "8",
				"max" => "150",
				"messageMinimum" => "Minimum title's length 8 char !",
				"messageMaximum" => "Max title's length 150 char !"
			))
		));
		$title->setFilters(array(
			"string",
			"striptags"
		));
		$this->add($title);

		$uri = new Text("slug", array("class" => "form-control", "id" => "management-add-uri", "placeholder" => "Articles uri.."));
		$uri->setLabel("Relative URI");
		$uri->addValidators(array(
			new PresenceOf(array(
				"message" => "Relative URI is required !"
			)),
			new StringLength(array(
				"min" => "8",
				"max" => "200",
				"messageMinimum" => "Minimum uri's length 8 char !",
				"messageMaximum" => "Max title's length 200 char !"
			))
		));
		$uri->setFilters(array(
			"string",
			"striptags",
			"lower"
		));
		$this->add($uri);

		$description = new TextArea("description", array("class" => "form-control limited", "id" => "management-add-description", "rows" => "5", "maxlength" => "255"));
		$description->setLabel("Description");
		$description->addValidators(array(
			new StringLength(array(
				"max" => "255",
				"messageMaximum" => "Max description's length 255 char !"
			))
		));
		$description->setFilters(array(
			"striptags",
			"string"
		));
		$this->add($description);

		$tag = new Text("tag", array("class" => "", "id" => "management-add-tag"));
		$tag->setLabel("Tag");
		$tag->addValidators(array(
			new PresenceOf(array(
				"message" => "Tag is required !"
			)),
			new StringLength(array(
				"min" => "4",
				"max" => "40",
				"messageMinimum" => "Minimum tag's length 4 char !",
				"messageMaximum" => "Max tag's length 40 char !"
			))
		));
		$tag->setFilters(array(
			"string",
			"striptags"
		));
		$this->add($tag);

		$cate = new Select("category", array(
			"do-uong"              => "Đồ uống",
			"mon-an-vat"           => "Món ăn vặt",
			"mon-an-gia-dinh"      => "Món ăn gia đình",
			"mon-an-theo-mua"      => "Món ăn theo mùa",
			"dac-san-vung-mien"    => "Đặc sản vùng miền",
			"streetfood"           => "Streetfood",
		));
		$cate->setLabel("Category");
		$this->add($cate);
	}

}