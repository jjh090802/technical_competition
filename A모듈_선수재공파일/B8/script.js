let green_box = document.querySelector("#green_btn");
let red_box = document.querySelector("#red_btn");

green_box.addEventListener("click",function(){
    button("success","성공하였습니다.");
})

red_box.addEventListener("click",function(){
    button("fail","실패하였습니다.");
})

function button(type,msg){
    var li = document.createElement("li");
    li.className = type;
    li.textContent = msg;

    li.addEventListener("click",function(){
        li.remove();
    })

    setTimeout(function(){
        li.remove();
    },5000)

    document.querySelector("#list").append(li);
}