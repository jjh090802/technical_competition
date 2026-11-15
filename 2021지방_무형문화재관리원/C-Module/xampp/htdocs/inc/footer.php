<?php if ($gnb != '') { ?>
        </main>
    </div>
<?php } ?>

    <footer class="footer">
        <div class="inner">
            <ul class="footer-menu">
                <li><a href="#">이용 안내</a></li>
                <li><a href="#" class="point">개인정보 처리방침</a></li>
                <li><a href="#">저작권 보호 정책</a></li>
                <li><a href="#">도로명 주소안내</a></li>
                <li><a href="#">사이트 오류 신고</a></li>
            </ul>
            <div class="footer-info">
                <img src="images/logo_white.svg" alt="무형문화재관리원" title="무형문화재관리원" class="footer-logo">
                <div>
                    <address>(54931) 전라북도 전주시 완산구 전통문화로 95 무형문화재관리원</address>
                    <p>대표전화 063-123-4567 <span>|</span> 팩스 063-123-4568</p>
                    <p class="copy">COPYRIGHT © 무형문화재관리원. ALL RIGHTS RESERVED.</p>
                </div>
            </div>
        </div>
    </footer>
<?php if (isset($script)) { ?>
    <script src="<?php echo $script; ?>"></script>
<?php } ?>
</body>
</html>
