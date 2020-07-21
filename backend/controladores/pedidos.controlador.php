<?php

class ControladorPedido{

	/*=============================================
	SELECCIONAR PEDIDO
	=============================================*/

	static public function ctrMostrarPedido($fecha){

		$respuesta = ModeloPedido::mdlMostrarPedido($fecha);

		return $respuesta;

	}
	
	/*=============================================
	SELECCIONAR DETALLE DE PEDIDO
	=============================================*/

	static public function ctrMostrarDetallePedido($producto2,$datosId){

		$respuesta = ModeloPedido::mdlMostrarDetallePedido($producto2,$datosId);

		return $respuesta;

	}

	/*=============================================
	SUMAS
	=============================================*/

	static public function ctrMostrarSumas($producto3){

		$respuesta = ModeloPedido::mdlMostrarSumas($producto3);

		return $respuesta;

	}

	/*=============================================
	SELECCIONAR PEDIDO FILTRO
	=============================================*/

	static public function ctrMostrarPedidoFiltro($distrito1,$distrito2,$distrito3){

		$respuesta = ModeloPedido::mdlMostrarPedidoFiltro($distrito1,$distrito2,$distrito3);

		return $respuesta;

	}

	/*=============================================
	PRODUCTOS DEL PEDIDO
	=============================================*/

	static public function ctrMostrarProducto($idPedido){

		$respuesta = ModeloPedido::mdlMostrarProducto($idPedido);

		return $respuesta;

	}

	/*=============================================
	LISTA DE PRODUCTOS
	=============================================*/

	static public function ctrListaProducto(){

		$respuesta = ModeloPedido::mdlListaProducto();

		return $respuesta;

	}
	
	/*=============================================
	TOTAL DE PRECIO VENTAS
	=============================================*/

	static public function ctrTotalVentas(){

		$respuesta = ModeloPedido::mdlTotalVentas();

		return $respuesta;

	}
	
	/*=============================================
	TOTAL DE PRECIO COMPRA
	=============================================*/

	static public function ctrTotalCompras(){

		$respuesta = ModeloPedido::mdlTotalCompras();

		return $respuesta;

	}
	
	/*=============================================
	ACTUALIZAR ESTADO
	=============================================*/

	static public function ctrActualizarEstado($datos){

		$tabla = "pedido";

		$respuesta = ModeloPedido::mdlActualizarEstado($tabla, $datos);

		return $respuesta;

	}
	
	/*=============================================
	BUSCAR PEDIDO ESTADO
	=============================================*/

	static public function ctrMostrarPedidoId($id){

		$respuesta = ModeloPedido::mdlMostrarPedidoId($id);

		return $respuesta;

	}

}