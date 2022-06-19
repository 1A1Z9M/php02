<?php

require_once("funcs.php");

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=azuma1109_kadai08;charset=utf8;host=mysql57.azuma1109.sakura.ne.jp','azuma1109','*****');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("select * from users_table_2");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $data .= "<tr>";
    $data .= "<td>".h($res["id"])."</td>"."<td>".h($res["family_name"])."</td>"."<td>".h($res["first_name"])."</td>"."<td>".h($res["family_kana"])."</td>"."<td>".h($res["first_kana"])."</td>"."<td>".h($res["email"])."</td>"."<td>".h($res["tel"])."</td>"."<td>".h($res["postcode"])."</td>"."<td>".h($res["prefecture"])."</td>"."<td>".h($res["city"])."</td>"."<td>".h($res["address"])."</td>"."<td>".h($res["building"])."</td>"."<td>".h($res["indate"])."</td>";
    $data .= "</tr>";

  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>admin</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">admin</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
      <table>
        <tr>
          <th>ID</th>
          <th>姓</th>
          <th>名</th>
          <th>カナ(姓)</th>
          <th>カナ(名)</th>
          <th>メールアドレス</th>
          <th>電話番号</th>
          <th>郵便番号</th>
          <th>住所</th>
          <th></th>
          <th></th>
          <th></th>
          <th>登録日時</th>
        </tr>
        <?=$data?>
      </table>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
