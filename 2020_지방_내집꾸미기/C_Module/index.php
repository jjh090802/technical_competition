<?php 
    session_start();
    
?>
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
                    <li><a href="./" class="on">홈</a></li>
                    <li><a href="housewarming">온라인 집들이</a></li>
                    <li><a href="store">스토어</a></li>
                    <li><a href="specialist">전문가</a></li>
                    <li><a href="estimate">시공 견적</a></li>
                </ul>
            </nav>

            <div class="util">
                <?php if (isset($_SESSION['user'])): ?>
                    <span><?= htmlspecialchars($_SESSION['user']['name']) ?>(<?= htmlspecialchars($_SESSION['user']['userid']) ?>)</span>
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

    <!-- 비주얼 슬라이드: 2초마다 1→2→3→2→1… (자바스크립트 없이 CSS 애니메이션) -->
    <section class="visual">
        <!-- 장면 1, 2, 3, 2(돌아오는 2) 를 고르는 라디오. 이전·다음 아이콘(label)이 이것을 고른다 -->
        <input type="radio" name="slide" id="s1">
        <input type="radio" name="slide" id="s2">
        <input type="radio" name="slide" id="s3">
        <input type="radio" name="slide" id="s4">

        <ul class="slides">
            <li>
                <img src="images/visual1.jpg" alt="세이지 그린 벽과 주황색 소파가 있는 거실" title="세이지 그린 거실">
                <div class="text">
                    <p class="en">ONLINE HOUSEWARMING</p>
                    <h2>우리 집의 변신,<br>온라인 집들이</h2>
                    <p>Before &amp; After 사진으로 이웃들의 인테리어 노하우를 만나 보세요.</p>
                    <a href="housewarming" class="btn">집들이 구경하기</a>
                </div>
            </li>
            <li>
                <img src="images/visual2.jpg" alt="패브릭 침대와 무드등이 있는 침실" title="아늑한 침실">
                <div class="text">
                    <p class="en">STORE</p>
                    <h2>공간을 채우는<br>감성 소품</h2>
                    <p>조명, 쿠션, 화분까지 우리 집에 어울리는 소품을 골라 보세요.</p>
                    <a href="store" class="btn">스토어 둘러보기</a>
                </div>
            </li>
            <li>
                <img src="images/visual3.jpg" alt="펜던트 조명 아래 원목 식탁이 있는 주방" title="원목 식탁 주방">
                <div class="text">
                    <p class="en">SPECIALIST</p>
                    <h2>믿을 수 있는<br>전문가 시공</h2>
                    <p>시공 견적을 요청하고 여러 전문가의 견적을 비교해 보세요.</p>
                    <a href="estimate" class="btn">시공 견적 요청</a>
                </div>
            </li>
        </ul>

        <!-- 장면마다 이전·다음 아이콘 한 쌍. 지금 장면의 한 쌍만 보인다 -->
        <div class="arrows">
            <p class="a1"><label for="s4" class="prev" title="이전 이미지">이전</label><label for="s2" class="next" title="다음 이미지">다음</label></p>
            <p class="a2"><label for="s1" class="prev" title="이전 이미지">이전</label><label for="s3" class="next" title="다음 이미지">다음</label></p>
            <p class="a3"><label for="s2" class="prev" title="이전 이미지">이전</label><label for="s4" class="next" title="다음 이미지">다음</label></p>
            <p class="a4"><label for="s3" class="prev" title="이전 이미지">이전</label><label for="s1" class="next" title="다음 이미지">다음</label></p>
        </div>
    </section>

    <!-- 온라인 집들이: Before 사진에 마우스를 올리면 After 사진이 왼쪽부터 쓸려 나온다 -->
    <section class="section house">
        <div class="inner">
            <div class="title">
                <p class="en">ONLINE HOUSEWARMING</p>
                <h2>온라인 집들이</h2>
                <p>사진에 마우스를 올리면 바뀐 모습(After)을 볼 수 있어요.</p>
                <a href="housewarming" class="more">더보기 +</a>
            </div>
            <ul class="house-list">
                <li>
                    <div class="photo">
                        <img src="images/house/before1.jpg" alt="회색 벽의 빈 거실 (Before)" title="Before">
                        <span class="tag">BEFORE</span>
                        <div class="after">
                            <img src="images/house/after1.jpg" alt="세이지 그린 거실 (After)" title="After">
                            <span class="tag">AFTER</span>
                        </div>
                        <span class="line"></span>
                    </div>
                    <p class="knowhow">회색 거실 벽을 세이지 그린으로 칠하고 주황색 소파로 포인트를 주었어요.</p>
                    <p class="info"><span class="writer">sky_kim</span><span class="star">★★★★★ <b>5</b></span></p>
                </li>
                <li>
                    <div class="photo">
                        <img src="images/house/before2.jpg" alt="매트리스만 있는 방 (Before)" title="Before">
                        <span class="tag">BEFORE</span>
                        <div class="after">
                            <img src="images/house/after2.jpg" alt="침대와 무드등이 있는 침실 (After)" title="After">
                            <span class="tag">AFTER</span>
                        </div>
                        <span class="line"></span>
                    </div>
                    <p class="knowhow">매트리스만 있던 방에 패브릭 헤드보드 침대와 무드등을 들였더니 호텔 같아졌어요.</p>
                    <p class="info"><span class="writer">moon_lee</span><span class="star">★★★★☆ <b>4</b></span></p>
                </li>
                <li>
                    <div class="photo">
                        <img src="images/house/before3.jpg" alt="낡은 주방 (Before)" title="Before">
                        <span class="tag">BEFORE</span>
                        <div class="after">
                            <img src="images/house/after3.jpg" alt="펜던트 조명과 식탁이 있는 주방 (After)" title="After">
                            <span class="tag">AFTER</span>
                        </div>
                        <span class="line"></span>
                    </div>
                    <p class="knowhow">식탁 위에 펜던트 조명 두 개만 달아도 주방 분위기가 확 달라집니다.</p>
                    <p class="info"><span class="writer">hello_park</span><span class="star">★★★★★ <b>5</b></span></p>
                </li>
                <li>
                    <div class="photo">
                        <img src="images/house/before4.jpg" alt="상자만 쌓인 방 (Before)" title="Before">
                        <span class="tag">BEFORE</span>
                        <div class="after">
                            <img src="images/house/after4.jpg" alt="책장과 책상이 있는 서재 (After)" title="After">
                            <span class="tag">AFTER</span>
                        </div>
                        <span class="line"></span>
                    </div>
                    <p class="knowhow">한쪽 벽만 초록색으로 칠하고 책장을 두어 집중이 잘 되는 서재를 만들었어요.</p>
                    <p class="info"><span class="writer">choi_desk</span><span class="star">★★★☆☆ <b>3</b></span></p>
                </li>
            </ul>
        </div>
    </section>

    <!-- 전문가: 사진에 마우스를 올리면 카드가 뒤집혀 이름·아이디가 보인다 -->
    <section class="section expert">
        <div class="inner">
            <div class="title">
                <p class="en">SPECIALIST</p>
                <h2>전문가</h2>
                <p>우리 집을 함께 꾸며 줄 인테리어 전문가를 만나 보세요.</p>
                <a href="specialist" class="more">더보기 +</a>
            </div>
            <ul class="expert-list">
                <li class="card">
                    <div class="card-in">
                        <div class="front">
                            <img src="images/specialist/specialist1.jpg" alt="전문가1 사진" title="전문가1">
                            <p>거실·주방 리모델링</p>
                        </div>
                        <div class="back">
                            <strong>전문가1</strong>
                            <span>specialist1</span>
                            <p>거실·주방 리모델링</p>
                            <a href="specialist" class="btn">자세히 보기</a>
                        </div>
                    </div>
                </li>
                <li class="card">
                    <div class="card-in">
                        <div class="front">
                            <img src="images/specialist/specialist2.jpg" alt="전문가2 사진" title="전문가2">
                            <p>홈 스타일링</p>
                        </div>
                        <div class="back">
                            <strong>전문가2</strong>
                            <span>specialist2</span>
                            <p>홈 스타일링</p>
                            <a href="specialist" class="btn">자세히 보기</a>
                        </div>
                    </div>
                </li>
                <li class="card">
                    <div class="card-in">
                        <div class="front">
                            <img src="images/specialist/specialist3.jpg" alt="전문가3 사진" title="전문가3">
                            <p>도배·바닥 시공</p>
                        </div>
                        <div class="back">
                            <strong>전문가3</strong>
                            <span>specialist3</span>
                            <p>도배·바닥 시공</p>
                            <a href="specialist" class="btn">자세히 보기</a>
                        </div>
                    </div>
                </li>
                <li class="card">
                    <div class="card-in">
                        <div class="front">
                            <img src="images/specialist/specialist4.jpg" alt="전문가4 사진" title="전문가4">
                            <p>조명·가구 배치</p>
                        </div>
                        <div class="back">
                            <strong>전문가4</strong>
                            <span>specialist4</span>
                            <p>조명·가구 배치</p>
                            <a href="specialist" class="btn">자세히 보기</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <!-- 전문가 시공 후기 -->
    <section class="section review">
        <div class="inner">
            <div class="title">
                <p class="en">REVIEW</p>
                <h2>전문가 시공 후기</h2>
                <p>전문가에게 시공을 맡긴 회원들의 솔직한 후기입니다.</p>
                <a href="specialist" class="more">더보기 +</a>
            </div>
            <ul class="review-list">
                <li>
                    <div class="who">
                        <img src="images/specialist/specialist1.jpg" alt="전문가1 사진" title="전문가1">
                        <p><strong>전문가1</strong> <span>specialist1</span></p>
                        <span class="star">★★★★★ <b>5</b></span>
                    </div>
                    <p class="content">낡은 거실 벽지와 바닥을 새로 시공했습니다. 날마다 사진으로 진행 상황을 알려 주셔서 믿고 맡길 수 있었어요.</p>
                    <dl>
                        <dt>작성자</dt><dd>김하늘 (sky_kim)</dd>
                        <dt>비용</dt><dd>3,500,000원</dd>
                    </dl>
                </li>
                <li>
                    <div class="who">
                        <img src="images/specialist/specialist3.jpg" alt="전문가3 사진" title="전문가3">
                        <p><strong>전문가3</strong> <span>specialist3</span></p>
                        <span class="star">★★★★☆ <b>4</b></span>
                    </div>
                    <p class="content">작은방 도배와 장판을 하루 만에 끝내 주셨어요. 마감이 깔끔하고 뒷정리까지 완벽했습니다.</p>
                    <dl>
                        <dt>작성자</dt><dd>이달님 (moon_lee)</dd>
                        <dt>비용</dt><dd>1,200,000원</dd>
                    </dl>
                </li>
                <li>
                    <div class="who">
                        <img src="images/specialist/specialist2.jpg" alt="전문가2 사진" title="전문가2">
                        <p><strong>전문가2</strong> <span>specialist2</span></p>
                        <span class="star">★★★★★ <b>5</b></span>
                    </div>
                    <p class="content">가지고 있던 가구 배치만 바꿨는데 집이 훨씬 넓어 보여요. 소품 추천도 센스 있으셨어요.</p>
                    <dl>
                        <dt>작성자</dt><dd>박소연 (hello_park)</dd>
                        <dt>비용</dt><dd>800,000원</dd>
                    </dl>
                </li>
            </ul>
        </div>
    </section>

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
