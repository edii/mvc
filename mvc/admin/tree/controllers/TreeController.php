<?php

class TreeController extends \Controller
{
	public $layout = 'dashboard'; //'column1'

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
            // $_tree = $_model -> getTree(); - old
            
            $_tree = $_model -> _getCreateTree();
            
            
            echo "<pre>";
            var_dump( $_tree );
            echo "</pre>";
            
            $this->render('index');
        }
        
}
