<?php
require 'header.php'; 
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Pedido <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Cantidad</th>
                            <th>Total del pedido</th>
                            <th>Total de kilos pedidos</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Gas</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Cantidad</th>
                            <th>Total del pedido</th>
                            <th>Total de kilos pedidos</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Gas</th>
                          </tfoot>
                        </table>
                    </div>
                     <div class="panel-body"  id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Cantidad:</label>
                          <input type="hidden" name="id_pedido" id="id_pedido">
                          <input type="number" class="form-control" name="cantidad" id="cantidad" maxlength="100" placeholder="Ingrese cantidad" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Total del Pedido:</label>
                          
                          <input type="number" class="form-control" name="total_pedido" id="total_pedido" maxlength="11" placeholder="Ingrese el total del pedido" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Total kilos pedidos:</label>
                          <input type="number" class="form-control" name="total_kilos_pedidos" id="total_kilos_pedidos" maxlength="11" placeholder="Ingrese total de kilos pedidos" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Estado:</label>
                          <input type="text" class="form-control" name="estado" id="estado" maxlength="11" placeholder="Ingrese estado" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Usuario:</label>
                          <input type="text" class="form-control" name="usuario_id_usuario" id="usuario_id_usuario" maxlength="11" placeholder="Ingrese usuario" required>
                          
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Gas:</label>
                           <select name="gas_id_gas" id="gas_id_gas" class="form-control selectpicker" data-live-search="true" required></select>
                        </div>
                      
                        <div class="for-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                          <button class="btn btn-danger" onclick="cancelarform()" type="button" ><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                      </form>
                        
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

<?php 
require 'footer.php';

?>
<script type="text/javascript" src="scripts/pedido.js"></script>
