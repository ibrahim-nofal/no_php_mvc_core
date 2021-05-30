<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal;

/**
 * Description of Response
 *
 * @author jcc
 */
class Response {
    public function setStatusCode(int $code){
        http_response_code($code);
    }
    
    public function redirect(string $url){
        header('Location: ' . $url);
    }
}
