<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderMenuItem;
use App\Models\Restaurant;

class SMSController extends Controller{

  public function SendSMS($request,$response,$args){
    $id = $args['id'];
    $mobile = $id;
    $message = $args['msg'];
  //  $msg = $args['msg'];
    $gClient =  new \GuzzleHttp\Client();
    $gClient->request('POST', 'https://protective-river.glitch.me/sms', [
            'form_params' => [
                'to'      => $mobile,
                'message' => $message,
            ],
        ]);
    /*var_dump($res);*/
    echo "hi";

  }

   public function GetMessageLog($request){
    $req = $request->getParam("From");
    if (!isset($req)) {
    $req = 'null';
    }
    $place_order = new Order(array(
      'user_id' => 26,
      'restaurant_id' => 1,
      'order_quantity' => 1,
      'order_price' => 40,
      'order_date' => date("Y-m-d"),
      'status' => $req,
      'payment_method' => 'test from mobile'
    ));
    $place_order->save();
    echo "hi";
   }

  public function addOrderFromTwilio($request, $response){
    $user_id = $request->getParam("USER_ID");
    $order_quantity = $request->getParam('QUANTITY');
    $order_price = $request->getParam('PRICE');
    $payment_method = $request->getParam('PAYMENT');
    
    $restaurant_id = $request->getParam('restaurant_id');
    $status = "Order has been placed";
    $orderdate = date("Y-m-d H:i:s");

    $order_menu_item = $request->getParam("ORDER_LIST");

    $place_order = new Order(array(
      'user_id' => $user_id,
      'restaurant_id' => $restaurant_id,
      'order_quantity' => $order_quantity,
      'order_price' => $order_price,
      'order_date' => $orderdate,
      'status' => $status,
      'payment_method' => $payment_method
    ));
    $place_order->save();
    
    $order_index = $place_order->order_id;
    //$ord = '[{"extra":"","id":1,"note":"","orderName":"Fried Rice with Sauce","price":30.0,"quantity":1}]';
    $orderJsonList = json_decode($order_menu_item, true);
    

    for($i = 0; $i < count($orderJsonList); $i++){
      $menu_id = $orderJsonList[$i]['id'];
      $menu_item_name = $orderJsonList[$i]['orderName'];
      $price = $orderJsonList[$i]['price'];
      $quantity = $orderJsonList[$i]['quantity'];
      $extra = $orderJsonList[$i]['extra'];
      $note = $orderJsonList[$i]['note'];

      $subtotal = $price * $quantity;

      $saveOrderMenu = new OrderMenuItem(array(
        'order_id' => $order_index,
        'menu_item_id' => $menu_id,
        'quantity' => $quantity,
        'price' => $price,
        'subtotal' => $subtotal,
        'options' => $extra,
        'notes' => $note
      ));
      $saveOrderMenu->save();
    }
    
     return $this->view->render($response, 'placeorder.php', array('success' => array('success' => 1)));
  }

 
}
