$(document).ready(function(){
    $('.select-bottom').click(function(){
          $('.form-file').trigger('click');
      })
    $('.form-file').change(function(){
      if($(this).val()!=''){
      readURL2(this);
      }
    })
});
  
function readURL2(input) {
    if(input.files[0].type=='image/jpeg' || input.files[0].type=='image/png') {
        $.each(jQuery(input)[0].files, function (i, file) {
            var reader = new FileReader();
            reader.onload = function (e) {
            $('.u-image-perfil').css('background-image','url('+ e.target.result+')');
            }
            reader.readAsDataURL(input.files[0]);
        });
    }else{
        alert("Solo se permiten archivos .jpg y .png");
    }
}