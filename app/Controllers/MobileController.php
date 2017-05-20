<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderMenuItem;
use App\Models\Restaurant;

class MobileController extends Controller{

  public function viewMobileMenu($request, $response){
    $menu = Menu::all();
    return $this->view->render($response, 'mobilemenu.php', array('menu' => $menu));
  }
  public function viewMobileMenuToOne($request, $response, $args){
    $id = $args['id'];
    $menu = Menu::where('restaurant_id', $id)->get();;
    return $this->view->render($response, 'mobilemenu.php', array('menu' => $menu));
  }

  public function viewMobileMenuItemById($request, $response){
    $id = $request->getParam('MENU_ID');
    $menu_items = MenuItem::where('menu_id', $id)->get();
    return $this->view->render($response, 'mobilemenuitem.php', array('menuitems' => $menu_items));
  }
  public function setStatus($request, $response , $args){
    $id = $args['id'];
    $order = Order::where('order_id', $id)->first();
    
    
    if($order->admin_status == 1){
    Order::where('order_id', $id)->update(['status' => 'Done']);
    return $this->view->render($response, 'Done.php', array('status' => array("success" => 1, "message" => 'Done Acept Delivery')));
    }
    else{
    return $this->view->render($response, 'Done.php', array('status' => array("success" => 0, "message" => 'no Acept Admin')));
    }
    }
    public function setStatusAdmin($request, $response , $args){
    $id = $args['id'];
    $order = Order::where('order_id', $id)->get();
    
    
    if(Order::where('order_id', $id)->update(['admin_status' => '1']) and Order::where('order_id', $id)->update(['status' => 'pendding'])){
    return $this->view->render($response, 'Done.php', array('status' => array("success" => 1, "message" => 'Done Acept Admin')));
    }
    else{
    return $this->view->render($response, 'Done.php', array('status' => array("success" => 0, "message" => 'can nott Done Acept Admin')));
    }
    
    
    
    
  }
  
  public function viewAllMobileOrderHistory($request, $response){
    $orderHistory = Order::orderBy('order_id', 'desc')->get();
    for($i = 0; $i < count($orderHistory); $i++){
    	if($orderHistory[$i]['restaurant_id'] != 0){
    	$restaurant = Restaurant::where('restaurant_id', $orderHistory[$i]['restaurant_id'])->first();
    	$user_info = User::where('id', $orderHistory[$i]['user_id'])->first();
       $orderHistory[$i]['restaurantName'] = $restaurant['name'];
       $orderHistory[$i]['user_name'] = $user_info['username'] ;
       $orderHistory[$i]['user_email'] = $user_info['email'] ;
       $orderHistory[$i]['user_address'] = $user_info['address'] ;
       $orderHistory[$i]['user_phone'] = $user_info['phone_number'] ;
    	}else{
    	$orderHistory[$i]['restaurantName'] = "unknown";
    	}
       
     }
    return $this->view->render($response, 'allorders.php', array('order_history' => $orderHistory));  
  }
  public function viewAllMobileOrderHistoryAdmin($request, $response){
    $orderHistory = Order::where('admin_status','0')->orderBy('order_id', 'desc')->get();
    for($i = 0; $i < count($orderHistory); $i++){
    	if($orderHistory[$i]['restaurant_id'] != 0){
    	$restaurant = Restaurant::where('restaurant_id', $orderHistory[$i]['restaurant_id'])->first();
    	$user_info = User::where('id', $orderHistory[$i]['user_id'])->first();
       $orderHistory[$i]['restaurantName'] = $restaurant['name'];
       $orderHistory[$i]['user_name'] = $user_info['username'] ;
       $orderHistory[$i]['user_email'] = $user_info['email'] ;
       $orderHistory[$i]['user_address'] = $user_info['address'] ;
       $orderHistory[$i]['user_phone'] = $user_info['phone_number'] ;
    	}else{
    	$orderHistory[$i]['restaurantName'] = "unknown";
    	}
       
     }
    return $this->view->render($response, 'allorders.php', array('order_history' => $orderHistory));  
  }
  public function viewAllMobileOrderHistoryDelivery($request, $response){
    $orderHistory = Order::where('admin_status','1')->where('status', '<>', 'Done')->orderBy('order_id', 'desc')->get();
    for($i = 0; $i < count($orderHistory); $i++){
    	if($orderHistory[$i]['restaurant_id'] != 0){
    	$restaurant = Restaurant::where('restaurant_id', $orderHistory[$i]['restaurant_id'])->first();
    	$user_info = User::where('id', $orderHistory[$i]['user_id'])->first();
       $orderHistory[$i]['restaurantName'] = $restaurant['name'];
       $orderHistory[$i]['user_name'] = $user_info['username'] ;
       $orderHistory[$i]['user_email'] = $user_info['email'] ;
       $orderHistory[$i]['user_address'] = $user_info['address'] ;
       $orderHistory[$i]['user_phone'] = $user_info['phone_number'] ;
    	}else{
    	$orderHistory[$i]['restaurantName'] = "unknown";
    	}
       
     }
    return $this->view->render($response, 'allorders.php', array('order_history' => $orderHistory));  
  }

  public function viewMobileUserOrderHistory($request, $response, $args){
     $id = $args['id'];
     $allOrders = array();
     $order_menu = OrderMenuItem::where("order_id", $id)->get();
     for($i = 0; $i < count($order_menu); $i++){
       $menuItems = MenuItem::where('menu_item_id', $order_menu[$i]['menu_item_id'])->first();
       
       $order_name = array(
           'id' => $order_menu[$i]['order_id'],
           "orderName" => $menuItems['item_name'], 
           'quantity' => $order_menu[$i]['quantity'],
           'price' => $order_menu[$i]['price'],
           'extra' => $order_menu[$i]['options'],
           'note' => $order_menu[$i]['notes']
        );
        $allOrders[$i] = $order_name;
     }
     return $this->view->render($response, 'mobileorderhistory.php', array('user_order' => $allOrders));
  }

  public function viewMobileHotDeal($request, $response){
    $menu_items = MenuItem::where('hot_deal', 1)->get();
    return $this->view->render($response, 'mobilehotdeal.php', array('menu_items' => $menu_items));
  }
  
  public function editUserPassword($request, $response){
   // $id = $request->getParam("USER_ID");
    
	$EMAIL = $request->getParam('EMAIL');
	$OLD_PASSWORD = $request->getParam('OLD_PASSWORD');
	$NEW_PASSWORD = $request->getParam('NEW_PASSWORD');
	$mNEW_PASSWORD  = md5($NEW_PASSWORD );
	$user_info = User::where('email', $EMAIL)->first();
	
	if(md5($OLD_PASSWORD) == $user_info['password']){
	User::where("email", $EMAIL)->update(['password' => $mNEW_PASSWORD]);
	return $this->view->render($response, 'mobileuseredit.php', array('profile' => array('success' => 1)));
	}else{
	return $this->view->render($response, 'mobileuseredit.php', array('profile' => array('success' => 0)));
	}

	
    
  }
  public function editUserProfile($request, $response){
   // $id = $request->getParam("USER_ID");
    $username = $request->getParam('USERNAME');
	$email = $request->getParam('EMAIL');
	$address = $request->getParam('ADDRESS');
	$phone = $request->getParam('PHONE_NUMBER');

	//update user information
    User::where("email", $email)->update(['username' => $username, 'email' => $email, 'address' => $address, 'phone_number' => $phone]);
    return $this->view->render($response, 'mobileuseredit.php', array('profile' => array('success' => 1)));
  }
  
  public function addOrderFromMobileUser($request, $response){
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
