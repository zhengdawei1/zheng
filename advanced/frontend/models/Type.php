<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
class Type extends Model{
    public static function Update($post){
        $res=Yii::$app->db->createCommand()->update('type',[
            'name'=>$post['name'],
            'pid'=>$post['pid']
        ],"id='$post[id]'")->execute();

        return $res;
    }
}