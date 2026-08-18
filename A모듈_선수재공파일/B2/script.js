function add(e){
    let value = document.querySelector("input").value;

    if(value == ""){
        return;
    }

    document.querySelector("ul").innerHTML +="<li>"+value+"<button class='del' onclick='del(this)'>삭제</button></li>";

    document.querySelector("input").value = "";
}

function del(e){
    e.parentElement.remove();
}   