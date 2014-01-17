<?php

class ErrorController extends \Controller
{
	public $layout = 'dashboard';

	private $_model;
        
        /**
         * construct
         */
        public function init() {
            $this -> _model = \init::app() -> getModels('auth/users');
        }
	
	public function actionIndex() {
            $this->render('index');
	}

}
