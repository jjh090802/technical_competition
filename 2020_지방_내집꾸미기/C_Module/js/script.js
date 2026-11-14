// ===== 모달 열기·닫기 (모든 페이지 공통) =====

// data-open="#모달아이디" 를 누르면 그 모달을 연다
// data-id 가 있으면 모달 폼의 id 칸에, data-title 이 있으면 모달 제목에 넣는다
document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-open]');
    if (!btn) return;
    e.preventDefault();
    const modal = document.querySelector(btn.dataset.open);
    if (btn.dataset.id) modal.querySelector('[name=id]').value = btn.dataset.id;
    if (btn.dataset.title) modal.querySelector('h3').textContent = btn.dataset.title;
    modal.showModal();
});

// 모달 안의 닫기 버튼
document.addEventListener('click', (e) => {
    if (e.target.matches('.modal .close')) e.target.closest('dialog').close();
});
