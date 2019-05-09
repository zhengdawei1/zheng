<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
class Role extends Model{
    public static function Add($post){
        $res=Yii::$app->db->createCommand()->insert('jia_role',[
            'name'=>$post['name'],
            'pid'=>$post['pid']
        ])->execute();
        return $res;
    }
}