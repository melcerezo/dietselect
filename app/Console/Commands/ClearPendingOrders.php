<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notification;
use Illuminate\Mail as mailer;
use App\Foodie;
use App\Chef;
use App\Order;
use Carbon\Carbon;

class ClearPendingOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dietselect:pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear pending orders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

//        $saturday=Carbon::now();
//        $dt = Carbon::now();
//        $monday=$dt->startOfWeek();

        $pendingOrders = Order::where('is_paid','=',0)
            ->where('foodie_id','=',22)
//            ->where('is_cancelled','=',0)
//            ->join('order_items','order_items.order_id','=','orders.id')
//            ->where('orders.is_created','>',$monday)
//            ->where('orders.is_created','<',$saturday)
//            ->select('*','orders.is_created as it_time')
            ->get();

        foreach($pendingOrders as $item){
//            $item->is_cancelled=1;
//            $item->save();
            $messageFoodie = 'Your order is: '.$item->created_at->format('F d, Y h:i A');
//            $messageFoodie = 'Hello, your order is: on'. $pendingOrders->it_time;
            $foodiePhoneNumber = '0'.$item->foodie->mobile_number;
            $urlFoodie = 'https://www.itexmo.com/php_api/api.php';
            $itexmoFoodie = array('1' => $foodiePhoneNumber, '2' => $messageFoodie, '3' => 'PR-DIETS656642_VBVIA');
            $paramFoodie = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($itexmoFoodie),
                ),
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ),
            );
            $contextFoodie = stream_context_create($paramFoodie);
            file_get_contents($urlFoodie, false, $contextFoodie);


//        dd($foodie);

        }
//        $mobileNumber = $item->foodie->mobile_number;
//

    }
}
