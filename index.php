<?php
require_once "modelos/conexion.php";
require_once "controladores/pedidos.controlador.php";
require_once "modelos/pedidos.modelo.php";

$producto=ControladorPedido::ctrListaProducto();



?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title>Simple</title>
    
    <meta name="description" content="Haz tu pedido aquí y en máximo 5 días te lo estaremos entregando" />

    <!-- Open Graph data -->
    <meta property="og:title" content="Simple" />
    <meta property="og:type" content="website" />
    <!--<meta property="og:url" content="http://simple-suppliers.com/" />-->
    <meta property="og:image" content="https://simple-suppliers.com/img/logo.png" />
    <meta property="og:description" content="Haz tu pedido aquí y en máximo 5 días te lo estaremos entregando" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="shortcut icon" href="img/simple-ico.png"><!--favicon image-->
    <!-- Stylesheets-->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font/all.css">

    <link rel="stylesheet" href="alert/sweetalert2.min.css">

    
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="cssE/estilos.css">
    

<style type="text/css">

body::-webkit-scrollbar{
    display: none;
}
body::-webkit-scrollbar-thumb{  
   display: none;
}

</style>

<!--=====================================
PLUGINS DE JAVASCRIPT
======================================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="js/font/all.js"></script>

<script src="js/plugins/jquery.min.js"></script>

<script src="js/plugins/bootstrap.min.js"></script>

<script src="alert/sweetalert2.min.js"></script>

<script type="text/javascript" src="js/script.js"></script>

<script src="jsE/main.js"></script>

<script>


$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});

function sumaSubtotales(){

  var subtotales = $(".suma");
  var arraySumaSubtotales = [];
  
  for(var i = 0; i < subtotales.length; i++){

    var subtotalesArray = $(subtotales[i]).html();
    arraySumaSubtotales.push(Number(subtotalesArray));

  }

  function sumaArraySubtotales(total, numero){

    return total + numero;

  }

  var sumaTotal = arraySumaSubtotales.reduce(sumaArraySubtotales);

  $("#totalSuma").html('<strong>S/. <input type="text" readonly name="precioTotal" value="'+(sumaTotal).toFixed(2)+'" style="border:none;width:60px;"></strong>');

  

}

function multi(numero){
  var total = 1;
  var change= false; 
  if($("#textCantidad"+numero).val()==""){
    var t=0
    document.getElementById('costo'+numero).innerHTML = t.toFixed(2);
    sumaSubtotales();
    idOcultos();
  }else{
      $(".monto"+numero).each(function(){
          if (!isNaN(parseFloat($(this).val()))) {
              change= true;
              total *= parseFloat($(this).val());
          }
      });
      // Si se modifico el valor , retornamos la multiplicación
      // caso contrario 0
      total = (change)? total:0;
      document.getElementById('costo'+numero).innerHTML = total.toFixed(2);
      sumaSubtotales();
      idOcultos();
  }
}


</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-167216833-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-167216833-1');
</script>
</head>
<body style="">

<?php
  if(isset($_GET["res"])){
?>
  
  <script>
    Swal.fire({
      title: '<b style="color:#000;">Gracias por tu compra!</b>',
      icon:'success',
      html: 'Se te enviara una notificación al correo y puedes contactarnos escribiendonos al <a class="mail2" href="https://wa.me/51992966157" target="_blank"><b>992-966-157</b></a> o enviarnos un correo a <a class="mail2" target="_blank" href="mailto:ventas@grupokahatt.com"><b>ventas@grupokahatt.com</b></a>',
      confirmButtonText: 'Cerrar',
      closeOnConfirm: false
    }).then((isConfirm) => {
      if (isConfirm) {
        window.location="https://simple-suppliers.com/";
      }
    })
  </script>
  
<?php
}
?>

<?php
  if(isset($_GET["error"])){
?>
  
  <script>
    Swal.fire({
      title: '<b style="color:#000;">ERROR!</b>',
      icon: 'error',
      html: '¡SELECCIONE UN PRODUCTO POR FAVOR!',
      confirmButtonText: 'Cerrar',
      closeOnConfirm: false
    }).then((isConfirm) => {
      if (isConfirm) {
        window.location="https://simple-suppliers.com/";
      }
    })
  </script>
  
<?php
} 
?>

