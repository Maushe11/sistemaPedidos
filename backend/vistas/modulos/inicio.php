<!--=====================================
PÁGINA DE PEDIDOS
======================================-->
<?php





?>

<script src="vistas/js/xlsx.full.min.js"></script>
<script src="vistas/js/FileSaver.min.js"></script>
<script src="vistas/js/tableexport.min.js"></script>
<!-- content-wrapper -->
<div class="content-wrapper">

  <!-- content-header -->
  <section class="content-header">
    
    <h1>
    Lista de Pedidos
    </h1>

    <div class="box-header with-border">
  
      <label for="comment">Filtro por Fecha</label>

      <div class="row">
        <form method="post">
          <div class="col-md-3 col-xs-12">
            <input type="date" id="" name="fecha" style="width: 100%;padding: 5px;">
          </div>
          <div class="col-md-3 col-xs-12">
            <div class="row">
              <div class="col-md-6">
                <input type="submit" style="width: 100%;background: #DADBDB;" class="btn btn-secondary" id="filtro" value="Filtrar">
              </div>
              <div class="col-md-6">
                <input type="submit" style="width: 100%;background: #DADBDB;" class="btn btn-secondary" value="Limpiar Filtro">
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>

  </section>
  <!-- content-header -->

<?php

@$fecha = $_POST["fecha"];


 $pedidos = ControladorPedido::ctrMostrarPedido($fecha);

?>
<div class="content" style="min-height: 20px;">
  <div class="row">
    <div class="col-md-12">
        <h1 style="text-align: center;margin: 0;">
            <?php
            
            date_default_timezone_set("America/Lima");
            $dActual = date("Y-m-d");
            if($fecha == ""){
              echo "Todos los pedidos";
            }else{
              echo @$fecha; 
            }
            
            ?>
        </h1>
    </div>
  </div>
</div>
  <!-- content -->
  <section class="content">
    
    <!-- row -->
    <div class="row">

    </div>
    <!-- row -->

    <!-- row -->
    <div class="row">

      <!-- PEDIDOS -->

      <?php

        $i=0;

        foreach ($pedidos as $key => $value) {

          $i++;
          
          echo '<div class="col-lg-12">
        
        <!-- USERS LIST -->
        <div class="box box-primary collapsed-box">

          <!-- box-header -->
            <div class="box-header with-border">
          
              <h3 class="box-title"><span style="color:#b3b3b3">PEDIDO '.$value[0].'</span> <span></span></h3>

              <div class="box-tools pull-right">

               <div id="mostrarEstado'.$value[0].'" style="display: inline-block;"></div>';
                
echo '<script>
$("#mostrarEstado'.$value[0].'").load("vistas/modulos/mensajes.php?id='.$value[0].'");
</script>';
                
                echo '<select name="cboEstado'.$value[0].'" id="cboEstado'.$value[0].'">
                    <option value=""></option>
                    <option value="1">Nuevo</option>
                    <option value="2">Proceso</option>
                    <option value="3">Entregado</option>
                  </select>

                  <input type="button" class="btn estado'.$value[0].'" idPedido="'.$value[0].'" style="padding-top:0;padding-bottom:0;" value="Guardar">';

echo '<script>
function registroUsuario'.$value[0].'(){

  var estado = $("#cboEstado'.$value[0].'").val();

  if(estado == ""){
    return false;
  }else{
    return true;
  }

}
$(".estado'.$value[0].'").click(function(){

  var idPedido = $(this).attr("idPedido");
  console.log("idPedido", idPedido);

  var idEstado = $("#cboEstado'.$value[0].'").val();
  console.log("idEstado", idEstado);

  if(idEstado != ""){

    var datos = new FormData();
    datos.append("idPedido", idPedido);
    datos.append("idEstado", idEstado);

    $.ajax({
      url:"ajax/pedido.ajax.php",
      method:"POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){
        console.log("respuesta",respuesta);
        $("#mostrarEstado'.$value[0].'").load("vistas/modulos/mensajes.php?id='.$value[0].'");
      }

    })

  }

})
</script>';

                echo '

                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
            
              </div>

            </div>
            <!-- /.box-header -->

            <!-- box-body -->
            <div class="box-body">

              <div class="panel panel-default">
        
              
              
              <div class="panel-body" id="areaImprimir'.$i.'">
                
                <div class="form-group row">

                  <div id="datosImprimir'.$i.'">
                  
                    <h2 style="text-align:center;">Pedido '.$value[0].'</h2>

                    <div class="col-md-6 col-xs-12" style="margin-top: 5px;">
                  
                      <label for="comment">Nombre:</label>
          
                      <input type="text" readonly="readonly" class="form-control" id="" value="'.$value["nombres"].' '.$value["apellidos"].'">

                    </div>

                    <div class="col-md-6 col-xs-12" style="margin-top: 5px;">

                      <label for="comment">Direccion de Entrega:</label>
              
                      <input type="text" readonly="readonly" class="form-control" id="" value="'.$value["direccion"].' - '.$value["distrito"].'">

                    </div>

                    <div class="col-md-6 col-xs-12" style="margin-top: 5px;">

                      <label for="comment">Teléfono o Celular:</label>
              
                      <input type="text" readonly="readonly" class="form-control" id="llaveSecretaPaypal" value="'.$value["telefono"].'">

                    </div>

                    <div class="col-md-6 col-xs-12" style="margin-top: 5px;margin-bottom: 10px;">

                      <label for="comment">Fecha de Pedido:</label>
              
                      <input type="text" readonly="readonly" class="form-control" id="llaveSecretaPaypal" value="'.$value["fechaRegistrada"].'">

                    </div>

                  </div>

                  <div class="col-md-12" style="margin-top: 15px;">
                    
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col"></th>
                          <th scope="col">Sku</th>
                          <th scope="col">Producto</th>
                          <th scope="col" style="text-align: center;">Precio</th>
                          <th scope="col" style="text-align: center;">Cantidad</th>
                          <th scope="col" style="text-align: center;">SubTotal</th>
                        </tr>
                      </thead>
                      <tbody>';

                      $idPedido = $value[0];

                      $productos = ControladorPedido::ctrMostrarProducto($idPedido);

                      $cantidad=0;

                      foreach ($productos as $key2 => $value2) {
                        $cantidad++;
                        echo'<tr>
                              <th scope="row">'.$cantidad.'</th>
                              <td>'.$value2["detalleSku"].'</td>
                              <td>'.$value2["detalleNomPro"].'</td>
                              <td style="text-align: center;">'.$value2["detallePrecioVenta"].'</td>
                              <td style="text-align: center;">'.$value2["cantidad"].'</td>
                              <td style="text-align: center;">'.number_format($value2["detallePrecioVenta"]*$value2["cantidad"], 2, '.', '').'</td>
                            </tr>
                            <tr>';

                      }
                        echo '<tr>
                          <td colspan="4"></td>
                          <th style="text-align: center;">Total</th>
                          <th style="text-align: center;">'.$value["precioTotal"].'</th>
                        </tr>
                      </tbody>
                    </table>
                    
