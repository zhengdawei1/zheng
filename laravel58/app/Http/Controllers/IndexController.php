<?php

namespace App\Http\Controllers;


use App\Jobs\Queue;

class IndexController extends Controller
{

    public function index()
    {
        $data=[
            [1,2,3],
            [4,5,6]
        ];
        foreach ($data as $item) {
            $this->dispatch(new Queue($item));
        }
        return response()->json(['code'=>0, 'msg'=>"success"]);
    }

}