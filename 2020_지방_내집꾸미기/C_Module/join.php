<?php
session_start();
require __DIR__ . '/db.php';

$userid   = trim($_POST['userid'] ?? '');
$password = $_POST['password'] ?? '';
$name     = trim($_POST['name'] ?? '');


// 2) 아이디 중복 확인 (전문가 포함)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE userid = ?");
$stmt->execute([$userid]);
if ($stmt->fetchColumn() > 0) {
    echo "<script>alert('중복되는 아이디입니다. 다른 아이디를 사용해주세요.'); history.back();</script>";
    exit;
}

// 3) 저장 (photo 컬럼은 NOT NULL 이라 빈 문자열로 저장)
$stmt = $pdo->prepare("INSERT INTO users (userid, password, name, photo, type) VALUES (?, ?, ?, '', 'user')");
$stmt->execute([$userid, $password, $name]);

echo "<script>alert('회원가입이 완료되었습니다.'); location.href='index.php';</script>";
