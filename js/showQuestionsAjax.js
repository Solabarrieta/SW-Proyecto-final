const showTable = function (){
    const XMLHttpRequestShow = new XMLHttpRequest();
    const $showQuestions = document.getElementById('showQuestions');
  
    XMLHttpRequestShow.addEventListener('readystatechange', () => {
      if (XMLHttpRequestShow.readyState !== 4) return;
  
      $showQuestions.innerHTML = XMLHttpRequestShow.response;
    });
  
    XMLHttpRequestShow.open('GET', '../php/ShowQuestionsAJax.php');
    XMLHttpRequestShow.send();
  }
  
const hideTable =  function () {
    const XMLHttpRequestShow = new XMLHttpRequest();
    const $showQuestions = document.getElementById('showQuestions');
  
    XMLHttpRequestShow.addEventListener('readystatechange', () => {
      if (XMLHttpRequestShow.readyState !== 4) return;
  
      $showQuestions.innerHTML = '';
    });
  
    XMLHttpRequestShow.open('GET', 'hide');
    XMLHttpRequestShow.send();
}