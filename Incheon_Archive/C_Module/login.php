<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../공통제공파일/fontawesome/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="header_min">
            <div class="header_logo_box">
                <a href="index.html">
                    <i class="fa-brands fa-firefox"></i>
                    <h2>인천 아카이브</h2>
                </a>
            </div>

            <nav>
                <ul>
                    <li><a href="#">문의사항</a></li>
                    <li><a href="#">게시판</a>
                        <ul class="sub_nav">
                            <li><a href="Best.html">베스트 게시판</a></li>
                            <li><a href="">전체 게시판</a></li>
                        </ul>
                    </li>
                    <li><a href="#">토론</a>
                        <ul class="sub_nav">
                            <li><a href="debate.html">베스트 토론</a></li>
                            <li><a href="">전체 토론</a></li>
                        </ul>
                    </li>
                    <li><a href="#">마이페이지</a></li>
                </ul>
            </nav>

            <div class="auth-buttons">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user_area">
                        <img src="uploads/<?php echo $_SESSION['profile_image'] ?? 'default.png'; ?>" class="profile_thumb">
                        <span><?php echo $_SESSION['username']; ?></span>
                        <a href="logout.php" class="btn_signin">로그아웃</a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn_signin">로그인</a>
                    <a href="join.php" class="btn_signup">회원가입</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="auth_main">
        <div class="auth_box signup_box">
            <h1>로그인</h1>

            <form id="signupForm" class="auth_form" method="POST" action="login_process.php">

            <div class="input_wrap">
                <input type="text" id="username" name="username" placeholder="아이디" class="auth_input">
                <span class="input_hint">영문, 숫자 조합 4~12자</span>
            </div>

            <div class="input_wrap">
                <input type="password" id="password" name="password" placeholder="비밀번호" class="auth_input">
                <span class="input_hint">영문, 숫자, 특수문자 조합 8~12자</span>
            </div>

            <button type="submit" class="auth_submit">로그인</button>
            </form>

        </div>
    </main>

    <footer>
        <div class="footer_width" style="width: 70%; padding: 20px;">
            <div class="hi_footer">
                <a href="index.html">
                    <i class="fa-brands fa-firefox"></i>
                    <h2>인천 아카이브</h2>
                </a>

                <ul>
                    <li>문의사항 | 1588-1234 (평일 09:00 ~ 18:00)</li>
                    <li>관리자 전용 | 010-9876-5432 (긴급 시스템 장애 신고 전용)</li>
                </ul>
            </div>

            <hr>

            <div class="low_footer">
                <span>© 2026 Incheon Archive. All rights reserved.</span>

                <div class="sns_box">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-square-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-square-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>