<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Order;


class OrderController extends Controller{


  public function viewOrders($request, $response){
    if(!$this->auth->check()){
     return $response->withRedirect($this->router->pathFor('home'));
    }

    $order = Order::all();
    return $this->view->render($response, 'order.php', array('order' => $order));
  }

  public function viewSingleOrders($request, $response, $args){
    if(!$this->auth->check()){
     return $response->withRedirect($this->router->pathFor('home'));
    }
    $id = $args['id'];
    $singleOrder = Order::where('order_id', $id)->first();
    return $this->view->render($response, 'singleorder.php', array('order' => $singleOrder));
  }




}
