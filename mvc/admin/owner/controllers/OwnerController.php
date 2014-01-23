<?php

class OwnerController extends \Controller
{
	public $layout = 'dashboard';

	private $_users;
        
        // owner (model)
        private $_mowner = false;
        /**
         * construct
         */
        public function init() {
           $this -> _users = \init::app() -> getModels('auth/users');
           if(empty($this -> _mowner))
            $this -> _mowner = \init::app() -> getModels('owner/mowner');
        }
	
	 /**
         * Owner site ( settings globalls elements )
          * load listing
         */
        
        public function actionIndex() {
            $this->layout( false );
            
            $this->render('index', array(
                        'sections_actual' => \init::app()->getTreeSection(),
                        'listing'   => $this->_mowner -> getOwners(),
                        'validate'  => $this -> _users -> getRight(),
                        '_session'  =>  $this -> _users -> getValidate() -> getSession()
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
                        $this->_mowner ->save(true, $_owner);
                     }
                 }
                 
            } else if($_method == 'add'){
                // add
                $_title = 'Добавить';
                if(!(int)$_id) {
                    if(is_array($_owner) and count($_owner) > 0) {
                        $this->_mowner ->save(true, $_owner);
                     }
                }
                
            } else {
                $_error = true;
            }
            
            // update info
           
               
            if(!$_error) {   
                $this->render('form',array(
                    'title'   => $_title,
                    'listing'   => $this->_mowner -> getOwnerID($_id),
                    'validate'  => $this -> _users -> getRight(),
                    '_session'  =>  $this -> _users -> getValidate() -> getSession()
                ));
            } else {
                 $this ->redirect('/'._request_uri.'/error/404/');
            }                 

	}
}
