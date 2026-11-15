<?php
$pageTitle = '연혁';
$gnb = 'about';
$lnb = '일반현황';
$lnb2 = '연혁';
$script = 'js/history.js';
include 'inc/header.php';
?>
            <!-- 안내 + 연혁 등록 버튼 -->
            <div class="tool-bar">
                <p>무형문화재관리원이 걸어온 길입니다. 연도를 누르면 그해의 연혁만 볼 수 있습니다.</p>
                <button type="button" class="btn btn-main" id="addBtn">연혁 등록</button>
            </div>

            <!-- 연도 탭 (js/history.js 가 채운다) -->
            <ul class="year-tab" id="yearTab"></ul>

            <!-- 고른 연도의 연혁 (js/history.js 가 채운다) -->
            <div class="history" id="historyBody"></div>

    <!-- 연혁 등록·수정 다이얼로그 -->
    <dialog class="dialog" id="historyDialog">
        <form id="historyForm">
            <div class="dialog-head">
                <h3>연혁 관리</h3>
                <button type="button" class="dialog-x" data-close title="닫기">×</button>
            </div>
            <div class="dialog-body">
                <p>
                    <label for="historyContent">(*) 연혁내용</label>
                    <input type="text" id="historyContent" maxlength="100" placeholder="예) 무형유산 디지털 아카이브 개통" required autofocus>
                </p>
                <p>
                    <label for="historyDate">(*) 연혁일자</label>
                    <input type="date" id="historyDate" required>
                </p>
            </div>
            <div class="dialog-foot">
                <button type="button" class="btn" data-close>닫기</button>
                <button type="submit" class="btn btn-main">저장</button>
            </div>
        </form>
    </dialog>

    <!-- 삭제 확인 창 -->
    <dialog class="dialog dialog-confirm" id="confirmDialog">
        <div class="dialog-head">
            <h3>경고</h3>
        </div>
        <div class="dialog-body">
            <p class="warn">연혁을 삭제하시겠습니까?</p>
        </div>
        <div class="dialog-foot">
            <button type="button" class="btn btn-main" id="confirmOk">확인</button>
            <button type="button" class="btn" data-close>취소</button>
        </div>
    </dialog>

<?php include 'inc/footer.php'; ?>
