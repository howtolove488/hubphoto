<?php
namespace App\Controllers;

use App\Controllers\ControllerBase;
use App\Models\Articles;
use Phalcon\Filter;

class ArticleController extends ControllerBase {
    public function initialize() {
        $this->tag->setTitle("Articles name here");
        parent::initialize();
        $this->assets->addCss('css/reset.css');
        $this->assets->addCss('css/main.css');
        $this->assets->addCss('css/font-awesome.min.css');
        $this->assets->addJs('js/jquery.js');
        $this->assets->addJs('js/main.js');
        $this->view->setTemplateAfter('common');
    }
    public function indexAction() {
        // get id and slug from url
        $filter = new Filter();
        $url = $this->dispatcher->getParam('article_uri');
        $sanz_url = $filter->sanitize($url, 'string');
        $exp_url = explode('-', $sanz_url);
        $article_id = $filter->sanitize(end($exp_url), 'int');
        $article_slug = $filter->sanitize(implode(array_slice($exp_url, 0, count($exp_url)-1), '-'), 'string');

        // select article by info was finded
        $article = Articles::findFirst(array(
            'conditions' => 'id = :aid: AND slug = :aslug:',
            'bind' => array(
                "aid" => $article_id,
                "aslug" => $article_slug
            ),
            'columns' => 'title, description, intro, content, tag, category'
        ));

        // Get relate previous, next post.
        $pre_relateds = Articles::find(array(
            'conditions' => 'id < :aid: AND category = :acate:',
            'bind' => array(
                'aid' => $article_id,
                'acate' => $article->category
            ),
            'columns' => 'id, slug',
            'limit' => 1
        ));
        $next_relateds = Articles::find(array(
            'conditions' => 'id > :aid: AND category = :acate:',
            'bind' => array(
                'aid' => $article_id,
                'acate' => $article->category,
            ),
            'columns' => 'id, slug',
            'limit' => 1
        ));

        // Send variable to view
        $this->view->article = $article;
        if(count($pre_relateds) > 0) {
            foreach($pre_relateds as $pre_related) {
                $this->view->pre_related = $pre_related;    
            }
        }
        if(count($next_relateds) > 0) {
            foreach($next_relateds as $next_related) {
                $this->view->next_related = $next_related;    
            }
        }
    }
}
