<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal\exception;

/**
 * Description of NotFoundException
 *
 * @author jcc
 */
use Exception;
class NotFoundException extends Exception{
    //put your code here
    protected  $code = 404;
    protected  $message = "This page not found";
}
