<!DOCTYPE html>
<html lang="es">
  <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    <title>Simple</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <link rel="shortcut icon" href="img/simple-ico.png"><!--favicon image-->
    <!-- Stylesheets-->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font/all.css">
    <link rel="stylesheet" href="cssE/estiloMensaje.css">
    <link rel="stylesheet" href="css/estilo.css">
    

    
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
    window.location.hash="no-back-button";
window.location.hash="Again-No-back-button";//esta linea es necesaria para chrome
window.onhashchange=function(){window.location.hash="no-back-button";}
</script>
  </head>
<body>
  <?php
  
require('conexion.php');

date_default_timezone_set("America/Lima");

$conectar=mysqli_connect($mibase["host"],$mibase["user"],$mibase["pass"],$mibase["base"]) or die ('No se Conecto'.mysqli_error());

mysqli_set_charset($conectar, 'utf8');

$idPedidoNuevo = $_GET["codigo"];

$sql = "SELECT * FROM pedido WHERE id=".$idPedidoNuevo." limit 1";
$res=mysqli_query($conectar,$sql);	
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

$codigo2 = $_GET["codigo2"];

if($_GET["codigo"]==$idPedidoNuevo){
    if($_GET["codigo2"]==$row["precioTotal"]){
        
    $mensaje = '<div style="width: 100%;background: #eee; position: relative; font-family: sans-serif;padding-bottom: 40px;">
		
		<center>
			<a href="https://studio24.com.pe/simple-mejoras/">
			    <img class="imgLogo" src="https://studio24.com.pe/simpleFrontend/img/logo.png">
			</a>
		</center>
		
		<div class="campo">
			
			<center>
				<h1 style="font-weight: 700; color: #056CAD;">Gracias Por Tu Compra</h1>
			</center>
				<hr style="border: 1px solid #ccc;width: 100%;">

				<h3 style="color:#000;font-weight:400;font-size: 20px;">
				Este es el detalle de tu pedido:
				</h3>
    <center>
    <br>
    <div class="contenidoTabla">
    <table style="border:1px solid #dee2e6;">
    <tr>
        <td style="padding:5px;border-bottom: 1px solid #dee2e6;margin:0;"><b>Producto</b></td>
        <td style="padding:5px;border-bottom: 1px solid #dee2e6;margin:0;"><b>Precio</b></td>
        <td style="padding:5px;border-bottom: 1px solid #dee2e6;margin:0;"><b>Cantidad</b></td>
        <td style="padding:5px;border-bottom: 1px solid #dee2e6;margin:0;"><b>Monto</b></td>
    </tr>';
    
    $sqlCorreo = "SELECT * FROM detallepedido d INNER JOIN producto p ON d.idProducto=p.id WHERE d.idPedido = $idPedidoNuevo";
	$resCorreo=mysqli_query($conectar,$sqlCorreo);
    
    while ($fila = mysqli_fetch_array($resCorreo, MYSQLI_ASSOC)){
        $mensaje .= '<tr>
                        <td style="padding:5px;border-bottom: 1px solid #dee2e6;margin:0;">'.$fila["nombreProducto"].'</td>
                        <td style="padding:5px;border-bottom: 1px solid #dee2e6;margin:0;">'.$fila["precioVenta"].'</td>
                        <td style="text-align:center;border-bottom: 1px solid #dee2e6;margin:0;">'.$fila["cantidad"].'</td>
                        <td style="padding:5px;border-bottom: 1px solid #dee2e6;margin:0;">'.number_format($fila["precioVenta"]*$fila["cantidad"], 2, '.', '').'</td>
                    </tr>';
    }
	
	$sqlCorreo2 = "SELECT * FROM pedido WHERE id=".$idPedidoNuevo." limit 1";
	$resCorreo2=mysqli_query($conectar,$sqlCorreo2);	
	$rowCorreo2 = mysqli_fetch_array($resCorreo2, MYSQLI_ASSOC);

	$mensaje .='<tr>
	            <td></td>
	            <td></td>
	            <td style="text-align:center;padding:5px;"><b>Total</b></td>
	            <td style="padding:5px;">'.$rowCorreo2["precioTotal"].'</td>
	
	</table>
	</div>
	</center>
	<br>
	<h3 style="color:#000;font-weight:400;font-size: 20px;">El pago será realizado a la hora de entrega, aceptamos efectivo y todas las tarjetas como medio de pago.</h3>
    
    <h3 style="color:#000;font-weight:400;font-size: 20px;">Pedidos menores a 200 soles tendrán un recargo de 8 soles de envío.</h3>
    
	<h3 style="color:#000;font-weight:400;font-size: 18px;">
	  Te hemos enviado un correo de confirmación de pedido y tu pedido esta siendo programado dentro de los próximos 4 días hábiles. Si tienes alguna duda, consulta puedes llamarnos al <a class="mail" href="tel:+51992966157">992-966-157</a> o escribirnos a <a class="mail" href="mailto:ventas@grupokahatt.com">ventas@grupokahatt.com</a>
	</h3>
	<center>
	<br><br>
	<a id="btnPedir" href="https://simple-suppliers.com/">Volver al Inicio</a>
	<br><br>
	</center>
	</div>

	</div>';
    echo $mensaje;
    }else{
        echo '<br><br><br><center><h1>Error en el servidor vuelva a intentarlo!</h1></center>';
    }
}else{
    echo '<br><br><br><center><h1>Error en el servidor vuelva a intentarlo!</h1></center>';
}
    ?>
</body>
</html>