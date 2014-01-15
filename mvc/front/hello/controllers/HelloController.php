<?php

class HelloController extends \Controller
{
	public $layout = 'column1'; //'column1'

	private $_model;

	public function actionDB()
	{
            
            
            
            // \init::app()->setTheme( false );
            
            // connect db from controlers
            //$_db = new CDatabase( 'main', NULL);
            
            $_connector = \init::app() -> getDBConnector();
            $_dbDefinition = \init::app() -> getDBDefinitions();
            
            // CI (mysql)
            //$_connector = $_db->getConnection()->query("SELECT * FROM section")->result_array();
            
            // CI (pdo)
            // $_connector = $_db->getConnection()->query("SELECT * FROM section")->result_array();
            
            // drupal
             $options['target'] = 'main';   
             $args = array();
             
             //$_dbdefionitions = $_db->getDatabaseDefinition();
             
             $query_res = $_connector -> query("SELECT * FROM section LIMIT 1", $args, $options)-> fetchAll();
             //$query_res = $_connector -> select('section', 's', $options) 
                               // -> fields('s', array('SectionID')) 
                                //-> range(0, 1)
                               // -> addTag('section_access')    
                                //-> execute()
                               // -> fetchObject();
             
             $data = ['blaaaa'];
             $this->render('db', array(
			'data'=>$query_res,
                        'definitions' => $_dbDefinition   
		));
		
	}
        
        /**
	 * Displays a particular model.
	 */
	public function actionTest()
	{
            
                echo "<pre>";
                var_dump( $_REQUEST );
                echo "</pre>";
            
            
               $dataProvider = ['blaaa', 'ddddd'];
            
                $this->render('index', array(
			'dataProvider'=>$dataProvider,
		));  
	}
        
        public function actionSubcat()
	{
            
                echo "<pre>";
                var_dump( $_REQUEST );
                echo "</pre>";
            
                echo "SUbCat";
             
	}
        
        public function actionSubcat2() {
            
                echo "<pre>";
                var_dump( $_REQUEST );
                echo "</pre>";
            
                echo "SUbCat2";
             
	}

	public function actionIndex() {
            
            
                    
            //echo "path = ".PATH; die('stop');
                    
            //$img = ResizeImages::createImage(PATH.'/style/front/image/sisky.jpg');
            //$img->cropCenter('4pr', '3pr')->save(PATH.'/style/front/image/crop_image.jpg');
            
             echo "layout ---- = ".$this->layout;
             echo "<hr />";
            
            $themes = \init::app()->getTheme( 'home' );
                   
            $_gets = $this->getActionParams();
            
            $dataProvider = ['blaaa', 'ddddd'];
            
            
            $this->render('index', array(
			'dataProvider'=>$dataProvider,
		));
	}
}
