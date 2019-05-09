<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
class Jia_token extends Model{
    public static function Add($res,$token){
        $sql=Yii::$app->db->createCommand()->insert('jia_token',[
            'token'=>$token,
            'uid'=>$res['id']
        ])->execute();
        return $sql;
    }
}