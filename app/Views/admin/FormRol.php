 <section class="content-header">
     <div class="container-fluid">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1> <?php echo $titulo; ?> </h1>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                     <li class="breadcrumb-item"><a href="#" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/rolesuser/list');">Listado Rol</a></li>
                     <li class="breadcrumb-item active">Formulario Rol</li>
                 </ol>
             </div>
         </div>
     </div>
 </section>

 <section class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-md-12">
                 <div class="card card-<?php echo $color; ?>">
                     <div class="card-header">
                         <h3 class="card-title"><b><?php echo $texto; ?></b></h3>
                     </div>
                     
                         <div class="card-body">

                             <div class="form-group">
                                 <label for="nombrerol">Nombre del rol</label>  <span id="rol_olbligg" style="color: red;"></span>
                                 <input onkeypress="return soloLetras(event)" autocomplete="off" value="<?php echo $editar[1]; ?>" type="text" name="nombrerol" class="form-control" id="nombrerol" placeholder="Nombre del rol" maxlength="50">
                             </div>

                         </div>
                         <div class="card-footer">
                             <?php echo $accion; ?> - <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/rolesuser/list');" class='btn btn-danger'>Volver</a>
                         </div>
                  
                 </div>
             </div>
         </div>
     </div>
 </section>
 
 <script src="<?php echo base_url(); ?>public/js/usuario.js"></script>