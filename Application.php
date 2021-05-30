<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal;

/**
 * Description of Application
 *
 * @author jcc
 */
class Application {
    
    
    public string $layout= 'main';
    public string $userClass;
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public ?DBModel $user;
    public View $view;
    public function __construct($rootPath , array $config) {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request , $this->response);
        self::$app = $this;
        $this->db = new Database($config['db']);
        $this->session = new Session();
        $this->view = new View();
        $this->userClass = $config['userClass'];
        
        $primaryValue = $this->session->get('user');
        if($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
            
        }else{
            $this->user = null;
        }
        
        
    }
    
    public function run(){
        //todo
        
        try{
            echo $this->router->resolve();
        } catch (\Exception $ex) {
            Application::$app->response->setStatusCode($ex->getCode());
            echo Application::$app->view->renderView("_error" , [
                'exception' => $ex
            ]);
        }
        
        
    }
    
    public function getController(): Controller {
        return $this->controller;
    }

    public function setController(Controller $controller): void {
        $this->controller = $controller;
    }
    
    public function login(DBModel $user){
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user' , $primaryValue);
        return true;
    }
    
    public function logout(){
        $this->user = null;
        $this->session->remove('user');
    }
    
    public static function isGuest() {
        return !self::$app->user;
    }

}
