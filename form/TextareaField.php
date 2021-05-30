<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal\form;

/**
 * Description of TextareaField
 *
 * @author jcc
 */
class TextareaField extends BaseField{
    //put your code here
    
    public function renderInput(): string {
        return sprintf('<textarea name="%s" class="form-control %s"></textarea>' ,
                $this->attribute,
                $this->model->hasError($this->attribute) ? 'is-invalid' : '' ,
                $this->model->{$this->attribute}
        );
    }
}
