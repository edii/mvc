<?php

class SettingsController extends \Controller
{
	public $layout = 'dashboard';

	private $_users;
        
        /**
         * construct
         */
        public function init() {
           $this -> _users = \init::app() -> getModels('auth/users');
        }
	
	public function actionIndex() {
            
             $this->render('index');
	}
        
        /*
         * (sidebar left) bandwidth-transfer-widget
         */
        public function actionBandwidthTransfer() {
            
             $this->render('bandwidth_transfer', array(
                 'validate' => $this -> _users -> getRight()
             ));
	}
        
        /*
         * (sidebar left) disk-space-widget
         */
        public function actionDiskSpace() {
            
             $this->render('disk_space', array(
                 'validate' => $this -> _users -> getRight()
             ));
	}
        
        /*
         * (sidebar left) stats-widget
         */
        public function actionStats() {
            
             $this->render('stats', array(
                 'validate' => $this -> _users -> getRight()
             ));
	}
        
        /*
         * (sidebar left) site-info-widget
         */
        public function actionSiteInfo() {
            
             $this->render('site_info', array(
                 'validate' => $this -> _users -> getRight()
             ));
	}
}
