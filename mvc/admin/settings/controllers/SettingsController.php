<?php

class SettingsController extends \Controller
{
	public $layout = 'dashboard';

	private $_model;
        
        /**
         * construct
         */
        public function init() {
           $this -> _model = \init::app() -> getModels('auth/users');
        }
	
	public function actionIndex() {
            
             $this->render('index');
	}
        
        /*
         * (sidebar left) bandwidth-transfer-widget
         */
        public function actionBandwidthTransfer() {
            
             $this->render('bandwidth_transfer');
	}
        
        /*
         * (sidebar left) disk-space-widget
         */
        public function actionDiskSpace() {
            
             $this->render('disk_space');
	}
        
        /*
         * (sidebar left) stats-widget
         */
        public function actionStats() {
            
             $this->render('stats');
	}
        
        /*
         * (sidebar left) site-info-widget
         */
        public function actionSiteInfo() {
            
             $this->render('site_info');
	}
}
