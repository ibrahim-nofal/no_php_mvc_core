<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\form;

/**
 * Description of BaseField
 *
 * @author jcc
 */
use app\core\Model;
abstract class BaseField {
    //put your code here
    

    public Model $model;
    public string $attribute;
    public function __construct(Model $model , string $attribute){
        $this->model = $model;
        $this->attribute = $attribute;
    }
    
    abstract public function renderInput():string;
    
        public function __toString() {
        return sprintf(
                '<div class="mb-3">
                    <label class="form-label">%s</label>
                    %s
                    <div class="invalid-feedback">
                        %s
                    </div>
                </div>',
                $this->model->getLabels($this->attribute),
                $this->renderInput(),
                $this->model->getFirstError($this->attribute)
                
        );
    }
}
