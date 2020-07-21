<?php

class ModeloPedido{

	/*=============================================
	LISTA PRODUCTO
	=============================================*/

	static public function mdlListaProducto(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM producto where cantidadPedida=0");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

}