<?php
  if(isset($_GET["mail"])){
?>
  
  <script>
    Swal.fire({
      title: '¡ERROR!',
      icon: 'error',
      html: '¡HUBO UN ERROR AL ENVIAR EL MAIL!',
      confirmButtonText: 'Cerrar',
      closeOnConfirm: false
    }).then((isConfirm) => {
      if (isConfirm) {
        window.location="https://simple-suppliers.com/";
      }
    })
  </script>
  
<?php
} 
?>


<!--=====================================
---HEADER
======================================-->
<div class="header" style="z-index: 5;">
  
  <img src="img/logo.png" id="inicio" style="">

  <div>

    <div class="contenedorLink" style="">

      <!--<div class="link" id="btnServicios">Servicios</div>

      <div class="link" id="btnTrabaja">Trabaja con Nosotros</div>-->

      <div class="link" id="btnContacto">¿Tienes alguna duda? Contáctanos</div>

      <!--<a href="#" style="border-radius: 20px;border:2px solid #000;">Inicia Sesión</a>-->

    </div>

  </div>

</div>


<!-- INICIO -->
<div class="slideshow" id="contenidoInicio" style="z-index: 1;display:block;">

  <ul class="slider">

    <li class="li">
      <div class="row">
        <div class="col-md-6">
          
        </div>
        <div class="col-md-6">
          <img src="img/image_-01.png" style="width: 100%;height: 100vh;">
        </div>
      </div>
      
      <section class="caption">
        <div class="container" style="max-width: 80%;">
          <div class="row">
            <div class="col-md-12">
              <h1><span style="color:#056CAD">#QuedateEnCasa</span></h1>
              <p>Mantenlo Simple. Haznos tu pedido desde casa y nosotros nos encargamos de llevartelo tomando las medidas de salubridad necesarias</p>
            </div>
          </div>
        </div>
      </section>
    </li>

    <li class="li">
      <div class="row">
        <div class="col-md-6">
          
        </div>
        <div class="col-md-6">
          <img src="img/image_-02.png" style="width: 100%;height: 100vh;">
        </div>
      </div>
      <section class="caption">
        <div class="container" style="max-width: 80%;">
          <div class="row">
            <div class="col-md-12">
              <h1>No te <span style="color:#056CAD">compliques</span></h1>
              <p>Tenemos todo lo esencial para tu hogar. Abarrotes, frutas y verduras, productos de limpieza, etc.</p>
            </div>
          </div>
        </div>
      </section>
    </li>

    <li class="li">
      <div class="row">
        <div class="col-md-6">
          
        </div>
        <div class="col-md-6">
          <img src="img/image_-03.png" style="width: 100%;height: 100vh;">
        </div>
      </div>
      <section class="caption">
        <div class="container" style="max-width: 80%;">
          <div class="row">
            <div class="col-md-12">
              <h1>Llegamos a los<br> siguientes <span style="color:#056CAD">distritos</span></h1>
              <p>Por el momento llegamos a los siguientes distritos: La Molina, San Isidro, Miraflores, Surco, San Borja, Barranco, Lince, Magdalena, Jesus María, Pueblo Libre, San Miguel y Surquillo. Para más información, haz click en contáctanos, estaremos felices de atenderte.</p>
            </div>
          </div>
        </div>
      </section>
    </li>

  </ul>

  <div class="campoBoton" style="">
    
    <input type="button"  id="btnPedir" value="Haz tu pedido">

  </div>


  <ol class="pagination">
    
  </ol>

</div>
<!-- FIN INICIO -->

<!-- SERVICIOS -->
<div class="slideshow" id="contenidoServicios" style="position: fixed;z-index: 2;display:none;">

  <ul class="slider">

    <li>
      <div class="row">
        <div class="col-md-6">
          
        </div>
        <div class="col-md-6">
          <img src="img/image_-04.png" style="width: 100%;height: 100vh;">
          <img src="img/image_-05.png" style="position: absolute;width: 70%;bottom: 10%;left: 0px;">
        </div>
      </div>
      
      <section class="caption">
        <div class="container" style="max-width: 80%;">
          <div class="row">
            <div class="col-md-12">
              <h1>Nuestros<br><span style="color:#056CAD">Servicios</span></h1>
              <p>Encargate de hacer tu lista con nosotros, una vez que la mandes recibirás un correo de confirmación y con una fecha estimada de entrega (48 contando días hábiles).</p>
            </div>
          </div>
        </div>
      </section>
    </li>

  </ul>

  <div class="campoBoton">
    
    <input type="button"  id="btnPedir2" value="Haz tu pedido">

  </div>
