<?php

namespace App\Http\Controllers;

use App\Jobs\QueuedTest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Jobs\Queue;

class QueuedController extends Controller
{
    public function Test(){

        $arr=array(
            'time'=>time()
        );

        $this->dispatch(new Queue($arr));
    }
}