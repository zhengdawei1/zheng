<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model{
    public function index($data){
        $res=DB::table('orders')->insert($data);
        return $res;
    }

}