<?php
include("funcs.php");
$pdo = db_conn();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ホーム</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <!-- <?php echo $_SESSION["name"]; ?>さん　 -->
    <?php include("menu.php"); ?>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="index2.php" enctype="multipart/form-data">
    <div class="container jumbotron" id="view">
    <!-- <fieldset>
    <legend>映画のジャンルから探す</legend>
    <input type="submit" name='submit' value="検索">
    </fieldset>     -->
    
    <fieldset>
            <legend>条件から探す</legend>
            <table border="1" width="1000">
            <tr><td>部屋の間取り</td>
              <td><input type="radio" name="layout" value="1R" onclick="formSwitch()" >1R</td>
              <td><input type="radio" name="layout" value="1K" onclick="formSwitch()">1K</td>
              <td><input type="radio" name="layout" value="1DK" onclick="formSwitch()">1DK</td>
              <td><input type="radio" name="layout" value="1LDK" onclick="formSwitch()">1LDK</td></tr>
              <tr><td>部屋のタイプ</td><td colspan="4">
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
                <tr><td>好きなジャンル</td><td colspan="4">
                    <div class="select_genre">
                    <input type="radio" value="ナチュラル"  name="genre" ><label><img src="./interiortype/natural.jpeg" alt="" width="200px"></label>
                    <input type="radio" value="アメリカン"  name="genre"><label><img src="./interiortype/american.jpeg" alt="" width="200px"></label>
                    <input type="radio" value="モダン"  name="genre"><label><img src="./interiortype/modern.jpeg" alt="" width="200px"></label>
                    <input type="radio" value="インダストリアル"  name="genre"><label><img src="./interiortype/industrial.jpeg" alt="" width="200px"></label><br>
                    <input type="radio" value="北欧"  name="genre"><label><img src="./interiortype/nordic.jpeg" alt="" width="200px"></label>
                    <input type="radio" value="ヴィンテージ"  name="genre"><label><img src="./interiortype/vintage.jpeg" alt="" width="200px"></label>
                    <input type="radio" value="和モダン"  name="genre"><label><img src="./interiortype/japanese-modern.jpeg" alt="" width="200px"></label>
                    <input type="radio" value="その他"  name="genre"><label><img src="./interiortype/others.jpeg" alt="" width="200px"></label>
                    </div>
                </td></tr>
            </table><br>
            <input type="submit" name='submit' value="検索">
        </fieldset>
        
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