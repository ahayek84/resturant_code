<?php

include_once ("includes/db.php");
   
 
header('Content-Type: application/json; charset=utf-8');

        
            echo json_encode(login());
       

        
        function login(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $mobile = $_GET['mobile'];
            $password = $_GET['password'];
            if(empty($mobile)){
                $return['results'] = false;
                $return['masseges'] = " يجب كتابة رقم الجوال";
                return $return;
            }
            else if(empty($password)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة كلمة مرور";
                return $return;
            }
            $sql = $mysqli->query("SELECT * FROM `users` WHERE `phone` = '$mobile' and  `password` = '$password'");
            $sql_info = $sql->fetch_assoc();
            if($sql_info){
                $return['results'] = true;
                $return['user_info'] = $sql_info;
                $return['masseges'] = "تم تسجيل الدخول بنجاح";
                return $return;
            }else{
                $return['results'] = false;
                $return['masseges'] = "خطأ في تسجيل الدخول";
                return $return;
            }
        }
        
        
?>