<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn(){
  try {
    $db_name = "interiordb";    //データベース名
    $db_id   = "root";      //アカウント名
    $db_pw   = "";      //パスワード：XAMPPはパスワード無しに修正してください。
    $db_host = "localhost"; //DBホスト

        //localhost以外＊＊自分で書き直してください！！＊＊
        if($_SERVER["HTTP_HOST"] != 'localhost'){
          $db_name = "konichan_interiordb";  //データベース名
          $db_id   = "konichan";  //アカウント名（さくらコントロールパネルに表示されています）
          $db_pw   = "w2W0qoH8";  //パスワード(さくらサーバー最初にDB作成する際に設定したパスワード)
          $db_host = "mysql57.konichan.sakura.ne.jp"; //例）mysql**db.ne.jp...
      }
    return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
  } catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
  }
}

//SQLエラー
function sql_error(){
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}
//SessionCheck
function sschk(){
  if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
    exit("Login Error");
  }else{
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}

//単ファイルアップロード 
//fileUpload("送信名","アップロード先フォルダ");
function fileUpload($fname,$path){
  if (isset($_FILES[$fname] ) && $_FILES[$fname]["error"] ==0 ) {
        //ファイル名取得
        $file_name = $_FILES[$fname]["name"];
        //一時保存場所取得
        $tmp_path  = $_FILES[$fname]["tmp_name"];
        //拡張子取得
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        //ユニークファイル名作成(名前の衝突を防ぎ、名前をハッシュ化する )
        $file_name = $fname.date("YmdHis").md5(session_id()) . "." . $extension;
        // FileUpload [--Start--]
        $file_dir_path = $path."/".$file_name;
        if ( is_uploaded_file( $tmp_path ) ) {
            if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
                chmod( $file_dir_path, 0644 );
                return $file_name; //成功時：ファイル名を返す
            } else {
                return 1; //失敗時：ファイル移動に失敗
            }
        }
     }else{
         return 2; //失敗時：ファイル取得エラー
     }
    }


//複数ファイルアップロード 
//fileUpload("送信名","アップロード先フォルダ");
function multiFileUpload($fname,$path){
  if (isset($_FILES[$fname]["name"] ) && count($_FILES[$fname]["name"]) > 0 ) {
    for ($i =0; $i<count($_FILES[$fname]["name"]); $i++){
      
      //ファイル名取得
      $file_name = $_FILES[$fname]["name"][$i];
      //一時保存場所取得
      $tmp_path  = $_FILES[$fname]["tmp_name"][$i];
      //拡張子取得
      $extension = pathinfo($file_name, PATHINFO_EXTENSION);
      //ユニークファイル名作成(名前の衝突を防ぎ、名前をハッシュ化する )
      $file_name = $fname.date("YmdHis").md5(session_id()) . "." . $extension;
      // FileUpload [--Start--]
      $file_dir_path = $path."/".$file_name;
      if ( is_uploaded_file( $tmp_path ) ) {
          if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
              chmod( $file_dir_path, 0644 );
              return $file_name; //成功時：ファイル名を返す
          } else {
              return 1; //失敗時：ファイル移動に失敗
          }
      }
    }
   }else{
       return 2; //失敗時：ファイル取得エラー
   }
}
// function multiFileUpload($fname,$path){
// if(isset($_POST['submit'])){
//   $countfiles = count($_FILES['$fname']['name']);
//   for($i=0;$i<$countfiles;$i++){
//       $filename = $_FILES['$fname']['name'][$i];
//       // $sql = "INSERT INTO fileup(id,name) VALUES ('$filename','$filename')";
//       // $db->query($sql);
//       move_uploaded_file($_FILES['$fname']['tmp_name'][$i],'design_up/'.$filename);
//   }
// }}