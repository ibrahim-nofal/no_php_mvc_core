<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core;

/**
 * Description of Controller
 *
 * @author jcc
 */
use app\core\middlewares\BaseMiddleware;
class Controller {
       
    public string $layout = 'main';
    public string $action = '';
    /** @var \app\core\middlewares\BaseMiddleware[] */ 
    protected array $middlewares = [];
    public function setLayout($layout){
        $this->layout = $layout;
    }
    public function render($view , $params= []){
        return Application::$app->view->renderView($view, $params);
    }
    
    public function registerMiddleware(BaseMiddleware $middleware){
        $this->middlewares[] = $middleware;
    }
    
    public function getMiddlewares(){
        return $this->middlewares;
    }
    
}
