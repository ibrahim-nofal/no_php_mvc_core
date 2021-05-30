<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal;

/**
 * Description of Router
 *
 * @author jcc
 */
use nofal\exception\NotFoundException;
class Router {
    //put your code here
    
    public array $routes = [];
    public Request $request;
    public Response $response;
    public function __construct(Request $request , Response $response) {
        $this->request = $request;
        $this->response = $response;
    }
    public function get(string $path , $callback){
        $this->routes['get'][$path] = $callback;
    }
    public function post(string $path , $callback){
        $this->routes['post'][$path] = $callback;
    }
    
    
 
    
    public function resolve(){
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        
        if($callback === false){
            throw new NotFoundException();
        }
        if(is_string($callback)){
            return Application::$app->view->renderView($callback);
        }
        
        if(is_array($callback)){
            /**  @var \nofal\Controller $controller */           
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;
            foreach($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
        }
        return call_user_func($callback , $this->request , $this->response);
    }
    
    
}
