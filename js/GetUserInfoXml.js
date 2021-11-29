/* eslint-disable no-alert */
/* eslint-disable no-undef */
$(document).ready(() => {
  $('#botonCompl').click(() => {
    // Guardamos el correo
    const correo = $('#correo').val();
    let enc = false;
    $('#telefono').val('');
    $('#nombre').val('');
    $('#apellidos').val('');
    // Miramos el XML para ver si existe el correo
    $.get('../xml/Users.xml', (xml) => {
      // Iteramos sobre cada usuario
      $(xml)
        .find('usuario')
        .each(function viewdata() {
          // Si existe ese correo, mostramos sus datos
          if (correo === $(this).find('email').text()) {
            $('#telefono').val($(this).find('telefono').text());
            $('#nombre').val($(this).find('nombre').text());
            $('#apellidos').val(
              `${$(this).find('apellido1').text()
              } ${
                $(this).find('apellido2').text()}`,
            );
            enc = true;
          }
        });
      if (!enc) {
        alert('Este correo no está registrado. Introduzca otro.');
      }
    });
  });
});
