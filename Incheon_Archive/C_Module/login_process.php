<?php
session_start();
include 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];

// 1. 필수 입력 확인
if (!$username || !$password) {
    echo "<script>alert('아이디와 비밀번호를 입력해주세요.'); history.back();</script>";
    exit;
}

// 2. DB에서 해당 아이디를 가진 회원 찾기
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// 3. 회원이 없거나 비밀번호가 틀리면
if (!$user || $user['password'] !== $password) {
    echo "<script>alert('아이디 또는 비밀번호가 일치하지 않습니다.'); history.back();</script>";
    exit;
}

// 4. 로그인 성공 → 세션에 정보 저장
$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];

echo "<script>location.href='index.php';</script>";
?>