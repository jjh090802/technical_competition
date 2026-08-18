let drop = document.querySelector(".drop_box");
let reset = document.querySelector(".reset");

let backup = drop.innerHTML;

reset.addEventListener("click",function del(){
    drop.innerHTML = backup;
})

drop.addEventListener("dragover",function error(e){
    e.preventDefault();
})

drop.addEventListener("drop",function eror(e){
    e.preventDefault();
    let File = e.dataTransfer.files[0];
    show(File);
})

function show(File){
    let reader = new FileReader();

    reader.addEventListener("load", function load(event){
        drop.innerHTML = `<img src="${event.target.result}"/>`
    })

    reader.readAsDataURL(File);
}



