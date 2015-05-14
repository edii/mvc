<?php

class ProductsController extends \Controller
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
               $this -> _mproducts_categories = \init::app() -> getModels('products_categories/mproductsCategories');
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
                'products' => $this->_mproducts ->getProducts(),
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
            $_product = \init::app() ->getRequest() -> getParam('product');
            if(empty($_method) or !isset($_method)) {
                // fatal error ( rediract listings owners )
               $_error = true;
            }
            
            if($_method == 'edit') {
                 $_title = 'Редактирование';
                 
                 if(!(int)$_id) {
                    $_error = true;
                 } else {
                     if(is_array($_product) and count($_product) > 0) {
                        $this->_mproducts ->save(true, $_product);
                     }
                 }
                 
            } else if($_method == 'add'){
                // add
                $_title = 'Добавить';               
                if(!(int)$_id) {
                    if(is_array($_product) and count($_product) > 0) {
                        $_product['UserID'] = 'root';
                        $_product['OwnerID'] = 'root';
                        $this->_mproducts ->save(true, $_product);
                    }
                }
                
            } else {
                $_error = true;
            }
            
            if(!$_error) {   
                $this->render('form',array(
                    'title'   => $_title,
                    'sections_actual' => \init::app()->getTreeSection(),
                    'listing'   => $this->_mproducts -> getProductID($_id),
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
            $this -> _mproducts -> delete(array('id' => $_id));
            
            $this ->redirect('/'._request_uri.'/section');
        }
}        
