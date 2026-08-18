function time(){
    let now = new Date();

    document.querySelector(".clock").textContent = `${now.getHours().toString().padStart(2,'0')}:${now.getMinutes().toString().padStart(2,'0')}:${now.getSeconds().toString().padStart(2,'0')}`
}

setInterval(time,1000);

time();