</div>
<!-- FIN SERVICIOS -->

<!-- TRABAJA -->
<div class="slideshow" id="contenidoTrabaja" style="position: fixed;z-index: 2;display:none;">

  <ul class="slider">

    <li>
      <div class="row">
        <div class="col-md-6">
          
        </div>
        <div class="col-md-6">
          <img src="img/image_-04.png" style="width: 100%;height: 100vh;">
          <img src="img/image_-06.png" style="position: absolute;width: 70%;bottom: 10%;left: 0px;">
        </div>
      </div>
      
      <section class="caption">
        <div class="container" style="max-width: 80%;">
          <div class="row">
            <div class="col-md-12">
              <h1>Trabaja con<br><span style="color:#056CAD">Nosotros</span></h1>
              <p>¿Quieres que despachemos tus productos para nuestros clientes? Comunicate con nosotros al mail que figuraabajo y te responderemos lo antes posible. Gracias por confiar en nosotros.</p>
              <br><br><br>
              <a class="mail" href="mailto:ventas@grupokahatt.com">ventas@grupokahatt.com</a>
            </div>
          </div>
        </div>
      </section>
    </li>

  </ul>

</div>
<!-- FIN TRABAJA -->

<!-- CONTACTO -->
<div class="slideshow" id="contenidoContacto" style="position: fixed;z-index: 2;display:none;">

  <ul class="slider">

    <li>
      <div class="row">
        <div class="col-md-6 col-xs-12">
          
        </div>
        <div class="col-md-6 col-xs-12">
          <img src="img/image_-04.png" style="width: 100%;height: 100vh;">
          <img src="img/image_-07.png" style="position: absolute;width: 70%;bottom: 10%;left: 0px;">
        </div>
      </div>
      
      <section class="caption">
        <div class="container" style="max-width: 80%;">
          <div class="row">
            <div class="col-md-12">
              <h1>¿Tienes dudas?<br><span style="color:#056CAD">Contáctanos</span></h1>
              <p>Dejanos hacerte la vida mas SIMPLE. Escribenos a <a class="mail" href="mailto:ventas@grupokahatt.com">ventas@grupokahatt.com</a> o llamanos al <a class="mail" href="tel:+51992966157">992-966-157</a></p>
              <br>
              
            </div>
          </div>
        </div>
      </section>
    </li>

  </ul>

</div>
<!-- FIN CONTACTO -->

<footer style="background: #053AAD;position: fixed; width: 100%;bottom: 0;z-index: 2;">
  <div class="container" style="max-width:95%;">
    <div class="row" id="cFooter" style="">
      <div class="col-md-6" id="txtFooter1" style="text-align: left;color: #fff;">
        Página realizada por MAHGO
      </div>
      <div class="col-md-6" id="txtFooter2" style="text-align: right;color: #fff;">
        Grupo Kahatt - Todos los derechos reservados - 2020
      </div>
    </div>
  </div>
</footer>


