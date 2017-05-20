<?php

include_once ("includes/db.php");
   
 
header('Content-Type: application/json; charset=utf-8');

if($_POST['action'] == "reset_password"){
            echo json_encode(reset_password());
        }
        else{
            echo json_encode(reset_password());
            exit();
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
?>