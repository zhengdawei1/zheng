<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model{
    public function add($data){
        $res=DB::table('ticket')->insert($data);
        return $res;
    }

    public function show(){
        $res=DB::table('ticket')->get();
        return $res;
    }


    public function del($id){
        $res=DB::table('ticket')->delete($id);
        return $res;
    }

    public function upd($id,$data){
        $res=DB::table('ticket')->where('id',$id)->update($data);
        return $res;
    }

    public function t_show($ticket_id){
        $res=DB::select("select * from ticket where id='$ticket_id'");
        return $res;
    }


    public function upd1($ticket_id,$ticket_num){
        $res=DB::table('ticket')->where('id',$ticket_id)->decrement('stock_num', $ticket_num);
        return $res;
    }


    public function getone($ticket_id)
    {
        $res=DB::select("select * from ticket where id='$ticket_id'");
        return $res;
    }
}