<?php

class TreeController extends \Controller
{
	public $layout = false; //'column1'

	private $_model;
        
        /**
         * construct
         */
        public function init() {
            $this -> _model = \init::app() -> getModels('tree/ctree');
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
                'tree' => $_tree
            ));
        }
        
}
