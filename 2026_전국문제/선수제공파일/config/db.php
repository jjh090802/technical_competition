<?php
// DB 접속 정보 (XAMPP 기본값: 아이디 root, 비밀번호 없음)
$pdo = new PDO("mysql:host=localhost;dbname=mysite;charset=utf8mb4", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);