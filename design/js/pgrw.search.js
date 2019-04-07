/*
  PARA HACER BÚSQUEDAS VÍA AJAX POR EJEMPLO
  BUSCAR USERNAME
*/
$(document).ready(function(){
  var username;
  $("#username").keyup(function(){
    username=$(this);
    $.post(username.data("url")+username.val(),function(data){
      if(data.code==200 && data.response.login){
        $(username.data("content")).html('<div class="form-control-alert pt-3 pb-3"><i class="far fa-hand-point-left"></i> Nombre de usuario no disponible</div>')
        $("#continuar_wizard").value("");
      }else{
        $(username.data("content")).html("");
        $("#continuar_wizard").value(1);
      }
    },"json");
  })
});
