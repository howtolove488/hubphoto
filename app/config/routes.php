<?php

use Phalcon\Mvc\Router;

$router = new Router();
$router->removeExtraSlashes(true);

/**
 *  Home;
 */
$router->add('/', array(
    'controller' => 'index',
    'action'  =>  'index'
))->setName('home');

$router->add('/test/base', array(
    'controller' => 'test',
    'action' => 'index'
));
/**
 *  get an article with absolute uri;
 */
$router->addGet('/{article_uri:[0-9A-Za-z\-]+}', array(
    'controller'  =>  'article',
    'action'  =>  'index'
));
/**
 *  Router cate
 */
$router->add('/do-uong', array(
    'controller' => 'categories',
    'action' => 'index'
));
$router->add('/mon-an-vat', array(
    'controller' => 'categories',
    'action' => 'snacks'
));
$router->add('/mon-an-gia-dinh', array(
    'controller' => 'categories',
    'action' => 'familiar'
));
$router->add('/mon-an-theo-mua', array(
    'controller' => 'categories',
    'action' => 'seasonfood'
));
$router->add('/dac-san-vung-mien', array(
    'controller' => 'categories',
    'action' => 'regionfood'
));
$router->add('/streetfood', array(
    'controller' => 'categories',
    'action' => 'streetfood'
));
/**
 *  Uri manager(list, add, edit)
 */
$router->add('/management', array(
    'controller'  =>  'admin',
    'action'   => 'index'
));
$router->add('/management/create-an-article', array(
    'controller'  =>  'admin',
    'action'   => 'createarticle'
));
$router->add('/management/list-articles/{article_id:[0-9]+}', array(
    'controller'  =>  'admin',
    'action'   => 'editarticle'
));
$router->add('/management/list-articles', array(
    'controller'  =>  'admin',
    'action'   => 'listarticles'
));
$router->add('/management/user-profile', array(
    'controller'  =>  'admin',
    'action'   => 'user'
));
$router->add('/management/gallery', array(
    'controller'  =>  'admin',
    'action'   => 'gallery'
));
/**
 *  Authentication(login)
 */
$router->add('/authentication', array(
  'controller' => 'authenticate',
  'action'  =>  'index'
))->setName('login');
$router->add('/authentication/logout', array(
    'controller' => 'authenticate',
    'action' => 'logout'
));

// Froala upload image.
$router->addPost('/froalaeditorcrudimage/upload', array(
    'controller' => 'froala',
    'action' => 'index'
));
$router->addGet('/froalaeditorcrudimage/loadimage', array(
    'controller' => 'froala',
    'action' => 'loadimg'
));
$router->addPost('/froalaeditorcrudimage/deleteimage', array(
    'controller' => 'froala',
    'action' => 'deleteimg'
));

// Errors Page
$router->add('/errors', array( //E404
    'controller' => 'errors',
    'action' => 'index'
));
$router->add('/errors/405', array( //E405
    'controller' => 'errors',
    'action' => 'e405'
));

return $router;
