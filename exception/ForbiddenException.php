<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core\exception;

/**
 * Description of ForbiddenException
 *
 * @author jcc
 *
 * 
 */
use Exception;
class ForbiddenException extends Exception{
    //put your code here
    protected $code = 403;
    protected $message = 'You don\'t have permisstion to access this page';
}
