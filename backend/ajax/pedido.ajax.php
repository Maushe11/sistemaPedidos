<?php

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

class AjaxPedidos{

	/*=============================================
	ACTUALIZAR ESTADO
	=============================================*/	

	public $idPedido;
	public $idEstado;

	public function ajaxAgregarEstado(){

		$datos = array("idPedido"=>$this->idPedido,
					   "idEstado"=>$this->idEstado);

		$respuesta = ControladorPedido::ctrActualizarEstado($datos);

		echo $respuesta;

	}

}

/*=============================================
ACTULIZAR ESTADO
=============================================*/	

if(isset($_POST["idPedido"])){

	$deseo = new AjaxPedidos();
	$deseo -> idPedido = $_POST["idPedido"];
	$deseo -> idEstado = $_POST["idEstado"];
	$deseo ->ajaxAgregarEstado();
	
}