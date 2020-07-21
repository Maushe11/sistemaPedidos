<?php



$listaProductos = ControladorPedido::ctrListaProducto();

?>
<script type="text/javascript">
  
function printDiv2(nombreDiv) {

     var contenido= document.getElementById(nombreDiv).innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     //document.body.innerHTML = contenidoOriginal;

     window.location="https://simple-suppliers.com/backend/inicio";
}
</script>
<div class="content-wrapper">

  <section class="content-header">

    <h1>
      Gestor de Pedidos
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Gestor Pedidos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!-- CONTENIDO -->

      <div class="col-md-12">
        
        <!-- USERS LIST -->
        <div class="box">
<script>

</script>
          <!-- box-header -->
            <div class="box-header with-border">
  
              <label for="comment">Filtro por Distrito</label>

              <div class="row">
                <form method="post">
                  <div class="col-md-3">
                    <input type="text"  class="form-control filtro1" name="filtro1" id="filtro" value="" placeholder="distrito1..">
                  </div>
                  <div class="col-md-3">
                    <input type="text"  class="form-control filtro2" name="filtro2" id="filtro" value="" placeholder="distrito2..">
                  </div>
                  <div class="col-md-3">
                    <input type="text"  class="form-control filtro3" name="filtro3" id="filtro" value="" placeholder="distrito3..">
                  </div>
                  <div class="col-md-3">
                    <div class="row">
                      <div class="col-md-6">
                        <input type="submit" style="width: 100%;" class="btn btn-secondary" id="filtro" value="Filtrar">
                      </div>
                      <div class="col-md-6">
                        <input type="submit" style="width: 100%;" class="btn btn-secondary" value="Limpiar Filtro">
                      </div>
                    </div>
                  </div>
                </form>
              </div>

            </div>
            <!-- /.box-header -->



<?php

@$distrito1 = $_POST["filtro1"];
@$distrito2 = $_POST["filtro2"];
@$distrito3 = $_POST["filtro3"];


$pedidos = ControladorPedido::ctrMostrarPedidoFiltro($distrito1,$distrito2,$distrito3);

