<?php

include_once ("app_db.php");
   
 
header('Content-Type: application/json; charset=utf-8');
if($_POST['action'] == "sign_up"){
            echo json_encode(sign_up());
        }
        else{
            echo json_encode(sign_up());
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
            $sql = $mysqli->query("SELECT * FROM `delivery_user` WHERE `phone` = '$mobile' ");
            if(mysqli_num_rows($sql)>0){
                $return['results'] = false;
                $return['masseges'] = "رقم الجوال المدخل مستخدم من قبل";
                return $return;
            }else{
                $user_addSql = ("INSERT INTO `delivery_user`( `name`, `phone`, `area`, `email`, `password`, `created_at`) VALUES ('$fullname','$mobile','$address','$email','$password',now())");

                if($mysqli->query($user_addSql)){
                    $return['results'] = true;
                    $return['masseges'] = ".....تم الإضافة بنجاح";
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

?>