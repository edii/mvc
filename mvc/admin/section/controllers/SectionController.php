<?php

class SectionController extends \Controller
{
	public $layout = 'dashboard';

	private $_musers;
        
        // section (model)
        private $_msection = false;
        /**
         * construct
         */
        public function init() {
           $this -> _musers = \init::app() -> getModels('auth/users');
           if(empty($this -> _msection))
               $this -> _msection = \init::app() -> getModels('section/msection');
        }
        
        public function actionIndex() {
            $this->layout( false );
            
            $this->render('index', array(
                'section_list'   => $this -> _msection -> getSections(),
                'validate'  => $this -> _musers -> getRight(),
                '_session'  =>  $this -> _musers -> getValidate() -> getSession()
            ));
	}
}
