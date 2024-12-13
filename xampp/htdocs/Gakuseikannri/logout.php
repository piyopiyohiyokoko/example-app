<?php
if (!session_id()) {
    session_start();
}

// セッション変数を全て解除する 
$_SESSION = array();

// クッキーからセッションを削除
if (isset($_COOKIE["PHPSESSID"])) {
    setcookie("PHPSESSID", '', time() - 1800, '/');
}

// セッションを破壊する
session_destroy();

// ログインページへ
header('Location:./index.php');
