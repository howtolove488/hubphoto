<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Flash\Direct as Flash;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventManager;
use Phalcon\Security;
use Phalcon\Encrypt;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Setting up the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setDI($this);
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines(array(
        '.volt' => function ($view) {
            $config = $this->getConfig();

            $volt = new VoltEngine($view, $this);

            $volt->setOptions(array(
                'compiledPath' => $config->application->cacheDir.'/volt',
                'compiledSeparator' => '_'
            ));

            $compiler = $volt->getCompiler();
            
            $compiler->addFunction('is_a', 'is_a');

            $compiler->addFunction('date', 'date');

            $compiler->addFunction('round', 'round');
            return $volt;
        },
        '.phtml' => PhpEngine::class

    ));

    return $view;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $connection = new $class(array(
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ));

    return $connection;
});


/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash(array(
        'error'   => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice'  => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ));
});
$di->set("flashSession", function () {
    return new FlashSession(array(
      'error'   => 'alert alert-danger',
      'success' => 'alert alert-success',
      'notice'  => 'alert alert-info',
      'warning' => 'alert alert-warning'
    ));
});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Set dispatcher
 */
 $di->set('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $eventmanager = new EventManager();
    // Add event to dispatch what will authentication user before excute route
    $eventmanager->attach(
        'dispatch:beforeExecuteRoute',
        new App\Plugins\SecurityPlugin()
    );
    // Add event not found an route
    $eventmanager->attach(
        'dispatch:beforeException',
        new App\Plugins\NotfoundPlugin()
    );
    $dispatcher->setDefaultNamespace('App\Controllers');
    $dispatcher->setEventsManager($eventmanager);
    return $dispatcher;
 });
/**
 * Security app with Hash and CSRF token
 */
$di->set('security', function () {
    $security = new Security();
    $security->setWorkFactor(12);
    return $security;
});
/**
 * Enable encrypt
 */
$di->set("encrypt", function () {
    $encrypt = new Encrypt();
    $encrypt->setKey('mykey');
    return $encrypt;
});
/**
 * Set router
 */
$di->set('router', function () {
    require_once('routes.php');
    return $router;
});
