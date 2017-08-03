<?php

namespace App\Controllers;

use App\Controllers\ControllerBase;

class ErrorsController extends ControllerBase {
    public function initialize() {
        $this->assets->addCss('css/reset.css');
        $this->assets->addCss('css/error_page.css');
        $this->assets->addCss('css/font-awesome.min.css');
    }
    public function indexAction() {
        // E 404
        $this->tag->setTitle('404 Page not found !');
    }
    public function e405Action() {
        // E 405

        $this->tag->setTitle('405 Not allowed access !');
    }
}
