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

        $saturday=Carbon::now();
        $dt = Carbon::now();
        $monday=$dt->startOfWeek();

        $pendingOrders = Order::where('is_paid','=',0)
            ->where('is_cancelled','=',0)
            ->where('foodie_id','=',22)
            ->where('created_at','>',$monday)
            ->where('created_at','<',$saturday)
            ->get();

        foreach($pendingOrders as $item){
            $item->is_cancelled=1;
            $item->save();

            $foodnotif = new Notification();
            $foodnotif->sender_id = 0;
            $foodnotif->receiver_id = $item->foodie->id;
            $foodnotif->receiver_type = 'f';
            $foodnotif->notification = 'Your order on '.$item->created_at->format('F d, Y h:i A').' has been cancelled due to your failure to pay ';
            $foodnotif->notification .= 'before ' . $saturday . ' 3:00pm.';
            $foodnotif->notification_type = 3;
            $foodnotif->save();

            $messageFoodie = 'Your order on '.$item->created_at->format('F d, Y h:i A').' has been cancelled';
            $messageFoodie .= ' because you failed to pay before '.$saturday->format('F d, Y').' 3:00pm.';
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

            $orderItems = $item->order_item()->get();
            $arrayChef=[];
            foreach($orderItems as $orderItem){
                $arrayChef[]=$orderItem->chef_id;
                if($orderItem->is_cancelled == 0){
                    $orderItem->is_cancelled=1;
                    $orderItem->save();
                }
            }
            $uniqueChef=array_unique($arrayChef);

            foreach($uniqueChef as $chefUn){
                $planName=[];
                foreach($orderItems as $orderItem){
                    if($orderItem->chef_id==$chefUn){
                        $planName[] = $orderItem->plan->plan_name;
                        if ($orderItem->is_customized == 0) {
                            $planName[] .= '- Standard';
                        } elseif ($orderItem->is_customized == 1) {
                            $planName[] .= '- Custom';
                        }
                    }
                }
                $chef = Chef::where('id','=',$chefUn)->first();
                $foodie =$item->foodie->first_name.' '.$item->foodie->last_name;

                $chefnotif = new Notification();
                $chefnotif->sender_id = 0;
                $chefnotif->receiver_id = $chef->id;
                $chefnotif->receiver_type = 'c';
                $chefnotif->notification = $foodie. '\'s order for: ';
                foreach ($planName as $pName) {
                    $chefnotif->notification .= $pName . ' ';
                }
                $chefnotif->notification .= 'has been cancelled due to failure to pay before '.$saturday.' 3:00pm.';
                $chefnotif->notification_type = 3;
                $chefnotif->save();

                $messageChef = $foodie.'\'s order for: ';
                foreach ($planName as $pName) {
                    $messageChef .= $pName . ' ';
                }
                $messageChef.='has been cancelled due to no payment before '.$saturday->format('F d, Y').' 3:00pm.';
                $chefPhoneNumber = '0'.$chef->mobile_number;
                $urlChef = 'https://www.itexmo.com/php_api/api.php';
                $itexmoChef = array('1' => $chefPhoneNumber, '2' => $messageChef, '3' => 'PR-DIETS656642_VBVIA');
                $paramChef = array(
                    'http' => array(
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($itexmoChef),
                    ),
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                    ),
                );
                $contextChef = stream_context_create($paramChef);
                file_get_contents($urlChef, false, $contextChef);
            }

//        dd($foodie);

        }
//        $mobileNumber = $item->foodie->mobile_number;
//

    }
}
