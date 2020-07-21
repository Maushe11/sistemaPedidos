<?php

require_once "../../controladores/pedidos.controlador.php";
require_once "../../modelos/pedidos.modelo.php";

$id = $_GET["id"];


$pedidos2 = ControladorPedido::ctrMostrarPedidoId($id);

foreach ($pedidos2 as $key => $v) {
    
    if($v["estado"]==1){
     echo '<label style="margin-right:20px; background:#ECE80A;padding-left:10px;padding-right:10px;border-radius:5px;">Nuevo</label>';
    }
    if($v["estado"]==2){
     echo '<label style="margin-right:20px; background:#0A76EC;padding-left:10px;padding-right:10px;border-radius:5px;">Proceso</label>';
    }
    if($v["estado"]==3){
     echo '<label style="margin-right:20px; background:#38B81E;padding-left:10px;padding-right:10px;border-radius:5px;">Entregado</label>';
    }

}