<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> <?php echo $titulo; ?> </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin">Inicio</a></li>
                    <li class="breadcrumb-item active">Password</li>
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

                        <input type="hidden" id="ClienteID" value="<?php echo $editar[0]; ?>">
                        <input type="hidden" id="passhidden" value="<?php echo $editar[8]; ?>">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passactual">Password actual</label> <span id="passactual_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" type="password" name="passactual" class="form-control" id="passactual" placeholder="Ingrese password actual" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="passnew">Nuevo password</label> <span id="passnew_olbligg" style="color: red;"></span>
                                    <input autocomplete="off" type="password" name="passnew" class="form-control" id="passnew" placeholder="Ingrese password nuevo" maxlength="80">
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group text-center">
                                    <label>Ver </label> <br>
                                    <button class="btn btn-success" onclick="mostrar_usu();"><i class="fa fa-eye"></i></button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <?php echo $accion; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>public/js/tienda.js"></script>

<script>
    function mostrar_usu() {
        var ver = document.getElementById("passactual");
        var con = document.getElementById("passnew");

        if (ver.type == "password") {
            ver.type = "text";
            con.type = "text";
        } else {
            ver.type = "password";
            con.type = "password";
        }
    }
</script>