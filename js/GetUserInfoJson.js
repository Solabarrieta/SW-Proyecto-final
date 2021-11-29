/* eslint-disable no-alert */
/* eslint-disable no-restricted-syntax */
/* eslint-disable no-undef */
$(document).ready(() => {
  $('#botonCompl').click(() => {
    // Guardamos el correo
    const correo = $('#correo').val();

    $('#telefono').val('');
    $('#nombre').val('');
    $('#apellidos').val('');
    // Miramos a ver si existe el correo
    $.getJSON('../json/Users.json', (json) => {
      // Iteramos sobre cada usuario
      let enc = false;
      for (usuario in json.usuarios) {
        if (json.usuarios[usuario].email === correo) {
          $('#telefono').val(json.usuarios[usuario].telefono);
          $('#nombre').val(json.usuarios[usuario].nombre);
          $('#apellidos').val(`${json.usuarios[usuario].apellido1} ${json.usuarios[usuario].apellido2}`);
          enc = true;
        }
      }
      if (!enc) {
        alert('Este correo no está registrado. Introduzca otro.');
      }
    });
  });
});
