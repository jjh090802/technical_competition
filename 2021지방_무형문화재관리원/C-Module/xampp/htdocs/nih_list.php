<?php
$pageTitle = '전체 현황';
$gnb = 'nih';
$lnb = '전체 현황';
include 'inc/header.php';
?>
            <!-- 총 개수 · 현재 페이지 / 총 페이지 + 보기 방식 -->
            <div class="list-top">
                <p class="count">총 <b>37</b>건 · <b>1</b> / 4 페이지</p>
                <p class="view-btns">
                    <a href="nih.php?view=album&amp;bcode=&amp;page=1" class="">앨범</a>
                    <a href="nih.php?view=list&amp;bcode=&amp;page=1" class="on">목록</a>
                </p>
            </div>
            <p class="tool-right"><a href="nih_form.php?view=list&amp;bcode=&amp;page=1" class="btn btn-main">등록</a></p>

                        <!-- 목록형: 문화재명을 누르면 수정 화면 -->
            <table class="board">
                <caption class="blind">무형문화재 목록</caption>
                <thead>
                    <tr>
                        <th scope="col">순번</th>
                        <th scope="col">문화재명</th>
                        <th scope="col">문화재 종목</th>
                        <th scope="col">지정호수</th>
                        <th scope="col">소재지</th>
                        <th scope="col" class="hide-m">분류</th>
                    </tr>
                </thead>
                <tbody>
                                        <tr>
                        <td>1</td>
                        <td class="name"><a href="nih_form.php?id=1&amp;view=list&amp;bcode=&amp;page=1">종묘제례악</a></td>
                        <td>국가무형문화재</td>
                        <td>제1호</td>
                        <td>서울특별시 종로구</td>
                        <td class="hide-m">전통 공연·예술</td>
                    </tr>
                                        <tr>
                        <td>2</td>
                        <td class="name"><a href="nih_form.php?id=2&amp;view=list&amp;bcode=&amp;page=1">양주별산대놀이</a></td>
                        <td>국가무형문화재</td>
                        <td>제2호</td>
                        <td>경기도 양주시</td>
                        <td class="hide-m">전통 공연·예술</td>
                    </tr>
                                        <tr>
                        <td>3</td>
                        <td class="name"><a href="nih_form.php?id=3&amp;view=list&amp;bcode=&amp;page=1">남사당놀이</a></td>
                        <td>국가무형문화재</td>
                        <td>제3호</td>
                        <td>서울특별시</td>
                        <td class="hide-m">전통 공연·예술</td>
                    </tr>
                                        <tr>
                        <td>4</td>
                        <td class="name"><a href="nih_form.php?id=4&amp;view=list&amp;bcode=&amp;page=1">갓일</a></td>
                        <td>국가무형문화재</td>
                        <td>제4호</td>
                        <td>서울특별시</td>
                        <td class="hide-m">전통기술</td>
                    </tr>
                                        <tr>
                        <td>5</td>
                        <td class="name"><a href="nih_form.php?id=5&amp;view=list&amp;bcode=&amp;page=1">판소리</a></td>
                        <td>국가무형문화재</td>
                        <td>제5호</td>
                        <td>전국일원</td>
                        <td class="hide-m">전통 공연·예술</td>
                    </tr>
                                        <tr>
                        <td>6</td>
                        <td class="name"><a href="nih_form.php?id=6&amp;view=list&amp;bcode=&amp;page=1">강강술래</a></td>
                        <td>국가무형문화재</td>
                        <td>제8호</td>
                        <td>전라남도 해남군</td>
                        <td class="hide-m">전통 공연·예술</td>
                    </tr>
                                        <tr>
                        <td>7</td>
                        <td class="name"><a href="nih_form.php?id=7&amp;view=list&amp;bcode=&amp;page=1">농악</a></td>
                        <td>국가무형문화재</td>
                        <td>제11호</td>
                        <td>전국일원</td>
                        <td class="hide-m">전통 공연·예술</td>
                    </tr>
                                        <tr>
                        <td>8</td>
                        <td class="name"><a href="nih_form.php?id=8&amp;view=list&amp;bcode=&amp;page=1">강릉단오제</a></td>
                        <td>국가무형문화재</td>
                        <td>제13호</td>
                        <td>강원도 강릉시</td>
                        <td class="hide-m">의례·의식</td>
                    </tr>
                                        <tr>
                        <td>9</td>
                        <td class="name"><a href="nih_form.php?id=9&amp;view=list&amp;bcode=&amp;page=1">한산모시짜기</a></td>
                        <td>국가무형문화재</td>
                        <td>제14호</td>
                        <td>충청남도 서천군</td>
                        <td class="hide-m">전통기술</td>
                    </tr>
                                        <tr>
                        <td>10</td>
                        <td class="name"><a href="nih_form.php?id=10&amp;view=list&amp;bcode=&amp;page=1">안동차전놀이</a></td>
                        <td>국가무형문화재</td>
                        <td>제24호</td>
                        <td>경상북도 안동시</td>
                        <td class="hide-m">전통 놀이·무예</td>
                    </tr>
                                    </tbody>
            </table>

            <!-- 페이지 번호: 10개씩 묶어서 -->
                                    <p class="paging">
                <a href="nih.php?view=list&amp;bcode=&amp;page=1" title="처음 페이지">&lt;&lt;</a>
                <a href="nih.php?view=list&amp;bcode=&amp;page=1" title="이전 페이지">&lt;</a>
                                                <strong title="현재 페이지">1</strong>
                                                                <a href="nih.php?view=list&amp;bcode=&amp;page=2">2</a>
                                                                <a href="nih.php?view=list&amp;bcode=&amp;page=3">3</a>
                                                                <a href="nih.php?view=list&amp;bcode=&amp;page=4">4</a>
                                                <a href="nih.php?view=list&amp;bcode=&amp;page=2" title="다음 페이지">&gt;</a>
                <a href="nih.php?view=list&amp;bcode=&amp;page=4" title="마지막 페이지">&gt;&gt;</a>
            </p>

<?php include 'inc/footer.php'; ?>
