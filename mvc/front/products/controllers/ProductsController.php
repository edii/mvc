<?php

class ProductsController extends \Controller
{
	public $layout = 'test'; //'column1'

	private $_model;
        private $_msection = false;

        public function init() {
            if(empty($this -> _msection))
               $this -> _msection = \init::app() -> getModels('section/msection');
        }
        
        /* --- // page content --- */
        public function getListProducts() {
            
        }
        
        /**
	 * Displays a particular model.
	 */
	public function actionTest()
	{
            
                
               \init::app()->setTheme( 'column2' );
                
            
               $dataProvider = ['blaaa', 'ddddd'];
            
                $this->render('index', array(
			'dataProvider'=>$dataProvider,
		));  
	}

	public function actionIndex()
	{
            $this->layout( $this -> layout );
            $secID = false; 
            $alies = false;
            $sec_url = false;
            $productAlies = false;
            if($section = \init::app() -> getTreeSection() and is_array( $section )) {
                $secID = $section['SectionId'];
                $alies = $this -> _msection -> getSectionID( $secID )['SectionAlias'];
                $sec_url = $this -> _msection -> getSectionID( $secID )['SectionUrl'];
            }
            
            if($sec_url) {
                $productAlies = str_replace($sec_url.'/', '', trim(\init::app() -> getRequest() -> getUrl(), '/'));
            }
            
            echo "<pre>";
            var_dump( $secID, $alies, $sec_url, \init::app() -> getRequest() -> getUrl(), $productAlies );
            echo "</pre>";
            
            $this->render('productList', array()); 
	}
       
        
}
