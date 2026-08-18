function updateClock(){
    var now = new Date();
    document.getElementsByClassName('clock')[0].textContent 
    = `${now.getHours().toString().padStart(2,'0')}:${now.getMinutes().toString().padStart(2,'0')}:${now.getSeconds().toString().padStart(2,'0')}`;
}

setInterval(updateClock, 1000);

updateClock();