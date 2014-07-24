<?php

class IndexController extends Controller {

    public function __construct($args) {
        parent::__construct($args);
    }

    public function indexAction() {
        $this->view->smarty->display('index/index.tpl');
    }

}
