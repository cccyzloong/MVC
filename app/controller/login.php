<?php

class LoginController extends Controller {

    public function __construct($args) {
        parent::__construct($args);

        $this->checkLoginAndRedirect();
    }

    public function indexAction() {
        $this->view->setMetaTitle('Login');

        $this->view->smarty->assign('session', $_SESSION);

        $this->view->smarty->display('login/index.tpl');
    }

}
