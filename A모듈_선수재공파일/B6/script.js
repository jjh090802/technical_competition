const drop = document.getElementById("img_box");
const reset = document.getElementById("reset");

const backup = drop.innerHTML;

reset.addEventListener("click", function resetBox() {drop.innerHTML = backup;});

drop.addEventListener("dragover", function preventDefault(e) {e.preventDefault();});

drop.addEventListener("drop",function handleDrop(e){
  e.preventDefault();
  const file = e.dataTransfer.files[0];
  showPreview(file);
});

function showPreview(file) {
  const reader = new FileReader();

  reader.addEventListener("load", function showResult(event) {
    drop.innerHTML = `<img src="${event.target.result}" alt="미리보기" />`;
  });

  reader.readAsDataURL(file); // 파일을 이미지로 쓸 수 있는 문자열로 변환

}


