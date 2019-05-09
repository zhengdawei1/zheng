<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Orders;
use App\Http\Models\Ticket;
use Illuminate\Support\Facades\Mail;
class Queue  implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;

    /**
     * Queue constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data=$this->data;
        $ticket_id=$data['ticket_id'];
        $ticket_num=$data['ticket_num'];
        $ticket_name=$data['ticket_name'];
        unset($data['ticket_id']);
        $ticket=new Ticket();
        $orders=new Orders();
        $re=$ticket->getone($ticket_id);
        $stock_num=$re[0]->stock_num;
        if($stock_num>0)
        {
            $res=$orders->index($data);
            if($res)
            {
                $res1=$ticket->upd1($ticket_id,$ticket_num);
                if($res1)
                {
                    echo 'yes';
                    echo "'$ticket_num','$ticket_name'";
                    Mail::raw("购买成功",function($message){
                        $to="18601769931@163.com";
                        $message->to($to)->subject("您已订购成功");
                    });
                }
            }
        }
       else
       {
            echo 'no';
        }
    }
}