<?php

class HelloController extends \Controller
{
	public $layout = 'column1'; //'column1'

	private $_model;

	public function actionDB()
	{
            
            // \init::app()->setTheme( false );
            
            // connect db from controlers
            $_db = new CDatabase( 'main', NULL);
            
            
            // CI (mysql)
            //$_connector = $_db->getConnection()->query("SELECT * FROM section")->result_array();
            
            // CI (pdo)
            // $_connector = $_db->getConnection()->query("SELECT * FROM section")->result_array();
            
            // drupal
             $options['target'] = 'main';   
             $args = array();
             
             $_connector = $_db->getConnection();
             $_dbdefionitions = $_db->getDatabaseDefinition();
             
             $query_res = $_connector -> query("SELECT * FROM section", $args, $options)-> fetchAll();
             //$query_res = $_connector -> select('section', 's', $options) 
                               // -> fields('s', array('SectionID')) 
                                //-> range(0, 1)
                               // -> addTag('section_access')    
                                //-> execute()
                               // -> fetchObject();
             
             $data = ['blaaaa'];
             $this->render('db', array(
			'data'=>$data,
		));
		
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
           // if($this->layout) {
             // \init::app()->setTheme( $this->layout );
           // }
            
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
