<?php
namespace frontend\models;
use Yii;
use yii\base\Model;

class Token extends Model{
    public static function Get($res){
        $sql=Yii::$app->db->createCommand("select * from token where uid='$res[id]'")->queryAll();
        return $sql;
    }

    public static function Add($access_token,$res){
        $data=Yii::$app->db->createCommand()->insert('token',[
            'token'=>$access_token,
            'uid'=>$res['id']
        ])->execute();
        return $data;
    }
}