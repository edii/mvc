<?php

class SectionController extends \Controller
{
	public $layout = 'dashboard';

	private $_mauth;
        
        // section (model)
        private $_msection = false;
        /**
         * construct
         */
        public function init() {
           $this -> _mauth = \init::app() -> getModels('auth/users');
           if(empty($this -> _msection))
               $this -> _msection = \init::app() -> getModels('section/msection');
        }
        
        public function actionIndex() {
            $this->layout( false );
            
            $this->render('index', array(
                'section_list'   => $this -> _msection -> getSections(),
                'validate'  => $this -> _mauth -> getRight(),
                '_session'  =>  $this -> _mauth -> getValidate() -> getSession()
            ));
	}
}
