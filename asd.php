
<?php

require_once "PHPMailer/PHPMailerAutoload.php";

require('conexion.php');

date_default_timezone_set("America/Lima");

$conectar=mysqli_connect($mibase["host"],$mibase["user"],$mibase["pass"],$mibase["base"]) or die ('No se Conecto'.mysqli_error());

mysqli_set_charset($conectar, 'utf8');

$nombres = html_entity_decode($_POST["txtNombre"], ENT_QUOTES | ENT_HTML401, "UTF-8");
$apellidos = html_entity_decode($_POST["txtApellidos"], ENT_QUOTES | ENT_HTML401, "UTF-8");

$celular = $_POST["txtCelular"];

$distrito = html_entity_decode($_POST["txtDistrito"], ENT_QUOTES | ENT_HTML401, "UTF-8");

$email = $_POST["txtEmail"];


@$txtNumC = $_POST["txtNumC"];

$direccion = html_entity_decode($_POST["txtCalle"], ENT_QUOTES | ENT_HTML401, "UTF-8").' '.$_POST["txtCalleNum"].' '.$_POST["txtTipoC"].' '.$txtNumC;

@$precioTotal = $_POST["precioTotal"];

$totalProductos = $_POST["txtTotalProductos"];

if($precioTotal=="0.00" || $precioTotal==""){
	header('location:index.php?error');
}else{
	/*REGISTRAR CLIENTE*/
	$sql = "INSERT INTO cliente(nombres,apellidos,distrito,direccion,telefono,email) VALUES('$nombres','$apellidos','$distrito','$direccion','$celular','$email')";
	$result=mysqli_query($conectar,$sql);

	/*BUSCAR CLIENTE*/
	$sqlBusCliente = "SELECT * FROM cliente WHERE nombres='$nombres' AND apellidos='$apellidos' AND distrito='$distrito' AND direccion='$direccion' AND telefono='$celular' ORDER BY id DESC LIMIT 1";
	$res=mysqli_query($conectar,$sqlBusCliente);
	$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
	$idClienteNuevo = $row["id"];
	$d = date("Y-m-d");

	/*REGISTRAR PEDIDO*/
	$sqlPedido = "INSERT INTO pedido(idCliente,precioTotal,fecha) VALUES($idClienteNuevo,$precioTotal,'$d')";
	$resPedido = mysqli_query($conectar,$sqlPedido);

	/*BUSCAR PEDIDO*/

	$sqlBusPedido = "SELECT * FROM pedido WHERE idCliente=$idClienteNuevo AND precioTotal=$precioTotal ORDER BY id DESC LIMIT 1";
	$rBusPedido=mysqli_query($conectar,$sqlBusPedido);
	$rowBusPE = mysqli_fetch_array($rBusPedido, MYSQLI_ASSOC);

	$idPedidoNuevo = $rowBusPE["id"];
	$codigo2 = $rowBusPE["precioTotal"];

	for ($i=1; $i <= $totalProductos; $i++) { 
	
		$idProducto = $_POST["idOculto".$i];
		
		$sqlBusProducto = "SELECT * FROM producto WHERE id= $idProducto";
    	$rBusProducto=mysqli_query($conectar,$sqlBusProducto);
    	$rowBusPro = mysqli_fetch_array($rBusProducto, MYSQLI_ASSOC);
    	
    	$sku=$rowBusPro["sku"];
    	$nomPro=$rowBusPro["nombreProducto"];
    	$precioCompra=$rowBusPro["precioCompra"];
    	$precioVenta=$rowBusPro["precioVenta"];

		$cantidad = $_POST["cantidadOculto".$i];
		/*REGISTRAR DETALLE DE PEDIDO*/
		$sqlDetallePedido = "INSERT INTO detallepedido(idPedido,idProducto,cantidad,detalleSku,detalleNomPro,detallePrecioCompra,detallePrecioVenta) VALUES($idPedidoNuevo,$idProducto,$cantidad,'$sku','$nomPro',$precioCompra,$precioVenta)";
		$respuestaFinal=mysqli_query($conectar,$sqlDetallePedido);

	}
	
	/*AUMENTO POR RECARGO*/
	
	$precioTotalFloat = floatval($precioTotal);;
	
	if($precioTotalFloat < 200.00){
	    
	    $sqlBusProRecargo = "SELECT * FROM producto WHERE id= 282";
    	$rBusProRecargo=mysqli_query($conectar,$sqlBusProRecargo);
    	$rowBusProRecargo = mysqli_fetch_array($rBusProRecargo, MYSQLI_ASSOC);
    	
    	$nomProRecargo=$rowBusProRecargo["nombreProducto"];
    	$precioVentaRecargo=$rowBusProRecargo["precioVenta"];
    	
	    /*REGISTRAR RECARGO AL DETALLEPEDIDO*/
	    $SqlDetRecargo = "INSERT INTO detallepedido(idPedido,idProducto,cantidad,detalleNomPro,detallePrecioVenta) VALUES($idPedidoNuevo,282,1,'$nomProRecargo',$precioVentaRecargo)";
		$respuestaFinalRecargo=mysqli_query($conectar,$SqlDetRecargo);
		
		/*MODIFICAR PRECIO TOTAL EN PEDIDO*/
		$precioTotalSumado = $precioTotalFloat + $precioVentaRecargo;
		
		$sqlPedidoRecarga = "UPDATE pedido SET precioTotal=$precioTotalSumado WHERE id=$idPedidoNuevo";
		$resPedidoRecarga = mysqli_query($conectar,$sqlPedidoRecarga);
		
		$sqlBusPedidoRegistrado = "SELECT * FROM pedido WHERE idCliente=$idClienteNuevo AND precioTotal=$precioTotalSumado ORDER BY id DESC LIMIT 1";
    	$rBusPedidoRegistrado =mysqli_query($conectar,$sqlBusPedidoRegistrado);
    	$rowBusPERegistrado = mysqli_fetch_array($rBusPedidoRegistrado, MYSQLI_ASSOC);
		
		$codigo2 = $rowBusPERegistrado["precioTotal"];
	    
	}
	
	

	/*=============================================
	CONDICIONES
	=============================================*/

	$hoy = date("Y-m-d");
	$hora= date("H:i:s");

	$sqlCondicion = "SELECT count(id) as num FROM pedido WHERE fecha='$hoy'";
	$resCondicio=mysqli_query($conectar,$sqlCondicion);
	$rowBusCondicion = mysqli_fetch_array($resCondicio, MYSQLI_ASSOC);

	$totalPedidosHoy = $rowBusCondicion["num"];

	$fechaPedidoNuevo = $rowBusPE["fecha"];

	$sumaFecha = date("Y-m-d",strtotime($fechaPedidoNuevo."+ 1 days")); 

	if ($totalPedidosHoy <= 20) {

		echo "Todo normal";

	}else{

		echo "Se modifica fecha";

		/*MODIFICAR FECHA PEDIDO*/
		$sqlPedidoU = "UPDATE pedido SET fecha='$sumaFecha' WHERE id=$idPedidoNuevo";
		$resPedidoU=mysqli_query($conectar,$sqlPedidoU);

	}

/*=============================================
CONFIRMAR PEDIDO Y ENVIAR EMAIL
=============================================*/

if($rBusPedido){

	/*=============================================
	ENVIO DE MAIL CLIENTE
	=============================================*/

	$mail = new PHPMailer;

	$mail->CharSet = 'UTF-8';

	$mail->isMail();

	$mail->setFrom('ventas@grupokahatt.com','Simple');

	$mail->addReplyTo('ventas@grupokahatt.com','Simple');

	$mail->Subject ="Tu pedido fue recibido";

	$mail->addAddress($email);
	
	$mensaje = '<div style="width: 100%;background: #eee; position: relative; font-family: sans-serif;padding-bottom: 40px;">
		
		<center>
			
			<img style="padding:20px;width: 15%;" src="https://studio24.com.pe/simpleFrontend/img/logo.png">
			
		</center>
		
		<div style="position: relative; margin:auto; width: 600px;background: white; padding: 20px;">
			
			<center>
				<h1 style="font-weight: 700; color: #056CAD;">Gracias '.$nombres.'</h1>
			</center>
				<hr style="border: 1px solid #ccc;width: 100%;">

				<h3 style="#000;font-weight:400">Tu pedido ha sido recibido y está siendo programado. En poco tiempo estaremos contactándote para confirmarte el día de entrega de su pedido.<br><br>
				Este es el detalle de tu pedido:</h3>
    <center>
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
	</center>
	
	<h3 style="#000;font-weight:400">Tenemos algunos recordatorios para tener en cuenta:</h3>

 
    <h5 style="#000;font-weight:400">
    a. Por temas de salud y seguridad, nuestro personal no podrá subir a departamentos ni ingresar a su hogar.<br><br>
    
    b. El pago será realizado a la hora de entrega, aceptamos efectivo y todas las tarjetas como medio de pago.<br><br>
    
    c. Pedidos menores a 200 soles tendrán un recargo de 8 soles de envío.<br><br>
    
    d. Estamos sujetos al stock habilitado por MAKRO. La disponibilidad de productos nos es confirmada el mismo día de entrega. Si tienes alguna consulta sobre esto, contáctanos al siguiente numero:992966157<br><br>
    
    e. Recuerda hacer la revisión de la mercadería junto con nuestro personal a la hora de la entrega.</h5>
    
    	<h3 style="#000;font-weight:400">Muchísimas gracias por tu compra.<br><br>
    
    ¿Tienes alguna duda? Contactanos al: 992 266 157 o escríbenos a ventas@grupokahatt.com</h3>
	</div>

	</div>';

	$mail->msgHTML($mensaje);

	$envioCliente =$mail->Send();

	/*=============================================
	ENVIO DE MAIL EMPRESA
	=============================================*/

	$m = new PHPMailer;

	$m->CharSet = 'UTF-8';

	$m->isMail();

	$m->setFrom('ventas@grupokahatt.com','Simple');

	$m->addReplyTo('ventas@grupokahatt.com','Simple');

	$m->Subject ="Pedido de ".$nombres;

	$m->addAddress('ventas@grupokahatt.com');

	$m->msgHTML('<div style="width: 100%;background: #eee; position: relative; font-family: sans-serif;padding-bottom: 40px;">
		
    	<center>
    		
    		<img style="padding:20px;width: 15%;" src="https://studio24.com.pe/simpleFrontend/img/logo.png">
    		
    	</center>
    	
    	<div style="position: relative; margin:auto; width: 600px;background: white; padding: 20px;">
    		
    		<center>
    			<h1 style="font-weight: 700; color: #056CAD;">Nuevo Pedido</h1>
    		</center>
    			<hr style="border: 1px solid #ccc;width: 100%;">
                <br>
    			<p style="color:#000;font-weight:400;font-size:1.17em;">
    			<b>Pedido de:</b> '.$nombres.' '.$apellidos.'<br>
                <b>Monto:</b> S./ '.$precioTotal.'<br>
                <b>Distrito:</b> '.$distrito.'<br>
                <b>Hora del pedido: </b>'.$hora.'<br>
                
                </p>
    		    <br><br>
    
    	</div>
    
    </div>');

	$envioEmpresa =$m->Send();

	if($respuestaFinal && $envioCliente && $envioEmpresa){

		header('location:res.php?codigo='.$idPedidoNuevo.'&codigo2='.$codigo2);

	}else{

		header('location:index.php?mail');

	}

}else{
    
    echo '<br><br><br><br><center><h1>Hubo un error en el proceso de su pedido por favor vuelva a intentarlo</h1></center>';
    
}

}








?>

</body>
</html>