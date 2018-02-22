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
                          <h1 class="box-title">Gas <button class="btn btn-success" id="btnAgregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Descripcion</th>
                            <th>kilos</th>
                            <th>Valor</th>
                                <th>imagen </th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Descripcion</th>
                            <th>kilos</th>
                            <th>Valor</th>
                                <th>imagen </th>
                          </tfoot>
                        </table>
                    </div>
                     <div class="panel-body" style="height: 400px;" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Descripcion:</label>
                          <input type="hidden" name="id_gas" id="id_gas">
                          <input type="text" class="form-control" name="descripcion_gas" id="descripcion_gas" maxlength="100" placeholder="Ingrese descripcion" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>kilos:</label>
                          <input type="text" class="form-control" name="kilos" id="kilos" maxlength="11" placeholder="Ingrese kilos" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>Valor:</label>
                          <input type="text" class="form-control" name="valor" id="valor" maxlength="11" placeholder="Ingrese valor" required>
                        </div>

                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                             
                             <label >imagen :</label>
                             <input type="file" name="imagen" class="form-control" id="imagen">
                             <input type="hidden" name="imagenactual" id="imagenactual">
                             <img src="" width="150px" height="120px" id="imagenmuestra">
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
<script type="text/javascript" src="scripts/gas.js"></script>
