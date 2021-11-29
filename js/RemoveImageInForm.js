/* eslint-disable camelcase */
/* eslint-disable no-undef */
$(document).ready(() => {
  $('#borrarImagen').on('click', () => {
    $('#subirImagen').replaceWith((selected_photo = $('#subirImagen').clone(true)));
    $('#preview').removeProp('src').hide();
    $('#subirImagen').val('');
    $('preview').remove();
  });
});
