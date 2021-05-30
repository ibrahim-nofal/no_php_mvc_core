<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal;

/**
 * Description of UserModel
 *
 * @author jcc
 */
abstract class UserModel extends DBModel{
    //put your code here
    abstract public function getDisplayName():string;
}
