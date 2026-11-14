// ===== 스토어: 상품 목록, 검색, 드래그앤드롭 장바구니, 구매 내역 이미지 =====
// B 모듈 js/script.js 와 같다. 자료 경로만 /data/store.json, /images/store/ 로 바꿨다
const $ = (selector) => document.querySelector(selector);
const won = (n) => n.toLocaleString('ko-KR') + '원';   // 129000 → "129,000원"

let products = [];   // store.json 의 모든 상품
let cart = [];       // 장바구니에 담은 상품 (상품 정보 + qty 수량)

// ----- 1. store.json 을 읽어 상품 목록을 그린다 (fetch 는 http://localhost/ 처럼 서버에서 열어야 동작한다)
async function load() {
    try {
        const data = await (await fetch('data/store.json')).json();
        // 가격이 "129,000" 처럼 글자여도 계산할 수 있게 숫자로 바꿔 둔다
        products = data.products.map((p) => ({ ...p, price: Number(String(p.price).replace(/,/g, '')) }));
        renderList();
    } catch (error) {
        $('#list').innerHTML = '<li class="msg">상품을 불러오지 못했습니다. XAMPP 의 http://localhost/ 주소로 열어 주세요.</li>';
    }
}

// ----- 2. 검색 (상품명 또는 브랜드명, 초성 검색, 하이라이트)
const CHO = 'ㄱㄲㄴㄷㄸㄹㅁㅂㅃㅅㅆㅇㅈㅉㅊㅋㅌㅍㅎ';

// 한 글자의 초성 ('우' → 'ㅇ'). 한글 음절이 아니면 그대로 돌려준다
function cho(ch) {
    const code = ch.charCodeAt(0) - 44032;   // 44032 = '가'
    return code >= 0 && code < 11172 ? CHO[Math.floor(code / 588)] : ch;
}

// text 에서 word 가 시작하는 위치 (없으면 -1). 검색어가 초성이면 text 글자의 초성과 비교한다
function find(text, word) {
    const t = text.toLowerCase();
    const w = word.toLowerCase();
    for (let i = 0; i + w.length <= t.length; i++) {
        if ([...w].every((c, j) => c === t[i + j] || c === cho(t[i + j]))) return i;
    }
    return -1;
}

// 찾은 부분을 <mark> 로 감싸 하이라이트한다
function mark(text, word) {
    const i = word ? find(text, word) : -1;
    if (i < 0) return text;
    return text.slice(0, i) + '<mark>' + text.slice(i, i + word.length) + '</mark>' + text.slice(i + word.length);
}

// 상품 목록 그리기: 검색어가 있으면 상품명이나 브랜드명에 들어 있는 상품만
function renderList() {
    const word = $('#keyword').value.trim();
    const list = products.filter((p) => !word || find(p.product_name, word) >= 0 || find(p.brand, word) >= 0);
    $('#list').innerHTML = list.map((p) => `
        <li data-id="${p.id}">
            <img src="images/store/${p.photo}" alt="${p.product_name}" title="${p.product_name}" draggable="true">
            <p class="brand">${mark(p.brand, word)}</p>
            <p class="name">${mark(p.product_name, word)}</p>
            <p class="price">${won(p.price)}</p>
        </li>`).join('');
    $('#empty').hidden = list.length > 0;
}

// 글자를 입력하는 즉시 목록에 반영
$('#keyword').addEventListener('input', renderList);

// ----- 3. 드래그앤드롭: 상품 사진을 끌어 드롭 영역에 놓으면 장바구니에 담는다
const drop = $('#drop');
let dragId = 0;       // 끌고 있는 상품 번호
let added = false;    // 이번 드래그로 장바구니에 담겼는지

$('#list').addEventListener('dragstart', (e) => {
    const li = e.target.closest('li');
    dragId = Number(li.dataset.id);
    added = false;
    e.dataTransfer.setData('text/plain', dragId);
    li.classList.add('dragging');
    drop.classList.add('ready');
});

// 드래그가 끝났는데 담기지 않았으면(영역 밖, 이미 담긴 상품) 제자리로 돌아오는 효과
$('#list').addEventListener('dragend', (e) => {
    const li = e.target.closest('li');
    li.classList.remove('dragging');
    drop.classList.remove('ready', 'over');
    if (!added) {
        li.classList.add('back');
        li.addEventListener('animationend', () => li.classList.remove('back'), { once: true });
    }
});

drop.addEventListener('dragover', (e) => {
    e.preventDefault();   // 이 영역에 놓을 수 있게 한다
    drop.classList.add('over');
});
drop.addEventListener('dragleave', () => drop.classList.remove('over'));
drop.addEventListener('drop', (e) => {
    e.preventDefault();
    drop.classList.remove('over');
    added = addCart(Number(e.dataTransfer.getData('text/plain')));
});

// ----- 4. 장바구니
const total = () => cart.reduce((sum, p) => sum + p.price * p.qty, 0);

// 담기에 성공하면 true. 이미 담긴 상품이면 메시지를 보여 주고 false
function addCart(id) {
    if (cart.some((p) => p.id === id)) {
        alert('이미 장바구니에 담긴 상품입니다.');
        return false;
    }
    const product = products.find((p) => p.id === id);
    if (!product) return false;
    cart.push({ ...product, qty: 1 });
    renderCart();
    return true;
}

