<?php

class OwnerController extends \Controller
{
	public $layout = 'dashboard';

	private $_model;
        
        // owner (model)
        private $_owner = false;
        /**
         * construct
         */
        public function init() {
           $this -> _model = \init::app() -> getModels('auth/users');
           if(empty($this -> _owner))
            $this -> _owner = \init::app() -> getModels('owner/mowner');
        }
	
	 /**
         * Owner site ( settings globalls elements )
          * load listing
         */
        
        public function actionIndex() {
            $this->layout( false );
            
//            echo "<pre>";
//            var_dump( $_REQUEST );
//            echo "</pre>";
            
            // view
            $this->render('index', array(
                        'listing'   => $this->_owner -> getOwners(),
                        'validate'  => $this -> _model -> getRight(),
                        '_session'  =>  $this -> _model -> getValidate() -> getSession()
                    ));

	}
        
        public function actionManager() {
            $this->layout( false );
            
            $_action = \init::app() -> getParams('action');
            
            if(!empty($_action) and isset($_action)) {
                    echo "<pre>";
                    var_dump( $_REQUEST );
                    echo "</pre>";
            }
            
//            echo "<pre>";
//            var_dump( $_REQUEST );
//            echo "</pre>";
            
            // view
            $this->render('edit', array(
                        'listing'   => $this->_owner -> getOwners(),
                        'validate'  => $this -> _model -> getRight(),
                        '_session'  =>  $this -> _model -> getValidate() -> getSession()
                    ));

	}
}
