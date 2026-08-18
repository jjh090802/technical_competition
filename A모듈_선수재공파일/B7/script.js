const otpInputs = document.querySelectorAll('.otp-input');
const submitBtn = document.querySelectorAll('#submitBtn');

otpInputs.forEach((input, index) => {
  // 입력 처리
  input.addEventListener('input', (e) => {
    const value = e.target.value;

    // 숫자가 아니면 무시 (제거)
    if (!/^[0-9]$/.test(value)) {
      e.target.value = '';
      return;
    }

    // 한 글자만 입력된 경우 다음 칸으로 이동
    if (value.length === 1 && index < otpInputs.length - 1) {
      otpInputs[index + 1].focus();
    }

    checkAllFilled();
  });

  // 키 입력 처리 (백스페이스)
  input.addEventListener('keydown', (e) => {
    if (e.key === 'Backspace') {
      if (input.value === '' && index > 0) {
        // 현재 칸이 비어있으면 이전 칸으로 이동 후 값 삭제
        otpInputs[index - 1].focus();
        otpInputs[index - 1].value = '';
        e.preventDefault();
        checkAllFilled();
      } else {
        // 현재 칸에 값이 있으면 그냥 삭제
        input.value = '';
        checkAllFilled();
      }
    }
  });
});

// 모든 칸이 채워졌는지 확인 후 버튼 활성화
function checkAllFilled() {
  const allFilled = Array.from(otpInputs).every((input) => input.value !== '');

  if (allFilled) {
    submitBtn.disabled = false;
    submitBtn.classList.add('active');
  } else {
    submitBtn.disabled = true;
    submitBtn.classList.remove('active');
  }
}

