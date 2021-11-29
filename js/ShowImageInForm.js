$(document).ready(() => {
  $('#subirImagen').change(function subirImagen() {
    if (this.files && this.files[0]) {
      const reader = new FileReader();
      reader.onload = function show(e) {
        $('#preview').attr('src', e.target.result).show();
      };
      reader.readAsDataURL(this.files[0]);
    }
  });
});
