<?php
session_start();
$id = $_GET["id"];
include("funcs.php");
sschk();
$pdo = db_conn();

$stmt   = $pdo->prepare("SELECT * FROM gs_user_table where id=:id"); 
//SQLをセット
$stmt->bindValue(':id',   $id,    PDO::PARAM_INT);
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

// データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  $row = $stmt->fetch(); // 指定した１つのデータを取り出して $row に格納
}

$apikey = "4a11667ad7bfcfa961832d0488e4f8fa"; //TMDbのAPIキー
$error = "";

if (array_key_exists('movie_title', $_GET) && $_GET['movie_title'] != "") {
    $url_Contents = 
    file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=".$apikey."&language=ja-JA&query=".$_GET['movie_title']."&page=1&include_adult=false");
    $movieArray = json_decode($url_Contents, true);
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>マイ・インテリア投稿</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <?php echo $_SESSION["name"]; ?>さん　
    <?php include("menu.php"); ?>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php" enctype="multipart/form-data">
    <div class="container jumbotron" id="view">
        <fieldset>
            <legend>マイ・インテリア投稿</legend>
            <table border="1">
            <tr><td>👤ユーザーネーム</td><td colspan ="2"><input type="hidden" name="name" value="<?php echo $_SESSION["name"]; ?>"><?php echo $_SESSION["name"]; ?></td>
            <td>📩Email</td><td colspan ="2"><input type="text" name="email" required></td></tr>
            <tr><td>🎥映画の名前</td>
            <td colspan ="2"><input type="text" name="movie" value="<?=$row["movie"]?>"></td>
            <td>⭐️インテリアのタイトル</td><td colspan ="2"><input type="text" name="title" required></td></tr>
            <tr><td>🏠部屋の間取り</td>
              <td><input type="radio" name="layout" value="1R" onclick="formSwitch()" required >1R</td>
              <td><input type="radio" name="layout" value="1K" onclick="formSwitch()">1K</td>
              <td><input type="radio" name="layout" value="1DK" onclick="formSwitch()">1DK</td>
              <td><input type="radio" name="layout" value="1LDK" onclick="formSwitch()">1LDK</td></tr>
              <tr><td>🏡部屋のタイプ</td><td colspan="5">
  <div id="1R" style="display:inline">
    <div class="1R" style="display:inline">
    <input type="radio" value="1R-A"  name="roomtype">Aタイプ
    <img src="./roomtype/1r_a.jpeg" alt="" height="300px">
    </div>
    <div class="1R" style="display:inline">
    <input type="radio" value="1R-B" id="アイスクリーム" name="roomtype">Bタイプ
    <img src="./roomtype/1r_b.jpeg" alt="" height="300px">
    </div>
    <div class="1R" style="display:inline">
    <input type="radio" value="1R-C" id="チーズケーキ" name="roomtype">Cタイプ
    <img src="./roomtype/1r_c.jpeg" alt="" height="300px">
    </div> <br>
    <div class="1R" style="display:inline">
      <input type="radio" value="1R-D" id="お団子" name="roomtype">Dタイプ
      <img src="./roomtype/1r_d.jpeg" alt="" height="300px">
    </div>
    <div class="1R" style="display:inline">
      <input type="radio" value="1R-E" id="i" name="roomtype">Eタイプ
      <img src="./roomtype/1r_e.jpeg" alt="" height="300px">
    </div>
  </div>

  
<div id="1K">
    <div class="1K" style="display:inline">
      <input type="radio" value="1K-A" id="自由が丘" name="roomtype">Aタイプ
      <img src="./roomtype/1k_a.jpeg" alt="" height="300px">
    </div>
    <div class="1K" style="display:inline">
      <input type="radio" value="1K-B" id="下北沢" name="roomtype">Bタイプ
      <img src="./roomtype/1k_b.jpeg" alt="" height="300px">
    </div>
    <div class="1K" style="display:inline">
      <input type="radio" value="1K-C" id="吉祥寺" name="roomtype">Cタイプ
      <img src="./roomtype/1k_c.jpeg" alt="" height="300px">
    </div><br>
    <div class="1K" style="display:inline">
      <input type="radio" value="1K-D" id="高円寺" name="roomtype">Dタイプ
      <img src="./roomtype/1k_d.jpeg" alt="" height="300px">
    </div>
    <div class="1K" style="display:inline">
      <input type="radio" value="1K-E" id="e" name="roomtype">Eタイプ
      <img src="./roomtype/1k_e.jpeg" alt="" height="300px">
    </div>
</div>

<div id="1DK">
    <div class="form-check" style="display:inline">
      <input type="radio" value="1DK-A" id="1dk_a" name="roomtype">Aタイプ
      <img src="./roomtype/1dk_a.jpeg" alt="" height="300px">
    </div>
    <div class="form-check" style="display:inline">
      <input type="radio" value="1DK-B" id="1dk_b" name="roomtype">Bタイプ
      <img src="./roomtype/1dk_b.jpeg" alt="" height="300px">
    </div>
    <div class="form-check" style="display:inline">
      <input type="radio" value="1DK-C" id="1dk_c" name="roomtype">Cタイプ
      <img src="./roomtype/1dk_c.jpeg" alt="" height="300px">
    </div><br>
    <div class="form-check" style="display:inline">
      <input type="radio" value="1DK-D" id="1dk_d" name="roomtype">Dタイプ
      <img src="./roomtype/1dk_d.jpeg" alt="" height="300px">
    </div>
    <div class="form-check" style="display:inline">
      <input type="radio" value="1DK-E" id="1dk_e" name="roomtype">Eタイプ
      <img src="./roomtype/1dk_e.jpeg" alt="" height="300px">
    </div>
</div>

<div id="1LDK">
    <div class="form-check" style="display:inline">
      <input type="radio" value="1LDK-A" id="1ldk_a" name="roomtype">Aタイプ
      <img src="./roomtype/1ldk_a.jpeg" alt="" height="300px">
    </div>
    <div class="form-check" style="display:inline">
      <input type="radio" value="1LDK-B" id="1ldk_b" name="roomtype">Bタイプ
      <img src="./roomtype/1ldk_b.jpeg" alt="" height="300px">
    </div>
    <div class="form-check" style="display:inline">
      <input type="radio" value="1LDK-C" id="1ldk_c" name="roomtype">Cタイプ
      <img src="./roomtype/1ldk_c.jpeg" alt="" height="300px">
    </div><br>
    <div class="form-check" style="display:inline">
      <input type="radio" value="1LDK-D" id="1ldk_d" name="roomtype">Dタイプ
      <img src="./roomtype/1ldk_d.jpeg" alt="" height="300px">
    </div>
    <div class="form-check" style="display:inline">
      <input type="radio" value="1LDK-E" id="1ldk_e" name="roomtype">Eタイプ
      <img src="./roomtype/1ldk_e.jpeg" alt="" height="300px">
    </div>
</div>
</td></tr>
            <tr><td>📝コンセプト・<br>こだわり</td><td colspan="2"><textArea name="comment" rows="4" cols="30"></textArea></td>
           <td>🏷ジャンル</td><td colspan="2">
           <input type="radio" value="ナチュラル"  name="genre" required>ナチュラル
           <input type="radio" value="アメリカン"  name="genre">アメリカン
           <input type="radio" value="モダン"  name="genre">モダン
           <input type="radio" value="インダストリアル"  name="genre">インダストリアル<br>
           <input type="radio" value="北欧"  name="genre">北欧
           <input type="radio" value="ヴィンテージ"  name="genre">ヴィンテージ
           <input type="radio" value="和モダン"  name="genre">和モダン
           <input type="radio" value="その他"  name="genre">その他



           </td></tr>
            <tr><td>図面(1ファイル)</td><td colspan="2"><input type="file" name="upfile" multiple required></td>
            <td>デザイン(複数ファイル)</td><td colspan="2"><input type="file" name="design[]" multiple required></td></tr>
</table><br>
            <input type="submit" name='submit' value="投稿">
        </fieldset>
    </div>
</form>
<!-- Main[End] -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>

  <script>
    function formSwitch() {
        hoge = document.getElementsByName('layout')
        if (hoge[0].checked) {
            // 好きな食べ物が選択されたら下記を実行します
            document.getElementById('1R').style.display = "";
            document.getElementById('1K').style.display = "none";
            document.getElementById('1DK').style.display = "none";
            document.getElementById('1LDK').style.display = "none";
        } else if (hoge[1].checked) {
            // 好きな場所が選択されたら下記を実行します
            document.getElementById('1R').style.display = "none";
            document.getElementById('1K').style.display = "";
            document.getElementById('1DK').style.display = "none";
            document.getElementById('1LDK').style.display = "none";
          } else if (hoge[2].checked) {
            // 好きな場所が選択されたら下記を実行します
            document.getElementById('1R').style.display = "none";
            document.getElementById('1K').style.display = "none";
            document.getElementById('1DK').style.display = "";
            document.getElementById('1LDK').style.display = "none";
          } else if (hoge[3].checked) {
            // 好きな場所が選択されたら下記を実行します
            document.getElementById('1R').style.display = "none";
            document.getElementById('1K').style.display = "none";
            document.getElementById('1DK').style.display = "none";
            document.getElementById('1LDK').style.display = "";
        } else {
            document.getElementById('1R').style.display = "none";
            document.getElementById('1K').style.display = "none";
            document.getElementById('1DK').style.display = "none";
            document.getElementById('1LDK').style.display = "none";
        }
    }
    window.addEventListener('load', formSwitch());
  </script>

</body>
</html>

