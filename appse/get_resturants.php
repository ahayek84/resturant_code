<?php

include_once ("app_db.php");
   
 
header('Content-Type: application/json; charset=utf-8');

if($_POST['action'] == "get_resturants"){
            echo json_encode(get_resturants());
        }
        else{
            echo json_encode(get_resturants());
            exit();
        }
function get_resturants(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $sql = $mysqli->query("SELECT * FROM `resturants` ");
            $resturants_names=array();
            while ($row = $sql->fetch_assoc()){
                $resturants_names[]=$row;
            }
            if($sql){
                $return['results'] = true;
                $return['resturants'] = $resturants_names;
                $return['masseges'] = " تم جلب البيانات بنجاح";
            }
            else{
                $return['results'] = false;
                $return['masseges'] = "خطأ في جلب البيانات";
            }
            return $return;
        }
?>