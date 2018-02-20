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
                          <h1 class="box-title">Gaas <button class="btn btn-success" onclick="mostrarFormulario(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive"  id="listadoRegistros">
                    <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                        <thead>
                       
                        <th>descripcion_gas </th>
                        <th>kilos</th>
                        <th>valor </th>
                        <th>imagen </th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                       
                        <th>descripcion_gas </th>
                        <th>kilos</th>
                        <th>valor </th>
                        <th>imagen </th>
                                           
                        </tfoot>
                    </table>
                                            
                    </div>
                    <div class="panel-body" style="height: 400px;"  id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST" >
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                         <input type="hidden" name="id_gas" id="id_gas">
                            
                            <label >descripcion_gas :</label>
                            <input type="text" class="form-control" name="descripcion_gas" id="descripcion_gas" maxlength="50" placeholder="Rut Socio">

                        </div>


                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                         <label >kilos:</label>
                          <input type="text" class="form-control" name="kilos" id="kilos" maxlength="50" > 

                        </div>

             
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                            <label >valor :</label>
                             <input type="text" class="form-control" name="valor" id="valor" maxlength="50" placeholder="Nombre Socio">                            
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                             
                             <label >imagen :</label>
                             <input type="file" name="imagen" class="form-control" id="imagen">
                        </div>
                   

                        <div class="form-group col-md-12 col-lg-12 col-sm-12 col-xs-12" >
                            <button class="btn btn-primary" type="submit" id="btnGuardar">
                                <i class="fa fa-save">Guardar</i>
                            </button>

                             <button class="btn btn-danger" onclick="cancelarForm()" type="button">
                                <i class="fa fa-arrow-circle-left">Cancelar</i>
                            </button>
                            <button class="btn btn-danger" type="submit" type="button">
                                <i class="fa fa-arrow-circle-left">Editar</i>
                            </button>
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
<script src="scripts/gas.js"></script>