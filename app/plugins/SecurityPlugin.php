<?php

namespace App\Plugins;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;

class SecurityPlugin extends Plugin {
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher) {
    	$auth = $this->session->get('authentication');
    	if($auth && $auth === md5('21676jokerelse')) {
    		$role = 'Users';
    	}
    	else {
    		$role = 'Guest';
    	}

    	$controllerName = $dispatcher->getControllerName();
    	$actionName = $dispatcher->getActionName();
    	$acl = $this->getAcl();

    	// Check exist resouce
    	if(!$acl->isResource($controllerName)) {
    		$dispatcher->forward(array(
    			'controller' => 'errors',
    			'action' => 'index'
    		));

    		return false;
    	}

    	$allowed = $acl->isAllowed($role, $controllerName, $actionName);
    	if(!$allowed) {
    		$dispatcher->forward(array(
    			'controller' => 'errors',
    			'action' => 'e405'
    		));
    		$this->flashSession->warning('You have not permission to access !');
    		$this->session->destroy();
    		return false;
    	}
    }
    public function getAcl() {
    	if(!$this->persistent->acl) {
    		$acl = new AclList();
    		$acl->setDefaultAction(Acl::DENY);

    		$roles = array(
    			'guest' => new Role('Guest', 'Anyone browsing the site who is not signed in is considered to be a "Guest".'),
    			'users' => new Role('Users', 'Member privileges, granted after sign in.')
    		);

    		foreach($roles as $role) {
    			$acl->addRole($role);
    		}

    		$privateResource = array(
    			'admin'  => array('index', 'createarticle', 'editarticle', 'listarticles', 'user', 'gallery'),
                'froala' => array('index', 'loadimg', 'deleteimg')
    		);

    		$publicResource = array(
    			'article'      => array('index'),
    			'authenticate' => array('index', 'logout'),
    			'index'        => array('index'),
                'errors'       => array('index', 'e405'),
                'categories'   => array('index', 'snacks', 'familiar', 'seasonfood', 'regionfood', 'streetfood')
    		);

    		foreach($privateResource as $resourceName => $actionsName) {
    			$acl->addResource(new Resource($resourceName), $actionsName);
    		}
    		foreach($publicResource as $resourceName => $actionsName) {
    			$acl->addResource(new Resource($resourceName), $actionsName);
    		}

    		foreach($roles as $role) {
    			foreach($publicResource as $resourceName => $actionsName) {
    				foreach($actionsName as $action) {
    					$acl->allow($role->getName(), $resourceName, $action);
    				}
    			}
    		}

    		foreach($privateResource as $resourceName => $actionsName) {
    			foreach($actionsName as $action) {
    				$acl->allow('Users', $resourceName, $action);
    			}
    		}

    		$this->persistent->acl = $acl;
    	}
    	return $this->persistent->acl;
    }
}
