<?php
//1. POSTデータ取得
$name	=	$_POST["name"];
$url	=	$_POST["url"];
$com	=	$_POST["com"];


//2. DB接続します 'mysql'を変えるだけでどんなDBでもコピペで使える。レンタルSBとか使う場合は、'localhost'を書き換える。$pdoの中にもろもろの関数が入れて、使える状態になる。
try {
  $pdo = new PDO('mysql:dbname=kadi_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage()); //エラーが出た時、'exhit'で処理を止め、エラー文書を表示。
}


//３．データ登録SQL作成 コピペで必要なとこだけ書き換えて使う。
$stmt = $pdo->prepare("INSERT INTO kadai_bm_table(`id`, `書籍名`, `書籍URL`, `書籍コメント`, `登録日時`)VALUES(NULL, :name, :url, :com, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':com', $com, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //execute=実行。

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php"); //:の後ろに必ず、スペースを入れる。index.phpへ飛ぶ。
  exit;//ヘッダーを使ったら、exitで終了。
}
?>
