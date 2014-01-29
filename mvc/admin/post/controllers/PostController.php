<?php

class PostController extends \Controller
{
	public $layout = 'dashboard';

	private $_users;
        
        // owner (model)
        private $_mpost = false;
        /**
         * construct
         */
        public function init() {
           $this -> _users = \init::app() -> getModels('auth/users');
           if(empty($this -> _mpost))
                $this -> _mpost = \init::app() -> getModels('post/mpost');
        }
            
        public function actionIndex() {
            $this->layout( false );
            
            $this->render('index');
	}    
}
