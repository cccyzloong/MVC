<?php

class Controller {

    public $GET;
    public $POST;
    public $model;
    public $view;
    public $args;
    private $_auth;

    public function __construct($args) {
        $this->args = $args;
        
        $this->_setGetAndPost();

        $this->view = new View($this->args);

        $model = ucfirst($this->args['controller']) . 'Model';
        $this->model = class_exists($model) ? new $model($this->args) : FALSE;

        $this->_auth = new Auth($this->POST);

        if (isset($this->POST['logout']) && $this->POST['logout'] && $this->_auth->isLoggedIn()) {
            $this->_auth->logout();
        }

        if ($this->_auth->error) {
            $this->view->smarty->assign('alert', $this->_auth->error);
        }

        $this->view->smarty->assign('isLoggedIn', $this->_auth->isLoggedIn());
        $this->view->smarty->assign('controller', $this->args['controller']);
        $this->view->smarty->assign('action', isset($this->args['action']) ? $this->args['action'] : FALSE);
        $this->view->smarty->assign('get', $this->GET);
        $this->view->smarty->assign('post', $this->POST);
    }

    private function _setGetAndPost() {
        if (isset($this->args['get'])) {
            $this->GET = $this->args['get'];
            unset($this->args['get']);
        }

        if (isset($this->args['post'])) {
            $this->POST = $this->args['post'];
            unset($this->args['post']);
        }
    }

    public function checkLoginAndRedirect() {
        switch ($this->_auth->isLoggedIn()) {
            case TRUE:
                if ($this->args['controller'] == LOGIN_CONTROLLER) {
                    $this->redirect(DEFAULT_CONTROLLER);
                }
                break;

            case FALSE:
                if ($this->args['controller'] != LOGIN_CONTROLLER) {
                    $this->redirect(LOGIN_CONTROLLER);
                }
                break;

            default:
                $this->redirect(LOGIN_CONTROLLER);
                break;
        }
    }

    public function redirect($location = FALSE) {
        $location = $location && !empty($location) ? $location : '/';
        $location = $location[0] != '/' ? '/' . $location : $location;

        header('Location: ' . $location);
    }

}
