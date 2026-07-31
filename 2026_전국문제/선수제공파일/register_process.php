<?php
require 'config/db.php';

$user_id  = $_POST['user_id'];
$password = $_POST['password'];

$check = $pdo->prepare("SELECT id FROM users WHERE user_id = ?");
$check->execute([$user_id]);

if ($check->fetch()) {
    echo "<script>alert('이미 사용 중인 아이디입니다.'); history.back();</script>";
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (user_id, password) VALUES (?, ?)");
$stmt->execute([$user_id, $hashed_password]);

// 성공 시 alert 띄우고 → index.html로 이동
echo "<script>alert('회원가입이 완료되었습니다!'); location.href='index.php';</script>";
exit;