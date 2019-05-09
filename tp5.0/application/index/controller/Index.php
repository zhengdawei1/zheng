<?php
namespace app\index\controller;
use think\Db;
use think\Request;
use think\Controller;
class Index extends Controller
{
    //展示添加页面
    public function index()
    {
        return view();
    }


    //添加方法
    public function insert(){
        $data['name']=input('post.name');//接收传值
        $data['home']=input('post.home');
        $data['desc']=input('post.desc');
        $file = request()->file('img');//接收文件
        $info = $file->move(ROOT_PATH . 'public' . DS. 'static'. DS . 'uploads');
        $file->rule('uniqid')->move('/home/www/upload/4f50538ef0e383a3fd6903a29d3fb440.jpg');//md5去重
        //判断
        if($info)
        {
            $data['img']=$info->getSaveName();
        }else{
            $data['img']=null;
        }

        $res=Db::table('brand')->insert($data);//实例化表
        if($res)
        {
            $this->success('添加成功','show');
        }else{
            $this->error('添加失败');
        }
    }


    public function show(){
        $p=Request::instance()->param('page');//接收前台传值
        if($p==''){
            $page=1;
        }else
        {
            $page=$p;
        }

        $count=Db::table('brand')->count();//求出总条数
        $length=3;//求出每页显示条数
        $zong_page=ceil($count/$length);//求出总页数
        $limit=($page-1)*$length;//求出偏移量
        $data=Db::table('brand')->limit($limit,$length)->select();
        $arr['data']=$data;//进行赋值
        $arr['home']=1;
        $arr['prev']=$page-1<1?1:$page-1;
        $arr['p']=$page;
        $arr['next']=$page+1>$zong_page?$zong_page:$page+1;
        $arr['last']=$zong_page;
        return view('show',['list'=>$arr]);
    }

    public function page(){
        $desc=Request::instance()->param('desc');//接收前台传值
        $word=Request::instance()->param('word');//接收前台传值
        $where='';
        //判断 如果有值则执行
        if($word)
        {
            $where['name']=$word;
        }
        //判断 如果有值则执行
        if($desc)
        {
            $where['desc']=$desc;
        }
        $p=Request::instance()->param('page');//接收传值
        if($p==''){
            $page=1;
        }else
        {
            $page=$p;
        }

        $count=Db::table('brand')->where($where)->count();//求出总条数
        $length=3;//求出每页显示条数
        $zong_page=ceil($count/$length);//求出总页数
        $limit=($page-1)*$length;//求出偏移量
        $data=Db::table('brand')->where($where)->limit($limit,$length)->select();
        $arr['data']=$data;
        $arr['home']=1;
        $arr['prev']=$page-1<1?1:$page-1;
        $arr['p']=$page;
        $arr['next']=$page+1>$zong_page?$zong_page:$page+1;
        $arr['last']=$zong_page;
        echo json_encode($arr);//输出json
    }

    public function del(){
        $id=Request::instance()->param('id');//接收前台id传值
        Db::table('brand')->delete($id);//删除
        $word=Request::instance()->param('word');//接收传值
        $where='';
        if($word)
        {
            $where['name']=$word;
        }

        $p=Request::instance()->param('page');
        if($p==''){
            $page=1;
        }else
        {
            $page=$p;
        }

        $count=Db::table('brand')->where($where)->count();//求出总条数
        $length=3;//求出每页显示条数
        $zong_page=ceil($count/$length);//求出总页数
        $limit=($page-1)*$length;//求出偏移量
        $data=Db::table('brand')->where($where)->limit($limit,$length)->select();
        $arr['data']=$data;//赋值
        $arr['home']=1;
        $arr['prev']=$page-1<1?1:$page-1;
        $arr['p']=$page;
        $arr['next']=$page+1>$zong_page?$zong_page:$page+1;
        $arr['last']=$zong_page;
        echo json_encode($arr);//输出json

    }

    public function change(){
        $data['id']=Request::instance()->param('s_id');//接收id传值
        $data['name']=Request::instance()->param('_new');//接收姓名传值
        //通过id改名字
        if(Db::table('brand')->update($data))
        {
            return 1;
        }else{
            return 0;
        }
    }

}