<table border="1" id="tabla'.$i.'" style="display:none">
<tr>
  <td colspan="6">
Pedido  '.$value[0].'<br>
Nombre: '.$value["nombres"].' '.$value["apellidos"].'<br>
Direccion de Entrega: '.$value["direccion"].' - '.$value["distrito"].'<br>
Teléfono o Celular: '.$value["telefono"].'<br>
Fecha de Pedido: '.$value["fechaRegistrada"].'<br>
  </td>
</tr>
<tr><td></td></tr>
<tbody>
  <tr>
    <td></td>
    <td>Sku</td>
    <td>Producto</td>
    <td>Precio</td>
    <td>Cantidad</td>
    <td>SubTotal</td>
  </tr>';
$cantSumada = 0;
foreach ($productos as $key3 => $value3) {
  $cantSumada++;
  echo '<tr>
    <td>'.$cantSumada.'</td>
    <td>'.$value3["sku"].'</td>
    <td>'.$value3["nombreProducto"].'</td>
    <td>'.$value3["precioVenta"].'</td>
    <td>'.$value3["cantidad"].'</td>
    <td>'.number_format($value3["precioVenta"]*$value3["cantidad"], 2, '.', '').'</td>
  </tr>';
}

echo '<tr>
      <td colspan="4"></td>
      <th>Total</th>
      <th>'.$value["precioTotal"].'</th>
    </tr>
</tbody>

</table>

                  </div>

                </div>

              </div>

              </div>

            </div>
            <!-- /.box-body -->
<script>
    function exportar'.$i.'(){

        const $tabla = document.querySelector("#tabla'.$i.'");

            let tableExport = new TableExport($tabla, {
                exportButtons: false, // No queremos botones
                filename: "descarga'.$i.'", //Nombre del archivo de Excel
                sheetname: "descarga'.$i.'", //Título de la hoja
            });
            let datos = tableExport.getExportData();
            let preferenciasDocumento = datos.tabla'.$i.'.xlsx;
            tableExport.export2file(preferenciasDocumento.data, preferenciasDocumento.mimeType, preferenciasDocumento.filename, preferenciasDocumento.fileExtension, preferenciasDocumento.merges, preferenciasDocumento.RTL, preferenciasDocumento.sheetname);
        
    }
</script>
            <!-- box-footer -->
            <div class="box-footer text-center">'; 

            $print1 = "printDiv('areaImprimir".$i."')";

            $print2 = "printDiv('datosImprimir".$i."')";
            
            $exportar = "exportar".$i."()";

              echo '<button type="button" id="guardarColores" class="btn btn-primary pull-left" onclick="'.$print1.'">Imprimir Recibo</button>

              <button type="button" id="guardarColores" class="btn btn-primary pull-center" onclick="'.$print2.'">Imprimir Datos</button>
            
              <button type="button" class="btn btn-primary pull-right" onclick="'.$exportar.'">Descargar Excel</button>';

          
      echo '</div>
            <!-- /.box-footer -->

        </div>
        <!-- USERS LIST -->

      </div>';



        }

      ?>

    </div>
    <!-- row -->

 </section>
  <!-- content -->

</div>
<!-- content-wrapper -->