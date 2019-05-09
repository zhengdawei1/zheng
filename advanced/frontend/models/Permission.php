<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
class Permission extends Model{
    public static function Add($post){
        $res=Yii::$app->db->createCommand()->insert('jia_permission',[
            'name'=>$post['name'],
            'uid'=>$post['uid']
        ])->execute();
        return $res;
    }

    public static function Get(){
        $res=Yii::$app->db->createCommand('select * from jia_permission')->queryAll();
        return $res;
    }
}