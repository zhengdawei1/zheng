<?php
namespace frontend\models;
use Yii;
use yii\base\Model;
class Goods extends Model{
    public static function Add($post)
    {
        $res=Yii::$app->db->createCommand()->insert('goods',[
            'name'=>$post['name'],
            'price'=>$post['price'],
            'num'=>$post['num'],
            'pid'=>$post['pid']
        ])->execute();
        return $res;
    }

    public static function One($post){
        $res=Yii::$app->db->createCommand('select * from goods where id='.$post['uid'])->queryOne();
        return $res;
    }
    public static function Get(){
        $res=Yii::$app->db->createCommand('select * from goods')->queryAll();
        return $res;
    }


    public static function Update($post){
        $res=Yii::$app->db->createCommand()->update('goods',[
            'name'=>$post['name'],
            'price'=>$post['price'],
            'num'=>$post['num']
        ],"id='$post[uid]'")->execute();
        return $res;
    }
}