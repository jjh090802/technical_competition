<?php
$apiBase = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/openAPI/';
$pageTitle = '무형문화재 현황 조회';
$gnb = 'open';
$lnb = '무형문화재 현황 조회';
include 'inc/header.php';
?>
            <p class="api-lead">등록된 무형문화재 현황을 <b>REST</b> 방식으로 조회합니다. 응답은 <b>JSON</b> 이고, 그림은 <b>base64</b> 로 들어 있어 따로 그림 주소를 부르지 않고 img 태그의 src 에 그대로 넣어 쓸 수 있습니다.</p>

            <!-- 1. 전문 정보 -->
            <section class="api">
                <h3>1. 전문 정보</h3>
                <table class="board api-table">
                    <caption class="blind">전문 정보</caption>
                    <tbody>
                        <tr><th scope="row">전문명</th><td class="left">무형문화재 정보 조회 (상세 정보 포함)</td></tr>
                        <tr><th scope="row">요청 주소</th><td class="left"><code><?php echo htmlspecialchars($apiBase); ?>nihList.php</code></td></tr>
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
                        <tr><td><code>pageNo</code></td><td>페이지 번호</td><td class="must">필수</td><td>1</td><td class="left">요청 페이지 번호 (1 부터)</td></tr>
                        <tr><td><code>numOfRows</code></td><td>페이지당 항목수</td><td class="must">필수</td><td>3</td><td class="left">한 페이지에 받을 항목 수 (1~100)</td></tr>
                        <tr><td><code>bcodeName</code></td><td>무형문화 종류</td><td>선택</td><td>전통 공연</td><td class="left">이 글자가 들어간 종류만 (포함 검색). 없으면 전체</td></tr>
                    </tbody>
                </table>
            </section>

            <!-- 3. 응답 항목 -->
            <section class="api">
                <h3>3. 응답 항목</h3>
                <table class="board api-table">
                    <caption class="blind">응답 항목</caption>
                    <thead>
                        <tr><th scope="col">항목명</th><th scope="col">국문명</th><th scope="col">필수</th><th scope="col">샘플</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><code>numOfRows</code></td><td>페이지당 항목수</td><td class="must">필수</td><td>3</td></tr>
                        <tr><td><code>pageNo</code></td><td>페이지</td><td class="must">필수</td><td>1</td></tr>
                        <tr><td><code>totalCount</code></td><td>모든 항목수 (조건에 맞는)</td><td class="must">필수</td><td>11</td></tr>
                        <tr><td><code>items</code></td><td>조회 결과 항목 목록 (0..n)</td><td></td><td>아래 항목들</td></tr>
                                                                        <tr class="sub-row">
                            <td><code>ccbaKdcd</code></td>
                            <td>종목코드</td>
                            <td class="must">필수</td>
                            <td>17</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaAsno</code></td>
                            <td>지정번호</td>
                            <td class="must">필수</td>
                            <td>00170000</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaCtcd</code></td>
                            <td>시도코드</td>
                            <td class="must">필수</td>
                            <td>11</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaCpno</code></td>
                            <td>연계번호</td>
                            <td class=""></td>
                            <td>1271100170000</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>longitude</code></td>
                            <td>경도</td>
                            <td class=""></td>
                            <td>0</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>latitude</code></td>
                            <td>위도</td>
                            <td class=""></td>
                            <td>0</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccmaName</code></td>
                            <td>문화재종목</td>
                            <td class="must">필수</td>
                            <td>국가무형문화재</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>crltsnoNm</code></td>
                            <td>지정호수</td>
                            <td class="must">필수</td>
                            <td>17</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaMnm1</code></td>
                            <td>문화재명(국문)</td>
                            <td class="must">필수</td>
                            <td>봉산탈춤</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaMnm2</code></td>
                            <td>문화재명(한자)</td>
                            <td class=""></td>
                            <td>鳳山탈춤</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>gcodeName</code></td>
                            <td>문화재분류</td>
                            <td class=""></td>
                            <td>무형문화재</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>bcodeName</code></td>
                            <td>문화재분류2(종류)</td>
                            <td class=""></td>
                            <td>전통 공연·예술</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>mcodeName</code></td>
                            <td>문화재분류3</td>
                            <td class=""></td>
                            <td>연희</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>scodeName</code></td>
                            <td>문화재분류4</td>
                            <td class=""></td>
                            <td></td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaQuan</code></td>
                            <td>수량</td>
                            <td class=""></td>
                            <td></td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaAsdt</code></td>
                            <td>지정(등록일)</td>
                            <td class=""></td>
                            <td>19670616</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaCtcdNm</code></td>
                            <td>시도명</td>
                            <td class=""></td>
                            <td>서울특별시</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccsiName</code></td>
                            <td>시군구명</td>
                            <td class=""></td>
                            <td></td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaLcad</code></td>
                            <td>소재지 상세</td>
                            <td class=""></td>
                            <td>서울특별시</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccceName</code></td>
                            <td>시대</td>
                            <td class=""></td>
                            <td></td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaPoss</code></td>
                            <td>소유자</td>
                            <td class=""></td>
                            <td></td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaAdmin</code></td>
                            <td>관리자</td>
                            <td class=""></td>
                            <td>(사)봉산탈춤보존회</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaCncl</code></td>
                            <td>지정해제여부</td>
                            <td class=""></td>
                            <td>N</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>ccbaCndt</code></td>
                            <td>지정해제일</td>
                            <td class=""></td>
                            <td></td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>image</code></td>
                            <td>이미지</td>
                            <td class=""></td>
                            <td>data:image/jpeg;base64,/9j/4AAQ…</td>
                        </tr>
                                                <tr class="sub-row">
                            <td><code>content</code></td>
                            <td>설명</td>
                            <td class=""></td>
                            <td>탈춤이란…</td>
                        </tr>
                                            </tbody>
                </table>
            </section>

            <!-- 4. 요청 · 응답 예시 -->
            <section class="api">
                <h3>4. 요청 · 응답 예시</h3>
                <ul class="api-links">
                    <li><a href="openAPI/nihList.php?pageNo=1&amp;numOfRows=3" target="_blank">/openAPI/nihList.php?pageNo=1&amp;numOfRows=3</a> 첫 페이지 3건</li>
                    <li><a href="openAPI/nihList.php?pageNo=2&amp;numOfRows=3&amp;bcodeName=%EC%A0%84%ED%86%B5+%EA%B3%B5%EC%97%B0" target="_blank">/openAPI/nihList.php?pageNo=2&amp;numOfRows=3&amp;bcodeName=전통 공연</a> '전통 공연'이 들어간 종류의 2페이지</li>
                    <li><a href="openAPI/nihList.php?pageNo=1" target="_blank">/openAPI/nihList.php?pageNo=1</a> numOfRows 가 없는 잘못된 요청 (400)</li>
                </ul>
