<?php

class SectionController extends \Controller
{
	public $layout = 'dashboard';

	private $_users;
        
        // section (model)
        private $_msection = false;
        /**
         * construct
         */
        public function init() {
           $this -> _users = \init::app() -> getModels('auth/users');
           if(empty($this -> _msection))
               $this -> _msection = \init::app() -> getModels('section/msection');
        }
        
        public function actionIndex() {
            $this->layout( false );
            
            $this->render('index', array(
                'sections_actual' => \init::app()->getTreeSection(),
                'section_list'   => $this -> _msection -> getSections(),
                'validate'  => $this -> _users -> getRight(),
                '_session'  =>  $this -> _users -> getValidate() -> getSession()
            ));
	}
        
        public function actionManager_s() {
            $this->layout( false );
            
            $_error = false;
            $_id = \init::app() ->getRequest() -> getParam('id'); 
            $_method = \init::app() ->getRequest() -> getParam('method');
            $_section = \init::app() ->getRequest() -> getParam('sections');
            if(empty($_method) or !isset($_method)) {
                // fatal error ( rediract listings owners )
               $_error = true;
            }
            
            if($_method == 'edit') {
                 $_title = 'Редактирование';
                 
                 if(!(int)$_id) {
                    $_error = true;
                 } else {
                     if(is_array($_section) and count($_section) > 0) {
                        $this->_msection ->save(true, $_section);
                     }
                 }
                 
            } else if($_method == 'add'){
                // add
                $_title = 'Добавить';
                if(!(int)$_id) {
                    if(is_array($_section) and count($_section) > 0) {
                        $this->_msection ->save(true, $_section);
                     }
                }
                
            } else {
                $_error = true;
            }
            
            // update info
           
               
            if(!$_error) {   
                $this->render('form',array(
                    'title'   => $_title,
                    'sections_actual' => \init::app()->getTreeSection(),
                    'listing'   => $this->_msection -> getSectionID($_id),
                    'validate'  => $this -> _users -> getRight(),
                    '_session'  =>  $this -> _users -> getValidate() -> getSession()
                ));
            } else {
                 $this ->redirect('/'._request_uri.'/error/404/');
            }                 

	}
}
