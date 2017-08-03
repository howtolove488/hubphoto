<?php
namespace App\Controllers;

use App\Controllers\ControllerBase;
use App\Models\Articles;

class IndexController extends ControllerBase {
    public function initialize() {
        $this->tag->setTitle('Món ăn ngon cho bạn bè và gia đình');
        parent::initialize();
        $this->assets->addCss('css/reset.css');
        $this->assets->addCss('css/main.css');
        $this->assets->addCss('css/font-awesome.min.css');
        $this->assets->addJs('js/jquery.js');
        $this->assets->addJs('js/main.js');
        $this->view->setTemplateAfter('common');
    }
    public function indexAction() {
        $articles = Articles::find(array(
            'columns' => 'id, title, tag, intro, slug',
            'order' => 'updated_at DESC'
        ));
        $this->view->articles = $articles;
    }
}
