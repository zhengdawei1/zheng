<?php

namespace frontend\controllers;
use Yii;
use frontend\models\Fruit;
use frontend\models\Jia_token;
use frontend\models\Permission;
class FruitController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionLogin()
    {
        $name=Yii::$app->request->post('name');
        $pwd=Yii::$app->request->post('pwd');
        $Fruit=new Fruit();
        $res=$Fruit->Login($name,$pwd);
        if($res)
        {
            $end=[
                'code'=>0,
                'msg'=>'登录成功'
            ];
            $token='token';
            $Jia_token=new Jia_token();
            $sql=$Jia_token->Add($res,$token);
            $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=fruit/login&sign='$token'";
            $this->curl($url,'POST',$res);
        }else{
            $end=[
                'code'=>1,
                'msg'=>'对不起,您没有权限'
            ];
        }
        return json_encode($end);
    }


    public function actionAddrbac(){
        $post=Yii::$app->request->post();
        if($post['id'])
        {
            $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=fruit2/addrbac&sign='$post[token]'";
            unset($post['uid'],$post['token']);
            $this->curl($url,'POST',$post);
        }else{
            $end=[
                'code'=>1,
                'msg'=>'对不起,您没有权限'
            ];
        }
        return $end;
    }

    public function actionPermission()
    {
        $post=Yii::$app->request->post();
        if($post['id'])
        {
            $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=fruit2/permission&sign='$post[token]'";
            unset($post['uid'],$post['token']);
            $this->curl($url,'POST',$post);
        }else{
            $end=[
                'code'=>1,
                'msg'=>'对不起,您没有权限'
            ];
        }
        return $end;
    }

    public function actionAddFruit(){
        $post=Yii::$app->request->post();
        if($post['id'])
        {
            $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=fruit2/fruit&sign='$post[token]'";
            unset($post['uid'],$post['token']);
            $this->curl($url,'POST',$post);
        }else{
            $end=[
                'code'=>1,
                'msg'=>'对不起,您没有权限'
            ];
        }
        return $end;
    }


    public function actionGet(){
        $post=Yii::$app->request->post();
        if($post['id'])
        {
            $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=fruit2/get&sign='$post[token]'";
            unset($post['uid'],$post['token']);
            $this->curl($url,'POST',$post);
        }else{
            $end=[
                'code'=>1,
                'msg'=>'对不起,您没有权限'
            ];
        }
        return $end;
    }


    public function actionUpdate()
    {
        $post=Yii::$app->request->post();
        if($post['id'])
        {
            $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=fruit2/update&sign='$post[token]'";
            unset($post['uid'],$post['token']);
            $this->curl($url,'POST',$post);
        }else{
            $end=[
                'code'=>1,
                'msg'=>'对不起,您没有权限'
            ];
        }
        return $end;
    }
    function curl($url,$method,$data)
    {
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
        $header[]="Content-type:application/json;charset=UTF-8";
        if(!empty($header))
        {
            curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
        }
        switch($method)
        {
            case 'GET':
                curl_setopt($curl,CURLOPT_HTTPGET,TRUE);
                break;
            case 'POST':
                curl_setopt($curl,CURLOPT_POST,true);
                curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data));
                break;
            case 'PUT':
                curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'PUT');
                curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data));
                break;
        }
        $res=curl_exec($curl);
        curl_close($curl);
        return $res;
    }
}
