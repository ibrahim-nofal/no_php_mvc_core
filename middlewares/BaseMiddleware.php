<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseMiddleware
 *
 * @author jcc
 */
namespace app\core\middlewares;
abstract class BaseMiddleware {
    
    abstract public function execute();
}