function renderCart() {
    $('#cart').innerHTML = cart.map((p) => `
        <li data-id="${p.id}">
            <img src="images/store/${p.photo}" alt="${p.product_name}" title="${p.product_name}">
            <div>
                <p class="name">${p.product_name}</p>
                <p class="brand">${p.brand}</p>
                <p class="price">${won(p.price)}</p>
            </div>
            <input type="number" class="qty" min="1" value="${p.qty}" title="수량">
            <p class="sum">${won(p.price * p.qty)}</p>
            <button type="button" class="del" title="삭제">X</button>
        </li>`).join('') || '<li class="msg">장바구니가 비어 있습니다.</li>';
    $('#total').textContent = won(total());
}

// 수량을 바꾸는 즉시 그 상품의 합계와 총합계를 다시 계산한다 (1보다 작거나 비우면 1개로 계산)
$('#cart').addEventListener('input', (e) => {
    if (!e.target.matches('.qty')) return;
    const li = e.target.closest('li');
    const item = cart.find((p) => p.id === Number(li.dataset.id));
    item.qty = Math.max(1, parseInt(e.target.value) || 1);
    li.querySelector('.sum').textContent = won(item.price * item.qty);
    $('#total').textContent = won(total());
});

// 입력을 마치면 칸에 실제 수량(1 이상)을 다시 보여 준다
$('#cart').addEventListener('change', renderCart);

// 삭제(X) 버튼
$('#cart').addEventListener('click', (e) => {
    if (!e.target.matches('.del')) return;
    const id = Number(e.target.closest('li').dataset.id);
    cart = cart.filter((p) => p.id !== id);
    renderCart();
});

// ----- 5. 구매하기 → 이름·주소 모달 → 구매 완료 → 구매 내역 이미지 모달
$('#buyBtn').addEventListener('click', () => {
    if (cart.length === 0) return alert('장바구니에 상품을 담아 주세요.');
    $('#buyModal').showModal();
});

$('#buyForm').addEventListener('submit', (e) => {
    e.preventDefault();
    $('#receipt').innerHTML = `<img src="${receipt($('#buyer').value, $('#address').value)}" alt="구매 내역" title="구매 내역">`;
    $('#buyModal').close();
    $('#buyForm').reset();
    cart = [];
    renderCart();
    $('#receiptModal').showModal();
});

// 모달의 닫기 버튼
document.querySelectorAll('.modal .close').forEach((btn) => {
    btn.addEventListener('click', () => btn.closest('dialog').close());
});

// 지금 시각을 "2020-01-31 13:05:09" 모양으로
function now() {
    const d = new Date();
    const two = (n) => String(n).padStart(2, '0');
    return `${d.getFullYear()}-${two(d.getMonth() + 1)}-${two(d.getDate())} ${two(d.getHours())}:${two(d.getMinutes())}:${two(d.getSeconds())}`;
}

// 구매 내역을 canvas 에 그려 PNG 이미지 주소(data:image/png...)로 돌려준다
function receipt(buyer, address) {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = 600;
    canvas.height = 270 + cart.length * 40;
    const text = (str, x, y, align = 'left') => {
        ctx.textAlign = align;
        ctx.fillText(str, x, y);
    };
    const line = (y) => ctx.fillRect(30, y, 540, 1);

    // 배경과 제목
    ctx.fillStyle = '#fff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.fillStyle = '#2f5d50';
    ctx.fillRect(0, 0, canvas.width, 70);
    ctx.fillStyle = '#fff';
    ctx.font = 'bold 24px "Malgun Gothic", "Apple SD Gothic Neo", sans-serif';
    text('내집꾸미기 구매 내역', 30, 45);

    // 표 머리
    ctx.fillStyle = '#333';
    ctx.font = 'bold 16px "Malgun Gothic", "Apple SD Gothic Neo", sans-serif';
    text('상품명', 30, 110);
    text('가격', 370, 110, 'right');
    text('수량', 450, 110, 'right');
    text('합계', 570, 110, 'right');
    line(122);

    // 상품마다 한 줄
    ctx.font = '16px "Malgun Gothic", "Apple SD Gothic Neo", sans-serif';
    let y = 152;
    cart.forEach((p) => {
        text(p.product_name, 30, y);
        text(won(p.price), 370, y, 'right');
        text(p.qty + '개', 450, y, 'right');
        text(won(p.price * p.qty), 570, y, 'right');
        y += 40;
    });
    line(y - 22);

    // 총합계, 구매일시, 구매자
    ctx.font = 'bold 20px "Malgun Gothic", "Apple SD Gothic Neo", sans-serif';
    text('총합계', 30, y + 14);
    ctx.fillStyle = '#d9774b';
    text(won(total()), 570, y + 14, 'right');
    ctx.fillStyle = '#666';
    ctx.font = '15px "Malgun Gothic", "Apple SD Gothic Neo", sans-serif';
    text('구매일시 : ' + now(), 30, y + 60);
    text('구매자 : ' + buyer + ' / 주소 : ' + address, 30, y + 88);
    return canvas.toDataURL('image/png');
}

load();
renderCart();
