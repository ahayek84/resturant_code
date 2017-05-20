<?php

include_once ("includes/db.php");
   
 
header('Content-Type: application/json; charset=utf-8');

            echo json_encode(get_meals_for_resturant());
            
function get_meals_for_resturant(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $resturant_id = $_GET['resturant_id'];
if(empty($resturant_id )){
                $return['results'] = false;
                $return['masseges'] = " يجب كتابة رقم المطعم";
                return $return;
            }
            $sql = $mysqli->query("SELECT * FROM `meals` WHERE `resturants_id` = '$resturant_id' ");
            $meals_names=array();
            while ($row = $sql->fetch_assoc()){
                $meals_names[]=$row;
            }
            if($sql){
                $return['results'] = true;
                $return['meals'] = $meals_names;
                $return['masseges'] = " تم جلب البيانات بنجاح";
            }
            else{
                $return['results'] = false;
                $return['masseges'] = "خطأ في جلب البيانات";
            }
            return $return;
            
        }