<div id="registro" style="position: fixed;z-index:10;width: 100%;height: 100vh;background: #fff;top: 0;right:-200%;overflow-y: scroll;">

  <form name="miformulario" method="post" action="asd.php"> 

    <div class="container">
      <div class="row">
        <div id="btnClose" style="position:absolute;top:2%;right:4%;cursor: pointer;color: #000;font-size: 30px;z-index: 5;">
          <i class="fas fa-times"></i>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-4" style="text-align: center;">
              <img src="img/logo.png" class="imgLogoR">
            </div>
            <div class="col-md-7" style="">
              <h1 class="tituloR" style="margin: 20px 0px;">En Simple, estamos contigo</h1>

              <p class="txtR">
                -<span style="color: #EC8A27;"> Ingresa tus datos y dirección del pedido, cantidades que deseas por producto y luego haz click en REALIZAR PEDIDO al final de la lista.</span><br>
                - Aceptamos pagos por transferencia o efectivo.<br>
                - Tiempo de despacho: Dentro de los 5 días una vez enviado el pedido.<br>
                - Despachamos de Lunes a Sábados.<br>
                - Pedidos menores a 200 soles tendrán un recargo de 8 soles de envío.<br>
              </p>
            </div>
          </div>
        </div>


        <div class="col-md-12" id="contenidoR1">
          
          <div class="row">

            <div class="col-md-6 col-xs-12" style="margin-top: 10px;">
              <label for="comment">Nombres:</label>
              <input type="text" name="txtNombre" class="form-control" id="" value="" required>
            </div>
            <div class="col-md-6 col-xs-12" style="margin-top: 10px;">
              <label for="comment">Apellidos:</label>
              <input type="text" name="txtApellidos" class="form-control" id="" value="" required>
            </div>

            <div class="col-md-6 col-xs-12" style="margin-top: 10px;">
              <label for="comment">Teléfono/Celular:</label>
              <input type="text" name="txtCelular" class="form-control" id="" minlength="9" maxlength="9" required>
            </div>
            <div class="col-md-6 col-xs-12" style="margin-top: 10px;">
              <label for="comment">Distrito:</label>
              <!--<input type="text" name="txtDistrito" class="form-control" id="" value="" required>-->
                <select class="form-control" name="txtDistrito" id="">
                  <option value="La Molina">La Molina</option>
                  <option value="San Isidro">San Isidro</option>
                  <option value="Miraflores">Miraflores</option>
                  <option value="Surco">Surco</option>
                  <option value="San Borja">San Borja</option>
                  <option value="Barranco">Barranco</option>
                  <option value="Lince">Lince</option>
                  <option value="Magdalena">Magdalena</option>
                  <option value="Jesus María">Jesus María</option>
                  <option value="Pueblo Libre">Pueblo Libre</option>
                  <option value="San Miguel">San Miguel</option>
                  <option value="Surquillo">Surquillo</option>
                </select>
            </div>
            <div class="col-md-6 col-xs-12" style="margin-top: 10px;">
              <label for="comment">Email:</label>
              <input type="email" name="txtEmail" class="form-control" id="" value="" required>
            </div>
            <div class="col-md-6 col-xs-12" style="margin-top: 10px;">
              <label for="comment">Dirección:</label>
              <div class="row">
                <div class="col-md-5">
                    <input type="text" name="txtCalle" class="form-control" id="" value="" placeholder="Dirección" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="txtCalleNum" class="form-control" id="" value="" placeholder="N°" required>
                </div>
<script>

