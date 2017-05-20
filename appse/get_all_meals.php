<?php

include_once ("includes/db.php");
   
 
header('Content-Type: application/json; charset=utf-8');
if($_POST['action'] == "get_all_meals"){
            echo json_encode(get_all_meals());
        }
        else{
            echo json_encode(get_all_meals());
            exit();
        }
function get_all_meals(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $sql = $mysqli->query("SELECT m.name , m.details , m.price , m.image , m.rating , r.name as name_resturant FROM `meals` as m LEFT JOIN resturants as r on r.id = m.resturants_id ");
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

?>