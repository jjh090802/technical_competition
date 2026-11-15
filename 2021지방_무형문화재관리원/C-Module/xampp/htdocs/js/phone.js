// ===== 전화번호 =====
// "전화번호 조회" 전문(/restAPI/phone.php, JSON)을 받아 부서 탭과 연락처를 보여 준다
//   응답: { statusCd, statusMsg, totalCount, items: [{ sn, deptNm, name, telNo }] }

const deptTab = document.querySelector('#deptTab');
const phoneBody = document.querySelector('#phoneBody');

let items = [];      // 전문의 연락처 목록
let dept = '전체';    // 고른 부서

// 전문 요청
async function loadPhone() {
    let data;
    try {
        const res = await fetch('/restAPI/phone.php');
        data = await res.json();
    } catch (err) {
        data = { statusCd: 'ERROR', statusMsg: '전화번호 전문을 받지 못했습니다.' };
    }

    // 상태 코드가 200 이 아니면 여기서 멈춘다
    if (String(data.statusCd) !== '200') {
        showError(data.statusMsg);
        return;
    }
    items = data.items;
    render();
}

// 오류: 콘텐츠 영역에 상태 메시지를 보이고, 알린 뒤 메인 페이지로 이동
function showError(message) {
    deptTab.innerHTML = '';
    phoneBody.innerHTML = '<p class="error"></p>';
    phoneBody.querySelector('.error').textContent = message;
    setTimeout(() => {               // 메시지가 화면에 그려진 다음 알린다
        alert(message);
        location.href = '/';       // 메인 페이지 (htdocs 의 index)
    }, 100);
}

// 받은 글자가 HTML 로 해석되지 않게 바꾼다
function esc(text) {
    return String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

// 화면 그리기: 부서 탭 + 부서별 연락처
function render() {
    // 전문에 나오는 모든 부서 (나온 순서, 중복 없이) + 맨 앞에 전체
    const depts = ['전체', ...new Set(items.map(item => item.deptNm))];

    deptTab.innerHTML = depts.map(d =>
        `<li><button type="button" class="${d === dept ? 'on' : ''}" data-dept="${esc(d)}">${esc(d)}</button></li>`
    ).join('');

    // 전체면 모든 부서, 아니면 고른 부서만
    const shown = dept === '전체' ? depts.slice(1) : [dept];

    phoneBody.innerHTML = shown.map(d => {
        const people = items.filter(item => item.deptNm === d);
        return `
            <section class="dept">
                <h3>${esc(d)} <span>${people.length}명</span></h3>
                <ul class="people">
                    ${people.map(p => `<li><strong>${esc(p.name)}</strong><span>${esc(p.telNo)}</span></li>`).join('')}
                </ul>
            </section>`;
    }).join('');
}

// 부서 탭 클릭
deptTab.addEventListener('click', e => {
    const btn = e.target.closest('button');
    if (!btn) return;
    dept = btn.dataset.dept;
    render();
});

loadPhone();
