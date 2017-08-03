<?php
namespace App\Controllers;

use App\Controllers\ControllerBase;
use App\Forms\ArticleForm;
use App\Libs\checkfile;
use App\Libs\random;
use App\Models\Articles;
use App\Models\Gallery;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;
use Phalcon\Filter;

class AdminController extends ControllerBase {
    public function initialize() {
        parent::initialize();
        $this->assets->addCss('css/bootstrap.min.css');
        $this->assets->addCss('css/font-awesome.min.css');
        $this->assets->addCss('css/fonts.googleapis.com.css');
        $this->assets->addCss('css/ace.min.css');
        $this->assets->addCss('css/ace-skins.min.css');
        $this->assets->addCss('css/ace-rtl.min.css');
        $this->assets->addCss('css/ace-extra.min.css');
        $this->assets->addJs('js/jquery.js');
        $this->assets->addJs('js/bootstrap.min.js');
        $this->assets->addJs('js/ace-elements.min.js');
        $this->assets->addJs('js/ace.min.js');
    }
    public function indexAction() {
        $this->tag->setTitle("Management Pages");
        $this->assets->addJs('js/jquery-ui.custom.min.js');
        $this->assets->addJs('js/jquery.ui.touch-punch.min.js');
        $this->assets->addJs('js/jquery.easypiechart.min.js');
        $this->assets->addJs('js/jquery.sparkline.index.min.js');
        $this->assets->addJs('js/jquery.flot.min.js');
        $this->assets->addJs('js/jquery.flot.pie.min.js');
        $this->assets->addJs('js/jquery.flot.resize.min.js');
        $link_group = array("name" => "Dashboard", "link" => "/management");
        $this->view->link_group = $link_group;

        $recent_work = Articles::find(array(
            'columns' => 'id, title, updated_at, category',
            'order' => 'updated_at DESC',
            'limit' => '5'
        ));
        $count_record = Articles::count();
        $count_cate_du = Articles::count(array(
            'conditions' => 'category = :cate:',
            'bind' => array(
                'cate' => 'do-uong'
            )
        ));
        $count_cate_mav = Articles::count(array(
            'conditions' => 'category = :cate:',
            'bind' => array(
                'cate' => 'mon-an-vat'
            )
        ));
        $count_cate_magd = Articles::count(array(
            'conditions' => 'category = :cate:',
            'bind' => array(
                'cate' => 'mon-an-gia-dinh'
            )
        ));
        $count_cate_matm = Articles::count(array(
            'conditions' => 'category = :cate:',
            'bind' => array(
                'cate' => 'mon-an-theo-mua'
            )
        ));
        $count_cate_dsvm = Articles::count(array(
            'conditions' => 'category = :cate:',
            'bind' => array(
                'cate' => 'dac-san-vung-mien'
            )
        ));
        $count_cate_sf = Articles::count(array(
            'conditions' => 'category = :cate:',
            'bind' => array(
                'cate' => 'streetfood'
            )
        ));

        $phql_select_popular_post = "
            SELECT a.title, v.total, a.tag 
            FROM App\\Models\\Articles a 
            INNER JOIN App\\Models\\Views v 
            ORDER BY a.updated_at DESC 
            LIMIT 5 
        ";
        $popular_post = $this->modelsManager->executeQuery($phql_select_popular_post);

        $this->view->recent_work     = $recent_work;
        $this->view->count_record    = $count_record;
        $this->view->count_cate_du   = $count_cate_du;
        $this->view->count_cate_mav  = $count_cate_mav;
        $this->view->count_cate_magd = $count_cate_magd;
        $this->view->count_cate_matm = $count_cate_matm;
        $this->view->count_cate_dsvm = $count_cate_dsvm;
        $this->view->count_cate_sf   = $count_cate_sf;
        $this->view->popular_post    = $popular_post;
    }
    public function createarticleAction() {
        $this->tag->setTitle("Create an article..");
        $this->assets->addJs('js/jquery-ui.custom.min.js');
        $this->assets->addJs('js/jquery.ui.touch-punch.min.js');
        $this->assets->addJs('js/markdown.min.js');
        $this->assets->addJs('js/bootstrap-markdown.min.js');
        $this->assets->addJs('js/jquery.hotkeys.index.min.js');
        $this->assets->addJs('js/bootstrap-wysiwyg.min.js');
        $this->assets->addJs('js/bootbox.js');
        $this->assets->addJs('js/slug.js');
        $this->assets->addCss('froala/css/froala_editor.pkgd.min.css');
        $this->assets->addJs('froala/js/froala_editor.pkgd.min.js');
        $link_group = array("name" => "Create an article", "link" => "/management/create-an-article");
        $this->view->link_group = $link_group;
        $forms = new ArticleForm;
        $counte = 0; // This var help us hook errors to send to view.

        if($this->request->isPost()) {
            if(!$forms->isValid($_POST)) {
                $messages = $forms->getMessages();
                foreach($messages as $message) {
                    $this->flashSession->warning($message);
                    $counte += 1;
                }
            }
            else {
                $title       = $this->request->getPost('title', array('string','striptags'));
                $slug        = $this->request->getPost('slug', array('string', 'lower'));
                $description = $this->request->getPost('description', 'string');
                $tag         = $this->request->getPost('tag', array('string','striptags'));
                $cate        = $this->request->getPost('category', array('string', 'striptags'));
                $content     = $this->request->getPost('content');
                $updated     = time();
                $file_upload = null;
                if($this->request->hasFiles() == true) {
                    foreach ($this->request->getUploadedFiles() as $file) {
                        $name = $file->getName();
                        $type = $file->getType();
                        $extends = $file->getExtension();
                        if(checkfile::image($type, $extends) == true) {
                            $file_upload = $file;
                            $new_img_name = random::generate($name).'.'.$extends;
                        }
                        else {
                            $new_img_name = null;
                            // switch($cate) {
                            //     case "fastfood" :
                            //         $new_img_name = 'fastfood.png';
                            //         break;
                            //     case "drink" :
                            //         $new_img_name = 'drink.png';
                            //         break;
                            //     case "one" :
                            //         $new_img_name = 'one.png';
                            //         break;
                            //     case "two" :
                            //         $new_img_name = 'two.png';
                            //         break;
                            //     case "three" :
                            //         $new_img_name = 'three.png';
                            //         break;
                            //     default :
                            //         $new_img_name = 'fastfood.png';
                            //         break;
                            // }
                            $this->flashSession->warning('Image\'s type not allowed, we converted it to default image. You can check and fix it in list articles page! This errors won\'t make worse insert data process');
                            $counte += 1;
                        }
                    }
                }

                $articles = new Articles();

                $articles->title       = $title;
                $articles->slug        = $slug;
                $articles->intro       = $new_img_name;
                $articles->description = $description;
                $articles->tag         = $tag;
                $articles->category    = $cate;
                $articles->content     = $content;
                $articles->updated_at  = $updated;

                if($articles->save() == false) {
                    foreach($articles->getMessages() as $message) {
                        $this->flashSession->warning($message->getMessage());
                        $counte += 1;
                    }
                }
                else {
                    if($file_upload != null) {
                        $file_upload->moveTo('uploaded/'.$new_img_name);
                    }

                    // Save to sub table. it will not show errors;
                    $gallery = new Gallery();
                    $gallery->uri = $new_img_name;
                    $gallery->tag = $cate;
                    $gallery->save();
                    $this->flashSession->success('Success ! Create article successfully !');
                    $forms->clear();
                }
            }
        }

        $this->view->forms = $forms;
        $this->view->counte = $counte;
    }
    public function editarticleAction() {
        $this->assets->addJs('js/jquery-ui.custom.min.js');
        $this->assets->addJs('js/jquery.ui.touch-punch.min.js');
        $this->assets->addJs('js/markdown.min.js');
        $this->assets->addJs('js/bootstrap-markdown.min.js');
        $this->assets->addJs('js/jquery.hotkeys.index.min.js');
        $this->assets->addJs('js/bootstrap-wysiwyg.min.js');
        $this->assets->addJs('js/bootbox.js');
        $this->assets->addJs('js/slug.js');
        $this->assets->addCss('froala/css/froala_editor.pkgd.min.css');
        $this->assets->addJs('froala/js/froala_editor.pkgd.min.js');
        $forms = new ArticleForm;
        $counte = 0;

        // Get info article to edit
        $filter = new Filter();
        $aid = $this->dispatcher->getParam('article_id');
        $aid_sanitize = $filter->sanitize($aid, 'int');
        $article = Articles::findFirst(array(
            "conditions" => "id = :aid:",
            "bind" => array(
                "aid" => $aid_sanitize
            )
        ));

        // Set option title and link.
        $link_group = array("name" => "Editting /<b>".$article->title."</b>/", "link" => "/management/list_articles/".$article->id);
        $this->tag->setTitle('Editting '.$article->title);
        $this->view->link_group = $link_group;

        // Event submit
        if($this->request->isPost()) {
            if(!$forms->isValid($_POST)) {
                $messages = $forms->getMessages();
                foreach($messages as $message) {
                    $this->flashSession->warning($message);
                    $counte += 1;
                }
            }
            else {
                $title       = $this->request->getPost('title', array('string','striptags'));
                $slug        = $this->request->getPost('slug', array('string', 'lower'));
                $description = $this->request->getPost('description', 'string');
                $tag         = $this->request->getPost('tag', array('string','striptags'));
                $cate        = $this->request->getPost('category', array('string', 'striptags'));
                $content     = $this->request->getPost('content');
                $updated     = time();
                $file_upload = null;
                if($this->request->hasFiles() == true) {
                    foreach ($this->request->getUploadedFiles() as $file) {
                        $name = $file->getName();
                        $type = $file->getType();
                        $extends = $file->getExtension();
                        if(checkfile::image($type, $extends) == true) {
                            $file_upload = $file;
                            $new_img_name = random::generate($name).'.'.$extends;
                        }
                        else {
                            $new_img_name = null;
                            $this->flashSession->warning('Image\'s type not allowed, we converted it to default image. You can check and fix it in list articles page! This errors won\'t make worse insert data process');
                            $counte += 1;
                        }
                    }
                }

                $article->title       = $title;
                $article->slug        = $slug;
                $article->intro       = $new_img_name;
                $article->description = $description;
                $article->tag         = $tag;
                $article->category    = $cate;
                $article->content     = $content;
                $article->updated_at  = $updated;

                if($article->update() == false) {
                    foreach($article->getMessages() as $message) {
                        $this->flashSession->warning($message->getMessage());
                        $counte += 1;
                    }
                }
                else {
                    if($file_upload != null) {
                        $file_upload->moveTo('uploaded/'.$new_img_name);
                    }

                    $gallery = new Gallery();
                    $gallery->uri = $new_img_name;
                    $gallery->tag = $cate;
                    $gallery->save();
                    $this->dispatcher->forward(array(
                        'action' => 'listarticles'
                    ));
                    $this->flashSession->success('Updated id '.$article->id.'. All change can be check in list.');
                }
            }
        }

        $this->view->article = $article;
        $this->view->forms   = $forms;
        $this->view->counte  = $counte;
    }
    public function listarticlesAction() {
        $this->tag->setTitle("List Articles");
        $this->assets->addJs('js/jquery-ui.custom.min.js');
        $this->assets->addJs('js/jquery.ui.touch-punch.min.js');
        $this->assets->addJs('js/ajax-service.js');

        $link_group = array("name" => "List Articles", "link" => "/management/list-articles");
        $this->view->link_group = $link_group;

        $filter = new Filter();
        // Search article
        $search_result = $this->request->getQuery('search');
        if($search_result != null) {
            $search_result = $filter->sanitize($search_result, 'striptags');
            $list_articles = Articles::find(array(
                "conditions" => "title LIKE :key: or content LIKE :key:",
                "bind" => array(
                    "key" => "%".$search_result."%"
                ),
                "columns" => "id, title, slug, updated_at, description",
                "order" => "updated_at DESC"
            ));
        }
        else {
            // All articles
            $list_articles = Articles::find(array(
                "columns" => "id, title, slug, updated_at, description",
                "order" => "updated_at DESC"
            ));
        }

        // Paginator
        $current_page = $this->request->getQuery('page');
        $sanitize_page = $filter->sanitize($current_page, 'int');

        $panigator = new PaginatorModel(array(
            "data" => $list_articles,
            "limit" => 6,
            "page" => $sanitize_page
        ));
        $page = $panigator->getPaginate();
        $this->view->page = $page;

        // Optional variable.
        $count_result = count($list_articles);
        $this->view->count_result = $count_result;
        $this->view->search_result = $search_result;
    }
    public function userAction() {
        $this->tag->setTitle("Trang quản lý sản phẩm");
        $this->assets->addJs('js/bootstrap.min.js');
        $this->assets->addJs('js/ace-elements.min.js');
        $this->assets->addJs('js/ace.min.js');
        $this->assets->addJs('js/ace-editable.min.js');
        $this->assets->addJs('js/bootstrap-editable.min.js');
    }
    public function galleryAction() {
        $this->tag->setTitle("Gallery");
        $this->assets->addCss('css/colorbox.min.css');
        $this->assets->addJs('js/jquery.colorbox.min.js');
        $link_group = array("name" => "Gallery", "link" => "/management/gallery");
        $this->view->link_group = $link_group;

        $filter = new Filter();
        $current_page = $this->request->getQuery('page');
        $sanitize_page = $filter->sanitize($current_page, 'int');
        $gallery = Gallery::find(array(
            'order' => 'id DESC'
        ));

        $panigator = new PaginatorModel(array(
            'data' => $gallery,
            'limit' => 24,
            'page' => $sanitize_page
        ));
        $page = $panigator->getPaginate();

        $this->view->page = $page;
    }
}
