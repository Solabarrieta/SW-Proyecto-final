/* eslint-disable no-alert */
/* eslint-disable consistent-return */
$(document).ready(() => {
  $('#botonPreg').click(() => {
    const er = /^([a-zA-Z]+[0-9]{3})@ikasle\.ehu\.(eus|es)$/;
    const er2 = /^[a-zA-Z]+\.[a-zA-Z]+@ehu\.(eus|es)$/;
    const er3 = /^[a-zA-Z]+@ehu\.(eus|es)$/;

    const correo = $('#correo').val();
    const enun = $('#enun').val();
    const correct = $('#correct').val();
    const inc1 = $('#inc1').val();
    const inc2 = $('#inc2').val();
    const inc3 = $('#inc3').val();
    const dif = $('#dif').val();
    const tema = $('#tema').val();

    if (correo === '' || correo == null) {
      alert('Debes introducir una dirección de correo');
      return false;
    } if (!er.test(correo) && !er2.test(correo) && !er3.test(correo)) {
      alert('Debes introducir una dirección de correo válida');
      return false;
    }
    if (enun === '' || enun == null) {
      alert('Debes introducir una pregunta.');
      return false;
    } if (enun.length < 10) {
      alert('La pregunta debe tener 10 caracteres como mínimo');
      return false;
    }
    if (correct === '' || correct == null) {
      alert('Debes introducir una respuesta correcta.');
      return false;
    }
    if (inc1 === '' || inc1 == null) {
      alert('Debes introducir una respuesta incorrecta 1.');
      return false;
    }
    if (inc2 === '' || inc2 == null) {
      alert('Debes introducir una respuesta incorrecta 2.');
      return false;
    }
    if (inc3 === '' || inc3 == null) {
      alert('Debes introducir una respuesta incorrecta 3.');
      return false;
    }
    if (dif === '' || dif == null) {
      alert('Debes elegir una complejidad.');
      return false;
    }
    if (tema === '' || tema == null) {
      alert('Debes especificar un tema.');
      return false;
    }
  });
});
