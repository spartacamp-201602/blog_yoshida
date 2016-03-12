<?php
require_once('config.php');
require_once('function.php');

$id = $_GET['id'];
$dbh = connectDb();

$sql = "delete from posts where id = :id";


$stmt = $dbh->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

//index.phpにリダイレクトする
header('Location: index.php');
exit;