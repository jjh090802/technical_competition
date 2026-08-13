document.getElementById('profile_image').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(event) {
      document.getElementById('previewImg').src = event.target.result;
    };
    reader.readAsDataURL(file);
  }
});

