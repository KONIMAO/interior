<?php
session_start();
include("funcs.php");
sschk();
$pdo = db_conn();

$array=[];
if(isset($_POST['submit'])){
    $countfiles = count($_FILES['design']['name']);
    for($i=0;$i<$countfiles;$i++){
        // $filename = $_FILES['design']['name'][$i];
        // $tmp_path  = $_FILES[$fname]["tmp_name"][$i];
        $extension = pathinfo($_FILES['design']['name'][$i], PATHINFO_EXTENSION);
        $file_name = date("YmdHis").md5(session_id()).$_FILES['design']['name'][$i];
        $file_dir_path = "design_up/".$file_name;
        move_uploaded_file($_FILES['design']["tmp_name"][$i], $file_dir_path );
        // echo $file_dir_path;
        $array[]=$file_dir_path;
        // echo $array[$i];
        $json = json_encode($array, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
 }}

//1. POSTデータ取得
$id   = $_POST["id"];
$title   = $_POST["title"];
$name   = $_POST["name"];
$email  = $_POST["email"];
$movie  = $_POST["movie"];
$layout  = $_POST["layout"];
$roomtype  = $_POST["roomtype"];
$comment = $_POST["comment"];
$genre= $_POST["genre"];
$img   = fileUpload("upfile","upload");
$design   = $json;

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table(id, title, name, email, movie, layout, roomtype, comment, genre, img, design, indate )VALUES(:id, :title, :name, :email, :movie, :layout, :roomtype, :comment, :genre, :img, :json, sysdate())");
$stmt->bindValue(':id', $id);
$stmt->bindValue(':title', $title);
$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':movie', $movie);
$stmt->bindValue(':layout', $layout);
$stmt->bindValue(':roomtype', $roomtype);
$stmt->bindValue(':comment', $comment);
$stmt->bindValue(':genre', $genre);
$stmt->bindValue(':img', $img);
$stmt->bindValue(':json', $design);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("select.php");
}
?>
