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
                          <h1 class="box-title">Socio <button class="btn btn-success" onclick="mostrarFormulario(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive"  id="listadoRegistros">
                    <table id="tbllistado" class="table table-striped table-border table-condensed table-hover">
                        <thead>
                        <th>Opciones </th>
                        <th>Rut </th>
                        <th>Dv</th>
                        <th>Nombre </th>
                        <th>Fecha Ingreso</th>
                        <th>Telefono</th>
                        <th> Estado</th>
                        <th>User type</th>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <th>Opciones </th>
                        <th>Rut </th>
                        <th>Dv</th>
                        <th>Nombre </th>
                        <th>Fecha Ingreso</th>
                        <th>Telefono</th>
                        <th> Estado</th>
                        <th>User type</th>                        
                        </tfoot>
                    </table>
                                            
                    </div>
                    <div class="panel-body" style="height: 400px;"  id="formularioregistros">
                    <form name="formulario" id="formulario" method="POST" >
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                           <!-- <input type="hidden" name="rut_soc" id="rutsocio">-->
                            
                            <label >Rut :</label>
                            <input type="text" class="form-control" name="rut_soc" id="rut_soc" maxlength="50" placeholder="Rut Socio">

                        </div>


                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                         <label >Dv:</label>
                          <input type="text" class="form-control" name="dv_soc" id="dv_soc" maxlength="50" > 

                        </div>

             
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                            <label >nombre socio :</label>
                             <input type="text" class="form-control" name="nombre" id="nombre" maxlength="50" placeholder="Nombre Socio">                            
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                             
                             <label >Fecha Ingreso :</label>
                             <input type="date" name="fechaIngreso" class="form-control" id="fechaIngreso">
                        </div>
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >                            
                             <label >region :</label>
                            <input type="text" name="region" maxlength="50" id="region" class="form-control" placeholder="region Socio">

                        </div>
                            
                         <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                            <label >telefono :</label>
                            <input type="text" name="telefono" id="telefono"  maxlength="50"  class="form-control"placeholder="telefono Socio">

                         </div>                  
                        
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                            <label >Estado :</label>
                           <input type="text"  class="form-control" name="estado" id="estado" maxlength="50" placeholder="Estado Socio">
                        </div>
                            
                        <div class="form-group col-md-6 col-lg-6 col-sm-6 col-xs-12" >
                          
                             <label >User Type :</label>
                            <input type="text" name="user_type" class="form-control" id="user_type" maxlength="50">

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
<script src="scripts/socio.js"></script>