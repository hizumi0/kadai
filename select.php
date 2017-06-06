<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=kadi_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM kadai_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){//resの中に配列で入る。
//    $view .= '<tr><td>'.$res["name"].'</td><td>'.$res["indate"].'</td></tr>';// .=は= $view.と言う意味。これがないと$viewに上書きされちゃう。
	
	$view .= '<tr>';
	$view .= '<td>'.$res["name"].'</td>';
	$view .= '<td>'.$res["url"].'</td>';
	$view .= '<td>'.$res["登録日時"].'</td>';
	$view .= '</tr>';
	
	}

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>書籍DB</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
    <table><?=$view?></table>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
