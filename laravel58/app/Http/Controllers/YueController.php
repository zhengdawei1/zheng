<?php
namespace App\Http\Controllers;
use App\Jobs\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Ticket;
class YueController extends Controller{
    public function index(Request $request){
        $data=$request->post();
        $data['created']=date("Y:m:d H:i:s");
        $data['updated']=date("Y:m:d H:i:s");
        $ticket=new Ticket();
        $res=$ticket->add($data);
        if($res)
        {
            echo '添加成功';
        }else{
            echo '添加失败';
        }
    }

    public function show(){
        $ticket=new Ticket();
        $res=$ticket->show();
        echo json_encode($res);
    }


    public function delete(Request $request,$id){
        $ticket=new Ticket();
        $res=$ticket->del($id);
        if($res)
        {
            echo json_encode('删除成功');
        }else{
            echo json_encode('删除失败');
        }
    }

    public function update(Request $request,$id){
        $data=$request->post();
        $data['created']=date("Y:m:d H:i:s");
        $data['updated']=date("Y:m:d H:i:s");
        $ticket=new Ticket();
        $res=$ticket->upd($id,$data);
        if($res)
        {
            echo json_encode('修改成功');
        }else{
            echo json_encode('修改失败');
        }
    }


    public function add_order(Request $request){
        $tel=$request->post('tel');
        $ticket_id=$request->post('ticket_id');
        $ticket_num=$request->post('ticket_num');
        $ticket=new Ticket();
        $res=$ticket->t_show($ticket_id);
        $ticket_name=$res[0]->name;
        $price=$res[0]->price;
        $total_cost=$ticket_num*$price;
        $data=[
            'ticket_id'=>$ticket_id,
            'order_code'=>$ticket_id.rand(1111,9999),
            'tel'=>$tel,
            'ticket_name'=>$ticket_name,
            'ticket_num'=>$ticket_num,
            'total_cost'=>$total_cost,
            'created'=>date("Y:m:d H:i:s"),
            'updated'=>date("Y:m:d H:i:s")
        ];
        $this->dispatch(new Queue($data));
    }
}