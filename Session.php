<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\core;

/**
 * Description of Session
 *
 * @author jcc
 */
class Session {
   
    protected const FLASH_KEY = 'flash_messages';
    
    public function __construct(){
        session_start();
        $flashMessages = &$_SESSION[self::FLASH_KEY] ?? [];
        if($flashMessages){
            foreach($flashMessages as $key => &$flashMessage){
                //Mark to be removed
                $flashMessage['remove'] = true;
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
        
    }
    public function setFlash($key , $message){
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove'=> false,
            'value' => $message
        ];
    }
    
    public function getFlash($key){
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }
    
    public function __destruct(){
       $flashMessages = &$_SESSION[self::FLASH_KEY] ?? [];
       if($flashMessages){
        foreach($flashMessages as $key => &$flashMessage){
            //Mark to be removed
            if($flashMessage['remove']){
                unset($flashMessages[$key]);
            }
        }
       }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
        
    }
    public function get($key){
        return $_SESSION[$key] ?? false;
    }
    public function set($key , $value){
        $_SESSION[$key] = $value;
    }
    public function remove($key){
        unset($_SESSION[$key]);
    }
}
