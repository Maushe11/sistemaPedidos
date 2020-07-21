<?php

require_once "conexion.php";

class ModeloPedido{

	/*=============================================
	MOSTRAR PEDIDO
	=============================================*/

	static public function mdlMostrarPedido($fecha){

		if($fecha == ""){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido p INNER JOIN cliente c ON p.idCliente=c.id");

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido p INNER JOIN cliente c ON p.idCliente=c.id WHERE fecha = '".$fecha."'");

		}

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}
	
	/*=============================================
	MOSTRAR Detalle Pedido
	=============================================*/

	static public function mdlMostrarDetallePedido($producto2,$datosId){

		if($datosId == 0){

			return 0;

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT count(idDetallePedido) as detalle, cantidad  FROM detallepedido WHERE idPedido=".$datosId." AND idProducto=".$producto2."");

		}

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUMAS
	=============================================*/

	static public function mdlMostrarSumas($producto3){

		if($producto3 == 0){

			return 0;

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(idDetallePedido) as detalle,sum(cantidad) as suma FROM detallepedido d INNER JOIN pedido p on d.idPedido=p.id WHERE idProducto=".$producto3." and p.estado=2");

		}

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PEDIDO FILTRO
	=============================================*/

	static public function mdlMostrarPedidoFiltro($distrito1,$distrito2,$distrito3){

		if($distrito1=="" && $distrito2=="" && $distrito3==""){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido p INNER JOIN cliente c ON p.idCliente=c.id WHERE p.estado=2");

		}

		if($distrito1!="" && $distrito2=="" && $distrito3==""){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido p INNER JOIN cliente c ON p.idCliente=c.id WHERE p.estado=2 AND c.distrito LIKE '%".$distrito1."%'");

		}

		if($distrito1!="" && $distrito2!="" && $distrito3==""){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido p INNER JOIN cliente c ON p.idCliente=c.id WHERE p.estado=2 AND (c.distrito LIKE '%".$distrito1."%' OR distrito LIKE '%".$distrito2."%')");

		}

		if($distrito1!="" && $distrito2!="" && $distrito3!=""){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido p INNER JOIN cliente c ON p.idCliente=c.id WHERE p.estado=2 AND (c.distrito LIKE '%".$distrito1."%' OR distrito LIKE '%".$distrito2."%' OR distrito LIKE '%".$distrito3."%')");

		}

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PRODUCTO
	=============================================*/

	static public function mdlMostrarProducto($idPedido){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM detallepedido d INNER JOIN producto p ON d.idProducto=p.id WHERE d.idPedido = :idPedido");

		$stmt->bindParam(":idPedido", $idPedido, PDO::PARAM_INT);	

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	LISTA PRODUCTO
	=============================================*/

	static public function mdlListaProducto(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM producto");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}
	
	/*=============================================
	TOTAL DE PRECIO VENTAS
	=============================================*/
	
	static public function mdlTotalVentas(){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(precioTotal) AS sumaVentas FROM pedido");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}
	
	/*=============================================
	TOTAL DE PRECIO COMPRA
	=============================================*/
	
	static public function mdlTotalCompras(){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(p.precioCompra * d.cantidad) as sumaCompras FROM detallepedido d INNER JOIN producto p ON d.idProducto=p.id");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}
	
	/*=============================================
	ACTUALIZAR ESTADO
	=============================================*/

	static public function mdlActualizarEstado($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado=:id_estado WHERE id=:id_pedido");

		$stmt->bindParam(":id_pedido", $datos["idPedido"], PDO::PARAM_INT);
		$stmt->bindParam(":id_estado", $datos["idEstado"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}
	
	/*=============================================
	BUSCAR PEDIDO ESTADO
	=============================================*/

	static public function mdlMostrarPedidoId($id){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM pedido WHERE id = '".$id."'");

		if($stmt -> execute()){
		    return $stmt -> fetchAll();
		}else{
		    return "error";
		}

		$stmt -> close();

		$stmt = null;

	}

}