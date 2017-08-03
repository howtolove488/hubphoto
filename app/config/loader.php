<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
    array(
    	"App\Plugins"	  => $config->application->pluginsDir,
        "App\Libs"		  => $config->application->libraryDir,
    	"App\Forms"		  => $config->application->formsDir,
        "App\Models"      => $config->application->modelsDir,
        "App\Controllers" => $config->application->controllersDir
    )
);
$loader->register();
