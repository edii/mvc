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
            
            $_error = false;
            $_method = \init::app() ->getRequest() -> getParam('method');
            if(empty($_method) or !isset($_method)) {
                // fatal error ( rediract listings owners )
               $_error = true;
            }
            
            if($_method == 'edit') {
               $this->render('form',array(
                    'title'   => 'Редактирование',
                    'listing'   => $this->_owner -> getOwners(),
                    'validate'  => $this -> _model -> getRight(),
                    '_session'  =>  $this -> _model -> getValidate() -> getSession()
                ));

            } else if($_method == 'add'){
               // add
               $this->render('form',array(
                    'title'   => 'Добавление',
                    'validate'  => $this -> _model -> getRight(),
                    '_session'  =>  $this -> _model -> getValidate() -> getSession()
                ));
            } else {
                $_error = true;
            }
            
            if($_error) {
                 $this ->redirect('/'._request_uri.'/error/404/');
            }
                   
                  
            
               
           
            
            
//            echo "<pre>";
//            var_dump( $_REQUEST );
//            echo "</pre>";
            
            // view
//            $this->render('edit', array(
//                        'listing'   => $this->_owner -> getOwners(),
//                        'validate'  => $this -> _model -> getRight(),
//                        '_session'  =>  $this -> _model -> getValidate() -> getSession()
//                    ));

	}
}
