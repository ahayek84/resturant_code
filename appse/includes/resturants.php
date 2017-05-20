<?php include_once "db.php";

function get_all_deposited(){
    $db = Watany::getInstance();
    $mysqli = $db->getConnection();
    $mysqli->query("SET NAMES 'utf8';");
    $return = array();
    $rows = $mysqli->query("SELECT `id`,CONCAT(`f_name`, `m_name`, `l_name`) as name FROM `deposited`");
//    $owes_info = $sql->fetch_array();
//    $return['records'] = $owes_info;
//    $return['result'] = true;
    
    
     $owes_name=array();
     while ($row = $rows->fetch_assoc()){
	   $owes_name[]=$row;
      }
    
    $return['result'] = true;
    $return['records'] = $owes_name;
    $mysqli->close();
    return $return;
}

function deposited_add(){

    $db = Watany::getInstance();
    $mysqli = $db->getConnection();
    $mysqli->query("SET NAMES 'utf8';");
    $return = array();
    $deposited_f_name = $_POST['deposited_f_name'];
    $deposited_m_name = $_POST['deposited_m_name'];
    $deposited_l_name = $_POST['deposited_l_name'];
    $deposited_address = $_POST['deposited_phone1'];
    $deposited_phone1 = $_POST['deposited_phone1'];
    $deposited_phone2 = isset($_POST['deposited_phone2']) ? $_POST['deposited_phone2'] : NULL;
    $deposited_note = isset($_POST['deposited_note']) ? $_POST['deposited_note'] : NULL;

    if($deposited_f_name == ''){
        $return['results'] = false;
        $return['masseges'] = "الإسم الأول مطلوب";
        return $return;
    }
    if($deposited_m_name == ''){
        $return['results'] = false;
        $return['masseges'] = "إسم الأب مطلوب";
        return $return;
    }
    if($deposited_l_name == ''){
        $return['results'] = false;
        $return['masseges'] = "ااسم العائلة مطلوب";
        return $return;
    }

    if($deposited_phone1 == ''){
        $return['results'] = false;
        $return['masseges'] = "رقم الجوال 1 مطلوب";
        return $return;
    }
    if($deposited_address == ''){
        $return['results'] = false;
        $return['masseges'] = "العنوان مطلوب";
        return $return;
    }


    $sql = $mysqli->query("SELECT * FROM `deposited` WHERE `f_name` like '%$deposited_f_name%' and `m_name` like '%$deposited_m_name%' and `l_name` like '%$deposited_l_name%'");
    if(mysqli_num_rows($sql) > 0){
        $return['results'] = false;
        $return['masseges'] = " الإسم موجود مسبقا";
        return $return;
    }

    $sql = $mysqli->query("SELECT * FROM `deposited` WHERE `phone1` = '$deposited_phone1'");
    if(mysqli_num_rows($sql) > 0){
        $return['results'] = false;
        $return['masseges'] = "رقم الجوال 1 موجود مسبقا";
        return $return;
    }
    if($deposited_phone2 != ''){
        $sql = $mysqli->query("SELECT * FROM `owes` WHERE `phone2` = '$deposited_phone2'");
        if(mysqli_num_rows($sql) > 0){
            $return['results'] = false;
            $return['masseges'] = "رقم الجوال 2 موجود  مسبقا";
            return $return;
        }
    }



    $deposited_addSql = ("INSERT INTO deposited( f_name, m_name, l_name, address, phone1, phone2, note, created_at) VALUES
                                  ('$deposited_f_name','$deposited_m_name','$deposited_l_name','$deposited_address','$deposited_phone1','$deposited_phone2','$deposited_note',now())");
    if($mysqli->query($deposited_addSql)){
        $return['results'] = true;
        $return['masseges'] = "تم الإضافة بنجاح";
    }
    else{
        $return['results'] = false;
        $return['masseges'] = "لم يتم الإضافة بنجاح";
    }

    return $return;
}

function add_dozens(){

    $db = Watany::getInstance();
    $mysqli = $db->getConnection();
    $mysqli->query("SET NAMES 'utf8';");
    $return = array();
    $deposted_id = $_POST['deposited_id'];
    $count_needs = $_POST['num_dozens_needs'];
    $dozens_addSql = ("INSERT INTO `deposited_needs`(`dep_id`, `count_dozens`,`note`, `created_at`) VALUES ('$deposted_id', '$count_needs' , ' ',now())");
    if($mysqli->query($dozens_addSql)){
        $return['results'] = true;
        $return['masseges'] = "تم الإضافة بنجاح";
    }
    else{
        $return['results'] = false;
        $return['masseges'] = "لم يتم الإضافة بنجاح";
    }
    
    return $return;
}
function get_all_deposited_needs(){
    $db = Watany::getInstance();
    $mysqli = $db->getConnection();
    $mysqli->query("SET NAMES 'utf8';");
    $return = array();
    $deposited_needs_id = $_POST['id'];
    $rows = $mysqli->query("SELECT  sum(count_dozens) as dozens FROM `deposited_needs` where dep_id = '$deposited_needs_id' and if_back = 0");

    $count_needs = $rows->fetch_assoc();

    if($count_needs){
        if($count_needs['dozens']==0 or is_null($count_needs['dozens'])){
            $count_needs['dozens'] = 0 ;
        }
        $return['records'] = $count_needs;
        return $return;
    }
    
     
    $mysqli->close();
    
}
?>
