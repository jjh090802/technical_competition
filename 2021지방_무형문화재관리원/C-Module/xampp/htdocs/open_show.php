<?php
$apiBase = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/openAPI/';
$curYear = date('Y');
$curMonth = date('n');
$pageTitle = '공연 일정 조회';
$gnb = 'open';
$lnb = '공연 일정 조회';
include 'inc/header.php';
?>
            <p class="api-lead">등록된 공연 일정을 <b>REST</b> 방식으로 조회합니다. 응답은 <b>JSON</b> 이고, <b>월별(M)</b>로 부르면 공연일이 그 달인 공연만, <b>년도별(Y)</b>로 부르면 그해의 공연만 돌려줍니다. 월간·연간 공연 일정 화면과 같은 데이터입니다.</p>

            <!-- 1. 전문 정보 -->
            <section class="api">
                <h3>1. 전문 정보</h3>
                <table class="board api-table">
                    <caption class="blind">전문 정보</caption>
                    <tbody>
                        <tr><th scope="row">전문명</th><td class="left">공연 일정 조회</td></tr>
                        <tr><th scope="row">요청 주소</th><td class="left"><code><?php echo htmlspecialchars($apiBase); ?>showList.php</code></td></tr>
                        <tr><th scope="row">요청 방식</th><td class="left">GET (주소 뒤에 ?항목=값&amp;항목=값)</td></tr>
                        <tr><th scope="row">응답 형식</th><td class="left">JSON (UTF-8)</td></tr>
                    </tbody>
                </table>
            </section>

            <!-- 2. 요청 항목 -->
            <section class="api">
                <h3>2. 요청 항목</h3>
                <table class="board api-table">
                    <caption class="blind">요청 항목</caption>
                    <thead>
                        <tr><th scope="col">항목명</th><th scope="col">국문명</th><th scope="col">필수</th><th scope="col">샘플</th><th scope="col">설명</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><code>searchType</code></td><td>조회 구분</td><td class="must">필수</td><td>M</td><td class="left">M: 월별, Y: 년도별</td></tr>
                        <tr><td><code>year</code></td><td>년도</td><td class="must">필수</td><td>2021</td><td class="left">4자리 년도</td></tr>
                        <tr><td><code>month</code></td><td>월</td><td>가변</td><td>4</td><td class="left">월별(M) 조회 때 필수 (1~12)</td></tr>
                    </tbody>
                </table>
            </section>

            <!-- 3. 응답 항목 -->
            <section class="api">
                <h3>3. 응답 항목</h3>
                <table class="board api-table">
                    <caption class="blind">응답 항목</caption>
                    <thead>
                        <tr><th scope="col">항목명</th><th scope="col">국문명</th><th scope="col">필수</th><th scope="col">샘플</th><th scope="col">설명</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><code>showType</code></td><td>공연 종류</td><td class="must">필수</td><td>M</td><td class="left">요청한 조회 구분</td></tr>
                        <tr><td><code>year</code></td><td>년도</td><td class="must">필수</td><td>2021</td><td class="left">요청 년도</td></tr>
                        <tr><td><code>month</code></td><td>월</td><td>가변</td><td>4</td><td class="left">요청 월 (년도별이면 null)</td></tr>
                        <tr><td><code>totalCount</code></td><td>항목수</td><td class="must">필수</td><td>17</td><td class="left">조건에 맞는 공연 수</td></tr>
                        <tr><td><code>items</code></td><td>조회 결과 항목 목록</td><td></td><td></td><td class="left">0..n</td></tr>
                        <tr class="sub-row"><td><code>showUid</code></td><td>공연 고유번호</td><td class="must">필수</td><td>1</td><td class="left"></td></tr>
                        <tr class="sub-row"><td><code>showName</code></td><td>공연명</td><td class="must">필수</td><td>신노이</td><td class="left"></td></tr>
                        <tr class="sub-row"><td><code>showDt</code></td><td>공연일시</td><td class="must">필수</td><td>2018-01-01 14:00</td><td class="left">공연일자 + 공연시간</td></tr>
                        <tr class="sub-row"><td><code>organizer</code></td><td>주관</td><td></td><td>무형문화재관리원</td><td class="left"></td></tr>
                        <tr class="sub-row"><td><code>place</code></td><td>공연장소</td><td></td><td>얼쑤마루</td><td class="left"></td></tr>
                        <tr class="sub-row"><td><code>cast</code></td><td>출연진</td><td></td><td>미정</td><td class="left"></td></tr>
                        <tr class="sub-row"><td><code>rm</code></td><td>공연내용</td><td></td><td></td><td class="left"></td></tr>
                    </tbody>
                </table>
            </section>

            <!-- 4. 요청 · 응답 예시 -->
            <section class="api">
                <h3>4. 요청 · 응답 예시</h3>
                <ul class="api-links">
                    <li><a href="openAPI/showList.php?searchType=M&amp;year=<?= $curYear ?>&amp;month=<?= $curMonth ?>" target="_blank">/openAPI/showList.php?searchType=M&amp;year=<?= $curYear ?>&amp;month=<?= $curMonth ?></a> 이번 달 공연</li>
                    <li><a href="openAPI/showList.php?searchType=Y&amp;year=<?= $curYear ?>" target="_blank">/openAPI/showList.php?searchType=Y&amp;year=<?= $curYear ?></a> 올해 공연</li>
                    <li><a href="openAPI/showList.php?searchType=M&amp;year=<?= $curYear ?>" target="_blank">/openAPI/showList.php?searchType=M&amp;year=<?= $curYear ?></a> month 가 없는 잘못된 요청 (400)</li>
                </ul>
<pre class="code">{
    "showType": "M",
    "year": 2021,
    "month": 4,
    "totalCount": 2,
    "items": [
        {
            "showUid": 4,
            "showName": "판소리 다섯 바탕",
            "showDt": "2021-04-15 14:00",
            "organizer": "무형문화재관리원",
            "place": "얼쑤마루 대공연장",
            "cast": "국가무형문화재 보유자 및 전승자",
            "rm": "매달 한 번 여는 기획 공연입니다."
        },
        …
    ]
}

잘못된 요청 (HTTP 400)
{ "error": "월별 조회(M)에는 month(1~12)를 꼭 보내야 합니다." }</pre>
            </section>

            <!-- 5. 바로 해 보기 -->
            <section class="api">
                <h3>5. 바로 해 보기</h3>
                <form class="api-try" action="openAPI/showList.php" method="get" target="_blank">
                    <label>searchType
                        <select name="searchType">
                            <option value="M">M (월별)</option>
                            <option value="Y">Y (년도별)</option>
                        </select>
                    </label>
                    <label>year <input type="number" name="year" value="<?= $curYear ?>" min="1000" max="9999" required></label>
                    <label>month <input type="number" name="month" value="<?= $curMonth ?>" min="1" max="12"></label>
                    <button type="submit" class="btn btn-main">조회 (새 창)</button>
                </form>
            </section>

<?php include 'inc/footer.php'; ?>