?>
            <!-- box-body -->
            <div class="box-body row" id="imprimirGestor">

              <div class="col-xs-7" style="margin-top:5px;"> 
                
                <table class="table" style="margin-top:17px; font-size:12px;">
                  <thead>
                    <tr>
                      <th scope="col">Sku</th>
                      <th scope="col">Producto</th>
                      <th scope="col">Precio<br>Compra</th>
                      <th scope="col">Precio<br>Venta</th>
                      <th scope="col">Utilidades</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $contadorProductos = 0;

                    foreach ($listaProductos as $key => $producto) {
                    
                    $contadorProductos++;
                    if($producto["precioCompra"]=="0.00"){
                      $utilidades = "0.00";
                    }else{
                      $utilidades = number_format($producto["precioVenta"]-$producto["precioCompra"], 2, '.', '');
                    }
                    

                    echo '<tr>
                            <td>'.$producto["sku"].'</td>
                            <td>'.$producto["nombreProducto"].'</td>
                            <td>S/. '.$producto["precioCompra"].'</td>
                            <td>S/. '.$producto["precioVenta"].'</td>
                            <td>S/. '.$utilidades.'</td>
                          </tr>';

                    }
                    ?>
                    
                  </tbody>
                </table>

              </div>

              <script>
                $(function () {
                  $('.wrapper1').on('scroll', function (e) {
                      $('.wrapper2').scrollLeft($('.wrapper1').scrollLeft());
                  });
                
                });
                $(window).on('load', function (e) {
                    $('.div1').width($('.cliente').width());
                    $('.div2').width($('.cliente').width());
                });
              </script>

              <div class="wrapper1" style="width: 33.33333333%;overflow-x: scroll;height: 20px;overflow-y: hidden;">
                <div class="div1" style="height: 20px;"></div>
              </div>

              <div class="col-xs-4 wrapper2" style="overflow-x:scroll;">

              <?php

              $count=0;

              $espacio=0;

              
              
              foreach ($pedidos as $key => $value) {

                $count++;

                $id[]=$value[0];

                $espacio = $espacio +180;
                
                $set[] = $value["apellidos"].'<br>'.$value["distrito"].'<br>'.$value["fecha"];

              }
            


              ?>
                <div class="div2" style="overflow: none;">
                  <?php
                  if($count!=0){
                  ?>
                  <table class="table cliente" style="margin:0; font-size:12px; width:<?php echo $espacio.'px'; ?>">
                    <thead>
                      <tr>
                        <?php
                        foreach ($set as $datos) {
                              
                          echo '<th scope="col" style="line-height: 1;width: 180px;">'.$datos.'</th>';

                        }

                        ?>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php



                      foreach ($listaProductos as $key => $producto2){
                          
                          echo '<tr>'; 

                            foreach ($id as $datosId) {



                              $detalle=ControladorPedido::ctrMostrarDetallePedido($producto2['id'],$datosId);
                            
    
                              foreach ($detalle as $key => $detallePe) {

                                if($detallePe["detalle"]==0){
                                  echo '<td>0</td>';
                                }else{
                                  echo '<td>'.$detallePe["cantidad"].'</td>';
                                }

                              }
                              

                            }

                          echo '</tr>';

                        }

                      ?>
                      
                    </tbody>
                  </table>
                  <?php
                  }else{
                    echo '<h1>No hay ningún pedido</h1>';
                  } 
                  ?>
                </div>
              </div>

              <div class="col-xs-1" style="margin-top:2px;">
                 <table class="table" style=" font-size:12px;">
                  <thead>
                    <tr>
                      <th scope="col" style=""><br>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    foreach ($listaProductos as $key => $producto3){

                      echo '<tr>';

                        $sumas=ControladorPedido::ctrMostrarSumas($producto3['id']);

                        foreach ($sumas as $key => $sumasPe) {

                          if($sumasPe["detalle"]==0){
                            echo '<td>0</td>';
                          }else{
                            echo '<td>'.$sumasPe["suma"].'</td>';
                          }

                        }

                      echo '</tr>';

                    }

                    ?>
                    
                  </tbody>
                </table>
              </div>

            </div>
            <!-- /.box-body -->

            <!-- box-footer -->
            <div class="box-footer text-center">

              <!--<button type="button" id="guardarColores" class="btn btn-primary pull-left" onclick="">Imprimir</button>
            
              <button type="button" id="guardarColores" class="btn btn-primary pull-right">Descargar Excel</button>-->
              <div class="col-md-6">
                  <table class="table">
                  <?php
                    $totalVentas = ControladorPedido::ctrTotalVentas();
                    $totalCompras = ControladorPedido::ctrTotalCompras();
                    
                    foreach ($totalVentas as $key => $toVentas){
                        
                        echo '<tr>
                                <td>
                                <b>Total Venta</b>
                                </td>
                                <td>
                                S/. '.number_format($toVentas["sumaVentas"], 2, '.', '').'
                                </td>
                              </tr>';
                    }
                    
                    foreach ($totalCompras as $key => $toCompras){
                        
                        echo '<tr>
                                <td>
                                <b>Total Compra</b>
                                </td>
                                <td>
                                S/. '.number_format($toCompras["sumaCompras"], 2, '.', '').'
                                </td>
                              </tr>';
                    }
                    
                    $ganancia = number_format(($toVentas["sumaVentas"] - $toCompras["sumaCompras"]), 2, '.', '');
                    
                    echo '<tr>
                            <td>
                            <b>Total Ganancia</b>
                            </td>
                            <td>
                            S/. '.$ganancia.'
                            </td>
                          </tr>';
                
                  ?>
                  
                  </table>
              </div>
          
            </div>
            <!-- /.box-footer -->

        </div>
        <!-- USERS LIST -->

      </div>

    </div>
 
  </section>

</div>