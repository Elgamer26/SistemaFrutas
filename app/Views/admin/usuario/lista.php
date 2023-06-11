<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Listado de usuarios <i class="fa fa-users"></i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado de usuarios</li>
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
                        <h3 class="card-title"><b>Listado de usuarios</b>
                            - <a class="btn btn-success btn-sm" onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/UsuariosAccion/create');">
                                Nuevo usuario <i class="fa fa-plus"></i></a></h3>
                    </div>
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                                <div class="col-sm-12 text-center table-responsive ">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Opción</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Correo</th>
                                                <th>Cedula</th>
                                                <th>Rol</th>
                                                <th>Usuario</th>
                                                <th>Foto</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($ListaUsuario) && is_array($ListaUsuario)) {
                                                foreach ($ListaUsuario as $ListaUsuario_item) { ?>

                                                    <tr class="odd">
                                                        <td>
                                                            <?php if ($ListaUsuario_item["estado"] == "1") {     ?>
                                                                <a onclick="EstadoUsuario(<?php echo $ListaUsuario_item['id']; ?>, '0');" class='btn btn-danger btn-sm' title='Inactivar el usuario'><i class='fa fa-times'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/EditarUsuario/<?php echo $ListaUsuario_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el usuario'><i class='fa fa-edit'></i></a>
                                                            <?php   } else {     ?>
                                                                <a onclick="EstadoUsuario(<?php echo $ListaUsuario_item['id']; ?>, '1');" class='btn btn-success btn-sm' title='Activar el usuario'><i class='fa fa-check'></i></a>-
                                                                <a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/EditarUsuario/<?php echo $ListaUsuario_item['id']; ?>');" class='editar btn btn-primary btn-sm' title='Editar el usuario'><i class='fa fa-edit'></i></button>
                                                                <?php   } ?>
                                                        </td>

                                                        <td><?= esc($ListaUsuario_item["nombres"]); ?></td>
                                                        <td><?= esc($ListaUsuario_item["apellidos"]); ?></td>
                                                        <td><?= esc($ListaUsuario_item["correo"]); ?></td>
                                                        <td><?= esc($ListaUsuario_item["cedula"]); ?></td>
                                                        <td><span class="badge badge-warning"><?= esc($ListaUsuario_item["rol"]); ?></span> </td>
                                                        <td><?= esc($ListaUsuario_item["usuario"]); ?></td>
                                                        <td><a onclick="cargar_contenido('contenido_principal','<?php echo base_url(); ?>admin/EditarUsuarioFoto/<?php echo $ListaUsuario_item['id']; ?>');" style="border: none; border-radius: 50px;" title="Ver Imagen"><img style='border-radius: 50px;' src='<?php echo base_url(); ?>public/img/usuario/<?= esc($ListaUsuario_item["foto"]); ?>' width='45px' /></a></td>
                                                        <td>
                                                            <?php if ($ListaUsuario_item["estado"] == "1") {     ?>
                                                                <span class="badge badge-success">Activo</span>
                                                            <?php   } else {     ?>
                                                                <span class="badge badge-danger">Inactivo</span>
                                                            <?php   } ?>
                                                        </td>
                                                    </tr>

                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    No hay roles disponibles
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
                                                <th>Rol</th>
                                                <th>Usuario</th>
                                                <th>Foto</th>
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

<script src="<?php echo base_url(); ?>public/js/usuario.js"></script>

<div class="modal fade" id="modal_editar_photo">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: orange;">
                <h5 class="modal-title" id="modal_eitar_rolLabel"><b>Editar foto usuario <i class="fa fa-image"></i></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <input type="number" id="id_foto_producto">
                        <div class="col-md-12 mb-3 form-group">
                            <div class="ibox-body text-center">

                                <img id="foto_producto" style="border-radius: 25%;" white="350px" height="350px">
                                <h5 class="font-strong m-b-10 m-t-10"><span>Foto de usuario</span></h5>
                                <div>
                                    <input type="file" id="foto_new" class="form-control" onchange="mostrar_imagenEdit(this)">
                                    <input type="text" id="foto_actu">
                                    <br>
                                    <button class="btn btn-info btn-rounded mb-3" onclick="EditarFotoUsuario();"><i class="fa fa-plus"></i> Cambiar foto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrar_imagenEdit(input) {
        var filename = document.getElementById("foto_new").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {

            if (input.files) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#foto_producto").attr("src", e.target.result).height(350).width(350);
                }
                reader.readAsDataURL(input.files[0]);
            }

        } else {
            return swal.fire(
                "Mensaje de alerta",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
        }

    }

    $(document).ready(function() {
        $('#example2').DataTable({
            language: {
                rows: "%d fila seleccionada",
                processing: "Tratamiento en curso...",
                search: "Buscar&nbsp;:",
                lengthMenu: "Agrupar en _MENU_ items",
                info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
                infoEmpty: "No existe datos.",
                infoFiltered: "(filtrado de _MAX_ elementos en total)",
                infoPostFix: "",
                loadingRecords: "Cargando...",
                zeroRecords: "No se encontro resultados en tu busqueda",
                emptyTable: "No hay datos disponibles en la tabla",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Ultimo",
                },
                select: {
                    rows: "%d fila seleccionada",
                },
                aria: {
                    sortAscending: ": active para ordenar la columa en orden ascendente",
                    sortDescending: ": active para ordenar la columna en orden descendente",
                },
            },
        });
    });
</script>