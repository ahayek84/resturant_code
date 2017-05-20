<?php

include_once ("includes/db.php");
   
 
header('Content-Type: application/json; charset=utf-8');

if($_POST['action'] == "get_all_orders"){
            echo json_encode(get_all_orders());
        }
        else{
            echo json_encode(get_all_orders());
            exit();
        }
function get_all_orders(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL;
            if(empty($user_id) or is_null($user_id)){
                $return['results'] = false;
                $return['masseges'] = "يجب ارسال رقم المستخدم";
                return $return;
            }
            $return = array();
            $sql = $mysqli->query("SELECT state, m.name , m.details , m.price , m.image , m.rating , r.name as name_resturant FROM `orders` left join meals m ON m.id = orders.meal_id LEFT JOIN resturants r ON r.id = m.resturants_id WHERE user_id = '$user_id' ");
            $orders=array();
            while ($row = $sql->fetch_assoc()){
                $orders[]=$row;
            }
            if($sql){
                $return['results'] = true;
                $return['orders'] = $orders;
                $return['masseges'] = " تم جلب البيانات بنجاح";
            }
            else{
                $return['results'] = false;
                $return['masseges'] = "خطأ في جلب البيانات";
            }
            return $return;

        }

?>