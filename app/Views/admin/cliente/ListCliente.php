<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> <i class="fa fa-users"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado de clientes</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b><?php echo $texto; ?></b> </h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-center">

                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Correo</th>
                                                <th>Cedula</th>
                                                <th>Sexo</th>
                                                <th>Direccion</th>
                                                <th>Telefono</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListaCliente) && is_array($ListaCliente)) {
                                                foreach ($ListaCliente as $ListaCliente_item) { ?>

                                                    <tr class="odd">
                                                        <td>
                                                            <?php if ($ListaCliente_item["estado"] == "1") {     ?>
                                                                <a onclick="EstadoCliente(<?php echo $ListaCliente_item['id']; ?>, '0', '<?php echo $valorr; ?>');" class='btn btn-danger btn-sm' title='Inactivar el usuario'><i class='fa fa-times'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/cliente/edit/<?php echo $ListaCliente_item['id']; ?>/<?php echo $valorr; ?>');" class='editar btn btn-primary btn-sm' title='Editar el usuario'><i class='fa fa-edit'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="EstadoCliente(<?php echo $ListaCliente_item['id']; ?>, '1', '<?php echo $valorr; ?>');" class='btn btn-success btn-sm' title='Activar el usuario'><i class='fa fa-check'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/EditarUsuario/<?php echo $ListaCliente_item['id']; ?>/<?php echo $valorr; ?>');" class='editar btn btn-primary btn-sm' title='Editar el usuario'><i class='fa fa-edit'></i></button>
                                                                <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListaCliente_item["nombre"]); ?></td>
                                                        <td><?= esc($ListaCliente_item["apellidos"]); ?></td>
                                                        <td><?= esc($ListaCliente_item["correo"]); ?></td>
                                                        <td><?= esc($ListaCliente_item["cedula"]); ?></td>
                                                        <td><span class="badge badge-warning"><?= esc($ListaCliente_item["sexo"]); ?></span> </td>
                                                        <td><?= esc($ListaCliente_item["direccion"]); ?></td>
                                                        <td><?= esc($ListaCliente_item["telefono"]); ?></td>
                                                        <td>
                                                            <?php if ($ListaCliente_item["estado"] == "1") {     ?>
                                                                <span class="badge badge-success">Activo</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-danger">Inactivo</span>
                                                            <?php   } ?>
                                                        </td>
                                                    </tr>

                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                <span style="font-size: 20px;" class="badge badge-warning">No hay clientes disponibles</span>
                                                    <br>
                                                </tr>

                                            <?php }
                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Correo</th>
                                                <th>Cedula</th>
                                                <th>Sexo</th>
                                                <th>Direccion</th>
                                                <th>Telefono</th>
                                                <th>Estado</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/cliente.js"></script>
