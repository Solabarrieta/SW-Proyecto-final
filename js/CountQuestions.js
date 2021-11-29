function filterByUser(obj) {
  const search = location.search.substring(1);
  const getv = JSON.parse(
    `{"${decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g, '":"')}"}`,
  );

  if ('author' in obj && obj.author !== '' && obj.author === getv.correo) {
    return true;
  }
  return false;
}
const counterQuestions = function () {
  const XMLHttpRequestObject = new XMLHttpRequest();
  const $countID = document.getElementById('countQuestions');
  XMLHttpRequestObject.onreadystatechange = function contador() {
    if (XMLHttpRequestObject.readyState === 4) {
      const questionsP = JSON.parse(XMLHttpRequestObject.responseText);
      const questions = questionsP.assessmentItems;
      const questionsOfUser = questions.filter(filterByUser);
      const HTMLString = `<p>Mis preguntas/Todas las preguntas:${Object.keys(questionsOfUser).length}/${
        Object.keys(questions).length
      }</p>`;
      $countID.innerHTML = HTMLString;
    }
  };

  XMLHttpRequestObject.open('GET', '../json/Questions.json');
  XMLHttpRequestObject.send();
};

counterQuestions();
setInterval(counterQuestions, 10000);


