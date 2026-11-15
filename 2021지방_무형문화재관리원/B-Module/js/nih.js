// ===== 무형문화재 현황 =====
// "무형문화재 목록 조회" 전문(/xml/nihList.xml)으로 목록을 만들고,
// 항목마다 "상세 정보 조회" 전문(/xml/detail/{종목코드}_{시도코드}_{지정번호}.xml)의 imageUrl 로 그림을 넣는다.

const ALBUM_SIZE = 8;    // 앨범형 한 페이지 항목 수
const LIST_SIZE = 10;    // 목록형 한 페이지 항목 수
const NO_IMAGE = '<div class="noimg"><span>no image</span><small>이미지 준비 중</small></div>';

const count = document.querySelector('#count');
const nihBody = document.querySelector('#nihBody');
const paging = document.querySelector('#paging');

let items = [];         // 목록 전문의 item
let total = 0;          // 목록 전문의 totalCount
let page = 1;
let view = 'album';     // album | list

// XML 노드에서 태그 글자 꺼내기
function tag(node, name) {
    const el = node.querySelector(name);
    return el ? el.textContent.trim() : '';
}

// 받은 글자가 HTML 로 해석되지 않게 바꾼다
function esc(text) {
    return String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

// 오류: 콘텐츠 영역에 상태 메시지를 보이고 멈춘다
function showError(message) {
    count.textContent = '';
    paging.innerHTML = '';
    nihBody.innerHTML = '<p class="error"></p>';
    nihBody.querySelector('.error').textContent = message;
}

// 목록 전문 요청
async function loadList() {
    const res = await fetch('/xml/nihList.xml').catch(() => null);
    if (!res || !res.ok) {
        showError(`무형문화재 목록을 불러오지 못했습니다. (상태 코드 ${res ? res.status : '연결 실패'})`);
        return;
    }
    const xml = new DOMParser().parseFromString(await res.text(), 'text/xml');
    if (xml.querySelector('parsererror')) {
        showError('무형문화재 목록 전문의 형식이 올바르지 않습니다.');
        return;
    }

    total = Number(tag(xml, 'totalCount'));
    items = [...xml.querySelectorAll('item')].map(item => ({
        sn: tag(item, 'sn'),
        name: tag(item, 'ccbaMnm1'),
        kind: tag(item, 'ccmaName'),
        no: tag(item, 'crltsnoNm'),
        place: (tag(item, 'ccbaCtcdNm') + ' ' + tag(item, 'ccsiName')).trim(),
        kdcd: tag(item, 'ccbaKdcd'),
        ctcd: tag(item, 'ccbaCtcd'),
        asno: tag(item, 'ccbaAsno'),
    }));
    render();
}

// 상세 전문의 imageUrl 로 그림을 넣는다 (그림이 없거나 못 읽으면 no image)
async function loadImage(item, box) {
    const res = await fetch(`/xml/detail/${item.kdcd}_${item.ctcd}_${item.asno}.xml`).catch(() => null);
    let file = '';
    if (res && res.ok) {
        const xml = new DOMParser().parseFromString(await res.text(), 'text/xml');
        file = tag(xml, 'imageUrl');
    }
    if (!file) {
        box.innerHTML = NO_IMAGE;
        return;
    }
    const img = new Image();
    img.alt = item.name;
    img.title = item.name;
    img.onload = () => box.replaceChildren(img);
    img.onerror = () => { box.innerHTML = NO_IMAGE; };
    img.src = '/xml/image/' + encodeURIComponent(file.split('/').pop());   // 주소로 들어 있어도 파일 이름만 쓴다
}

// 화면 그리기: 개수 · 페이지, 목록, 페이지 번호
function render() {
    const size = view === 'album' ? ALBUM_SIZE : LIST_SIZE;
    const pages = Math.max(1, Math.ceil(total / size));
    const start = (page - 1) * size;
    const rows = items.slice(start, start + size);

    count.innerHTML = `총 <b>${total}</b>건 · <b>${page}</b>p / ${pages}p`;
    document.querySelectorAll('#viewBtns button').forEach(btn => {
        btn.classList.toggle('on', btn.dataset.view === view);
    });

    if (view === 'album') {
        nihBody.innerHTML = `<ul class="album">${rows.map(item => `
            <li>
                <div class="photo"><span class="spinner"></span></div>
                <strong>${esc(item.name)}</strong>
                <p>${esc(item.kind)} 제${esc(item.no)}호 · ${esc(item.place)}</p>
            </li>`).join('')}
        </ul>`;
        const boxes = nihBody.querySelectorAll('.photo');
        rows.forEach((item, i) => loadImage(item, boxes[i]));
    } else {
        nihBody.innerHTML = `
            <table class="board">
                <caption class="blind">무형문화재 목록</caption>
                <thead>
                    <tr><th scope="col">순번</th><th scope="col">문화재명</th><th scope="col">문화재 종목</th><th scope="col">지정호수</th><th scope="col">소재지</th></tr>
                </thead>
                <tbody>${rows.map(item => `
                    <tr>
                        <td>${esc(item.sn)}</td>
                        <td class="name">${esc(item.name)}</td>
                        <td>${esc(item.kind)}</td>
                        <td>${esc(item.no)}호</td>
                        <td>${esc(item.place)}</td>
                    </tr>`).join('')}
                </tbody>
            </table>`;
    }
    renderPaging(pages);
}

// 페이지 번호: << < (10개 묶음) > >>
function renderPaging(pages) {
    const first = Math.floor((page - 1) / 10) * 10 + 1;
    const last = Math.min(first + 9, pages);
    const btn = (text, p, title) => `<button type="button" data-page="${p}" title="${title}">${text}</button>`;

    let html = btn('&lt;&lt;', 1, '처음 페이지') + btn('&lt;', Math.max(1, page - 1), '이전 페이지');
    for (let p = first; p <= last; p++) {
        html += p === page ? `<strong title="현재 페이지">${p}</strong>` : btn(p, p, p + '페이지');
    }
    html += btn('&gt;', Math.min(pages, page + 1), '다음 페이지') + btn('&gt;&gt;', pages, '마지막 페이지');
    paging.innerHTML = html;
}

// 페이지 번호 클릭
paging.addEventListener('click', e => {
    const btn = e.target.closest('button');
    if (!btn) return;
    page = Number(btn.dataset.page);
    render();
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// 앨범 · 목록 바꾸기
document.querySelector('#viewBtns').addEventListener('click', e => {
    const btn = e.target.closest('button');
    if (!btn) return;
    view = btn.dataset.view;
    page = 1;
    render();
});

loadList();
