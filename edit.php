<?php

require_once('config.php');
require_once('function.php');

$id = $_GET['id'];

$dbh = connectDb();

$sql = "select * from posts where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$errors = array();

// 結果の取得
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// タスクの編集
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 受け取ったデータ
    $title = $_POST['title'];
    $body = $_POST['body'];

    // エラーチェック用の配列

    //バリデーション
    if ($title == '') {
        $errors['title'] = 'タイトルを入力してください';
    }

    if ($title == $post['title'] && $body == $post['body']) {
        $errors[] = 'タイトルか本文どちらかは編集してください';
    }

    if ($body == '') {
        $errors['body'] = '本文を入力してください';
    }

    //エラーが1つもなければレコードを更新
    if (empty($errors)) {
        $dbh = connectDb();

        $sql = "update posts set title = :title, body = :body, updated_at = now() where id = :id";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam("body", $body);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        header('Location: index.php');
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>編集画面</title>

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->

</head>
<body>

  <nav class="navbar navbar-inverse">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./index.php">NOWALL Blog</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="add.php">投稿する</a></li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container">
   <div class="row">
    <div class="col-lg-12">
     <h2>投稿内容の編集</h2>
    <p><a href="index.php" class="btn btn-primary">戻る</a></p>
 <?php if (!empty($errors)): ?>
  <?php foreach ($errors as $error): ?>
    <li>
    <?php echo $error; ?>
    </li>
  <?php endforeach; ?>
 <?php endif; ?>
      <form action="" method="post">
          <div class="form-group">
            <label>タイトル</label>
            <input type="text" name="title" value="<?php echo h($post['title']); ?>" class="form-control">
          </div>
          <div class="form-group">
           <label>本文</label>
           <textarea name="body" class="form-control" cols="30" rows="10"><?php echo h($post['body']); ?></textarea>
         </div>
         <div class="form-group">
          <input type="submit" value="編集" class="btn btn-primary">
        </div>
      </form>

    </div>
   </div>
  </div>

<!--   <h1>投稿内容を編集する</h1>
  <p><a href="index.php">戻る</a></p>
 <?php if (!empty($errors)): ?>
  <?php foreach ($errors as $error): ?>
    <li>
    <?php echo $error; ?>
    </li>
  <?php endforeach; ?>
 <?php endif; ?>
    <form action="" method="post">
    <p>
      タイトル<br>
      <input type="text" name="title" value="<?php echo h($post['title']); ?>">
    </p>
    <p>
      本文<br>
      <textarea name="body" cols="30" rows="5" value="<?php echo h($post['body']); ?>"><?php echo h($post['body']); ?></textarea>
    </p>
    <p><input type="submit" value="更新する"></p>
  </form> -->
</body>
</html>