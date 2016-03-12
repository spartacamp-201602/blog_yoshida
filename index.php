<?php
//設定ファイルと関数ファイルを読み込む
require_once('config.php');
require_once('function.php');

//データベースに接続
$dbh = connectDb();

//レコードの取得
//投稿順に上に表示されるように後で編集する
$sql = "select * from posts order by updated_at desc";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ブログアプリ</title>

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
    <div class="col-md-8">
     <h1>記事一覧</h1>
     <?php foreach ($posts as $post) : ?>
      <h3><a href="show.php?id=<?php echo h($post['id']); ?>"><?php echo h($post['title']); ?></a></h3>
      <p><?php echo h($post['body']); ?></p>
      <p>投稿日時: <?php echo $post['updated_at']; ?></p>
      <hr>
      <?php endforeach; ?>
    </div>

    <div class="col-md-4">
     <div class="thumbnail">
      <img src="http://spartacamp.s15.coreserver.jp/elites_camp/blog_design/img/elites_logo.png">
      <div class="caption">
       <h3>株式会社</h3>
       <p>Tel: 03-6279-0840</p>
       <p>Mail: info@nowall.co.jp</p>
      </div>
     </div>
     <div class="list-group">
      <h3>最近の投稿</h3>
      <a href="#" class="list-group-item">テスト</a>
      <a href="#" class="list-group-item">テスト</a>
     </div>
    </div>
   </div>
  </div>









<!-- <h1>Blog</h1>
  <a href="add.php">新規記事投稿</a>
  <h1>記事一覧</h1>
   <?php foreach ($posts as $post) : ?>
    <!-- ここのリンクを修正すること -->
<!--     <li style="list-style-type: none;">
    <a href="show.php?id=<?php echo h($post['id']); ?>"><?php echo $post['title']; ?></a><br>
    <?php echo $post['body']; ?>
    <br>
    投稿日時: <?php echo $post['updated_at']; ?><hr>
    </li>
   <?php endforeach; ?> -->
</body>
</html>













