<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nofal;

/**
 * Description of DBModel
 *
 * @author jcc
 */
use nofal\Application;
abstract class DBModel extends Model{
    
    
    abstract public function tablename():string;
    
    abstract public function attributes():array;
    
    abstract public function primaryKey():string;
    
    public function save(){
        $tableName = $this->tablename();
        $attribute = $this->attributes();
        
        $params = array_map(fn ($m) => ":$m" , $attribute);
        $stmt = self::prepare("INSERT INTO $tableName (". implode(',', $attribute) .")"
                 . " VALUES " . "(" . implode(',' , $params) . ")");
      
        foreach($attribute as $attribute){
            $stmt->bindValue(":$attribute" , $this->{$attribute});
        }
        $stmt->execute();
        return true;
    }
    
    public static function prepare(string $sql): \PDOStatement{
        return Application::$app->db->pdo->prepare($sql);
    }
    
    public function findOne($where){//[email => nofal@gmail.com , firstname => nofal]
        $tableName = static::tablename();
        $attributes = array_keys($where);
        $sql = implode(" AND " ,array_map(fn($m) => "$m = :$m" , $attributes));
        //SELECT * FROM $tablename WHERE email = :email AND firstname = :firstname
        
        $stmt = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key => $item){
            $stmt->bindValue(":$key" , $item);
        }
        
        $stmt->execute();
        return $stmt->fetchObject(static::class);
        
    }

}
