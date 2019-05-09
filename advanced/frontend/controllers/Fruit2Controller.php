<?php

namespace frontend\controllers;
use Yii;
use frontend\models\Role;
use frontend\models\Permission;
use frontend\models\Fruit;
use frontend\models\Type;
class Fruit2Controller extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionAddrbac()
    {
        $data=json_decode(file_get_contents('php://input'),true);
        $post=Yii::$app->request->post();
        $Role=new Role();
        $res=$Role->Add($post);

        if($res){
            $end=[
                'code'=>0,
                'msg'=>'添加成功'
            ];
        }else{
            $end=[
                'code'=>1,
                'msg'=>'添加失败'
            ];
        }
        return json_encode($end);
    }

    public function actionPermission(){
        $data=json_decode(file_get_contents('php://input'),true);
        $post=Yii::$app->request->post();
        $Permission=new Permission();
        $sql=$Permission->Add($post);

        if($sql){
            $end=[
                'code'=>0,
                'msg'=>'添加成功'
            ];
        }else{
            $end=[
                'code'=>1,
                'msg'=>'添加失败'
            ];
        }
        return json_encode($end);
    }

    public function actionFruit(){
        $data=json_decode(file_get_contents('php://input'),true);
        $post=Yii::$app->request->post();
        $Fruit=new Fruit();
        $res=$Fruit->Add($post);
        if($res)
        {
            $end=[
                'code'=>0,
                'msg'=>'添加成功'
            ];
        }else{
            $end=[
                'code'=>1,
                'msg'=>'添加失败'
            ];
        }
        return json_encode($end);
    }


    public function actionGet(){
        $Permission=new Permission();
        $res=$Permission->Get();
        return json_encode($res);
    }


    public function actionUpdate(){
        $data=json_decode(file_get_contents('php://input'),true);
        $post=Yii::$app->request->post();
        $Type=new Type();
        $res=$Type->Update($post);
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
