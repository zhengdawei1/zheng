<?php

namespace frontend\controllers;
use Yii;
use frontend\models\Goods;
class Yue2Controller extends \yii\web\Controller{
    public $enableCsrfValidation = false;

    public function actionAdd(){
        $data=file_get_contents('php://input');
        $post=Yii::$app->request->post();
        $Goods=new Goods();
        $res=$Goods->Add($post);
        if($res)
        {
            $sql=$Goods->One($post);
            return json_encode($sql);
        }else{
            $end=[
                'code'=>1,
                'msg'=>'添加失败'
            ];
        }
        return json_encode($end);
    }

    public function actionGet(){
        $data=file_get_contents('php://input');
        $post=Yii::$app->request->post();
        unset($post['uid'],$post['token']);
        $Goods=new Goods();
        $res=$Goods->Get();
        return json_encode($res);
    }

    public function actionUpdate(){
        $data=json_decode(file_get_contents('php://input'),true);
        $post=Yii::$app->request->post();
        unset($post['token']);
        $Goods=new Goods();
        $res=$Goods->Update($post);
        if($res)
        {
            $end=[
                'code'=>0,
                'msg'=>'修改成功'
            ];
        }else{
            $end=[
                'code'=>1,
                'msg'=>'修改失败'
            ];
        }
        return json_encode($end);
    }
}