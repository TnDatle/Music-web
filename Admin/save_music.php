<?php
require_once('db_connect.php');

extract($_POST);
$data = "";
foreach($_POST as $k => $v){
    if(!in_array($k,['id'])){
        $v = $conn->real_escape_string($v);
        if(!empty($data)) $data .=", ";
        $data .= "`{$k}` = '{$v}'";
    }
}
if(!empty($_FILES['audio']['tmp_name'])){
    $filename = $_FILES['audio']['name'];
    $filename = str_replace(" ","_",$filename);
    $i = -1;
    while(true){
        if($i > -1)
        $filename = $i."_".$filename;
        if(is_file('../Admin/audio/'.$filename))
        $i++;
        else
        break;
    }
    $file = $_FILES['audio']['tmp_name'];
    $type = mime_content_type($file);
    $type2 =  $_FILES['audio']['type'];
    if(strpos($type,"audio/") > -1 || strpos($type2,"audio/") > -1){
        $move = move_uploaded_file($file,'./audio/'.$filename);
        if(!$move){
            $resp['status'] = 'failed';
            $resp['msg'] = 'Audio file updload failed';
            $resp['error'] = $conn->error;
        }else{
            $data .= ", `audio_path` = CONCAT('../Admin/audio/{$filename}?v=',unix_timestamp(CURRENT_TIMESTAMP))";
        }

    }else{
        $resp['status'] = 'failed';
        $resp['msg'] = 'Invalid Audio file';
        $resp['error'] = $type;
        $resp['file'] = $_FILES;
    }
}

if(!isset($resp['status'])){
    if(empty($id)){
        $sql = "INSERT INTO `tbl_music` set {$data}";
    }else{
        $sql = "UPDATE `tbl_music` set {$data} where id = '{$id}'";
    }
    $save = $conn->query($sql);
    if($save){
        $mid = !empty($id) ? $id : $conn->insert_id;
        $resp['status'] = 'success';
        $resp['msg'] = ' Audio Data successfully saved';

        if(!empty($_FILES['img']['tmp_name'])){
            $filename = $_FILES['img']['name'];
            $filename = str_replace(" ","_",$filename);
            $file = $_FILES['img']['tmp_name'];
            $type = mime_content_type($file);
            $i = -1;
            while(true){
                $unique_filename = uniqid() . "_" . $filename; // Tạo tên tệp duy nhất
                if(is_file('../Admin/images/'.$unique_filename))
                    $i++;
                else
                    break;
            }
            if(strpos($type,"image/") > -1){
                $move = move_uploaded_file($file,"../Admin/images/".$unique_filename); // Di chuyển tệp với tên duy nhất
                if($move){
                    $conn->query("UPDATE `tbl_music` set image_path = CONCAT('../Admin/images/{$unique_filename}?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$mid}'");
                }else{
                    $data['msg'].= " But Image has failed to upload.";
                }
            }
        }

    }else{
        $resp['status'] = 'failed';
        $resp['msg'] = 'An error occurred while saving the data.';
        $resp['error'] = $conn->error;
        
    }
}

    
echo json_encode($resp);