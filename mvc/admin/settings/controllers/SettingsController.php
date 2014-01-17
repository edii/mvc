<?php

class HelloController extends \Controller
{
	public $layout = 'dashboard'; //'column1'

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
