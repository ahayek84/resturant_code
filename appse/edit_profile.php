<?php

include_once ("includes/db.php");
   
 
header('Content-Type: application/json; charset=utf-8');
if($_POST['action'] == "edit_profile"){
            echo json_encode(edit_profile());
        }
        else{
            echo json_encode(edit_profile());
            exit();
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

?>