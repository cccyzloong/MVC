<?php

class LoginController extends Controller {

    public function __construct($args) {
        parent::__construct($args);

        $this->view->setMetaTitle('Login');
    }

    public function indexAction() {
        $this->view->smarty->assign('session', $_SESSION);

        $this->view->smarty->display('login/index.tpl');
    }

}
