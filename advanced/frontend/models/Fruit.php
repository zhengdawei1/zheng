<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
class Fruit extends Model{
    public static function Login($name,$pwd)
    {
        $res=Yii::$app->db->createCommand("select * from jia_user where name='$name' and pwd='$pwd'")->queryOne();
        return $res;
    }

    public static function Add($post){
        $res=Yii::$app->db->createCommand()->insert('fruit',[
            'name'=>$post['name'],
            'price'=>$post['price'],
            'num'=>$post['num']
        ])->execute();
        return $res;
    }
}