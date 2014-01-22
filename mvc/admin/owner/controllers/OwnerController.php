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
            $_id = \init::app() ->getRequest() -> getParam('id'); 
            $_method = \init::app() ->getRequest() -> getParam('method');
            $_owner = \init::app() ->getRequest() -> getParam('owner');
            if(empty($_method) or !isset($_method)) {
                // fatal error ( rediract listings owners )
               $_error = true;
            }
            
            if($_method == 'edit') {
                 $_title = 'Редактирование';
                 
                 if(!(int)$_id) {
                    $_error = true;
                 } else {
                     if(is_array($_owner) and count($_owner) > 0) {
                        $this->_owner ->save(true, $_owner);
                     }
                 }
                 
            } else if($_method == 'add'){
                // add
                $_title = 'Добавить';
                if(!(int)$_id) {
                    if(is_array($_owner) and count($_owner) > 0) {
                        $this->_owner ->save(true, $_owner);
                     }
                }
                
            } else {
                $_error = true;
            }
            
            // update info
           
               
            if(!$_error) {   
                $this->render('form',array(
                    'title'   => $_title,
                    'listing'   => $this->_owner -> getOwnerID($_id),
                    'validate'  => $this -> _model -> getRight(),
                    '_session'  =>  $this -> _model -> getValidate() -> getSession()
                ));
            } else {
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
