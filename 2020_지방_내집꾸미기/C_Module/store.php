<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>내집꾸미기</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <!-- 헤더: 로그인 상태에 따라 [로그인·회원가입] ↔ [이름(아이디)·로그아웃] -->
    <header class="header">
        <div class="inner">
            <h1 class="logo"><a href="./"><img src="images/logo.png" alt="내집꾸미기" title="내집꾸미기"></a></h1>

            <nav class="menu">
                <span class="menu-icon" title="메뉴 보기"><i></i></span>
                <ul class="gnb">
                                                                <li><a href="./">홈</a></li>
                                            <li><a href="housewarming">온라인 집들이</a></li>
                                            <li><a href="store" class="on">스토어</a></li>
                                            <li><a href="specialist">전문가</a></li>
                                            <li><a href="estimate">시공 견적</a></li>
                                    </ul>
            </nav>

            <div class="util">
                <?php if (isset($_SESSION['user'])): ?>
                    <span class="me">
                        <?php if (!empty($_SESSION['user']['photo'])): ?>
                            <img src="<?= htmlspecialchars($_SESSION['user']['photo']) ?>" alt="내 사진" title="내 사진">
                        <?php endif; ?>
                        <?= htmlspecialchars($_SESSION['user']['name']) ?>(<?= htmlspecialchars($_SESSION['user']['userid']) ?>)
                    </span>
                    <a href="logout">로그아웃</a>
                <?php else: ?>
                    <a href="#" data-open="#loginModal">로그인</a>
                    <a href="#" data-open="#joinModal" class="join">회원가입</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- 로그인 모달 -->
    <dialog class="modal" id="loginModal">
        <form method="post" action="login">
            <h3>로그인</h3>
            <label>아이디 <input type="text" name="userid" required></label>
            <label>비밀번호 <input type="password" name="password" required></label>
            <div class="buttons">
                <button type="submit" class="btn">로그인</button>
                <button type="button" class="btn gray close">닫기</button>
            </div>
        </form>
    </dialog>

    <!-- 회원가입 모달: 아이디, 비밀번호, 이름, 사진, 자동입력방지 문자 -->
    <dialog class="modal" id="joinModal">
        <form method="post" action="join" enctype="multipart/form-data">
            <h3>회원가입</h3>
            <label>아이디 <input type="text" name="userid" required></label>
            <label>비밀번호 <input type="password" name="password" required></label>
            <label>이름 <input type="text" name="name" required></label>
            <label>사진 <input type="file" name="photo" accept="image/*" required></label>
            <div class="buttons">
                <button type="submit" class="btn">가입 완료</button>
                <button type="button" class="btn gray close">닫기</button>
            </div>
        </form>
    </dialog>

    <!-- 페이지 제목 -->
    <section class="sub-visual">
        <div class="inner">
            <p class="en">STORE</p>
            <h2>스토어</h2>
            <p>마음에 드는 상품 사진을 끌어다 장바구니에 놓아 보세요.</p>
        </div>
    </section>

    <section class="store">
        <div class="inner">
            <!-- 왼쪽: 검색 + 모든 상품 리스트 -->
            <div class="shop">
                <div class="search">
                    <input type="search" id="keyword" placeholder="상품명 또는 브랜드명으로 검색 (초성 검색: ㅇㄷ)" title="검색어">
                </div>
                <ul class="product-list" id="list"></ul>
                <p class="empty" id="empty" hidden>일치하는 상품이 없습니다.</p>
            </div>

            <!-- 오른쪽: 드롭 영역 + 장바구니 -->
            <aside class="cart">
                <div class="drop" id="drop">이곳에 상품을 넣어주세요.</div>
                <h3>장바구니</h3>
                <ul class="cart-list" id="cart"></ul>
                <p class="total">총합계 <strong id="total">0원</strong></p>
                <button type="button" class="btn" id="buyBtn">구매하기</button>
            </aside>
        </div>
    </section>

    <!-- 구매하기 모달: 이름과 주소 -->
    <dialog class="modal" id="buyModal">
        <form id="buyForm">
            <h3>구매하기</h3>
            <label>이름 <input type="text" id="buyer" required></label>
            <label>주소 <input type="text" id="address" required></label>
            <div class="buttons">
                <button type="submit" class="btn">구매 완료</button>
                <button type="button" class="btn gray close">닫기</button>
            </div>
        </form>
    </dialog>

    <!-- 구매 내역 모달: canvas 로 만든 이미지 (마우스 오른쪽 버튼으로 저장) -->
    <dialog class="modal" id="receiptModal">
        <h3>구매 내역</h3>
        <div id="receipt"></div>
        <p class="tip">이미지에 마우스 오른쪽 버튼을 눌러 '이미지를 다른 이름으로 저장'할 수 있습니다.</p>
        <div class="buttons">
            <button type="button" class="btn gray close">닫기</button>
        </div>
    </dialog>

    <script src="js/store.js"></script>

    <!-- 푸터: 카피라이트 -->
    <footer class="footer">
        <div class="inner">
            <img src="images/logo_white.png" alt="내집꾸미기" title="내집꾸미기">
            <p>COPYRIGHT ⓒ 2020 내집꾸미기. ALL RIGHTS RESERVED.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
