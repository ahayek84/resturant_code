<?php

include_once ("includes/db.php");
   
 
header('Content-Type: application/json; charset=utf-8'); 
add_order();
if($_POST['action'] == "add_order"){
            echo json_encode(login());
        }
        else{
            echo json_encode(login());
            exit();
        }
function add_order(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL;
            $meal_id = isset($_POST['meal_id']) ? $_POST['meal_id'] : NULL;
            if(empty($meal_id)){
               $return['results'] = false;
                $return['masseges'] = "يجب إختيار الوجبة "; 
                return $return;
            }else if(empty($user_id)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة رقم المستخدم";
                return $return;
            }
            $user_addSql = ("INSERT INTO `orders`(`user_id`, `meal_id`, `created_at`) VALUES ('$user_id','$meal_id',now())");
                if($mysqli->query($user_addSql)){
                    $return['results'] = true;
                    $return['masseges'] = "تم الإضافة بنجاح";
                    return $return;
                }
                else{
                    $return['results'] = false;
                    $return['masseges'] = "لم يتم الإضافة بنجاح";
                    return $return;
                }
            return $return;
        
        }
?>