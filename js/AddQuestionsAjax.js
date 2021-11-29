//const form = document.getElementById('fquestion');
$(document).ready(function() {
  let form= $('#fquestion');
$('#fquestion').on('submit', (event) => {
  event.stopPropagation();
  event.preventDefault();

  const formData = new FormData(form[0]);
$.ajax({
  url: "../php/AddQuestionWithImageAjax.php",
  type: "POST",
  data: formData,
  processData: false,
  contentType: false,
  success: function(response){
      
      $('#server__response').html(response);
      console.log($('#server__response'));
   },
    
});
});
})



const addQuestion = (event) => {
  console.log(event);
};