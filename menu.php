<nav class="navbar navbar-default">
    <div class="container-fluid" >
        <div class="navbar-header" style="display:inline;">
            <a class="navbar-brand" href="index.php">ホーム</a>
            <div class="navbar-brand">
            <input type="text" id="keyword">
            <button id="send" color="black">検索</button>
            </div>
            <a class="navbar-brand" href="post.php">マイ・インテリア投稿</a>
            <a class="navbar-brand" href="select.php" >投稿一覧</a>
            <a class="navbar-brand" href="logout.php" >ログアウト</a>
        </div>
    </div>
</nav>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
//登録ボタンをクリック
$("#send").on("click", function() {
    //axiosでAjax送信
    //Ajax（非同期通信）
    const params = new URLSearchParams();
    params.append('keyword',   $("#keyword").val());
    
    //axiosでAjax送信
    axios.post('select2.php',params).then(function (response) {
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
});
</script>