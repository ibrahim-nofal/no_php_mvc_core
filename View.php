<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal;

/**
 * Description of View
 *
 * @author jcc
 */
class View {
    //put your code here
    
    public string $title = '';
    
    
    public function renderView($view , $params = []){

        $viewContent = $this->renderOnlyView($view , $params);
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent , $layoutContent);
    }
    
    public function renderContent($viewContent){
        
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent , $layoutContent);
    }

    protected function layoutContent() {
        
        $layout =Application::$app->layout;
       if(Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }
       ob_start();
       include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
       return ob_get_clean();
    }
    
    protected function renderOnlyView($view , $params = []){
        foreach ($params as $key => $value){
            $$key = $value; 
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
