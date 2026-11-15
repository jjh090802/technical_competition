// ===== 연혁 관리 =====
// 연혁 목록과 마지막으로 고른 연도를 localStorage 에 저장한다 (브라우저를 다시 열어도 남는다)
//   nihc-history      : [{ id, date: 'YYYY-MM-DD', content }]
//   nihc-history-year : '2021'

const LIST_KEY = 'nihc-history';
const YEAR_KEY = 'nihc-history-year';

// 한 번도 저장한 적이 없을 때 보여 줄 기본 연혁
const SAMPLE = [
    ['2017-03-02', '무형유산 보호 기본계획 수립'],
    ['2017-07-14', '국가무형문화재 전승자 실태 조사 착수'],
    ['2017-11-20', '무형유산 기록화 사업 1단계 완료'],
    ['2018-02-01', '무형문화재관리원 개원 준비단 발족'],
    ['2018-06-18', '전수교육관 운영 지원 사업 시작'],
    ['2018-10-05', '국제 무형유산 학술대회 개최'],
    ['2019-01-21', '무형문화재관리원 개원'],
    ['2019-05-09', '얼쑤마루 공연장 개관'],
    ['2019-09-25', '전통공예 상설 전시실 개관'],
    ['2020-03-16', '온라인 전수교육 서비스 시작'],
    ['2020-08-03', '디지털 체험관 개관'],
    ['2020-12-16', '연등회 유네스코 인류무형문화유산 등재 기념행사'],
    ['2021-01-19', '무형유산 디지털 아카이브 개통'],
    ['2021-03-02', '누리집 개편 착수'],
    ['2021-04-09', '무형문화재 공개데이터(Open API) 서비스 시작'],
];

const yearTab = document.querySelector('#yearTab');
const historyBody = document.querySelector('#historyBody');
const dialog = document.querySelector('#historyDialog');
const form = document.querySelector('#historyForm');
const contentInput = document.querySelector('#historyContent');
const dateInput = document.querySelector('#historyDate');
const confirmDialog = document.querySelector('#confirmDialog');

let list = load();
let year = localStorage.getItem(YEAR_KEY);   // 마지막으로 고른 연도
let editId = null;     // 수정 중인 연혁 id (등록이면 null)
let deleteId = null;   // 삭제하려는 연혁 id

// 저장된 연혁 읽기 (없으면 기본 연혁)
function load() {
    const saved = localStorage.getItem(LIST_KEY);
    if (saved) return JSON.parse(saved);
    return SAMPLE.map(([date, content], i) => ({ id: i + 1, date, content }));
}

// 연혁 목록 저장
function save() {
    localStorage.setItem(LIST_KEY, JSON.stringify(list));
}

// 고른 연도 저장
function saveYear(value) {
    year = value;
    localStorage.setItem(YEAR_KEY, year);
}

// 입력한 글자가 HTML 로 해석되지 않게 바꾼다
function esc(text) {
    return String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

// 화면 그리기: 연도 탭 + 고른 연도의 연혁
function render() {
    // 저장된 모든 연도 (최근 연도가 앞)
    const years = [...new Set(list.map(h => h.date.slice(0, 4)))].sort().reverse();

    // 고른 연도가 없으면 마지막(가장 최근) 연도
    if (!years.includes(year)) year = years[0];

    yearTab.innerHTML = years.map(y =>
        `<li><button type="button" class="${y === year ? 'on' : ''}" data-year="${y}">${y}년</button></li>`
    ).join('');

    if (!year) {
        historyBody.innerHTML = '<p class="empty">등록된 연혁이 없습니다. [연혁 등록] 버튼을 눌러 추가하세요.</p>';
        return;
    }

    // 고른 연도의 연혁만, 날짜 순으로
    const rows = list.filter(h => h.date.startsWith(year)).sort((a, b) => a.date.localeCompare(b.date));

    historyBody.innerHTML = `
        <strong class="big-year">${year}<small>년</small></strong>
        <ul class="history-list">
            ${rows.map(h => `
            <li>
                <span class="date">${h.date.slice(5, 7)}. ${h.date.slice(8, 10)}</span>
                <p>${esc(h.content)}</p>
                <span class="btns">
                    <button type="button" data-edit="${h.id}">수정</button>
                    <button type="button" data-del="${h.id}">삭제</button>
                </span>
            </li>`).join('')}
        </ul>
        <figure class="history-img">
            <img src="images/history${year % 3 + 1}.jpg" alt="${year}년 연혁 그림" title="${year}년 연혁">
            <figcaption>${year}년, ${rows.length}건의 발자취</figcaption>
        </figure>`;
}

// 연도 탭: 그 연도만 보이고, 고른 연도를 저장한다
yearTab.addEventListener('click', e => {
    const btn = e.target.closest('button');
    if (!btn) return;
    saveYear(btn.dataset.year);
    render();
});

// [연혁 등록]: 빈 다이얼로그를 연다
document.querySelector('#addBtn').addEventListener('click', () => {
    editId = null;
    form.reset();
    dialog.showModal();
});

// 목록의 [수정] [삭제]
historyBody.addEventListener('click', e => {
    const editBtn = e.target.closest('[data-edit]');
    const delBtn = e.target.closest('[data-del]');

    if (editBtn) {
        const item = list.find(h => h.id === Number(editBtn.dataset.edit));
        editId = item.id;
        contentInput.value = item.content;
        dateInput.value = item.date;
        dialog.showModal();
    }
    if (delBtn) {
        deleteId = Number(delBtn.dataset.del);
        confirmDialog.showModal();
    }
});

// [저장]: 등록 또는 수정
form.addEventListener('submit', e => {
    e.preventDefault();
    const content = contentInput.value.trim();
    const date = dateInput.value;
    if (!content || !date) {
        alert('연혁내용과 연혁일자를 모두 입력하세요.');
        return;
    }

    if (editId) {
        const item = list.find(h => h.id === editId);
        item.content = content;
        item.date = date;
    } else {
        list.push({ id: Date.now(), date, content });
    }
    save();
    saveYear(date.slice(0, 4));   // 저장한 연혁의 연도를 보여 준다
    dialog.close();
    render();
});

// 삭제 확인 창의 [확인]
document.querySelector('#confirmOk').addEventListener('click', () => {
    list = list.filter(h => h.id !== deleteId);
    save();
    confirmDialog.close();
    render();
});

// [닫기] [취소] [×]
document.querySelectorAll('[data-close]').forEach(btn => {
    btn.addEventListener('click', () => btn.closest('dialog').close());
});

render();
