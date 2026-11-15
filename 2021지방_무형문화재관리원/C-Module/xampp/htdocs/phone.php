<?php
$pageTitle = '전화번호';
$gnb = 'about';
$lnb = '전화번호';
$script = 'js/phone.js';
include 'inc/header.php';
?>
            <!-- 안내 -->
            <div class="tool-bar">
                <p>부서를 누르면 그 부서의 연락처만 볼 수 있습니다. 바깥에서 거실 때는 <b>063-123-</b> 뒤에 내선 번호를 누르세요.</p>
            </div>

            <!-- 부서 탭 (js/phone.js 가 채운다) -->
            <ul class="dept-tab" id="deptTab"></ul>

            <!-- 부서별 연락처 (js/phone.js 가 채운다) -->
            <div class="phone" id="phoneBody">
                <p class="loading">전화번호를 불러오는 중입니다.</p>
            </div>

<?php include 'inc/footer.php'; ?>
