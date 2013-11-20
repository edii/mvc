<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Input extends \CModel {
    
    private static $db;

    private static $_tabelName = ['user'];
    
    protected function init() {
    }
    
    public function attributeNames() {
        
    }
    
    /**
     * input ( create fields )
     */
    public function input() {       
    }
    
    public function update() {
    }
    
    /**
     * 
     * save (input or update)
     * 
     */
    public function save() {
        die('load model input save');
        
    }
    
    
}
