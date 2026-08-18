
const box = document.getElementById('box');

// 화면 밖으로 못 나가게 이동 가능한 최대 범위를 먼저 계산
const maxTop = window.innerHeight - box.offsetHeight;
const maxLeft = window.innerWidth - box.offsetWidth;

// 초기 위치는 그 최대 범위의 절반 = 정중앙
let topPos = maxTop / 2;
let leftPos = maxLeft / 2;

// 한 번 누를 때 움직일 거리 (픽셀)
const speed = 20;

// 계산한 초기 위치를 box에 바로 적용 (첫 키 입력 때 튀지 않도록)
box.style.top = topPos + 'px';
box.style.left = leftPos + 'px';

// 키보드 이벤트 리스너 등록
window.addEventListener('keydown', (event) => {
    // 화살표 키는 Shift/Caps Lock에 영향받지 않고 항상 같은 문자열이라 소문자 변환 불필요
    const key = event.key;

    // 이동했을 때 범위를 벗어나는 경우에만 그 방향으로 이동하지 않음
    if (key === 'ArrowUp' && topPos - speed >= 0) {
        topPos -= speed; // 위로 이동
    } else if (key === 'ArrowDown' && topPos + speed <= maxTop) {
        topPos += speed; // 아래로 이동
    } else if (key === 'ArrowLeft' && leftPos - speed >= 0) {
        leftPos -= speed; // 왼쪽으로 이동
    } else if (key === 'ArrowRight' && leftPos + speed <= maxLeft) {
        leftPos += speed; // 오른쪽으로 이동
    } else {
        return; // 방향키 외의 키이거나 범위를 벗어나면 아무것도 하지 않음
    }

    // 변경된 위치 값을 상자의 스타일(CSS)에 적용
    box.style.top = topPos + 'px';
    box.style.left = leftPos + 'px';
});