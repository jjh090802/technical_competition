function check(e){
    let val = e.value;
    let length = val.length;
    let low = val.toLowerCase() != val;
    let num = /[0-9]/.test(val);
    let password = /[!@#$%^&*]/.test(val);

    console.log(val);
    console.log(length);
    console.log(low);
    console.log(num);
    console.log(password);

    let color = "";
    let text = "";

    if(length >= 8 && low && num &&password){
        color = "green";
        text = "안전";
    }
    else if(length >= 6 && low && num){
        color = "orange";
        text = "보통";
    }
    else if(length < 6){
        color = "red";
        text = "위험";
    }

    e.style.borderColor = color;
    document.querySelector(".text").textContent = text;
}