<?php
session_start();
require __DIR__ . '/db.php';

$userid   = trim($_POST['userid'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE userid = ? AND password = ?");
$stmt->execute([$userid, $password]);
$user = $stmt->fetch();

if (!$user) {
    echo "<script>alert('아이디 또는 비밀번호가 일치하지 않습니다.'); history.back();</script>";
    exit;
}

$_SESSION['user'] = [
    'idx'    => $user['idx'],
    'userid' => $user['userid'],
    'name'   => $user['name'],
    'photo'  => $user['photo'],
    'type'   => $user['type'],
];

echo "<script>location.href='index.php';</script>";