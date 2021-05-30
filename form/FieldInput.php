<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal\form;

/**
 * Description of Field
 *
 * @author jcc
 */
use nofal\Model;
class FieldInput extends BaseField{
    
    public const TYPE_TEXT = 'text';
    public const TYPE_EMAIL = 'email';
    public const TYPE_NUMBER = 'number';
    public const TYPE_PASSWORD = 'password';
    
    public string $type;
    public Model $model;
    public string $attribute;
    public function __construct(Model $model , string $attribute){
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }
    

    
   public function passwordField(){
       $this->type = self::TYPE_PASSWORD;
       return $this;
   }

    public function renderInput(): string {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control %s">' , 
                $this->type,
                $this->attribute,
                $this->model->{$this->attribute},
                $this->model->hasError($this->attribute) ? 'is-invalid' : '',
                );
                
    }

}
