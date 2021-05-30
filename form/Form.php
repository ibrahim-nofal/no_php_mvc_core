<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author jcc
 */
namespace app\core\form;
use app\core\Model;
class Form {
    //put your code 
    //
    public static function begin(string $action ,string $method):Form{
        echo sprintf('<form action="%s" method="%s">' , $action , $method);
        return new Form();
    }
    
    public static function end(){
        echo '</from>';
    }
    
    public function field(Model $model , $attribute){
        return new FieldInput($model , $attribute);
    }
}
