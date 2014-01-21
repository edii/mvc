<?php

class TreeController extends \Controller
{
	public $layout = false; //'column1'

	private $_model;
        private $model_validate;
        /**
         * construct
         */
        public function init() {
            $this -> _model = \init::app() -> getModels('tree/ctree');
            $this -> model_validate = \init::app() -> getModels('auth/users');
        }
	
        
        /**
         * box cotroller
         * return array
         */
        public function actionIndex() {
            $this->layout( false );
            $_model = \init::app() -> getModels('tree/ctree');
            $_tree = $_model -> getTree();
            
            $this->render('index', array(
                'tree'      => $_tree,
                'parent'    => true,
                'validate'  => $this -> model_validate -> getRight() 
            ));
        }
        
}