<pre class="code">{
    "numOfRows": 3,
    "pageNo": 1,
    "totalCount": 36,
    "items": [
        {
            "ccbaKdcd": "17",
            "ccbaAsno": "00010000",
            "ccbaCtcd": "11",
            "ccbaCpno": "1271100010000",
            "longitude": "126.994",
            "latitude": "37.5749",
            "ccmaName": "국가무형문화재",
            "crltsnoNm": "1",
            "ccbaMnm1": "종묘제례악",
            "ccbaMnm2": "宗廟祭禮樂",
            "gcodeName": "무형문화재",
            "bcodeName": "전통 공연·예술",
            …
            "image": "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD…",
            "content": "종묘에서 역대 왕과 왕비의 신위를 모시는 제사 때 …"
        },
        …
    ]
}

잘못된 요청 (HTTP 400)
{ "error": "pageNo(1 이상)와 numOfRows(1~100)를 숫자로 꼭 보내야 합니다." }</pre>
                <p class="api-tip">그림 쓰는 법: <code>&lt;img src="items[0].image 값"&gt;</code> 처럼 image 값을 그대로 src 에 넣습니다.</p>
            </section>

            <!-- 5. 바로 해 보기 -->
            <section class="api">
                <h3>5. 바로 해 보기</h3>
                <form class="api-try" action="openAPI/nihList.php" method="get" target="_blank">
                    <label>pageNo <input type="number" name="pageNo" value="1" min="1" required></label>
                    <label>numOfRows <input type="number" name="numOfRows" value="3" min="1" max="100" required></label>
                    <label>bcodeName <input type="text" name="bcodeName" placeholder="예) 전통 공연"></label>
                    <button type="submit" class="btn btn-main">조회 (새 창)</button>
                </form>
            </section>

<?php include 'inc/footer.php'; ?>
