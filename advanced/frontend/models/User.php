<?php
namespace frontend\models;
use Yii;
use yii\base\Model;

class User extends Model{
    public static function Login($name,$pwd){
        $res=Yii::$app->db->createCommand("select * from user where name='$name' and pwd='$pwd'")->queryOne();
        return $res;
    }
}