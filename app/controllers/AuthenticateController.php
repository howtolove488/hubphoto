<?php
namespace App\Controllers;

use App\Controllers\ControllerBase;
use App\Forms\LoginForm;

class AuthenticateController extends ControllerBase {
	public function initialize() {
		$this->tag->setTitle("Authenticate Your Roler");
        parent::initialize();
        $this->assets->addCss('css/bootstrap.min.css');
        $this->assets->addCss('css/font-awesome.min.css');
        $this->assets->addCss('css/fonts.googleapis.com.css');
        $this->assets->addCss('css/ace.min.css');
        $this->assets->addCss('css/ace-rtl.min.css');
        $this->assets->addJs('js/jquery-2.1.4.min.js');
	}
    public function indexAction() {
        $secret = "21676jokerelse";

        $forms = new LoginForm();
        $this->view->forms = $forms;

        $auth = $this->session->get('authentication');
        if($auth) {
            $this->dispatcher->forward(array(
                'controller' => 'admin',
                'action' => 'index'
            ));
        }

        if($this->request->isPost()) {
            if(!$forms->isValid($_POST)) {
                foreach($forms->getMessages() as $message) {
                    $this->flashSession->warning($message->getMessage());
                }
            }
            else {
                $key = $this->request->getPost('key', 'string');
                if($key === $secret) {
                    $this->session->set('authentication', md5($key));
                    $current_url = $this->router->getRewriteUri();
                    $this->redirectToCurrentUrl($current_url);
                }
                else {
                    $this->flashSession->warning('Authenticate got fail, please try again !');
                }
            }
        }
    }
    
    public function logoutAction() {
        $auth = $this->session->get('authentication');
        if($auth) {
            $this->session->remove('authentication');
            $this->session->destroy();
        }
        $this->response->redirect('/authentication');
    }

    public function redirectToCurrentUrl($current_url) {
        switch ($current_url) {
            case '/management':
                $this->dispatcher->forward(array(
                    'controller' => 'admin',
                    'action' => 'index'
                ));
                break;
            case '/management/create-an-article':
                $this->dispatcher->forward(array(
                    'controller' => 'admin',
                    'action' => 'createarticle'
                ));
                break;
            case '/management/list-articles':
                $this->dispatcher->forward(array(
                    'controller' => 'admin',
                    'action' => 'listarticles'
                ));
                break;
            case '/management/gallery':
                $this->dispatcher->forward(array(
                    'controller' => 'admin',
                    'action' => 'gallery'
                ));
                break;
            default:
                $this->dispatcher->forward(array(
                    'controller' => 'admin',
                    'action' => 'index'
                ));
                break;
        }
    }
}
