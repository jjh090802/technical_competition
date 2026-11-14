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
                                            <li><a href="specialist">전문가</a></li>
                                            <li><a href="estimate" class="on">시공 견적</a></li>
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
            <p class="en">ESTIMATE</p>
            <h2>시공 견적</h2>
            <p>시공 견적을 요청하면 전문가들이 견적을 보내 드립니다.</p>
        </div>
    </section>

    <section class="board">
        <div class="inner">
            <!-- 시공 견적 요청 리스트 -->
            <div class="board-top">
                <h3 class="board-title">시공 견적 요청 리스트</h3>
                <button type="button" class="btn" data-open="#requestModal">견적 요청</button>
            </div>
            <table class="table">
                <tr>
                    <th>회원</th>
                    <th>시공일</th>
                    <th>내용</th>
                    <th>상태</th>
                    <th>견적 개수</th>
                    <th>견적</th>
                </tr>
                                    <tr>
                        <td>박소연(park)</td>
                        <td>2026-12-12</td>
                        <td class="left">욕실 타일 줄눈 보수</td>
                        <td><span class="state ">진행 중</span></td>
                        <td>0개</td>
                        <td>
                                                                                </td>
                    </tr>
                                    <tr>
                        <td>김하늘(kim)</td>
                        <td>2026-12-05</td>
                        <td class="left">주방 상판 교체와 조명 달기</td>
                        <td><span class="state ">진행 중</span></td>
                        <td>2개</td>
                        <td>
                                                                                        <button type="button" class="btn small green" data-open="#view4">견적 보기</button>
                                                    </td>
                    </tr>
                                    <tr>
                        <td>이달님(lee)</td>
                        <td>2026-11-28</td>
                        <td class="left">작은방 도배와 장판</td>
                        <td><span class="state ">진행 중</span></td>
                        <td>2개</td>
                        <td>
                                                                                </td>
                    </tr>
                                    <tr>
                        <td>김하늘(kim)</td>
                        <td>2026-11-02</td>
                        <td class="left">거실 벽지와 바닥 교체</td>
                        <td><span class="state done">완료</span></td>
                        <td>3개</td>
                        <td>
                                                                                        <button type="button" class="btn small green" data-open="#view2">견적 보기</button>
                                                    </td>
                    </tr>
                                    <tr>
                        <td>최도윤(choi)</td>
                        <td>2026-10-20</td>
                        <td class="left">서재 벽 도장과 책장 설치</td>
                        <td><span class="state done">완료</span></td>
                        <td>1개</td>
                        <td>
                                                                                </td>
                    </tr>
                                            </table>

                    </div>
    </section>

    <!-- 견적 요청 모달 -->
    <dialog class="modal" id="requestModal">
        <form method="post">
            <input type="hidden" name="action" value="request">
            <h3>견적 요청</h3>
            <label>시공일 <input type="date" name="work_date" required></label>
            <label>내용 <textarea name="content" rows="5" required></textarea></label>
            <div class="buttons">
                <button type="submit" class="btn">작성 완료</button>
                <button type="button" class="btn gray close">닫기</button>
            </div>
        </form>
    </dialog>

    <!-- 견적 보내기 모달 (전문가) -->
    <dialog class="modal" id="sendModal">
        <form method="post">
            <input type="hidden" name="action" value="send">
            <input type="hidden" name="id">
            <h3>견적 보내기</h3>
            <label>비용(원) <input type="number" name="cost" min="1" required></label>
            <div class="buttons">
                <button type="submit" class="btn">입력 완료</button>
                <button type="button" class="btn gray close">닫기</button>
            </div>
        </form>
    </dialog>

    <!-- 견적 보기 모달: 내 요청마다 하나씩, 받은 견적 리스트. 선택 버튼은 진행 중일 때만 -->
                                            <dialog class="modal wide" id="view4">
            <h3>받은 견적 (2026-12-05 시공)</h3>
            <table class="table">
                <tr>
                    <th>전문가</th>
                    <th>비용</th>
                    <th>선택</th>
                </tr>
                                    <tr>
                        <td>전문가2(specialist2)</td>
                        <td>2,500,000원</td>
                        <td>
                                                            <form method="post">
                                    <input type="hidden" name="action" value="select">
                                    <input type="hidden" name="id" value="7">
                                    <button type="submit" class="btn small">선택</button>
                                </form>
                                                    </td>
                    </tr>
                                    <tr>
                        <td>전문가4(specialist4)</td>
                        <td>2,700,000원</td>
                        <td>
                                                            <form method="post">
                                    <input type="hidden" name="action" value="select">
                                    <input type="hidden" name="id" value="8">
                                    <button type="submit" class="btn small">선택</button>
                                </form>
                                                    </td>
                    </tr>
                                            </table>
            <div class="buttons">
                <button type="button" class="btn gray close">닫기</button>
            </div>
        </dialog>
                                            <dialog class="modal wide" id="view2">
            <h3>받은 견적 (2026-11-02 시공)</h3>
            <table class="table">
                <tr>
                    <th>전문가</th>
                    <th>비용</th>
                    <th>선택</th>
                </tr>
                                    <tr>
                        <td>전문가1(specialist1)</td>
                        <td>3,200,000원</td>
                        <td>
                                                    </td>
                    </tr>
                                    <tr>
                        <td>전문가2(specialist2)</td>
                        <td>2,900,000원</td>
                        <td>
                                                            <span class="state done">선택됨</span>
                                                    </td>
                    </tr>
                                    <tr>
                        <td>전문가3(specialist3)</td>
                        <td>3,100,000원</td>
                        <td>
                                                    </td>
                    </tr>
                                            </table>
            <div class="buttons">
                <button type="button" class="btn gray close">닫기</button>
            </div>
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
