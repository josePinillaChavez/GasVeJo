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
                            <th>login</th>
                            <th>clave</th>
                            <th>imagen</th>
                                <th>condicion </th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                           <th>Opciones</th>
                            <th>login</th>
                            <th>clave</th>
                            <th>imagen</th>
                                <th>condicion </th>
                          </tfoot>
                        </table>
                    </div>
                     <div class="panel-body" style="height: 400px;" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>login:</label>
                          <input type="hidden" name="id_usuario" id="id_usuario">
                          <input type="text" class="form-control" name="login" id="login" maxlength="100" placeholder="Ingrese login" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>clave:</label>
                          <input type="text" class="form-control" name="clave" id="clave" maxlength="11" placeholder="Ingrese clave" required>
                        </div>
                       
  
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                             <label>Permisos:</label>
                          <ul style="list-style: none;" id ="permisos">

                            
                          </ul>
                        </div>

                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                             
                             <label >imagen :</label>
                             <input type="file" name="imagen" class="form-control" id="imagen">
                             <input type="hidden" name="imagenactual" id="imagenactual">
                             <img src="" width="150px" height="120px" id="imagenmuestra">
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label>condicion:</label>
                          <input type="text" class="form-control" name="condicion" id="condicion" maxlength="11" placeholder="Ingrese condicion" required>
                        </div>
                        <div class="for-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                          <button class="btn btn-danger" onclick="cancelarForm()" type="button" ><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script type="text/javascript" src="scripts/usuario.js"></script>
