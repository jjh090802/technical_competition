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
                    <li><a href="store">스토어</a></li>
                    <li><a href="specialist" class="on">전문가</a></li>
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
                    <a href="./">로그인</a>
                    <a href="./" class="join">회원가입</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- 페이지 제목 -->
    <section class="sub-visual">
        <div class="inner">
            <p class="en">SPECIALIST</p>
            <h2>전문가</h2>
            <p>시공을 맡겨 본 전문가에게 후기와 평점을 남겨 주세요.</p>
        </div>
    </section>

    <!-- 전문가 리스트 -->
    <section class="board">
        <div class="inner">
            <h3 class="board-title">전문가 리스트</h3>
            <ul class="specialist-board">
                                    <li>
                        <img src="images/specialist/specialist1.jpg" alt="전문가1 사진" title="전문가1">
                        <p class="name">전문가1 <span>specialist1</span></p>
                        <p class="score"><span class="star">★★★★☆</span> 평점 <b>4</b></p>
                                                    <button type="button" class="btn small" data-open="#reviewModal" data-id="specialist1"
                                    data-title="전문가1(specialist1) 시공 후기 작성">시공 후기 작성</button>
                                            </li>
                                    <li>
                        <img src="images/specialist/specialist2.jpg" alt="전문가2 사진" title="전문가2">
                        <p class="name">전문가2 <span>specialist2</span></p>
                        <p class="score"><span class="star">★★★★★</span> 평점 <b>5</b></p>
                                                    <button type="button" class="btn small" data-open="#reviewModal" data-id="specialist2"
                                    data-title="전문가2(specialist2) 시공 후기 작성">시공 후기 작성</button>
                                            </li>
                                    <li>
                        <img src="images/specialist/specialist3.jpg" alt="전문가3 사진" title="전문가3">
                        <p class="name">전문가3 <span>specialist3</span></p>
                        <p class="score"><span class="star">★★★★☆</span> 평점 <b>4</b></p>
                                                    <button type="button" class="btn small" data-open="#reviewModal" data-id="specialist3"
                                    data-title="전문가3(specialist3) 시공 후기 작성">시공 후기 작성</button>
                                            </li>
                                    <li>
                        <img src="images/specialist/specialist4.jpg" alt="전문가4 사진" title="전문가4">
                        <p class="name">전문가4 <span>specialist4</span></p>
                        <p class="score"><span class="star">★★★★☆</span> 평점 <b>4</b></p>
                                                    <button type="button" class="btn small" data-open="#reviewModal" data-id="specialist4"
                                    data-title="전문가4(specialist4) 시공 후기 작성">시공 후기 작성</button>
                                            </li>
                            </ul>

            <!-- 시공 후기 리스트 -->
            <h3 class="board-title">시공 후기</h3>
            <table class="table">
                <tr>
                    <th>전문가</th>
                    <th>작성자</th>
                    <th>비용</th>
                    <th>내용</th>
                    <th>평점</th>
                </tr>
                                    <tr>
                        <td>전문가4(specialist4)</td>
                        <td>김하늘(kim)</td>
                        <td>600,000원</td>
                        <td class="left">조명 위치만 바꿔도 방이 달라 보인다는 걸 알았어요. 친절하게 설명해 주셨습니다.</td>
                        <td><span class="star">★★★★☆</span> 4</td>
                    </tr>
                                    <tr>
                        <td>전문가1(specialist1)</td>
                        <td>최도윤(choi)</td>
                        <td>2,000,000원</td>
                        <td class="left">서재 책장과 조명 공사를 깔끔하게 해 주셨어요. 일정도 약속대로 지켜 주셨습니다.</td>
                        <td><span class="star">★★★★☆</span> 4</td>
                    </tr>
                                    <tr>
                        <td>전문가2(specialist2)</td>
                        <td>박소연(park)</td>
                        <td>800,000원</td>
                        <td class="left">가지고 있던 가구 배치만 바꿨는데 집이 훨씬 넓어 보여요. 소품 추천도 센스 있으셨어요.</td>
                        <td><span class="star">★★★★★</span> 5</td>
                    </tr>
                                    <tr>
                        <td>전문가3(specialist3)</td>
                        <td>이달님(lee)</td>
                        <td>1,200,000원</td>
                        <td class="left">작은방 도배와 장판을 하루 만에 끝내 주셨어요. 마감이 깔끔하고 뒷정리까지 완벽했습니다.</td>
                        <td><span class="star">★★★★☆</span> 4</td>
                    </tr>
                                    <tr>
                        <td>전문가1(specialist1)</td>
                        <td>김하늘(kim)</td>
                        <td>3,500,000원</td>
                        <td class="left">낡은 거실 벽지와 바닥을 새로 시공했습니다. 날마다 사진으로 진행 상황을 알려 주셔서 믿고 맡길 수 있었어요.</td>
                        <td><span class="star">★★★★★</span> 5</td>
                    </tr>
                                            </table>
        </div>
    </section>

    <!-- 시공 후기 작성 모달 -->
    <dialog class="modal" id="reviewModal">
        <form method="post">
            <input type="hidden" name="action" value="review">
            <input type="hidden" name="id">
            <h3>시공 후기 작성</h3>
            <label>비용(원) <input type="number" name="cost" min="1" required></label>
            <label>내용 <textarea name="content" rows="5" required></textarea></label>
            <p class="label">평점</p>
            <div class="score-radio">
                                    <label><input type="radio" name="score" value="1" required> 1</label>
                                    <label><input type="radio" name="score" value="2" required> 2</label>
                                    <label><input type="radio" name="score" value="3" required> 3</label>
                                    <label><input type="radio" name="score" value="4" required> 4</label>
                                    <label><input type="radio" name="score" value="5" required> 5</label>
                            </div>
            <div class="buttons">
                <button type="submit" class="btn">작성 완료</button>
                <button type="button" class="btn gray close">닫기</button>
            </div>
        </form>
    </dialog>

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