function addElement(name) { 
    var select = document.getElementById(name);
    
    if(select.options[select.selectedIndex].value=="Casa"){
    
        var d = document.getElementById('numeroD');
        var align = d.removeAttribute('required');
        var dis = d.setAttribute('disabled','');
        
    }else if(select.options[select.selectedIndex].value=="Dpto."){
    
        var d = document.getElementById('numeroD');
        var align = d.setAttribute('required','');
        var dis = d.removeAttribute('disabled');
    
    } 
}
</script>
                <div class="col-md-3">
                    <select class="form-control" name="txtTipoC" id="tipoDomicilio" onchange="addElement('tipoDomicilio')">
                      <option value="Casa">Casa</option>
                      <option value="Dpto.">Dpto.</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" name="txtNumC" class="form-control" id="numeroD" value="" placeholder="N°" disabled>
                </div>
              </div>
              <!--<input type="text" name="txtDireccion" class="form-control" id="" value="" required>-->
            </div>

          </div>

        </div>

        <div class="col-md-12" id="contenidoR2" style="">
          
          <table class="table table-bordered table-hover" style="margin-top:17px;">
            <thead>
              <tr>
                <th scope="col" style="text-align: center">Tipo</th>
                <th scope="col" style="text-align: center">Producto</th>
                <th scope="col" style="text-align: center">Precio</th>
                <th scope="col"  style="text-align: center">Cantidad</th>
                <th scope="col"  style="text-align: center">Sub Total</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $count = 0;

              foreach ($producto as $key => $value) {
              
              $count++;

              echo '<tr>';

                if($value["temperatura"]=="Congelados"){
                  echo '<td style="text-align: center;background:#32D1D0;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Diary" || $value["temperatura"]=="Diary 2"){
                  echo '<td style="text-align: center;background:#D04A23;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Bebidas"){
                  echo '<td style="text-align: center;background:#327CD1;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Abarrotes"){
                  echo '<td style="text-align: center;background:#6FE065;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Abarrotes 2"){
                  echo '<td style="text-align: center;background:#8DF384;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Golosinas"){
                  echo '<td style="text-align: center;background:#E0E751;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Desayunos"){
                  echo '<td style="text-align: center;background:#E75A51;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Cuidado Personal"){
                  echo '<td style="text-align: center;background:#9499B5;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Higiene y Limpieza"){
                  echo '<td style="text-align: center;background:#94B3B5;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Bebidas Alcoholicas"){
                  echo '<td style="text-align: center;background:#DADBDB;">'.$value["temperatura"].'</td>';
                }else if($value["temperatura"]=="Orgánico"){
                  echo '<td style="text-align: center;background:#4BE02D;">'.$value["temperatura"].'</td>';
                }else{
                  echo '<td style="text-align: center;background:#DADBDB;">OTROS</td>';
                }

                echo '<td style="text-align: center">'.$value["nombreProducto"].'</td>';
              ?>

                      <td style="text-align: center">S/. <input type="text" readonly class="monto<?php echo $count; ?>" style="border:none;width:50px;" value="<?php echo $value["precioVenta"]; ?>"></td>
                      <td style="text-align: center">
                        <input type="text" name="canTidad<?php echo $count; ?>" class="form-control monto<?php echo $count; ?>" value="0" onClick="this.setSelectionRange(0, this.value.length)" onkeyup="multi('<?php echo $count; ?>');" id="textCantidad<?php echo $count; ?>" style="width:70px;text-align:center;margin:auto;">
                      </td>
                      <td style="text-align: left">
                        S/.
                        <label class="suma" id="costo<?php echo $count; ?>">0.00</label>

                        <input type="text" id="idEscondido<?php echo $count; ?>" value="<?php echo $value["id"]; ?>" style="width: 0px;opacity: 0;">
                      </td>

                    </tr>
              <?php

              }
echo '<script>
window.addEventListener("load", function() {
  miformulario.txtCelular.addEventListener("keypress", soloNumeros, false);
  miformulario.txtNumC.addEventListener("keypress", soloNumeros, false);
  miformulario.txtCalleNum.addEventListener("keypress", soloNumeros, false);';
  
for($w=1; $w<=$count;$w++){
    
    echo 'miformulario.canTidad'.$w.'.addEventListener("keypress", soloNumeros, false);';
    
}
  
echo '});

//Solo permite introducir numeros.
function soloNumeros(e){
  var key = window.event ? e.which : e.keyCode;
  if (key < 48 || key > 57) {
    e.preventDefault();
  }
}
</script>';

              ?>

              <tr>
                <td colspan="3" style="border: none;"><input type="text" id="totalCount" value="<?php echo $count; ?>" style="width: 20px;opacity: 0;"></td>
                <td style="text-align: center">TOTAL</td>
                <td style="text-align: left"><label id="totalSuma"></label></td>
              </tr>

              <!--<tr>
                <td colspan="5"><input type="submit" class="btnPedir" value="Realizar Pedido"></td>
              </tr>-->
              
            </tbody>
          </table>

        </div>

        <div class="col-md-12" style="text-align: center;margin-bottom: 60px;">
          <input type="submit" class="btnPedir" value="Realizar Pedido">
        </div>

      </div>
    </div>

    <div id="generadorId" style="opacity: 0;width: 0px;height: 0px;"></div>

    <div id="generadorCantidad" style="opacity: 0;width: 0px;height: 0px;"></div>

    <div id="generadorTotal" style="opacity: 0;width: 0px;height: 0px;"></div>

  </form>

</div>



    
      
  </body>
</html>