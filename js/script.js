$(document).ready(function(){

        
  $("#btnPedir").on( "click", function() {

    $("#registro").css("right","0%");
    $("#registro").css("transition","1s");
    
  });
  
  $("#btnPedir2").on( "click", function() {

    $("#registro").css("right","0%");
    $("#registro").css("transition","1s");
    
  });

  $("#btnClose").on( "click", function() {

    $("#registro").css("right","-200%");
    $("#registro").css("transition","1s");
    
  });

  $("#inicio").on( "click", function() {

    $("#contenidoInicio").css("display","block");
    $("#contenidoServicios").css("display","none");
    $("#contenidoTrabaja").css("display","none");
    $("#contenidoContacto").css("display","none");
    
  });

  $("#btnServicios").on( "click", function() {

    $("#contenidoInicio").css("display","none");
    $("#contenidoTrabaja").css("display","none");
    $("#contenidoContacto").css("display","none");
    $("#contenidoServicios").css("display","block");
    
  });

  $("#btnTrabaja").on( "click", function() {

    $("#contenidoInicio").css("display","none");
    $("#contenidoServicios").css("display","none");
    $("#contenidoContacto").css("display","none");
    $("#contenidoTrabaja").css("display","block");
    
  });

  $("#btnContacto").on( "click", function() {

    $("#contenidoInicio").css("display","none");
    $("#contenidoServicios").css("display","none");
    $("#contenidoTrabaja").css("display","none");
    $("#contenidoContacto").css("display","block");
    
  });

});

function idOcultos(){

  $("#generadorId").html('');
  $("#generadorTotal").html('');
  $("#generadorCantidad").html('');

  totalCount = $('#totalCount').val();

  count = 0;

  cantidad = "";
  
  for (var f = 1; f <= totalCount; f++) {
      
      if($("#textCantidad"+f).val()===""){
          $("#textCantidad"+f).val(0);
      }
      
  }

  for (var i = 1; i <= totalCount; i++) {
    
    idEscondido = $("#idEscondido"+i).val();

    costo = $("#costo"+i).html();

    cantidad = $("#textCantidad"+i).val();

    if(costo != "0.00"){

      count++;

      $("#generadorId").append('<input type="text" readonly name="idOculto'+count+'" value="'+idEscondido+'">');

    }

    if(cantidad != "0"){

      $("#generadorCantidad").append('<input type="text" readonly name="cantidadOculto'+count+'" value="'+cantidad+'">');

    }

  }

   $("#generadorTotal").append('<input type="text" readonly name="txtTotalProductos" value="'+count+'" style="background:red;">');
  
}

$(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
});

$(document).keydown(function (event) {
    if (event.keyCode == 123) { 
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {       
        return false;
    }
});