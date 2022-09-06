<?php
$array=[];
if(isset($_POST['submit'])){
    $countfiles = count($_FILES['design']['name']);
    for($i=0;$i<$countfiles;$i++){
        // $filename = $_FILES['design']['name'][$i];
        // $tmp_path  = $_FILES[$fname]["tmp_name"][$i];
        $extension = pathinfo($_FILES['design']['name'][$i], PATHINFO_EXTENSION);
        $file_name = $_FILES['design']['name'][$i].date("YmdHis").md5(session_id()). "." . $extension;
        $file_dir_path = "design_up/".$file_name;
        move_uploaded_file($_FILES['design']["tmp_name"][$i], $file_dir_path );
        // echo $file_dir_path;
        $array[]=$file_dir_path;
        // echo $array[$i];
        $json = json_encode($array, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
 }}
// echo $array[1];
echo $json;



?>
<form method='post' action='' enctype='multipart/form-data'>
<input type="file" name="design[]" id="file" multiple>
<input type='submit' name='submit' value='Upload'>
</form>