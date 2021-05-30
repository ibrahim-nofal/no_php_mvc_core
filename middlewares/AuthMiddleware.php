<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal\middlewares;

/**
 * Description of AuthMiddleware
 *
 * @author jcc
 */
use nofal\Application;
use nofal\exception\ForbiddenException;
class AuthMiddleware extends BaseMiddleware{
    //put your code here
    
    public array $actions = [];
    
    
    public function __construct(array $actions = []){
        $this->actions = $actions;
    }
    
    public function execute() {
        if(Application::isGuest()){
            if(empty($this->actions) || in_array(Application::$app->controller->action , $this->actions)){
                throw new ForbiddenException();
            }
        }
    }
}
