<?php

include_once ("includes/db.php");
include_once ("includes/users.php");
include_once ("includes/resturants.php");
include_once ("includes/meals.php");
    
 
header('Content-Type: application/json; charset=utf-8');

        if($_POST['action'] == "sign_up"){
            echo json_encode(sign_up());
        }
        else if($_POST['action'] == "login"){
            echo json_encode(login());
        }
        else if($_POST['action'] == "reset_password"){
            echo json_encode(reset_password());
        }
        else if($_POST['action'] == "get_resturants"){
            echo json_encode(get_resturants());
        }
        else if($_POST['action'] == "get_meals_for_resturant"){
            echo json_encode(get_meals_for_resturant());
        }
        else if($_POST['action'] == "get_all_meals"){
            echo json_encode(get_all_meals());
        }
        else if($_POST['action'] == "get_all_orders"){
            echo json_encode(get_all_orders());
        }
        else if($_POST['action'] == "get_uncomplete_orders"){
            echo json_encode(get_uncomplete_orders());
        }
        else if($_POST['action'] == "get_complete_orders"){
            echo json_encode(get_complete_orders());
        }
        else if($_POST['action'] == "edit_profile"){
            echo json_encode(edit_profile());
        }
        else if($_POST['action'] == "add_order"){
            echo json_encode(add_order());
        }
        else{
            echo json_encode(get_resturants());
            exit();
        }

        function sign_up(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $fullname = $_POST['fullname'];
            $mobile = $_POST['mobile'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            if(empty($fullname)){
               $return['results'] = false;
                $return['masseges'] = "يجب كتابة الإسم"; 
                return $return;
            }else if(empty($mobile)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة رقم الجوال";
                return $return;
            }else if(empty($password)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة كلمة مرور";
                return $return;
            }else if(empty($repassword)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة تأكيد كلمة المرور";
                return $return;
            }else if(empty($email)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة بريد إلكتروني";
                return $return;
            }else if(empty($address)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة العنوان";
                return $return;
            }
            if($repassword != $password){
                $return['results'] = false;
                $return['masseges'] = "كلمتا المرور غير متطابقتين";
                return $return;
            }
            $sql = $mysqli->query("SELECT * FROM `users` WHERE `phone` = '$mobile' ");
            if(mysqli_num_rows($sql)>0){
                $return['results'] = false;
                $return['masseges'] = "رقم الجوال المدخل مستخدم من قبل";
                return $return;
            }else{
                $user_addSql = ("INSERT INTO `users`( `name`, `phone`, `area`, `email`, `password`, `created_at`) VALUES ('$fullname','$mobile','$address','$email','$password',now())");

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
            }

            

            return $return;
        }
        function login(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $mobile = $_POST['mobile'];
            $password = $_POST['password'];
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
        function reset_password(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $mobile = $_POST['mobile'];
            $oldpassword = $_POST['oldpassword'];
            $newpassword = $_POST['newpassword'];
            $renewpassword = $_POST['renewpassword'];
            if(empty($oldpassword)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة كلمة المرور القديمة";
                return $return;
            }
            else if(empty($newpassword)){
                $return['results'] = false;
                $return['masseges'] = "يرجى إدخال كلمة مرور جديدة";
                return $return;
            }
            else if(empty($renewpassword)){
                $return['results'] = false;
                $return['masseges'] = " يرجى كتابة كلمة المرور الجديدة مرة أخرى";
                return $return;
            }
            else if($newpassword != $renewpassword){
                $return['results'] = false;
                $return['masseges'] = " كلمتا المرور غير متطابقتين";
                return $return;
            }
            $sql = $mysqli->query("SELECT * FROM `users` WHERE `phone` = '$mobile' ");
            $sql_info = $sql->fetch_assoc();
            if($sql_info){
                if($sql_info['password'] == $oldpassword){
                    $sql_update = "UPDATE `users` SET `password`='$newpassword' WHERE `phone` = '$mobile' ";
                        if($mysqli->query($sql_update)){
                            $return['results'] = true;
                            $return['masseges'] = " تم تغيير كلمة المرور";
                            return $return;
                        }
                }
                else{
                            $return['results'] = false;
                            $return['masseges'] = "كلمة المرور القديمة خاطئة";
                            return $return;
                }
            }else{
                $return['results'] = false;
                $return['masseges'] = "لا يوجد مستخدم بهذا الرقم";
                return $return;
            }
            
            
            
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
        function get_meals_for_resturant(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $resturant_id = $_POST['resturant_id'];
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
        function get_complete_orders(){
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
            $sql = $mysqli->query("SELECT m.name , m.details , m.price , m.image , m.rating , r.name as name_resturant FROM `orders` left join meals m ON m.id = orders.meal_id LEFT JOIN resturants r ON r.id = m.resturants_id WHERE user_id = '$user_id' and state = 1 ");
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
        function get_uncomplete_orders(){
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
            $sql = $mysqli->query("SELECT m.name , m.details , m.price , m.image , m.rating , r.name as name_resturant FROM `orders` left join meals m ON m.id = orders.meal_id LEFT JOIN resturants r ON r.id = m.resturants_id WHERE user_id = '$user_id' and state = 0 ");
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
        function edit_profile(){
            $db = app::getInstance();
            $mysqli = $db->getConnection();
            $mysqli->query("SET NAMES 'utf8';");
            $return = array();
            $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : NULL;
            $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : NULL;
            $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : NULL;
            $password = isset($_POST['password']) ? $_POST['password'] : NULL;
            $email = isset($_POST['email']) ? $_POST['email'] : NULL;
            $address = isset($_POST['address']) ? $_POST['address'] : NULL;
            if(empty($fullname)){
               $return['results'] = false;
                $return['masseges'] = "يجب كتابة الإسم"; 
                return $return;
            }else if(empty($user_id)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة رقم المستخدم";
                return $return;
            }else if(empty($mobile)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة رقم الجوال";
                return $return;
            }if(empty($email)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة بريد إلكتروني";
                return $return;
            }else if(empty($address)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة العنوان";
                return $return;
            }
            if(empty($password)){
                $return['results'] = false;
                $return['masseges'] = "يجب كتابة كلمة المرور";
                return $return;
            }
            $sql = $mysqli->query("SELECT * FROM `users` WHERE `id` = '$user_id'");
            $sql_info = $sql->fetch_assoc();
            if($sql_info['password'] != $password){
                $return['results'] = false;
                $return['masseges'] = "كلمة المرور المدخلة غير صحية";
                return $return;
            }
            $sql = $mysqli->query("SELECT * FROM `users` WHERE `phone` = '$mobile' and id != '$user_id' ");
            if(mysqli_num_rows($sql)>0){
                $return['results'] = false;
                $return['masseges'] = "رقم الجوال المدخل مستخدم من قبل";
                return $return;
            }else{
                $user_addSql = ("UPDATE `users` SET `name`='$fullname',`phone`='$mobile',`area`='$address',`email`='$email',`updateed_at`= now() WHERE id = '$user_id'");

                if($mysqli->query($user_addSql)){
                    $return['results'] = true;
                    $return['masseges'] = "تم التعديل بنجاح";
                    return $return;
                }
                else{
                    $return['results'] = false;
                    $return['masseges'] = "لم يتم التعديل بنجاح";
                    return $return;
                }
            }

            

            return $return;
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