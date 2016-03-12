<?php

require_once('config.php');
require_once('function.php');

$id = $_GET['id'];

$dbh = connectDb();

$sql = "select * from posts where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$post = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Blog</title>

  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

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
    <h2><?php echo h($post['title']); ?></h2>
    <p>投稿日時:<?php echo $post['created_at']; ?></p>
    <?php echo h($post['body']); ?><hr>
    <a href="edit.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">編集</a>
    <a href="delete.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">削除</a>
    <a href="index.php" class="btn btn-primary">戻る</a>
   </div>
  </div>
 </div>

<!--   <h1><?php echo h($post['title']); ?></h1>
  <a href="index.php">戻る</a>
  <li style="list-style-type: none;">
    [#<?php echo h($post['id']); ?>]
    @<?php echo h($post['title']); ?><br>
    <?php echo h($post['body']); ?><br>
    <hr>
    <a href="edit.php?id=<?php echo $post['id']; ?>">[編集]</a>
    <a href="delete.php?id=<?php echo $post['id']; ?>">[削除]</a>
    投稿日時:<?php echo $post['created_at']; ?>
  </li> -->
</body>
</html>