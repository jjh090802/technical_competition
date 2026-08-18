const Input = document.querySelectorAll("input");
const btn = document.querySelectorAll("#submitBtn");

Input.forEach((input, index){
    input.addEventListener('input', (e) => {
    const value = e.target.value;

    if(!/^[0-9]$/.test(value)) {
        e.target.value = '';
        return;
    }

    if(value.length == 1 && index < input.length -1){
        Input[index + 1].focus();
    }

    checkAllFilled();

    });

    input.addEventListener('keydown', (e) => {
        if(e.key == 'backspace'){
            if(input.value == '' && index > 0) {
                Input[index - 1].focus();
                Input[index - 1].value = '';
                e.preventDefault();
                checkAllFilled();
            } else {
                input.value = '';
                checkAllFilled();
            }
        }
    });
});


