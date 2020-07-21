<?php

class ControladorAdministradores{

	/*=================================================
	INGRESO DE ADMINISTRADOR
	=================================================*/

	public function ctrIngresoAdministrador(){

		if(isset($_POST["ingEmail"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

				#$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "administrador";
				$item = "email";
				$valor = $_POST["ingEmail"];

				$respuesta = ModeloAdministradores::mdlMostrarAdministradores($tabla, $item, $valor);

				if($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $_POST["ingPassword"]){

					$_SESSION["validarSesionBackend"] = "ok";
					$_SESSION["id"] = $respuesta["id"];
					$_SESSION["nombre"] = $respuesta["nombre"];
					$_SESSION["foto"] = $respuesta["foto"];
					$_SESSION["email"] = $respuesta["email"];
					$_SESSION["password"] = $respuesta["password"];
					$_SESSION["perfil"] = $respuesta["perfil"];

					echo '<script>
						
						window.location = "inicio";
						
					</script>';

				}else{

					echo '<br>
					<div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>
					';

				}
			}

		}

	}

}