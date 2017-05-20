<?php include_once "db.php";


/*function sign_up()
{

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
    }else if(empty($mobile)){
        $return['results'] = false;
        $return['masseges'] = "يجب كتابة رقم الجوال";
    }else if(empty($password)){
        $return['results'] = false;
        $return['masseges'] = "يجب كتابة كلمة مرور";
    }else if(empty($repassword)){
        $return['results'] = false;
        $return['masseges'] = "يجب كتابة تأكيد كلمة المرور";
    }else if(empty($email)){
        $return['results'] = false;
        $return['masseges'] = "يجب كتابة بريد إلكتروني";
    }else if(empty($address)){
        $return['results'] = false;
        $return['masseges'] = "يجب كتابة العنوان";
    }
    if($repassword != $password){
        $return['results'] = false;
        $return['masseges'] = "كلمتا المرور غير متطابقتين";
    }
    $sql = $mysqli->query("SELECT * FROM `users` WHERE `phone` = '$mobile' ");
    if(mysqli_num_rows($sql)>0){
        $return['results'] = false;
        $return['masseges'] = "رقم الجوال المدخل مستخدم من قبل";
    }
    
    $user_addSql = ("INSERT INTO `users`( `name`, `phone`, `area`, `email`, `password`, `created_at`) VALUES ('$fullname','$mobile','$address','$email','$password',now())");
    
    if($mysqli->query($user_addSql)){
        $return['results'] = true;
        $return['masseges'] = "تم الإضافة بنجاح";
    }
    else{
        $return['results'] = false;
        $return['masseges'] = "لم يتم الإضافة بنجاح";
    }
    
    return $return;
}
*/
?>
