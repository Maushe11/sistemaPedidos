<?php

class ControladorPedido{

	/*=============================================
	SELECCIONAR PEDIDO
	=============================================*/

	static public function ctrMostrarPedido(){

		$respuesta = ModeloPedido::mdlMostrarPedido();

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

}