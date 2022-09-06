<?php
// ini_set('display_errors', 'On'); // エラーを表示させるようにしてください
// error_reporting(E_ALL); // 全てのレベルのエラーを表示してください

session_start();
include("funcs.php");
sschk();
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<table border="2" width="605" bgcolor="'.$r["color"].'">';
    $view .= '<tr><td colspan="3"><h3>'.$r["title"].'</h3></td></tr>';
    $view .= '<tr><td "width="400" height="30">👤　<form action="select_name.php" method="post" style="display: inline"><input type="hidden" value="'.$r["name"].'"name="username"><button style="border:none; color:red" "type="submit">'.$r["name"].'</button></form></td>';
    $view .= '<td height="30"><a href="mailto:'.$r["email"].'?subject=【サービス名】インテリアについて">📩　メール</td>';
    $view .= '<td height="30">⏳　'.$r["indate"].'</td></tr>';
    $view .= '<tr><td colspan="2" width="400" height="30">🎥　'.$r["movie"].'</td>';
    $view .= '<td rowspan="3"><img src="upload/'.$r["img"].'" width="200"></td></tr>';
    $view .= '<tr><td width="400" height="30">🏠　'.$r["roomtype"].'タイプ</td>';
    $view .= '<td width="400" height="30">🏷️　'.$r["genre"].'</td></tr>';
    $view .= '<tr><td colspan="2" width="400" valign="top">📝コンセプト・こだわり：<br>'.$r["comment"].'</td></tr><tr><td colspan="3">';
    $text= $r["design"];
    // $view .=$text;
    $designs= json_decode($text, true);
    // $view .=$designs[0];
    foreach($designs as $design){
    $view .= '<img src="'.$design.'" width="200">';
    }
    $view .= "";

    if($_SESSION["name"]== $r["name"]){
      $view .= '</td></tr><tr><td colspan="3"><a class="btn btn-danger" href="detail.php?id='.$r["id"].'">🔄更新</a>';
      $view .= '<a class="btn btn-danger" href="delete.php?id='.$r["id"].'">🗑削除</a>';
    }    

    $view .= '</td></tr></table><br>';
  }}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>投稿一覧</title>
<link rel="stylesheet" href="css/range.css">
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
<div>
  <div>
    <!-- <form action="select_comment.php" method="post">
    <input type="text" id="keyword" name="keyword">
    <button id="send" type="send">検索</button>
    </form> -->
  </div>
    <div class="container jumbotron" id="view"><?=$view?></div>
</div>
<!-- Main[End] -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script scr="/select2.js"></script>

<script>
function search() {
    //axiosでAjax送信
    //Ajax（非同期通信）
    const params = new URLSearchParams();
    params.append('keyword',   $("#keyword").val());
    
    //axiosでAjax送信
    axios.post('select_name.php',params).then(function (response) {
        console.log(typeof response.data);//通信OK
        if(response.data){
          //>>>>通信でデータを受信したら処理をする場所<<<<
          document.querySelector("#view").innerHTML=response.data;
          
        }
    }).catch(function (error) {
        console.log(error);//通信Error
    }).then(function () {
        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    })};
</script>

<script>
//検索ボタンをクリック
function comment() {
    //axiosでAjax送信
    //Ajax（非同期通信）
    const params = new URLSearchParams();
    params.append('keyword',   $("#keyword").val());
    
    //axiosでAjax送信
    axios.post('select_comment.php',params).then(function (response) {
        console.log(typeof response.data);//通信OK
        if(response.data){
          //>>>>通信でデータを受信したら処理をする場所<<<<
          document.querySelector("#view").innerHTML=response.data;
          
        }
    }).catch(function (error) {
        console.log(error);//通信Error
    }).then(function () {
        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
};
</script>

<script>
        // 定数
      // Discover
      const API_URL = 'https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&api_key=4a11667ad7bfcfa961832d0488e4f8fa&language=ja-JA&page=1'
      // Images
      const IMG_PATH = 'https://image.tmdb.org/t/p/w1280'
      // Search
      const SEARCH_API = 'https://api.themoviedb.org/3/search/movie?api_key=4a11667ad7bfcfa961832d0488e4f8fa&language=ja-JA&query="'

      // 要素を取得
      const main = document.getElementById('main')
      const form = document.getElementById('form')
      const search = document.getElementById('search')

      // 映画情報を取得
      getMovies(API_URL)

      // async/awaitで非同期処理
      async function getMovies(url) {
        // APIヘGETリクエスト
        const res = await fetch(url)
        // 取得したデータをJSON形式で取得
        const data = await res.json()
        // Movieを表示
        showMovies(data.results)
      }

      function showMovies(movies) {
        // 画面初期化
        main.innerHTML = ''

        movies.forEach((movie) => {
          // オブジェクトから各変数に格納
          const {
            title,
            poster_path,
            vote_average,
            overview,
            id
          } = movie

          // Movieパネルを作成
          const movieEl = document.createElement('div')
          movieEl.classList.add('movie')
          // MoveパネルをHTMLに埋め込む
          movieEl.innerHTML =  `
          <div>
            <a href="https://www.themoviedb.org/movie/${id}" target="_blank" rel="noopener noreferrer">
            クリックしてね
            </a>
            </div>
          `
          main.appendChild(movieEl)
        })

      }

            // formから検索できるようにする
        form.addEventListener('load', (e) => {
        // フォームのデフォルトの動きを禁止
        // ここではページのリダイレクトをキャンセルしている
        e.preventDefault()

        // 検索文字列取得
        const searchTerm = search.value

        if(search && searchTerm !== '') {
          // 検索文字列を元に検索をする
          getMovies(SEARCH_API + searchTerm)
          // 検索文字列を削除
          search.value = ''
        } else {
          // ページを再読み込み
          // 検索キーワードない状態で検索すると初期状態のデータを表示できる
          // Searchで検索した結果をクリアしたい時などに使える
          window.location.reload()
        }
      })
</script>


</body>
</html>
