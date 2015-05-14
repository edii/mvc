<?php

class ProductsCategoryController extends \Controller
{
	public $layout = 'dashboard';

	private $_users;
        
        // section (model)
        private $_msection = false;
        private $_mproducts = false;
        private $_mproducts_categories = false;
        
        /**
         * construct
         */
        public function init() {
           $this -> _users = \init::app() -> getModels('auth/users');
           if(empty($this -> _msection))
               $this -> _msection = \init::app() -> getModels('section/msection');
           if(empty($this -> _mproducts))
               $this -> _mproducts = \init::app() -> getModels('products/mproducts');
           if(empty($this -> _mproducts_categories))
               $this -> _mproducts_categories = \init::app() -> getModels('products_categories/mproducts_categories');
        }
        
        public function actionIndex() {
        }
        public function actionList() {
            $_lang = \init::app() -> getLanguage();
            
            $this->layout( false );
            $validate = $this -> _users -> getRight();
            if(!$validate)
                $this -> redirect('/'._request_uri.'/home/login');
            
            
            $this->render('list', array(
                'categories' => $this -> _mproducts_categories ->getCategories(),
            ));
            
//            
//            $this->render('list', array(
//                'validate'  => $validate,
//                '_lang' => $_lang
//            ));
        }
        public function actionManager() {
            $this->layout( false );
            // update info
            $validate = $this -> _users -> getRight();
            if(!$validate)
                $this -> redirect('/'._request_uri.'/home/login');
            
            
            $_error = false;
            // $_user = $this -> _users -> getUserID(); 
            
            $_id = \init::app() ->getRequest() -> getParam('id'); 
            $_method = \init::app() ->getRequest() -> getParam('method');
            $_category = \init::app() ->getRequest() -> getParam('category');
            if(empty($_method) or !isset($_method)) {
                // fatal error ( rediract listings owners )
               $_error = true;
            }
            
            if($_method == 'edit') {
                 $_title = 'Редактирование';
                 
                 if(!(int)$_id) {
                    $_error = true;
                 } else {
                     if(is_array($_category) and count($_category) > 0) {
                        $this -> _mproducts_categories ->save(true, $_category);
                     }
                 }
                 
            } else if($_method == 'add'){
                // add
                $_title = 'Добавить';               
                if(!(int)$_id) {
                    if(is_array($_category) and count($_category) > 0) {
                        $_category['UserID'] = 'root';
                        $_category['OwnerID'] = 'root';
                        $this -> _mproducts_categories ->save(true, $_category);
                    }
                }
                
            } else {
                $_error = true;
            }
            
            if(!$_error) {   
                $this->render('form',array(
                    'title'   => $_title,
                    'sections_actual' => \init::app()->getTreeSection(),
                    'listing'   => $this -> _mproducts_categories -> getCategoryID($_id),
                    '_categories' => $this -> _mproducts_categories -> getCategoriesTree(false),
                    'validate'  => $validate,
                    '_session'  =>  $this -> _users -> getValidate() -> getSession()
                ));
            } else {
                 $this ->redirect('/'._request_uri.'/error/404/');
            }
        }
        public function actionDelete(){ 
            $this->layout( false );
     
            $_id = \init::app() ->getRequest() -> getParam('id');
            $this -> _mproducts_categories -> delete(array('id' => $_id));
            
            $this ->redirect('/'._request_uri.'/section');
        }
}        
