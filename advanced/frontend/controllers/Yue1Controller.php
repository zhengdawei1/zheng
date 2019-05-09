<?php

namespace frontend\controllers;
use Yii;
use frontend\models\User;
use frontend\models\Token;
class Yue1Controller extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionLogin()
    {
        $name=Yii::$app->request->post('name');
        $pwd=Yii::$app->request->post('pwd');
        $User=new User();
        $res=$User->Login($name,$pwd);
        if($res)
        {
            $Token=new  Token();
            $sql=$Token->Get($res);
            if(!$sql)
            {
                $token='token';
                $access_token=base64_encode($token);
                $data=$Token->Add($access_token,$res);
            }else{
                echo '已登录';
            }
            $end=[
                'code'=>0,
                'msg'=>'登录成功',
                'access_token'=>'token'
            ];
        }else{
            $end=[
                'code'=>1,
                'msg'=>'登录失败'
            ];
        }
        return json_encode($end);
    }


    public function actionAdd(){
        $post=Yii::$app->request->post();
        if($post['uid'])
        {
            $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=yue2/add&sign='$post[token]'";
            unset($post['uid'],$post['token']);
            $this->curl($url,'POST',$post);
        }
        else
        {
            $end=[
                'code'=>1,
                'msg'=>'请先登录'
            ];
            return json_encode($end);
        }
    }


    public function actionGet(){
        $post=Yii::$app->request->post();
        if($post['uid'])
        {
            $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=yue2/get&sign='$post[token]'";
            unset($post['uid'],$post['token']);
            $this->curl($url,'GET',$post);
        }else{
            $end=[
                'code'=>1,
                'msg'=>'请先登录'
            ];
            return $end;
        }
    }
    public function actionUpdate(){
        $post=Yii::$app->request->post();
        if($post['uid'])
        {
            $url="http://localhost/month10/yue/advanced/frontend/web/index.php?r=yue2/update&sign='$post[token]'";
            unset($post['uid'],$post['token']);
            $this->curl($url,'PUT',$post);
        }
        else{
            $end=[
                'code'=>1,
                'msg'=>'请先登录'
            ];
            return $end;
        }

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
            case "GET":
                curl_setopt($curl,CURLOPT_HTTPGET,true);
                break;
            case "POST":
                curl_setopt($curl,CURLOPT_POST,true);
                curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data));
                break;
            case "PUT":
                curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'PUT');
                curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data));
                break;
            case "DELETE":
                curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'DELETE');
                curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data));
                break;
        }
        $res=curl_exec($curl);
        curl_close($curl);
        return $res;
    }

}
