<?php

namespace App\Controllers;

use App\Controllers\ControllerBase;
use App\Models\Articles;

class CategoriesController extends ControllerBase {
	public function initialize() {
        parent::initialize();
        $this->assets->addCss('css/reset.css');
        $this->assets->addCss('css/main.css');
        $this->assets->addCss('css/font-awesome.min.css');
        $this->assets->addJs('js/jquery.js');
        $this->assets->addJs('js/main.js');
        $this->view->setTemplateAfter('common');
	}
	public function indexAction() {
		$this->tag->setTitle('Đồ uống');
		$articles = Articles::find(array(
			'conditions' => 'category = :cate:',
			'bind' => array(
				'cate' => 'do-uong'
			),
            'columns' => 'id, title, tag, intro, slug',
            'order' => 'updated_at DESC'
        ));
        $this->view->articles = $articles;
	}
	public function snacksAction() {
		$this->tag->setTitle('Món ăn vặt');
		$articles = Articles::find(array(
			'conditions' => 'category = :cate:',
			'bind' => array(
				'cate' => 'mon-an-vat'
			),
            'columns' => 'id, title, tag, intro, slug',
            'order' => 'updated_at DESC'
        ));
        $this->view->articles = $articles;
	}
	public function familiarAction() {
		$this->tag->setTitle('Món ăn dành cho gia đình');
		$articles = Articles::find(array(
			'conditions' => 'category = :cate:',
			'bind' => array(
				'cate' => 'mon-an-gia-dinh'
			),
            'columns' => 'id, title, tag, intro, slug',
            'order' => 'updated_at DESC'
        ));
        $this->view->articles = $articles;
	}
	public function seasonfoodAction() {
		$this->tag->setTitle('Món ăn theo mùa');
		$articles = Articles::find(array(
			'conditions' => 'category = :cate:',
			'bind' => array(
				'cate' => 'mon-an-theo-mua'
			),
            'columns' => 'id, title, tag, intro, slug',
            'order' => 'updated_at DESC'
        ));
        $this->view->articles = $articles;
	}
	public function regionfoodAction() {
		$this->tag->setTitle('Đặc sản vùng miền');
		$articles = Articles::find(array(
			'conditions' => 'category = :cate:',
			'bind' => array(
				'cate' => 'dac-san-vung-mien'
			),
            'columns' => 'id, title, tag, intro, slug',
            'order' => 'updated_at DESC'
        ));
        $this->view->articles = $articles;
	}
	public function streetfoodAction() {
		$this->tag->setTitle('Streetfood');
		$articles = Articles::find(array(
			'conditions' => 'category = :cate:',
			'bind' => array(
				'cate' => 'streetfood'
			),
            'columns' => 'id, title, tag, intro, slug',
            'order' => 'updated_at DESC'
        ));
        $this->view->articles = $articles;
	}
}