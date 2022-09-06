<?php
// ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
// error_reporting(E_ALL); // 全てのレベルのエラーを表示してください

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
$title   = $_POST["title"];
$name   = $_POST["name"];
$email   = $_POST["email"];
$movie  = $_POST["movie"];
$layout  = $_POST["layout"];
$roomtype  = $_POST["roomtype"];
$comment = $_POST["comment"];
$img   = fileUpload("upfile","upload");
$design   = $json;
$id     = $_POST["id"];

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_an_table SET title=:title, name=:name, email=:email, layout=:layout, movie=:movie, roomtype=:roomtype, comment=:comment, img=:img, design=:json WHERE id=:id");
$stmt->bindValue(':title',   $title, PDO::PARAM_STR);
$stmt->bindValue(':name',   $name, PDO::PARAM_STR);
$stmt->bindValue(':email',  $email, PDO::PARAM_STR);
$stmt->bindValue(':movie',  $movie, PDO::PARAM_STR);
$stmt->bindValue(':layout', $layout, PDO::PARAM_STR);
$stmt->bindValue(':roomtype', $roomtype,PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment,PDO::PARAM_STR);
$stmt->bindValue(':img',    $img, PDO::PARAM_STR);
$stmt->bindValue(':json',   $design, PDO::PARAM_STR);
$stmt->bindValue(':id',     $id,     PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("select.php");
}
?>